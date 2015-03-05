<?php
    include 'header.php';
?>


      <div class="row" ng-controller="partidoCtrl">
        
        <div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog" style="margin: 80px auto;">
                <div class="modal-content">
                    <div class="modal-header">
<!--                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&amp;times;</button>-->
                    <h4 class="modal-title text-center" id="myModalLabel">{{detallepart[0].local}} {{detallepart[0].goleslocal}} - {{detallepart[0].golesvisitante}} {{detallepart[0].visitante}}</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <h5>Fecha: {{detallepart[0].fecha}}</h5>
                            <h5>Hora: {{detallepart[0].hora}}</h5>
                            <h5>Lugar: {{detallepart[0].lugar}}</h5>
                            <h5>MVP: {{detallepart[0].mvp}}</h5>
                            <img class="img-rounded" ng-src="../{{detallepart[0].mvp}}" style="width: 50px; height: 60px;" />
                            <h5>Incidencias: </h5>
                            <div ng-repeat="detallein in detallepart[1]" ng-init="cargaIncidencias(detallein.goles,detallein.asistencias,detallein.rojas,detallein.amarillas)">                            
                                <span>{{detallein.jugador}}</span>
                                
                            </div>
                        </div>
                        <div class=""></div>    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
          </div>
        </div>
          
          
        <div class="col-sm-12 col-md-12 main"  ng-init="cargaTemporadas()">
            <div class="row placeholders"  >
                <select id="combotemp" class="form-horizontal" ng-model="myColor" ng-options="temporada.temporada for temporada in temporadas" ng-change="precargaResumenes();cargaPartido(myColor.temporada , '',true)">
                    
                </select>
            </div>
          

          <div class="row placeholders">
            <div class="col-xs-4 col-sm-4 placeholder" ng-repeat="resumen in resumenes">
              <h4>{{resumen.tipo}}</h4>
              <span class="text-muted lead">{{resumen.total}}</span>
            </div>
            
          </div>

          <h2 class="sub-header">Estadísticas  {{myColor.temporada}}</h2>
          <div class="table-responsive" >
            <table ng-init="cargaPartido('','',true)" class="table table-striped">
              <thead>
                  <tr class="cabecera_tabla">
                    <th ng-style="cargaEstilo(cabecera.clase)" ng-repeat='cabecera in cabeceras' ng-click='cargaPartido(cabecera.temporada , cabecera.orden,true)'>{{cabecera.text}}</th>
                    <th style="padding : 14px">Resultado</th>
                </tr>
              </thead>
              <tbody >
                <!--<tr ng-repeat="cliente in clientes | startFrom:currPage*pageSize | limitTo:pageSize">-->
                  <tr ng-repeat="partido in partidos" ng-class="partido.res" data-toggle="modal" data-target="#basicModal" style="cursor: pointer;" ng-click="cargaModal(partido.temporada,partido.jornada)">
                  <td>{{partido.temporada}}</td>
                  <td>{{partido.jornada}}</td>
                  <td>{{partido.local}}</td>
                  <td>{{partido.visitante}}</td>
                  <td>{{partido.fecha}}</td>
                  <td>{{partido.hora}}</td>
                  <td>{{partido.goleslocal}} - {{partido.golesvisitante}}</td>
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