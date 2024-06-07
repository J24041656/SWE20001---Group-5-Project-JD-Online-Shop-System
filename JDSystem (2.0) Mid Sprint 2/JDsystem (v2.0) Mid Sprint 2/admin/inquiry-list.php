<!--All Code below written by joshua on 30/5/2024-->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inquiry List</title>
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
        <h1 style="margin-top: 10px; margin-left: 30px;">All Inquiries</h1>
        
        <!-- ================ Inquiry List Section ================ -->
        <div class="list">
            <div class="recentList">
                <table>
                    <thead>
                        <tr>
                        <td>ID</td>
                        <td>Username</td>
                        <td>Email</td>
                        <td>Contact No.</td>
                        <td>Message</td>
                        <td>Date</td>
                        <td>Status</td>
                        <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Include the database connection file
                            include("../connect/config.php");

                            // Fetch inquiries data from database
                            $sql = "SELECT * FROM contact_us";
                            
                            
                            $result = mysqli_query($conn, $sql);
                            
                            if (mysqli_num_rows($result) > 0) {
                            
                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                 <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['name']; ?></td>
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['message']; ?></td>
                                    <td><?php echo $row['datetime']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    
                                    <td>
                                        <!--<a href="delete-inquiry.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this inquiry?');" class="link">
                                            <button class="delete-btn"><ion-icon name="trash-outline"></ion-icon></button>
                                        </a>-->
                                        <!--<a href="edit-product.php?product_upd=<?php echo $row['id']; ?>"><button class="edit-btn"><ion-icon name="create-outline"></ion-icon></ion-icon></button></a>-->
                                                            
                                    </td>
                                </tr>
                                <?php
                                }
                            } else {
                                echo "<tr><td colspan='10'>No inquiries found</td></tr>";
                            }

                            // Close database connection
                            mysqli_close($conn);
                                    
                            ?>
                            
                            
                            
                            <!-- $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                    <td>" . $row['id'] . "</td>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['email'] . "</td>
                                    <td>" . $row['phone'] . "</td>
                                    <td>" . $row['message'] . "</td>
                                    <td>" . $row['datetime'] . "</td>
                                    <td>" . $row['status'] . "</td>
                                    
                                    <td>
                                    <a href='order-view.php?order_id=" . $row['id'] . "'>
                                    <button class='view-btn'><ion-icon name='eye-outline'></ion-icon></button>
                                  </a>
                                        
                                    </td>
                                </tr>";
                                
                                }
                            } else {
                                echo "<tr><td colspan='10'>No inquiries found</td></tr>";
                            }

                            // Close database connection
                                    
                                    $conn->close();*/ 
                        ?>-->

                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
</body>