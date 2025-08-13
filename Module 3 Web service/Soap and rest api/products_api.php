<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

// Connect to SQLite database (create if not exists)
$db = new PDO('sqlite:' . __DIR__ . '/products.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create table if not exists
$db->exec("CREATE TABLE IF NOT EXISTS products (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    price REAL NOT NULL,
    description TEXT
)");

switch ($method) {
    case 'GET':
        // Read - get all or one product
        if (isset($_GET['id'])) {
            $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($product) {
                echo json_encode($product);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Product not found']);
            }
        } else {
            $stmt = $db->query("SELECT * FROM products");
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($products);
        }
        break;

    case 'POST':
        // Create new product
        if (!empty($input['name']) && isset($input['price'])) {
            $stmt = $db->prepare("INSERT INTO products (name, price, description) VALUES (?, ?, ?)");
            $stmt->execute([
                $input['name'],
                $input['price'],
                $input['description'] ?? null
            ]);
            $id = $db->lastInsertId();
            http_response_code(201);
            echo json_encode(['message' => 'Product created', 'id' => $id]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing required fields']);
        }
        break;

    case 'PUT':
        // Update product by id
        if (isset($_GET['id']) && !empty($input)) {
            $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$product) {
                http_response_code(404);
                echo json_encode(['error' => 'Product not found']);
                exit;
            }

            $name = $input['name'] ?? $product['name'];
            $price = $input['price'] ?? $product['price'];
            $description = $input['description'] ?? $product['description'];

            $stmt = $db->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
            $stmt->execute([$name, $price, $description, $_GET['id']]);

            echo json_encode(['message' => 'Product updated']);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing product ID or data']);
        }
        break;

    case 'DELETE':
        // Delete product by id
        if (isset($_GET['id'])) {
            $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            if ($stmt->rowCount()) {
                echo json_encode(['message' => 'Product deleted']);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Product not found']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Missing product ID']);
        }
        break;

    case 'OPTIONS':
        // Preflight request for CORS
        http_response_code(200);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
        break;
}
