<!DOCTYPE html>
<html lang="en">
<?php
include("connect/config.php");
error_reporting(0); 
session_start(); 

?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, intital-scale = 1">
    <!--page-icon------------>
    <link rel="shortcut icon" href="images/pg-logo.png">
    <title>Homepage</title>
</head>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
<link rel="stylesheet" href=css/style.css>

<html>
<body style=background-color:white>
    <!-- Insert Navbar -->
    <?php include'nav-footer/nav.php' ?>
    <!-- Slideshow container -->
    <div class="slideshow-container">

        <!-- Full-width images with number and caption text -->
        <div class="mySlides">
            <img src="images/shoesImage5.jpg" style="width: 100%;">
        </div>

        <div class="mySlides">
            <img src="images/shoesImage6.jpg" style="width: 100%">
        </div>

        <div class="mySlides">
            <img src="images/shoesImage4.jpg" style="width:100%">
        </div>

        <div class="mySlides">
            <img src="images/shoesImage7.jpg" style="width:100%">
        </div>

        <!-- Next and previous buttons -->
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <br>

    <!-- The dots/circles -->
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>
        <span class="dot" onclick="currentSlide(4)"></span>
    </div>
    <br><br><br>

    <h1 class="bookGroup">Best Sellers</h1>
    <table class="table1" width="80%" align="center">
        <tr>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/63975913z_276x.jpg?v=1660118189" class="cover" onclick="document.location='BookDetails.html'"></center>
                <p>
                    <b class="title" onclick="document.location='BookDetails.html'">The Ballad of Never After</b><br><b class="price">RM44.93</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781803362182_262x.jpg?v=1663638420" class="cover"></center>
                <p>
                    <b class="title">A Magic Steeped In Poison</b><br><b class="price">RM47.92</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781534465299_267x.jpg?v=1657787764" class="cover"></center>
                <p>
                    <b class="title">Blood Like Magic</b><br><b class="price">RM55.12</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781471410918_260x.jpg?v=1657787594" class="cover"></center>
                <p>
                    <b class="title">Daughter of Darkness</b><br><b class="price">RM43.12</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9780241532577_261x.jpg?v=1657787945" class="cover"></center>
                <p>
                    <b class="title">Beasts of Ruin</b><br><b class="price">RM41.56</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
        </tr>
    </table>

    <br><br><br>
    <h1 class="bookGroup">New Arrivals</h1>
    <table class="table1" width="80%" align="center">
        <tr>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781529362909_260x.jpg?v=1631191357" class="cover"></center>
                <p>
                    <b class="title">Spin the Dawn</b><br><b class="price">RM39.92</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781529356571_263x.jpg?v=1655366434" class="cover"></center>
                <p>
                    <b class="title">Six Crimson Cranes (UK)</b><br><b class="price">RM42.32</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9780008494902_382x.jpg?v=1660552186" class="cover"></center>
                <p>
                    <b class="title">Secrets So Deep</b><br><b class="price">RM47.92</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9780374390914_500x.jpg?v=1642663247" class="cover"></center>
                <p>
                    <b class="title">The Lost Dreamer</b><br><b class="price">RM52.72</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
            <td>
                <center><img src="https://cdn.shopify.com/s/files/1/0511/7575/1837/products/9781534478459_282x.jpg?v=1653547162" class="cover"></center>
                <p>
                    <b class="title">Curse of the Phoenix</b><br><b class="price">RM35.92</b>
                </p>
                <b class="bi bi-circle-fill">
                    <b class="stockIndicator">
                        In Stock
                    </b>
                </b>
            </td>
        </tr>
    </table>
    <!--Map Location-->
    <div class="Map">
        <h1>The Map</h1>
        <iframe style="width:90rem;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.082452833053!2d101.60447287409028!3d3.0726469969030643!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4c87994e6e83%3A0x6ec95f9bde584169!2sJD%20Sports!5e0!3m2!1sen!2smy!4v1715050969036!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!-- Insert Footer -->
    <?php include'nav-footer/footer.php' ?>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/HomeScript.js"></script>
</body>
</html>