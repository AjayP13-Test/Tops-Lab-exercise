<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

$mysqli = new mysqli("localhost", "root", "", "rest_api_demo");
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'] ?? '', '/'));
$id = $request[0] ?? null;

// GET all or single product
if ($method === 'GET') {
    if ($id) {
        $stmt = $mysqli->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        if ($result) {
            echo json_encode($result);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Product not found"]);
        }
    } else {
        $result = $mysqli->query("SELECT * FROM products")->fetch_all(MYSQLI_ASSOC);
        echo json_encode($result);
    }
}

// POST → create
if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!isset($data['name'], $data['price'])) {
        http_response_code(400);
        echo json_encode(["error" => "Name and price required"]);
        exit;
    }
    $stmt = $mysqli->prepare("INSERT INTO products (name, description, price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $data['name'], $data['description'], $data['price']);
    $stmt->execute();
    http_response_code(201);
    echo json_encode(["message" => "Product created", "id" => $mysqli->insert_id]);
}

// PUT → update
if ($method === 'PUT' && $id) {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $mysqli->prepare("UPDATE products SET name=?, description=?, price=? WHERE id=?");
    $stmt->bind_param("ssdi", $data['name'], $data['description'], $data['price'], $id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Product updated"]);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Update failed"]);
    }
}

// DELETE → remove
if ($method === 'DELETE' && $id) {
    $stmt = $mysqli->prepare("DELETE FROM products WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "Product deleted"]);
    } else {
        http_response_code(400);
        echo json_encode(["error" => "Delete failed"]);
    }
}
?>
