<?php
session_start();
include("connect/config.php"); // Include database connection settings

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check database connection
if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Check if the customer is logged in
if (!isset($_SESSION['cusID'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Retrieve the customer ID from the session
$customer_id = $_SESSION['cusID'];

// Debugging session variable
echo "Customer ID: " . $customer_id . "<br>";

// Fetch orders with their products
//$order_id = $_GET['order_id']; // assuming the order ID is passed via GET
// $sql = "SELECT o.id, o.user, o.tracking_no, o.total_price, o.date, o.contact, o.country_id, o.state_id, o.city_id, o.postcode, o.address, o.status, 
//               oi.product_id, p.name as product_name, oi.quantity, oi.total_price as item_total_price,
//               c.name as country_name, s.name as state_name, ci.name as city_name, ss.size as shoe_size
//         FROM orders o
//         JOIN order_items oi ON o.id = oi.order_id
//         JOIN products p ON oi.product_id = p.id
//         JOIN countries c ON o.country_id = c.id
//         JOIN states s ON o.state_id = s.id
//         JOIN cities ci ON o.city_id = ci.id
//         JOIN shoe_size ss ON oi.size_id = ss.id
//         WHERE o.id = ?";

// $stmt = $conn->prepare($sql);
// $stmt->bind_param("i", $order_id);
// $stmt->execute();
// $result = $stmt->get_result();

// Prepare and execute the query to fetch orders for the logged-in customer
$query = "SELECT * FROM orders WHERE user = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("i", $customer_id); // Bind the customer ID to the query
    $stmt->execute(); // Execute the query
    $result = $stmt->get_result(); // Get the result set from the executed query

    // Debugging query execution
    if (!$result) {
        die("Query Failed: " . mysqli_error($conn));
    }
} else {
    die("Statement preparation failed: " . mysqli_error($conn));
}
$a=$result;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <!-- Link to the CSS file for styling -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Page icon -->
    <link rel="shortcut icon" href="images/pg-logo.png">
</head>
<body style="background-color: white;">
    <!-- Insert Navbar -->
    <?php include 'nav-footer/nav.php'; ?>
    
    <!-- Container for order history -->
    <div class="container">
       
        <br/><br/>
        <!-- Order History Section -->
        <div class="order-history">
             <h1 style="margin-top: 10px; margin-left: 30px;">Your Order History</h1><br>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Tracking No.</th>
                        <th>Total Price</th>
                        <th>Address</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
              
                    // Check if the query returned any rows
                    if ($a && $a->num_rows > 0) {
                        // Output data of each row
                        while ($row = $a->fetch_assoc()) {
                            // Combine address fields into a single string
                            $fullAddress = htmlspecialchars($row['address']) . ", " . htmlspecialchars($row['postcode']) . ", " . htmlspecialchars($row['city_id']) . ", " . htmlspecialchars($row['state_id']) . ", " . htmlspecialchars($row['country_id']);
                            echo "<tr>
                                    <td>" . htmlspecialchars($row['id']) . "</td>
                                    <td>" . htmlspecialchars($row['tracking_no']) . "</td>
                                    <td>" . htmlspecialchars($row['total_price']) . "</td>
                                    <td>" . htmlspecialchars($fullAddress) . "</td>
                                    <td>" . htmlspecialchars($row['date']) . "</td>
                                    <td>" . htmlspecialchars($row['status']) . "</td>
                                </tr>";
                        }
                    } else {
                        // No orders found for the customer
                        echo "<tr><td colspan='6'><div class='error'>No Orders Found</div></td></tr>";
                    }
                    // Close the statement and the database connection
                    if ($stmt) $stmt->close();
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Insert Footer -->
    <?php include 'nav-footer/footer.php'; ?>
</body>
</html>