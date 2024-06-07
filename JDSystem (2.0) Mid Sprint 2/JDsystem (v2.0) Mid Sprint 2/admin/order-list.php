<?php
// Include the database connection file
include("../connect/config.php");

// Fetch orders with their status and related location data
$sql = "SELECT o.id, o.user, o.tracking_no, o.total_price, o.date, o.address, o.postcode, 
        c.name AS city_name, s.name AS state_name, cn.name AS country_name, o.status
        FROM orders o
        JOIN cities c ON o.city_id = c.id
        JOIN states s ON o.state_id = s.id
        JOIN countries cn ON o.country_id = cn.id
        ORDER BY o.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order List</title>
  <!-- ======= Styles ====== -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!--page-icon------------>
  <link rel="shortcut icon" href="assets/images/pg-logo.png">
</head>

<body>
  <!-- Container -->
  <div class="container">
    <?php include 'nav.php'; ?>
    <!-- Content -->
    <h1 style="margin-top: 10px; margin-left: 30px;">All Orders</h1>
    
    <!-- ================ Order List Section ================ -->
    <div class="list">
      <div class="recentList">
        <table>
          <thead>
            <tr>
              <td>Order ID</td>
              <td>User</td>
              <td>Tracking No.</td>
              <td>Total Price</td>
              <td>Address</td>
              <td>Date</td>
              <td>Status</td>
              <td>Action</td>
            </tr>
          </thead>

          <tbody>
            <?php 
            if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                $address = $row['address'] . ", " . $row['postcode'] . ", " . $row['city_name'] . ", " . $row['state_name'] . ", " . $row['country_name'];
                echo "<tr>
                  <td>" . $row['id'] . "</td>
                  <td>" . $row['user'] . "</td>
                  <td>" . $row['tracking_no'] . "</td>
                  <td>" . $row['total_price'] . "</td>
                  <td>" . $address . "</td>
                  <td>" . $row['date'] . "</td>
                  <td>" . $row['status'] . "</td>
                  <td>
                    <a href='order-view.php?order_id=" . $row['id'] . "'>
                      <button class='view-btn'><ion-icon name='eye-outline'></ion-icon></button>
                    </a>
                  </td>
                </tr>";
              }
            } else {
              echo "<tr><td colspan='8'><div class='error'>No Order</div></td></tr>";
            }
            $conn->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
