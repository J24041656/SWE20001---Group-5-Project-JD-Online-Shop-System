<?php
include("../connect/config.php");
error_reporting(0);
session_start();
if(empty($_SESSION['id']))
{
  header('location:index.php');
}

// $userID = $_SESSION['id'];
// $result = mysqli_query($conn, "SELECT levelID FROM staffs WHERE id = '$userID'");
// $user = mysqli_fetch_assoc($result);
// $_SESSION['levelID'] = $user['levelID'];

?>
<!-- <nav>
	<div class="navigation">
		<ul>
			<li>
				<a href="#">
					<span class="icon">
						<img src="assets/images/pg-logo.png">
					</span>
					<span class="title" style="font-size: 25px;">Online Shop</span>
				</a>
			</li>

			<li>
				<a href="dashboard.php">
					<span class="icon">
						<ion-icon name="home-outline"></ion-icon>
					</span>
					<span class="title">Dashboard</span>
				</a>
			</li>

			<li>
				<a href="customer-list.php">
					<span class="icon">
						<ion-icon name="people-outline"></ion-icon>
					</span>
					<span class="title">Customers</span>
				</a>
			</li>

			<li>
				<a href="staff-list.php">
					<span class="icon">
						<ion-icon name="person-outline"></ion-icon>
					</span>
					<span class="title">Users</span>
				</a>
			</li>

			<li>
				<a href="product-list.php">
					<span class="icon">
						<ion-icon name="cart-outline"></ion-icon>
					</span>
					<span class="title">Product</span>
				</a>
			</li>

			<li>
				<a href="order-list.php">
					<span class="icon">
						<ion-icon name="bag-handle-outline"></ion-icon>
					</span>
					<span class="title">Order</span>
				</a>
			</li>

			<li>
				<a href="staff-logout.php">
					<span class="icon">
						<ion-icon name="log-out-outline"></ion-icon>
					</span>
					<span class="title">Sign Out</span>
				</a>
			</li>
		</ul>
	</div>
</nav> -->
<nav>
    <div class="navigation">
        <ul>
            <li>
                <a href="#">
                    <span class="icon">
                        <img src="assets/images/pg-logo.png">
                    </span>
                    <span class="title" style="font-size: 25px;">Online Shop</span>
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                    <span class="icon">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="customer-list.php">
                    <span class="icon">
                        <ion-icon name="people-outline"></ion-icon>
                    </span>
                    <span class="title">Customers</span>
                </a>
            </li>
            <?php if ($_SESSION['levelID'] == 2) { ?>
            <li>
                <a href="staff-list.php">
                    <span class="icon">
                        <ion-icon name="person-outline"></ion-icon>
                    </span>
                    <span class="title">Users</span>
                </a>
            </li>
            <?php } ?>
            <li>
                <a href="product-list.php">
                    <span class="icon">
                        <ion-icon name="cart-outline"></ion-icon>
                    </span>
                    <span class="title">Product</span>
                </a>
            </li>
            <li>
                <a href="order-list.php">
                    <span class="icon">
                        <ion-icon name="bag-handle-outline"></ion-icon>
                    </span>
                    <span class="title">Order</span>
                </a>
            </li>
			<!--code below written by joshua (30/5/2024)-->
			<li>
                <a href="inquiry-list.php">
                    <span class="icon">
                        <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </span>
                    <span class="title">Inquiries</span>
                </a>
            </li>
            <li>
                <a href="staff-logout.php">
                    <span class="icon">
                        <ion-icon name="log-out-outline"></ion-icon>
                    </span>
                    <span class="title">Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
</nav>

<!-- ========================= Main ==================== -->
<div class="main">
	<div class="topbar">
		<div class="toggle">
			<ion-icon name="menu-outline"></ion-icon>
		</div>

		<div class="user">
			<a href="staff-profile.php"><img src="assets/images/user.png" alt=""></a>
		</div>
	</div>
	
	<!-- =========== Scripts =========  -->
	<script src="assets/js/main.js"></script>
	<!-- ====== ionicons ======= -->
	<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>