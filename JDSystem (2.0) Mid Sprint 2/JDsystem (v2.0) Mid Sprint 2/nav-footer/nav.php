
<head>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<style type="text/css">
	.navbar {
    background-color: black;
    padding: 18px 0;
}
	.nav-ul {
		list-style-type: none;
		margin: 0;
		padding: 0;
		/*overflow: hidden;
		background-color: black;*/
		display: flex;
    justify-content: center;
	}

	.nav-ul li {
/*		float: left;*/
		color: white;
		text-align: center;
/*		padding: 14px 0px;*/
/*		background-color: black;*/
 padding: 0 20px;
	}

	.start {
		margin-left: 400px;
	}

	.nav-ul li a {
		float: none;
		transform: translate(-50%, -50%);
		color: white;
		text-align: center;
		padding: 20px;
		text-decoration: none;
		font-family: Verdana;
		font-size: 0.95rem;
	}

	.nav-ul li a:hover {
		background-color: white;
		color: black;
		border-radius: 5px;
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
		margin-left: 1300px;
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

/* Responsive styles for navigation */
@media screen and (max-width: 768px) {
    /* Make the navigation items stack vertically */
    .navbar{
    	justify-content: center;
    }
    .nav-ul li {
        float: none;
        display: block;
        text-align: center;
    }

    /* Adjust padding for better spacing */
    .nav-ul li a {
        padding: 10px 5px;
    }

    /* Align the logo and icons to the center */
    .logoContainer {
        text-align: center;
        margin-left: 0;
    }

    .icons {
        text-align: center;
        margin: 10px auto;
    }

    /* Adjust margin and padding for responsiveness */
    .start {
        margin-left: 0;
    }

    .icons {
        margin-left: 0;
    }
}

</style>
<nav>
    <div class="logoContainer">
        <i class="nav-logo" onclick="document.location.href='index.php'"><img src="images/nav-logo.png"></i>
    </div>
    <div class="icons">

        <!-- <a href="#" class="favourite"><i class="bi bi-heart"></i><p class="menuLabel">  Favourites</p></a> -->
        <a href="#" onclick="document.location='cart.php'" class="cart"><i class="bi bi-cart"></i><p class="menuLabel">  Cart</p></a>
        <?php

        if(empty($_SESSION["cusID"])) // if customer is not logged in
        {
            // Show login link if not logged in
            echo '<a href="login.php" class="person"><i class="bi bi-person"></i><p class="menuLabel">  LogIn</p></a>';
        }
        else{
            // Show user profile link if logged in
            $cusID = $_SESSION['cusID'];
            $query = mysqli_query($conn,"SELECT * FROM customers WHERE cusID=$cusID");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['username'];
                $res_Email = $result['email'];
                $res_id = $result['cusID'];
            }
            ?>
            <a href="customerprofile.php" class="person"><i class="bi bi-person"></i><p class="menuLabel">  <?php echo $res_Uname ?></p></a>
        <?php } ?>
    </div>

    <br>

    <!-- Navigation Bar -->
    <div class="navbar">
        <ul class="nav-ul">
            <?php
            if(empty($_SESSION["cusID"])) // if customer is not logged in
            {
                // Show default navigation for non-logged-in users
                echo '<li><a href="index.php" class="start">Home</a></li>';
                echo '<li><a href="product.php">Product</a></li>';
                echo '<li><a href="aboutus.php">About</a></li>';
                echo '<li><a href="login.php">Login</a></li>';
            }
            else
            {
                // Show different navigation for logged-in users
                echo '<li><a href="index.php" class="start">Home</a></li>';
                echo '<li><a href="product.php">Product</a></li>';
                echo '<li><a href="aboutus.php">About</a></li>';
                echo '<li><a href="orderhistory.php">Order</a></li>';
                echo '<li><a href="connect/logout.php">Log Out</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>

