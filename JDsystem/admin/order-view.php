<?php
// Database connection
include("../connect/config.php");

// Check if the form has been submitted to update the status
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status in the database
    $update_sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();

    $success = '<div class="success"><strong>Update completed</strong></div>';
    header("refresh:1;url=order-list.php");
}

// Fetch orders with their products
$order_id = $_GET['order_id']; // assuming the order ID is passed via GET
$sql = "SELECT o.id, o.user, o.tracking_no, o.total_price, o.date, o.contact, o.country_id, o.state_id, o.city_id, o.postcode, o.address, o.status, 
               oi.product_id, p.name as product_name, oi.quantity, oi.total_price as item_total_price
        FROM orders o
        JOIN order_items oi ON o.id = oi.order_id
        JOIN products p ON oi.product_id = p.id
        WHERE o.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch order details
$order_details = $result->fetch_all(MYSQLI_ASSOC);

// Fetch the first row to get common order details
$order = $order_details[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Details</title>
  <!-- ======= Styles ====== -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!--page-icon------------>
  <link rel="shortcut icon" href="assets/images/pg-logo.png">

  <style type="text/css">
    h1 {
      text-align: center;
      color: #333;
    }
    .order-summary, .order-items, .customer-details {
      margin-bottom: 20px;
    }
    h2 {
      border-bottom: 2px solid #ddd;
      padding-bottom: 10px;
      color: #666;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table th, table td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: left;
    }
    table thead th {
      background-color: #f8f8f8;
    }
    table tfoot td {
      font-weight: bold;
    }
    @media (max-width: 600px) {
      .container {
        padding: 10px;
      }
      table th, table td {
        padding: 8px;
      }
    }
  </style>
</head>

<body>
  <!-- Cannot be deleted -->
  <div class="container">
    <?php include 'nav.php'; ?>

    <!-- Alert Message -->
    <?php echo $success; ?>
    
    <!-- ================ View Order Details ================= -->
    <div class="container-2">
      <h1>Order Details</h1>
      <div class="order-summary">
        <h2>Order #<?php echo htmlspecialchars($order['id']); ?></h2>
        <div class="row">
          <div class="col-15">
            <label for="date">Date</label>
          </div>
          <div class="col-80">
            <input readonly type="text" id="date" name="date" value="<?php echo htmlspecialchars($order['date']); ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-15">
            <label for="status">Status</label>
          </div>
          <div class="col-80">
            <form method="POST">
              <input type="hidden" name="order_id" value="<?php echo htmlspecialchars($order['id']); ?>">
              <select id="status" name="status">
                <option value="Under Process" <?php if ($order['status'] == 'Under Process') echo 'selected'; ?>>Under Process</option>
                <option value="Shipped" <?php if ($order['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                <option value="Rejected" <?php if ($order['status'] == 'Rejected') echo 'selected'; ?>>Rejected</option>
              </select>
          </div>
        </div>
      </div>
      
      <div class="order-items">
        <h2>Items</h2>
        <table>
          <thead>
            <tr>
              <th>Item</th>
              <th>Quantity</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($order_details as $item) { ?>
            <tr>
              <td><?php echo htmlspecialchars($item['product_name']); ?></td>
              <td><?php echo htmlspecialchars($item['quantity']); ?></td>
              <td><?php echo htmlspecialchars($item['item_total_price']); ?></td>
            </tr>
            <?php } ?>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2">Total</td>
              <td><?php echo htmlspecialchars($order['total_price']); ?></td>
            </tr>
          </tfoot>
        </table>
      </div>
      <br>
      <div class="customer-details">
        <h2>Customer Details</h2>
        <br>
        <div class="row">
          <div class="col-15">
            <label for="name">Name</label>
          </div>
          <div class="col-80">
            <input readonly type="text" id="name" name="name" value="<?php echo htmlspecialchars($order['user']); ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-15">
            <label for="contact">Phone</label>
          </div>
          <div class="col-80">
            <input readonly type="text" id="contact" name="contact" value="<?php echo htmlspecialchars($order['contact']); ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-15">
            <label for="tracking_no">Tracking No.</label>
          </div>
          <div class="col-80">
            <input readonly type="text" id="tracking_no" name="tracking_no" value="<?php echo htmlspecialchars($order['tracking_no']); ?>">
          </div>
        </div>
        <div class="row">
          <div class="col-15">
            <label for="address">Address</label>
          </div>
          <div class="col-80">
            <input readonly type="text" id="address" name="address" value="<?php echo htmlspecialchars($order['address']) . ', ' . htmlspecialchars($order['postcode']); ?>">
          </div>
        </div>
      </div>
      
       <div class="row">
            <div class="col-10">
                <input type="submit" value="Update">
            </div>
        </div>
      </form>
      <div class="row">
        <div class="col-20">
          <a href="order-list.php"><button class="btn-back">Back</button></a>
        </div>
      </div>
    </div>

      <!-- Cannot be deleted -->
      <!-- <div class="main"> in nav.php-->
    </div>
  </div>
</body>
</html>
