<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="css/calendar_home.css">

    <title>distri-show</title>

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

<?php require_once 'librerias/header_home.php';?>
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
                        <li><a href="Nuestros_Clientes">NUESTROS CLIENTES</a></li>
                        <li><a href="CALENDARIO">CALENDARIO</a></li>
                        <li><a href="contacto">CONTACTO</a></li>
                    </ul>
                </div>
                <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6">
                    <div class="img-rounded destacado col-xs-12 col-lg-12 col-md-12 col-sm-12 marginbot fondonaranja btn-group">
                        
                                
                                <button class="mes col-xs-2 col-lg-2 col-md-2 col-sm-2 btn btn-primary" data-calendar-nav="prev" style="background-color: transparent; border: none; padding: 0px;"><< </button>
                                <h3 id="mes" class="mes text-center col-xs-8 col-lg-8 col-md-8 col-sm-8 sinpadding"></h3>
                                <button class="mes col-xs-2 col-lg-2 col-md-2 col-sm-2 btn btn-primary" data-calendar-nav="next" style="background-color: transparent; border: none; padding: 0px;"> >></button>  


                                <div class="row marginbotlow fondocalendario">
                                        <div class="col-xs-12 col-lg-12 col-md-12 col-sm-12">
                                                <div id="calendar"></div>
                                        </div>
                                </div>

                                <div class="clearfix"></div>                        
                        
                    </div>
                    <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 sinpadding"><a href="TOYMUSICAL"><img class="img-rounded imgdestacado col-xs-11 col-lg-11 col-md-11 col-sm-11"  src="img/toy.jpg"/></a></div>
                    <div class="col-xs-6 col-lg-6 col-md-6 col-sm-6 sinpadding"><a href="HOMENAJES"><img class="img-rounded imgdestacado col-xs-11 col-lg-11 col-md-11 col-sm-11 col-lg-offset-1 col-sm-offset-1 col-xs-offset-1 col-md-offset-1" src="img/Abba.jpg"/></a></div>
                </div>
            </div>
        <div class="row marginbotlow backinicioma">
            <div class="textoMA col-xs-6 col-lg-6 col-md-6 col-sm-6 margintoplow"><p class="cabeceraMA">MOTHER AFRICA</p><p>Impresionantes acrobacias, un colorido vestuario, músicos en directo, artistas provenientes de los rincones más profundos 
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