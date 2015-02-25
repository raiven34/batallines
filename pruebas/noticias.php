<?php
    include 'header.php';
?>


      <div class="" ng-controller="noticiasCtrl" ng-init="cargaNoticias()">
        <div class="jumbotron text-center" ng-repeat="noticia in noticias" >
            <div class="row"><h2>{{noticia.titulo}}</h2></div>
        <div class="row"><img class="img-responsive col-md-offset-4 col-md-4" src="../{{noticia.imagen}}"/></div>
        <div class="row" ng-bind-html="noticia.texto"><span ng-bind-html="noticia.texto"></span></div>
        <div class="row"><h5>Escrito por {{noticia.autor}} el {{noticia.fecha}}</h5></div>
        </div>
      </div>

<?php
    include 'foot.php';
?>