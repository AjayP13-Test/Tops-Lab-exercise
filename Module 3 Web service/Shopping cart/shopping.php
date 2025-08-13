<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <h2 class="mb-4">Product List</h2>
    <a href="cart.php" class="btn btn-success mb-3">View Cart</a>
    <div class="row">
        <?php
        $result = $conn->query("SELECT * FROM products");
        while ($row = $result->fetch_assoc()):
        ?>
        <div class="col-md-4">
            <div class="card mb-4">
                <img src="<?php echo $row['image_url']; ?>" class="card-img-top" style="height:200px;object-fit:cover;">
                <div class="card-body">
                    <h5><?php echo $row['name']; ?></h5>
                    <p>₹<?php echo number_format($row['price'], 2); ?></p>
                    <form method="post" action="cart_action.php">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $row['name']; ?>">
                        <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                        <input type="number" name="quantity" value="1" min="1" class="form-control mb-2">
                        <button type="submit" name="add_to_cart" class="btn btn-primary w-100">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</div>
</body>
</html>
