<?php
    include 'header.php';
?>


      <div id="noticias" class="" ng-controller="noticiasCtrl" ng-init="cargaNoticias()" ng-cloak>
        <div class="jumbotron text-center" ng-repeat="noticia in noticias | startFrom:currPage*pageSize | limitTo:pageSize" style="padding: 0px 60px 0px 60px">
            <div class="row"><h2>{{noticia.titulo}}</h2></div>
        <div class="row"><img class="img-responsive col-md-offset-4 col-md-4" src="../{{noticia.imagen}}"/></div>
        <div class="row placeholder" ng-bind-html="noticia.texto"><span ng-bind-html="noticia.texto"></span></div>
        <div class="row"><h6>Escrito por {{noticia.autor}} el {{noticia.fecha}}</h6></div>
        </div>
    		 <button  class="btn btn-small" ng-disabled="currPage == 0" ng-click="currPage=currPage-1">
    		 	<i class="icon-backward"></i> <a onclick="$('html,body').animate({scrollTop:0},'slow');return false;">Anterior</a>
		    </button>
		    <button  class="btn btn-small" ng-disabled="currPage >= noticias.length/pageSize - 1" ng-click="currPage=currPage+1">
                        <i class=" icon-forward"></i> <a  onclick="$('html,body').animate({scrollTop:0},'slow');return false;">Siguiente</a>
		    </button> 
    		Pagina: {{currPage+1}} de {{totalNoticias()}}          
      </div>

<?php
    include 'foot.php';
?>