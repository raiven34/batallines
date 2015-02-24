<?php
    include 'header.php';
?>


      <div class="" ng-controller="noticiasCtrl" ng-init="cargaNoticias()">
        <div class="jumbotron text-center" ng-repeat="noticia in noticias" >
            <div class="row"><h1>{{noticia.titulo}}</h1></div>
        <div class="row"><img class="img-responsive col-md-offset-4 col-md-4" src="../{{noticia.imagen}}"/></div>
        <div class="row">{{noticia.texto}}</div>
        <div class="row"><h2>Adios</h1></div>
        </div>
      </div>

<?php
    include 'foot.php';
?>