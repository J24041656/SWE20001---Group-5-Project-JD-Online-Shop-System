<?php
session_start();
if(!isset($_SESSION['id'])) {
    // Redirect to login page or show an error message
    header("Location: index.php");
    exit();
}

// Check if the user is a manager
if($_SESSION['levelID'] != 2) {
    // Redirect to a page with a message indicating insufficient permissions
    //echo "You don't have permission to view this page.";
    //exit();
    header("refresh: .2; url=403error.php");
}else{


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Staff List</title>
  <!-- ======= Styles ====== -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!--page-icon------------>
  <link rel="shortcut icon" href="assets/images/pg-logo.png">
</head>

<body>
  <!-- Cannot be deleted -->
  <div class="container">
    <?php include'nav.php' ?>
    <!-- Content -->
    <h1 style="margin-top: 10px; margin-left: 30px;">Admin</h1>
    <div class="btn-list">
      <a href="add-staff.php"><button class="btn-add" role="button">Add New Staff</button></a>
    </div>
    <!-- ================ Staff List ================= -->
    <div class="list">
      <div class="recentList">
        <table>
          <thead>
            <tr>
              <td>ID</td>
              <td>Name</td>
              <td>Username</td>
              <td>Email</td>
              <td>Contact No.</td>
              <td>Access Level</td>
              <td>Action</td>
            </tr>
          </thead>

          <tbody>
            <?php 
            include('../connect/config.php');
            $sql = "SELECT s.id, s.name, s.username, s.email, s.contact, a.level 
            FROM staffs s
            INNER JOIN acesslevel a ON s.levelID = a.id";
            $res = mysqli_query($conn, $sql);
            if($res==TRUE)
            {
              $count = mysqli_num_rows($res); 
              $sn=1; 
              if($count>0)
              {
                while($rows=mysqli_fetch_assoc($res))
                {
                  $id=$rows['id'];
                  $name=$rows['name'];
                  $username=$rows['username'];
                  $email=$rows['email'];
                  $contact=$rows['contact'];
                  $level=$rows['level'];
                  ?>

                  <tr>
                    <td><?php echo $sn++; ?>. </td> 
                    <td><?php echo $name; ?></td>
                    <td><?php echo $username; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $contact; ?></td>
                    <td><?php echo $level; ?></td>
                    <td>
                      <a href="delete-staff.php?id=<?php echo $id; ?>" onclick="return confirm('Are you sure you want to delete this staff member?');" class="link">
                        <button class="delete-btn"><ion-icon name="trash-outline"></ion-icon></button>
                      </a>
                      <a href="edit-staff.php?staff_upd=<?php echo $id;?>"><button class="edit-btn"><ion-icon name="create-outline"></ion-icon></ion-icon></button></a>
                    </td>
                  </tr>
                <?php } }
                else{ ?>
                  <tr><td colspan="7"><div class="error">No Staff</div></td></tr>
                <?php } }?>
              </tbody>
            </table>
          </div>

          <!-- Cannot be deleted -->
          <!-- <div class="main"> in nav.php-->
          </div>
        </div>
      </body>
      <?php
    }
  ?>