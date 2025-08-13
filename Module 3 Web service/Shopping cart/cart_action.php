<?php
include 'db.php';

// Add product to cart
if (isset($_POST['add_to_cart'])) {
    $item = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity']
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // If item already in cart, update quantity
    $found = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $item['id']) {
            $cartItem['quantity'] += $item['quantity'];
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    header("Location: cart.php");
    exit;
}

// Update quantities
if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $id => $qty) {
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['id'] == $id) {
                $cartItem['quantity'] = $qty;
                break;
            }
        }
    }
    header("Location: cart.php");
    exit;
}

// Remove product
if (isset($_GET['remove'])) {
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['id'] == $_GET['remove']) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex array
    header("Location: cart.php");
    exit;
}
?>
