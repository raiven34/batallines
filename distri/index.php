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
    <link rel="stylesheet" href="css/calendar_home.css">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/estilos.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body>



    <div class="container containerfix">

<?php require_once 'librerias/header.php';?>
            <div class="row marginbotlow">
                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6">
                    <img class="img-responsive" src="img/LogoDistri.png"/>
                    <ul class="nav nav-pills nav-stacked menu marginbotlow" style="border-bottom: 2px solid #fff">
                        <li><a href="MotherAfrica">MOTHER AFRICA</a></li>
                        <li><a href="MAYO2015">GIRA MOTHER AFRICA MAYO 2015</a></li>
                        <li><a href="familiares">MUSICALES FAMILIARES</a></li>
                        <li><a href="HOMENAJES">MUSICALES HOMENAJE</a></li>
                    </ul>
                    <ul class="nav nav-pills nav-stacked menu">
                        <li><a href="#">NUESTROS CLIENTES</a></li>
                        <li><a href="CALENDARIO">CALENDARIO</a></li>
                        <li><a href="contacto">CONTACTO</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="img-rounded destacado col-xs-12 col-lg-12 col-md-12 col-sm-12 marginbot fondoblanco">
                        
                                <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
                                    <h3></h3>
                                        
                                </div>

                                <div class="row marginbotlow">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
                                                <div id="calendar"></div>
                                        </div>
                                </div>

                                <div class="clearfix"></div>                        
                        
                    </div>
                    <a href="TOYMUSICAL"><img class="img-rounded imgdestacado col-xs-5 col-lg-5 col-md-5 col-sm-5"  src="img/toy.jpg"/></a>
                    <img class="img-rounded imgdestacado col-xs-5 col-lg-5 col-md-5 col-sm-5 col-xs-offset-2 col-lg-offset-2 col-md-offset-2 col-sm-offset-2" src="img/Abba.jpg"/>
                </div>
            </div>
        <div class="row destacado marginbotlow backinicioma">
            <div class="textoMA col-xs-6 col-lg-6 col-md-6 col-sm-6" style="border-right: 1px solid #fff;"><p class="cabeceraMA">MOTHER AFRICA</p><p>Impresionantes acrobacias, un colorido vestuario, músicos en directo, artistas provenientes de los rincones más profundos 
del continente africano...</p><p> La pasión y el entusiasmo  de la cultura africana, se traslada a los escenarios más prestigios de 
                        nuestro país a través de "El Circo de los Sentidos" con su espectáculo MOTHER AFRICA.</p></div>
            <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6">
                    <ul class="nav nav-pills nav-stacked menu2 col-xs-6 col-lg-6 col-md-6 col-sm-6 marginbotlow">
                        <li><a href="MotherAfrica/VIDEOS/">VIDEOS</a></li>
                        <li><a href="MotherAfrica/FOTOS/">FOTOS</a></li>
                        <li><a href="Dossieres/Dossier_MotherAfrica_English.pdf">DOSSIER</a></li>
                    </ul>

            </div>
            
        </div>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="js/moment.js"></script>
        <script src="js/bootstrap.min.js"></script> 
	<script type="text/javascript" src="CALENDARIO/components/underscore/underscore-min.js"></script>
	<script type="text/javascript" src="CALENDARIO/components/jstimezonedetect/jstz.min.js"></script>
    	<script type="text/javascript" src="js/es-ES.js"></script>
	<script type="text/javascript" src="js/calendar_home.js"></script>
	<script type="text/javascript" src="js/app.js"></script>



  </body>
</html>