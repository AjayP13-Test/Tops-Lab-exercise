<?php
// db.php
$conn = new mysqli("localhost", "root", "", "product_catalog");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">

<div class="container my-5">
    <h1 class="text-center mb-4">Product Catalog</h1>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $row['name']; ?></h5>
                    <p class="card-text"><?php echo $row['description']; ?></p>
                    <p class="text-primary fw-bold">₹<?php echo number_format($row['price'], 2); ?></p>
                    <button class="btn btn-primary">Buy Now</button>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>
