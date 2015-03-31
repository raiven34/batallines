<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/estilos.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>



    <div class="container">
<?php require_once '../librerias/header.php';?>
        <div id="myCarousel" class="carousel slide col-xs-12 col-lg-12 col-md-12 col-sm-12 sinpadding" data-ride="carousel" data-interval="false">

          <!-- Carousel items -->
          <div class="carousel-inner">
            <div class="active item"><img class="itemcarousel"  src="../img/parte1toy.png" alt="banner1" /></div>
            <div class="item"><img class="itemcarousel"  src="../img/parte2toy.png" alt="banner2" /></div>
            <div class="item"><img class="itemcarousel"  src="../img/parte3toy.png" alt="banner4" /></div>
            <div class="item"><img class="itemcarousel"  src="../img/parte4toy.png" alt="banner5" /></div>
          </div>
          <!-- Carousel nav -->
          <a class="carousel-control left" style="font-size: 50px;" href="#myCarousel" data-slide="prev">&lsaquo;</a>
          <a class="carousel-control right" style="font-size: 50px;" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
                
     
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
    $(document).ready(function(){
        $('.myCarousel').carousel()
    });
    </script>

  </body>
</html>