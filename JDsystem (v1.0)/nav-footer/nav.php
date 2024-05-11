<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<style type="text/css">
	.nav-ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
		background-color: black;
	}

	.nav-ul li {
		float: left;
		color: white;
		text-align: center;
		padding: 14px 0px;
		background-color: black;
	}

	.start {
		margin-left: 400px;
	}

	.nav-ul li a {
		float: none;
		transform: translate(-50%, -50%);
		color: white;
		text-align: center;
		padding: 14px 10px;
		text-decoration: none;
		font-family: Verdana;
		font-size: 0.95rem;
		text-decoration: none;
		padding-left: 50px;
		padding-right: 50px;
	}

	.nav-ul li a:hover {
		background-color: white;
		color: black;
	}

	.nav-logo img {
		width: 200px;
		height: 50px;
	}

	.nav-logo img:hover {
		cursor: pointer;
	}

	.logoContainer {
		margin-left: 100px;
		margin-top: 10px;
	}

	.icons {
		justify-content: end;
		margin-top: -42px;
		margin-left: 1200px;
	}

	.favourite, .cart, .person{
		font-size: 1.25rem;
		color: black;
		padding-right: 20px;
		text-decoration: none;
	}

	.favourite:hover, .cart:hover, .person:hover {
		color: #1B99D4;
	}

	.menuLabel {
		font-size: 1rem;
		display: inline;
		margin-top: -50px;
		font-family: Verdana;
	}
</style>
<nav>
	<div class="logoContainer">
		<i class="nav-logo" onclick="document.location.href='index.php'"><img src="images/nav-logo.png"></i>
	</div>
	<div class="icons">

		<a href="#" class="favourite"><i class="bi bi-heart"></i><p class="menuLabel">  Favourites</p></a>
		<a href="#" onclick="document.location='Cart.html'" class="cart"><i class="bi bi-cart"></i><p class="menuLabel">  Cart</p></a>
		<?php

		if(empty($_SESSION["cusID"])) // if customer is not login
		{
			 //echo '<a href="login.php" class="person"><i class="bi bi-person"></i><p class="menuLabel">  LogIn</p></a>';
		}
		else{
			$cusID = $_SESSION['cusID'];
			$query = mysqli_query($conn,"SELECT*FROM customers WHERE cusID=$cusID");

			while($result = mysqli_fetch_assoc($query)){
				$res_Uname = $result['username'];
				$res_Email = $result['email'];
				$res_id = $result['cusID'];
			}
			?>
			<a href="" class="person"><i class="bi bi-person"></i><p class="menuLabel">  <?php echo $res_Uname ?></p></a>
		<?php } ?>
	</div>

	<br>

	<!--Navigation Bar-->
	<ul class="nav-ul">
		<?php
		if(empty($_SESSION["cusID"])) // if customer is not login
		{
			echo '<li><a href="index.php" class="start">Home</a></li>';
			echo '<li><a href="">Product</a></li>';
			echo '<li><a href="">About</a></li>';
			echo '<li><a href="login.php">Login</a></li>';
		}
		else
		{
			echo '<li><a href="index.php" class="start">Home</a></li>';
			echo '<li><a href="">Product</a></li>';
			echo '<li><a href="">About</a></li>';
			echo '<li><a href="">Order</a></li>';
			echo '<li><a href="connect/logout.php">Log Out</a></li>';
		}
		?>
	</ul>

</nav>
