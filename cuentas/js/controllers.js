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
        .controller("principal", function($routeParams,servicios,$location){
            var vs = this;
            vs.gastos=[];
            vs.seleccionado=[];
            vs.pagadores=[];
            vs.grupos=[];
            servicios.recuperagrupos().success(function(data){
                vs.grupos=data[0].datos;        
                //console.log(vs.grupos);

            });             
            servicios.recuperapagadores().success(function(data){
                data[0].datos.push({ usuario : "Nuevo"});
                for(i=0;i<data[0].datos.length;i++){
                    data[0].datos[i].estado="n";
                }   
                vs.pagadores=data[0].datos;
                //console.log(vs.pagadores);

            });            
            servicios.recuperagastos().success(function(data){
                for(i=0;i<data.length;i++){
                    data[i].estado="n";
                }     
                vs.gastos=data;
                vs.seleccionado=vs.gastos[0];
                if(vs.seleccionado.resultado==0){
                    $location.path("/login");
                }
            });
            vs.addinterviniente= function(){
                vs.seleccionado.pagadores.push({"usuario": "Nuevo", gasto: vs.seleccionado.id, id: "", importe_pagado: "0", importe_pagar: "0"});
                vs.seleccionado.estado='m';
                //vs.modificado=true;
                //console.log(vs.seleccionado);
            }
            vs.addgasto= function(){
                grupo={"id":"-","nombre":"-"};
                pagadores=[];
                vs.gastos.push({"id":"-","nombre":"-","descripcion":"-","grupo":grupo,"importe":"0","peridiocidad":"1","fecha":"2015-06-27 23:48:04","pagadores": pagadores,"estado":"a"});
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
                //console.log(vs.gastos);
            }   
            vs.guardar= function(){
                console.log(vs.gastos);
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
                vs.seleccionado=obj;
            }

        })                 
 