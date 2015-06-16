<?php
    include 'header.php';
?>


      <div class="row">

        <div class="col-sm-12 col-md-12 main" ng-controller="clienteCtrl" ng-init="cargaTemporadas()" ng-cloak>
            <div class="row placeholders"  >
                <select id="combotemp" class="form-horizontal" ng-model="myColor" ng-options="temporada.temporada for temporada in temporadas" ng-change="precargaResumenes();cargaCliente(myColor.temporada , 'apodo',true)">
                    
                </select>
            </div>
          

          <div class="row placeholders">
            <div class="col-xs-4 col-sm-4 placeholder" ng-repeat="resumen in resumenes">
              <img class="img-circle img-responsive" alt="200x200" ng-src="../{{ resumen.foto }}" style="width: 120px; height: 120px;">
              <h4>{{resumen.tipo}}</h4>
              <span class="text-muted lead">{{resumen.total}}</span>
            </div>
            
          </div>

          <h2 class="sub-header">Estadísticas  {{myColor.temporada}}</h2>
          <div class="table-responsive" >
            <table ng-init="cargaCliente('','apodo',true)" class="table table-striped">
              <thead>
                  <tr class="cabecera_tabla">
                      <th style="padding : 14px">Foto</th>
                    <th ng-style="cargaEstilo(cabecera.clase)" ng-repeat='cabecera in cabeceras' ng-click='cargaCliente(cabecera.temporada , cabecera.orden,false)'>{{cabecera.text}}</th>
                  
                </tr>
              </thead>
              <tbody >
                <!--<tr ng-repeat="cliente in clientes | startFrom:currPage*pageSize | limitTo:pageSize">-->
                <tr ng-repeat="cliente in clientes">
                  <td class="paddingimg"><img class="img-rounded" ng-src="../{{ cliente.foto }}" style="width: 40px; height: 40px;" /></td>
                  <td>{{cliente.apodo}}</td>
                  <td>{{cliente.partidos}}</td>
                  <td>{{cliente.goles}}</td>
                  <td>{{cliente.asistencias}}</td>
                  <td>{{cliente.amarillas}}</td>
                  <td>{{cliente.rojas}}</td>
                  <td>{{cliente.puntos}}</td>
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