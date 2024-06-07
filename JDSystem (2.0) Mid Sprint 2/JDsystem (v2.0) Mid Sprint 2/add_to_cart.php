<?php
session_start();
include("connect/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['cusID'];
    $product_id = intval($_POST['id']);
    $quantity = intval($_POST['quantity']);
    $size = $_POST['size'];

    // Check if cart item already exists
    $query = "SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $product_id AND size = '$size'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Update quantity if item exists
        $query = "UPDATE cart_items SET quantity = quantity + $quantity WHERE user_id = $user_id AND product_id = $product_id AND size = '$size'";
    } else {
        // Insert new cart item
        $query = "INSERT INTO cart_items (user_id, product_id, quantity, size) VALUES ($user_id, $product_id, $quantity, '$size')";
    }

    if (mysqli_query($conn, $query)) {
        // Fetch the updated cart items
        $cart_query = "SELECT cart_items.*, products.name, products.description, products.price, products.img 
                       FROM cart_items 
                       JOIN products ON cart_items.product_id = products.id 
                       WHERE user_id = '$user_id'";
        $cart_result = mysqli_query($conn, $cart_query);
        $cart_items = [];
        while ($row = mysqli_fetch_assoc($cart_result)) {
            $cart_items[] = $row;
        }
        $_SESSION["cart"] = $cart_items;

        echo json_encode(['success' => true, 'cart' => $cart_items]);
    } else {
        echo json_encode(['success' => false, 'error' => mysqli_error($conn)]);
    }
}
?>
