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
                if(data[0].resultado==0){
                    $location.path("/login");
                }else{
                    data[0].datos.push({ usuario : "Nuevo"});  
                    vs.pagadores=data[0].datos;  
                }

                //console.log(vs.pagadores);

            });            
            servicios.recuperagastos().success(function(data){
                for(i=0;i<data.length;i++){
                    data[i].estado="n";
                    for(a=0;a<data[i].pagadores.length;a++){
                        data[i].pagadores[a].estado="n";
                    } 
                }     
                vs.gastos=data;
                vs.seleccionado=vs.gastos[0];
                if(vs.seleccionado.resultado==0){
                    $location.path("/login");
                }
            });
            vs.addinterviniente= function(){
                vs.seleccionado.pagadores.push({"usuario": "Nuevo", "gasto": vs.seleccionado.id, id: "", "importe_pagado": "0", "importe_pagar" : "0", "estado" : "a"});
                if(vs.seleccionado.estado!="a"){ 
                    vs.seleccionado.estado='m';
                }
                //vs.modificado=true;
                //console.log(vs.seleccionado);
            }
            vs.addgasto= function(){
                grupo={"id":"-","nombre":"-"};
                pagadores=[];
                vs.gastos.push({"id":"","nombre":"-","descripcion":"-","grupo":grupo,"importe":"0","peridiocidad":"0","fecha":"","pagadores": pagadores,"estado":"a"});
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
                vs.seleccionado.estado='m';
                //console.log(vs.gastos);
            } 
            vs.igualar= function(){
                var total = vs.seleccionado.importe;
                var impigualado= total/vs.seleccionado.pagadores.length;
                for(i=0;i<vs.seleccionado.pagadores.length;i++){
                    vs.seleccionado.pagadores[i].importe_pagar=impigualado.toFixed(2);
                }
            }            
            vs.guardar= function(){
                console.log(vs.gastos);
            }
            vs.duplicagasto= function(obj){
                vs.gastos.push({"id":"","nombre": obj.nombre + '_copia',"descripcion":obj.descripcion,"grupo":obj.grupo,"importe":obj.importe,"peridiocidad":obj.peridiocidad,"fecha":"","pagadores": obj.pagadores,"estado":"a"});
                vs.seleccionado = vs.gastos[vs.gastos.length-1];
            }            
            vs.modificagasto= function(obj){
                if(obj.estado!="a"){
                    obj.estado="m";
                    vs.seleccionado.estado='m';
                }
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
 