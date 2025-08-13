<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container my-4">
    <h2>Shopping Cart</h2>
    <a href="products.php" class="btn btn-secondary mb-3">Continue Shopping</a>

    <?php if (!empty($_SESSION['cart'])): ?>
    <form method="post" action="cart_action.php">
        <table class="table table-bordered">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php
            $grandTotal = 0;
            foreach ($_SESSION['cart'] as $item):
                $total = $item['price'] * $item['quantity'];
                $grandTotal += $total;
            ?>
            <tr>
                <td><?php echo $item['name']; ?></td>
                <td>₹<?php echo number_format($item['price'], 2); ?></td>
                <td>
                    <input type="number" name="quantities[<?php echo $item['id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1" class="form-control">
                </td>
                <td>₹<?php echo number_format($total, 2); ?></td>
                <td>
                    <a href="cart_action.php?remove=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Remove</a>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                <td colspan="2"><strong>₹<?php echo number_format($grandTotal, 2); ?></strong></td>
            </tr>
        </table>
        <button type="submit" name="update_cart" class="btn btn-primary">Update Cart</button>
    </form>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>
</body>
</html>
