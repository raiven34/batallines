    angular.module('controllerModule', ['factoryModule','ui.bootstrap'])
        .controller("navCtrl", function($location){
                var map = this;
                map.estoy = function(ruta){
                    return $location.path().indexOf(ruta)!=-1;
                }
        })
        .controller("graficas", function($routeParams,servicios,$location,servicios){
                var vs = this;
                vs.ctx = document.getElementById("chart-area").getContext("2d");
                vs.datos=[0,0,0,0,0,0,0,0,0,0,0,0];
                vs.datos2=[0,0,0,0,0,0,0,0,0,0,0,0];
                vs.datos3=[0,0,0,0,0,0,0,0,0,0,0,0];
                vs.tipo="0"
                vs.nombre="Todos";
                vs.nombre1="Ninguno";
                vs.nombre2="Ninguno";
                vs.grupo="0";
                vs.grupo1="x";
                vs.grupo2="x";
                vs.cargar= function(){                   
                    
                    servicios.recuperagastosfac(vs.grupo,vs.tipo).success(function(data){
                        for(i=0;i<data.length;i++){
                            vs.datos[data[i].mes - 1] = parseFloat(data[i].total).toFixed(2);
                        }
                        var lineChartData = {
                                labels : ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
                                datasets : [
                                        {
                                                label: "Primera serie de datos",
                                                fillColor : "rgba(151,187,205,0.2)",
                                                strokeColor : "#6b9dfa",
                                                pointColor : "#1e45d7",
                                                pointStrokeColor : "#fff",
                                                pointHighlightFill : "#fff",
                                                pointHighlightStroke : "rgba(220,220,220,1)",
                                                data : vs.datos
                                        },
                                        {
                                                label: "Segunda serie de datos",
                                                fillColor : "rgba(233,226,37,0.2)",
                                                strokeColor : "rgba(233,226,37,1)",
                                                pointColor : "rgba(233,226,37,1)",
                                                pointStrokeColor : "#fff",
                                                pointHighlightFill : "#fff",
                                                pointHighlightStroke : "rgba(151,187,205,1)",
                                                data : vs.datos2
                                        },
                                        {
                                                label: "tercera serie de datos",
                                                fillColor : "rgba(243,62,62,0.2)",
                                                strokeColor : "rgba(243,62,62,1)",
                                                pointColor : "rgba(243,50,50,1)",
                                                pointStrokeColor : "#fff",
                                                pointHighlightFill : "#fff",
                                                pointHighlightStroke : "rgba(243,62,62,1)",
                                                data : vs.datos3
                                        }                                        
                                ]

                        };
                        
                        window.myPie = new Chart(vs.ctx).Line(lineChartData, {responsive:true,bezierCurveTension:0});
                    });
                    servicios.recuperagrupos().success(function(data){
                        vs.grupos=data[0].datos;
                        vs.grupos2=[];
                        vs.grupos3=[];
                        for(a=0;a<vs.grupos.length;a++){
                                    vs.grupos2.push(vs.grupos[a]);
                                    vs.grupos3.push(vs.grupos[a]);
                        }
                        vs.grupos.push({ id : "0" , nombre : 'Todos'});
                        vs.grupos2.push({ id : "0" , nombre : 'Todos'});
                        vs.grupos3.push({ id : "0" , nombre : 'Todos'});
                        vs.grupos.push({ id : "x" , nombre : 'Ninguno'});
                        vs.grupos2.push({ id : "x" , nombre : 'Ninguno'});
                        vs.grupos3.push({ id : "x" , nombre : 'Ninguno'});
                        //console.log(vs.grupos);

                    });

                    servicios.recuperanombres().success(function(data){
                        vs.nombres=data[0].datos;
                        vs.nombres2=[];
                        vs.nombres3=[];
                        for(a=0;a<vs.nombres.length;a++){
                                    vs.nombres2.push(vs.nombres[a]);
                                    vs.nombres3.push(vs.nombres[a]);
                        }
                        vs.nombres.push({nombre : 'Todos'});
                        vs.nombres2.push({nombre : 'Todos'});
                        vs.nombres3.push({nombre : 'Todos'});
                        vs.nombres.push({nombre : 'Ninguno'});
                        vs.nombres2.push({nombre : 'Ninguno'});
                        vs.nombres3.push({nombre : 'Ninguno'});
                        //console.log(vs.nombres);

                    });                       
                    
                };
                vs.actualizagraf= function(linea,filtro){
                    for(i=0;i<window.myPie.datasets[linea].points.length;i++){
                        window.myPie.datasets[linea].points[i].value = 0;
                    }                    
                    if(filtro!='x' && filtro!='Ninguna'){                    
                        servicios.recuperagastosfac(filtro,vs.tipo).success(function(data){
                            for(i=0;i<data.length;i++){
                                window.myPie.datasets[linea].points[data[i].mes - 1].value = parseFloat(data[i].total).toFixed(2);
                            }
                            window.myPie.update();
                        });
                    }
                };
                vs.reseteagraf= function(){
                    vs.nombre="Todos";
                    vs.nombre1="Ninguno";
                    vs.nombre2="Ninguno";
                    vs.grupo="0";
                    vs.grupo1="x";
                    vs.grupo2="x";                    
                    for(a=0;a<window.myPie.datasets.length;a++){
                        for(i=0;i<window.myPie.datasets[a].points.length;i++){
                            window.myPie.datasets[a].points[i].value = 0;
                        } 
                    }
                };
                vs.cargar();

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
            vs.nombres=[];
            vs.nombres2=[];
            vs.grupos=[];
            vs.grupos2=[];
            vs.total=0;
            vs.total_debo=0;
            vs.total_deben=0;
            vs.estado_deuda='0';
            vs.usuario="Todos";
            vs.nombre="Todos";
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
                    servicios.recuperagastos(vs.usuario,vs.estado_deuda,vs.grupo,vs.mes,vs.nombre).success(function(data){
                        for(i=0;i<data.length;i++){
                            data[i].estado="n";
                            data[i].estado_fac="p";
                            for(a=0;a<data[i].pagadores.length;a++){
                                data[i].pagadores[a].estado="n";
                                if(data[i].pagadores[a].importe_pagado != data[i].pagadores[a].importe_pagar){
                                    data[i].estado_fac="n";
                                }
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
                    servicios.recuperanombres().success(function(data){
                        if(data[0].resultado==0){
                            $location.path("/login");
                        }else{
                            //data[0].datos.push({ usuario : "Nuevo"});  
                            vs.nombres=data[0].datos; 
                            vs.nombres2=[];
                            for(a=0;a<vs.nombres.length;a++){
                                vs.nombres2.push(vs.nombres[a]);
                            }
                            vs.nombres2.push({ nombre : "Todos"}); 
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
            vs.actualiza_estado= function(){
                vs.seleccionado.estado_fac="p";
                for(a=0;a<vs.seleccionado.pagadores.length;a++){
                    if(vs.seleccionado.pagadores[a].importe_pagado != vs.seleccionado.pagadores[a].importe_pagar){
                        vs.seleccionado.estado_fac="n";
                    }                  
                }
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
                vs.gastos.push({"id":"","nombre":"","descripcion":"","grupo":grupo,"importe":0.00,"peridiocidad":"0","fecha":"","pagadores": pagadores,"estado":"a","estado_fac":"n"});
                vs.seleccionado = vs.gastos[vs.gastos.length-1];
                vs.currPage=vs.totalpaginas()-1;
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
                vs.seleccionado.estado_fac='p';
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
                vs.actualiza_estado();
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
                vs.actualiza_estado();
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
                vs.actualiza_estado();
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
                vs.currPage=vs.totalpaginas()-1;
            }            
            vs.modificagasto= function(obj){
                if(obj.estado!="a"){
                    obj.estado="m";
                    
                }
                if(vs.seleccionado.estado!="a"){ 
                    vs.seleccionado.estado='m';
                    
                }
                vs.calcula_total(); 
                vs.actualiza_estado();
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
//                    for(i=vs.gastos.length -1;i>0;i--){
//                        if(vs.gastos[i].estado!="d"){
//                            existe = i;
//                        }
//                    }
//                    vs.seleccionado = vs.gastos[existe];
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
 