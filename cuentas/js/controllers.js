    angular.module('controllerModule', ['factoryModule','ui.bootstrap'])
        .controller("navCtrl", function($location){
                var map = this;
                map.estoy = function(ruta){
                    return $location.path().indexOf(ruta)!=-1;
                }
        })

        .controller("login", function($routeParams,servicios,$location){
            var vs = this;
            vs.objlogin=[                    
                {
                    usuario:'',
                    password:''
                }
            ];
            vs.enviarlogin= function(obj){
                servicios.enviarlogin(obj).success(function(data){
                    vs.respuesta=data;
                    if(data[0].resultado==1){
                        $location.path("/principal");
                    }
                    //console.log(vs.objlogin);
//                        for(i=0;i<data.length;i++){
//                            data[i].estado="n";
//                        }
//                        vs.partidos=data;
//                        vs.tempactual = vs.partidos[0].temporada;

                });
                //console.log($scope.form);
            }           
            vs.changeView = function(url){
                $location.path(url);
            }  
            

        })
        .controller("principal", function($routeParams,servicios,$location,$scope){
            var vs = this;
            vs.gastos=[];
            vs.seleccionado=[];
            vs.pagadores=[];
            vs.pagadores2=[];
            vs.grupos=[];
            vs.grupos2=[];
            vs.total=0;
            vs.total_debo=0;
            vs.total_deben=0;
            vs.estado_deuda='0';
            vs.usuario="Todos";
            vs.mes="0";
            vs.grupo="0";
            vs.currPage = 0;
            vs.pageSize = 10;
            vs.predicate = 'id';
            vs.reverse = true;
            vs.mensaje=[                    
                {
                    mensaje:'',
                    tipo:''
                }
            ];
            $('.form_datetime').datetimepicker({
                language:  'es',
                weekStart: 1,
                todayBtn:  1,
                autoclose: 1,
                todayHighlight: 1,
                startView: 2,
                forceParse: 0,
                showMeridian: 0
            })
            .on('changeDate', function(ev){
                var ind = vs.gastos.indexOf(vs.seleccionado);
                //console.log(ev.date);
                vs.gastos[ind].fecha=$('#fecha').val();                                
                if(vs.gastos[ind].estado!="a"){ 
                    vs.gastos[ind].estado='m';
                }
                $scope.$apply()
                //console.log(vs.gastos[ind].fecha);
            });
            
            vs.totalpaginas = function() {
                    return Math.ceil(vs.gastos.length / vs.pageSize);
            };
            vs.order = function(predicate) {
                vs.reverse = (vs.predicate === predicate) ? !vs.reverse : false;
                vs.predicate = predicate;
            };          
            vs.cargar= function(){
                    servicios.recuperagastos(vs.usuario,vs.estado_deuda,vs.grupo,vs.mes).success(function(data){
                        for(i=0;i<data.length;i++){
                            data[i].estado="n";
                            for(a=0;a<data[i].pagadores.length;a++){
                                data[i].pagadores[a].estado="n";
                            } 
                        }     
                        vs.gastos=data;
                        vs.calcula_total();
                        vs.seleccionado=vs.gastos[0];
                        if(vs.seleccionado.resultado==0){
                            $location.path("/login");
                        }
                    }); 
                    servicios.recuperapagadores().success(function(data){
                        if(data[0].resultado==0){
                            $location.path("/login");
                        }else{
                            //data[0].datos.push({ usuario : "Nuevo"});  
                            vs.pagadores=data[0].datos; 
                            vs.pagadores2=[];
                            for(a=0;a<vs.pagadores.length;a++){
                                vs.pagadores2.push(vs.pagadores[a]);
                            }
                            vs.pagadores2.push({ usuario : "Todos"}); 
//                            console.log(vs.pagadores);
                        }

                        //console.log(vs.pagadores);

                    });
                    servicios.recuperagrupos().success(function(data){
                        vs.grupos=data[0].datos;
                        vs.grupos2=[];
                        for(a=0;a<vs.grupos.length;a++){
                                    vs.grupos2.push(vs.grupos[a]);
                        }
                        vs.grupos2.push({ id : "0" , nombre : 'Todos'}); 
                        //console.log(vs.grupos);

                    });                     
                    
            }
            
            vs.addinterviniente= function(){
                vs.seleccionado.pagadores.push({"usuario": "Nuevo", "gasto": vs.seleccionado.id, id: "", "importe_pagado": 0.00, "importe_pagar" : 0.00, "estado" : "a"});
                if(vs.seleccionado.estado!="a"){ 
                    vs.seleccionado.estado='m';
                }
                //vs.modificado=true;
                //console.log(vs.seleccionado);
            }
            vs.calcula_total= function(){
                vs.total=0;
                vs.total_deben=0;
                vs.total_debo=0;
                for(i=0;i<vs.gastos.length;i++){
                    if(vs.gastos[i].estado!='d'){
                        vs.total=vs.total + vs.gastos[i].importe;
                        for(a=0;a<vs.gastos[i].pagadores.length;a++){
                            if(vs.gastos[i].pagadores[a].usuario==vs.usuario){
                                if(vs.gastos[i].pagadores[a].importe_pagado>vs.gastos[i].pagadores[a].importe_pagar){
                                    vs.total_deben = vs.total_deben + (vs.gastos[i].pagadores[a].importe_pagado - vs.gastos[i].pagadores[a].importe_pagar);
                                }else if(vs.gastos[i].pagadores[a].importe_pagado<vs.gastos[i].pagadores[a].importe_pagar){
                                    vs.total_debo = vs.total_debo + (vs.gastos[i].pagadores[a].importe_pagar - vs.gastos[i].pagadores[a].importe_pagado);
                                }
                            }
                        }
                    }
                }
            }
            vs.addgasto= function(){
                grupo={"id":"","nombre":""};
                pagadores=[];
                vs.gastos.push({"id":"","nombre":"","descripcion":"","grupo":grupo,"importe":0.00,"peridiocidad":"0","fecha":"","pagadores": pagadores,"estado":"a"});
                vs.seleccionado = vs.gastos[vs.gastos.length-1];
                //vs.modificado=true;
                //console.log(vs.gastos);
            } 
            vs.removeinterviniente= function(obj){
                var ind = vs.gastos.indexOf(obj);
                var sel = vs.gastos.indexOf(vs.seleccionado);
                if(obj.estado=="a"){ 
                    vs.gastos[sel].pagadores.splice(ind, 1);                      
                }else{
                    obj.estado="d"; 
                    //vs.modificado=true;
                }
                if(vs.seleccionado.estado!="a"){ 
                    vs.seleccionado.estado='m';
                }
                //console.log(vs.gastos);
            } 
            vs.igualar= function(){
                contador=0;
                for(i=0;i<vs.seleccionado.pagadores.length;i++){
                    if(vs.seleccionado.pagadores[i].estado!='d'){
                        contador ++;
                    }
                }
                var total = vs.seleccionado.importe;
                var impigualado= (total/contador).toFixed(2);
                for(i=0;i<vs.seleccionado.pagadores.length;i++){
                    vs.seleccionado.pagadores[i].importe_pagar=parseFloat(impigualado);
                    if(vs.seleccionado.pagadores[i].estado!="a" && vs.seleccionado.pagadores[i].estado!="d"){ 
                        vs.seleccionado.pagadores[i].estado="m"; 
                    }
                }
                if(vs.seleccionado.estado!="a"){ 
                    vs.seleccionado.estado='m';
                    vs.calcula_total();
                }                
            }
            vs.liquidar= function(){
                for(i=0;i<vs.seleccionado.pagadores.length;i++){
                    vs.seleccionado.pagadores[i].importe_pagado = vs.seleccionado.pagadores[i].importe_pagar;
                    if(vs.seleccionado.pagadores[i].estado!="a" && vs.seleccionado.pagadores[i].estado!="d"){ 
                        vs.seleccionado.pagadores[i].estado="m"; 
                    }
                }
                if(vs.seleccionado.estado!="a"){ 
                  vs.seleccionado.estado='m';
                  vs.calcula_total();
                }
            }             
          vs.pagar= function(obj){
                obj.importe_pagado = obj.importe_pagar;
                if(obj.estado!="a"){ 
                    obj.estado="m"; 
                //vs.modificado=true;
                }
                if(vs.seleccionado.estado!="a"){ 
                    vs.seleccionado.estado='m';
                    vs.calcula_total();
                }
          } 
          vs.apagar_todo= function(obj){
                obj.importe_pagar = vs.seleccionado.importe;
                if(obj.estado!="a"){ 
                    obj.estado="m"; 
                //vs.modificado=true;
                }
                if(vs.seleccionado.estado!="a"){ 
                    vs.seleccionado.estado='m';
                }
          } 
          vs.pagar_todo= function(obj){
                obj.importe_pagado = vs.seleccionado.importe;
                if(obj.estado!="a"){ 
                    obj.estado="m"; 
                //vs.modificado=true;
                }
                if(vs.seleccionado.estado!="a"){ 
                    vs.seleccionado.estado='m';
                }
          }           
          vs.guardar= function(){
                servicios.enviargastos(vs.gastos).success(function(data){
                    if(data[0].Modificados>0){
                         vs.mensaje.mensaje= data[0].Modificados + " registros modificados; ";
                         vs.mensaje.tipo="s";
                    }
                    if(data[0].Insertados>0){
                         vs.mensaje.mensaje= vs.mensaje.mensaje + data[0].Insertados + " registros insertados; ";
                         vs.mensaje.tipo="s";
                    }
                    if(data[0].Eliminados>0){
                         vs.mensaje.mensaje= vs.mensaje.mensaje + data[0].Eliminados + " registros eliminados; ";
                         vs.mensaje.tipo="s";
                    }   
                    if(data[0].Erroneos>0){
                         vs.mensaje.mensaje= vs.mensaje.mensaje + data[0].Erroneos + " registros erroneos; ";
                         vs.mensaje.tipo="e";
                    }
                    vs.cargar();
                });              
                console.log(vs.gastos);
            }
            vs.duplicagasto= function(obj){
                vs.gastos.push({"id":"","nombre": obj.nombre + '_copia',"descripcion":obj.descripcion,"grupo":obj.grupo,"importe":obj.importe,"peridiocidad":obj.peridiocidad,"fecha":"","pagadores": obj.pagadores,"estado":"a"});
                vs.seleccionado = vs.gastos[vs.gastos.length-1];
            }            
            vs.modificagasto= function(obj){
                if(obj.estado!="a"){
                    obj.estado="m";
                    
                }
                if(vs.seleccionado.estado!="a"){ 
                    vs.seleccionado.estado='m';
                    
                }
                vs.calcula_total();
                //console.log(vs.gastos);
            }
            vs.removegasto= function(obj){
                    var existe = 0;
                    var ind = vs.gastos.indexOf(obj);
                    if(obj.estado=="a"){                    
                        vs.gastos.splice(ind, 1);                      
                    }else{
                        obj.estado="d"; 
                        //vs.modificado=true;
                    }
                    vs.calcula_total();
                    for(i=vs.gastos.length -1;i>0;i--){
                        if(vs.gastos[i].estado!="d"){
                            existe = i;
                        }
                    }
                    vs.seleccionado = vs.gastos[existe];
            }            
            vs.changeView = function(url){
                $location.path(url);
            }  
            vs.cambiaseleccionado = function(obj){
                if($scope.form.$valid){
                    vs.seleccionado=obj;
                    vs.mensaje.mensaje="";
                    vs.mensaje.tipo="";
                }else{
                    vs.mensaje.mensaje="Datos introducidos Erroneos";
                    vs.mensaje.tipo="e";
                }
            }
            vs.cargar();
            
        })
        .filter('startFrom', function() {
	return function(input, start) {
		start = +start;
		return input.slice(start);
	}
        });
 