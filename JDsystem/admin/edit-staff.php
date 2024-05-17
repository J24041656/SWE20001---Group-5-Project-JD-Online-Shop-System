<?php
include("../connect/config.php");
error_reporting(0);
session_start();

?>

<?php

if(isset($_POST['submit']))           //if upload btn is pressed
{
  if(empty($_POST['name']||$_POST['username']==''||$_POST['email']==''||$_POST['contact']==''||$_POST['password']==''||$_POST['levelID']==''))
  { 
    $error = '<div class="alert"><strong>Danger!</strong> All fields must be filled!</div>';
  }
  else
  {
    if(strlen($_POST['contact']) < 10)  //cal phone length
    {
      $error = '<div class="alert"><strong>Danger!</strong> Invalid phone number!</div>';
    }
    else{

      $sql = "UPDATE staffs SET name='$_POST[name]',username='$_POST[username]',email='$_POST[email]',contact='$_POST[contact]',password='$_POST[password]',levelID='$_POST[levelID]' where id='{$_SESSION['id']}'";  
      mysqli_query($conn, $sql); 
      move_uploaded_file($temp, $store);

      // $success =  'Update completed';
      $success = '<div class="success"><strong>Update completed</strong></div>';
      header("refresh:1;url=staff-list.php");
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Staff's Information</title>
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
    <!-- Alert Message -->
    <?php  echo $error; ?>
    <?php echo $success; ?>

    <h1 style="margin-top: 10px; margin-left: 30px;">Edit Staff's Information</h1>

    <!-- ================ Edit Staff ================= -->
    <div class="container-2">
      <form action="" method="post">

        <?php 
        $qml ="select * from staffs where id='$_GET[staff_upd]'";
        $rest=mysqli_query($conn, $qml); 
        $row = mysqli_fetch_assoc($rest);
        ?> 

        <div class="row">
          <div class="col-15">
            <label for="name">Name</label>
          </div>
          <div class="col-80">
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" placeholder="Please enter the staff's full name">
          </div>
        </div>
        <div class="row">
          <div class="col-15">
            <label for="username">Username</label>
          </div>
          <div class="col-80">
            <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" placeholder="Please enter staff's username">
          </div>
        </div>
        <div class="row">
          <div class="col-15">
            <label for="email">Email</label>
          </div>
          <div class="col-80">
            <input type="text" id="email" name="email" value="<?php echo $row['email']; ?>" placeholder="Please enter staff's email">
          </div>
        </div>
        <div class="row">
          <div class="col-15">
            <label for="contact">Contact No.</label>
          </div>
          <div class="col-80">
            <input type="text" id="contact" name="contact" placeholder="Please enter your current contact number" value="<?php echo $row['contact']; ?>" placeholder="Please enter staff's contact no.">
          </div>
        </div>
        <div class="row">
          <div class="col-15">
            <label for="password">Password</label>
          </div>
          <div class="col-80">
            <input type="password" id="password" name="password" placeholder="Please enter your new password" value="<?php echo $row['password']; ?>" placeholder="Please enter password">
          </div>
        </div>
        <div class="row">
          <div class="col-15">
            <label for="level">Access Level</label>
          </div>
          <div class="col-80">
            <select id="levelID" name="levelID">
             <?php
             $Acess_Level = mysqli_query($conn,"select * from acessLevel");
             while($level = mysqli_fetch_array($Acess_Level)){
              ?>    
              <option value="<?php echo $level['id']; ?>"><?php echo $level['level']; ?></option>
            <?php } ?>
          </select>
        </div>
        <br>
        <div class="row">
          <div class="col-10">
            <input type="submit" name="submit" value="Update">
          </div>
        </div>
      </form>
    </div>
     <div class="row">
        <div class="col-20">
          <a href="staff-list.php"><button class="btn-back">Back</button></a>
        </div>
      </div>

    <!-- Cannot be deleted -->
    <!-- <div class="main"> in nav.php-->
    </div>
  </div>
</body>