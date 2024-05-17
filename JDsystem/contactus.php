<!DOCTYPE html>
<html>
<head>
	<title>Contact us</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Quicksand&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0">
  <!--page-icon------------>
  <link rel="shortcut icon" href="images/pg-logo.png">
  <style>

    *{
      padding: 0;
      margin: 0;
      box-sizing: border-box;
      font-family: Verdana;
    }

    body{
      height: 100vh;
      width: 100%;
    }

    .container{
      position: relative;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px 100px;
    }

    .container:after{
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      background: url("img/bg.jpg") no-repeat center;
      background-size: cover;
      filter: blur(50px);
      z-index: -1;
    }
    .contact-box{
      max-width: 850px;
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      justify-content: center;
      align-items: center;
      text-align: center;
      background-color: #fff;
      box-shadow: 0px 0px 19px 5px rgba(0,0,0,0.19);
    }

    .left{
      background: url("images/1.jpg") no-repeat center;
      background-size: cover;
      height: 100%;
    }

    .right{
      padding: 25px 40px;
    }

    h2{
      position: relative;
      padding: 0 0 10px;
      margin-bottom: 10px;
    }

    h2:after{
      content: '';
      position: absolute;
      left: 50%;
      bottom: 0;
      transform: translateX(-50%);
      height: 4px;
      width: 50px;
      border-radius: 2px;
      background-color: #8b2c50;
    }

    .field{
      width: 100%;
      border: 2px solid rgba(0, 0, 0, 0);
      outline: none;
      background-color: rgba(230, 230, 230, 0.6);
      padding: 0.5rem 1rem;
      font-size: 1.1rem;
      margin-bottom: 22px;
      transition: .3s;
    }

    .field:hover{
      background-color: rgba(0, 0, 0, 0.1);
    }

    textarea{
      min-height: 150px;
    }

    .btn-2{
      height: 35px;
      background: #000000;
      border: 0;
      border-radius: 5px;
      color: #fff;
      font-size: 15px;
      cursor: pointer;
      transition: all .3s;
      margin-top: 10px;
      padding: 0px 10px;
      width: 100%;
    }
    .btn-2:hover{
      opacity: 0.7;
    }

    .field:focus{
      border: 2px solid rgba(30,85,250,0.47);
      background-color: #fff;
    }

    @media screen and (max-width: 880px){
      .contact-box{
        grid-template-columns: 1fr;
      }
      .left{
        height: 200px;
      }
    }
  </style>
</head>
<body>
  <?php include 'nav-footer/nav.php'; ?>
  <div class="container">
    <div class="contact-box">
     <div class="left"></div>
     <div class="right">
      <h2>Contact Us</h2>
      <input type="text" class="field" placeholder="Your Name">
      <input type="text" class="field" placeholder="Your Email">
      <input type="text" class="field" placeholder="Phone">
      <textarea placeholder="Message" class="field"></textarea>
      <button class="btn-2">Send</button>
    </div>
  </div>
</div>
<?php include 'nav-footer/footer.php'; ?>
</body>
</html>