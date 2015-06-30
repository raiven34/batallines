    angular.module('controllerModule', ['factoryModule','ui.bootstrap'])
        .controller("navCtrl", function($location){
                var map = this;
                map.estoy = function(ruta){
                    return $location.path().indexOf(ruta)!=-1;
                }
        })
        .controller("combotemp", function(servicios){
            var vc = this;
            vc.temporadas=[];
            servicios.recuperatemp().success(function(data){
                //data.push({"temporada":"Todas"});
                vc.temporadas=data;
                //console.log(vc.temporadas);
                vc.select = vc.temporadas[0]; 
            }); 
        }) 
        .controller("detallepartido", function($routeParams,servicios,$location){
            var vs = this;
            vs.jugadores=[];
            vs.respuesta=[{"Modificados":"0","Erroneos":"0","Insertados":"0","Eliminados":"0"}];
            servicios.recuperajugadorespart($routeParams.temporada,$routeParams.jornada).success(function(data){
                //data.push({"temporada":"Todas"});
                for(i=0;i<data.length;i++){
                    data[i].estado="n";
                }                
                vs.jugadores=data;
                //console.log(vc.jugadores); 
            }); 
            vs.enviardetalle= function(part){
                servicios.actualizadetallepartidos(part).success(function(data){
                    vs.respuesta=data;
                    console.log(vs.respuesta);
//                        for(i=0;i<data.length;i++){
//                            data[i].estado="n";
//                        }
//                        vs.partidos=data;
//                        vs.tempactual = vs.partidos[0].temporada;

                });
                //console.log($scope.form);
            } 
            vs.actualizaestado= function(obj){
                if(obj.estado!="a"){
                    obj.estado="m";
                }              
                //console.log(vs.partidos);
            }             
            vs.changeView = function(url){
                $location.path(url);
            }  
            

        })         
        .controller("estadisticas", function($location,servicios,$scope){
                var vs = this;
                vs.modificado=false;
                vs.tempactual="";
                vs.partidos=[];
                vs.respuesta=[{"Modificados":"0","Erroneos":"0","Insertados":"0","Eliminados":"0"}];
                vs.cargapartidos = function(temp){
 
                    servicios.recuperapartidos(temp).success(function(data){
                        
                        for(i=0;i<data.length;i++){
                            data[i].estado="n";
                        }
                        vs.partidos=data;
                        vs.tempactual = vs.partidos[0].temporada;
                        
                    }); 
                    //console.log(vs.tempactual);
                }

                vs.cargapartidos('');

                vs.removepartido= function(obj){
                    if(obj.estado=="a"){
                        var ind = vs.partidos.indexOf(obj);
                        vs.partidos.splice(ind, 1);                      
                    }else{
                        obj.estado="d";
                        vs.modificado=true;
                    }
                    //vs.partidos.splice(index, 1); 
                    //console.log(vs.partidos);
                } 
                vs.actualizaestado= function(obj){
                    if(obj.estado!="a"){
                        obj.estado="m";
                    }
                    vs.modificado=true;
                    //console.log(vs.partidos);
                }                 
                vs.addpartido= function(){
                    vs.partidos.push({"cronica": "", "fecha": "", "goleslocal": "0", "golesvisitante": "0", "hora": "", "jornada": parseInt(vs.partidos[vs.partidos.length -1].jornada) + 1,"jugado": "N", "local": "", "lugar": "", "temporada": vs.tempactual, "visitante": "", "estado":"a"});
                    vs.modificado=true;
                    //console.log(vs.partidos);
                } 
                vs.enviarpartidos= function(part){
                    servicios.actualizapartidos(part).success(function(data){
                        vs.respuesta=data;
                        //console.log(vs.respuesta[0].Modificados);                        
//                        for(i=0;i<data.length;i++){
//                            data[i].estado="n";
//                        }
//                        vs.partidos=data;
//                        vs.tempactual = vs.partidos[0].temporada;
                        
                    }); 
                }                 
                vs.changeView = function(url){
                    $location.path(url);
                }      

        })        
        .controller("notificacion", function(servicios,$http,$location,utilidades,$scope){
                var vs = this;
                vs.mensaje = 
                    {
                        message : "",
                        apikey:"AIzaSyDbpsUSs-WPDzAlSJ268yBUzdJtNvyc35E",
                        registrationIDs:'todos',
                        tipo: '0'
                    };
                vs.usuarios=[];
                servicios.recuperausuariosmov().success(function(data){
                data.push({"apodo":"Todos","movil_id":"todos"});
                vs.usuarios=data;
                //vs.select = vs.usuarios[vs.usuarios.length - 1]; 
                //console.log(vs.select);
                });
                vs.trigger = false;
                vs.error = "";
                vs.tipomsg="";
                vs.changeView = function(url){
                    
                    $location.path(url);
                }                
                vs.guardar = function(form){
                    if(!$scope.mensaje.$error.required){
                        resultado=[];
                        $http.get('../json/gcm_engine.php?apiKey=' + form.apikey + '&tipo='+ form.tipo + '&message=' + form.message + '&registrationIDs=' + form.registrationIDs,{ cache: true}).success(function(data){
                            resultado= data;
                            if(resultado.failure==0){
                                vs.trigger=true;
                                vs.error="Notificación Enviada";
                                vs.tipomsg="bg-success text-center";
                            }else{
                                vs.trigger=true;
                                vs.error="Se ha producido un Error";
                                vs.tipomsg="bg-danger text-center";
                            }
                            //console.log(resultado.failure);
                        });
                    }
                }
        })        
        .controller("admin", function($location){
                var vs = this;
                vs.menuadmin = [
                    {
                        id : 0,
                        text:'Estadisticas',
                        url:'/admin/estadisticas'
                    },
                    {
                        id : 1,
                        text:'Jugadores',
                        url:'/admin/estadisticas'
                    },
                    {
                        id : 2,
                        text:'Noticias',
                        url:'/admin/estadisticas'
                    },                        
                    {
                        id : 3,
                        text:'Enviar notificación',
                        url:'/admin/enviar_notificacion'
                    },                        
                    {
                        id : 4,
                        text:'Log',
                        url:'/admin/log'
                    },                        
                    {
                        id : 5,
                        text:'Backup',
                        url:'/admin/backup'
                    }, 
                    {
                        id : 6,
                        text:'Temporadas',
                        url:'/admin/backup'
                    }                     
                ];
                
                vs.changeView = function(url){
                    
                    $location.path(url);
                }
        })        