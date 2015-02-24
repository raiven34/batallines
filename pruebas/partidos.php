<?php
    include 'header.php';
?>


      <div class="row">

        <div class="col-sm-12 col-md-12 main" ng-controller="partidoCtrl" ng-init="cargaTemporadas()">
            <div class="row placeholders"  >
                <select id="combotemp" class="form-horizontal" ng-model="myColor" ng-options="temporada.temporada for temporada in temporadas" ng-change="precargaResumenes();cargaPartido(myColor.temporada , 'jornada',true)">
                    
                </select>
            </div>
          

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-4 placeholder" ng-repeat="resumen in resumenes">
              <h4>{{resumen.tipo}}</h4>
              <span class="text-muted lead">{{resumen.total}}</span>
            </div>
            
          </div>

          <h2 class="sub-header">Estadísticas  {{myColor.temporada}}</h2>
          <div class="table-responsive" >
            <table ng-init="cargaPartido('','jornada',true)" class="table table-striped">
              <thead>
                  <tr class="cabecera_tabla">
                    <th ng-style="cargaEstilo(cabecera.clase)" ng-repeat='cabecera in cabeceras' ng-click='cargaPartido(cabecera.temporada , cabecera.orden,true)'>{{cabecera.text}}</th>
                  
                </tr>
              </thead>
              <tbody >
                <!--<tr ng-repeat="cliente in clientes | startFrom:currPage*pageSize | limitTo:pageSize">-->
                  <tr ng-repeat="partido in partidos" ng-class="partido.res">
                  <td>{{partido.temporada}}</td>
                  <td>{{partido.jornada}}</td>
                  <td>{{partido.local}}</td>
                  <td>{{partido.visitante}}</td>
                  <td>{{partido.goleslocal}} - {{partido.golesvisitante}}</td>
                  <td>{{partido.fecha}}</td>
                  <td>{{partido.hora}}</td>
                </tr>
                
              </tbody>
            </table>
<!--    		 <button  class="btn btn-small" ng-disabled="currPage == 0" ng-click="currPage=currPage-1">
    		 	<i class="icon-backward"></i> Anterior
		    </button>
		    <button  class="btn btn-small" ng-disabled="currPage >= clientes.length/pageSize - 1" ng-click="currPage=currPage+1">
		        <i class=" icon-forward"></i> Siguiente
		    </button>
		     reflejaremos el numero de pagina actual de total 
    		Pagina: {{currPage+1}} de {{totalCliente()}}-->

          </div>
        </div>
      </div>
<?php
    include 'foot.php';
?>