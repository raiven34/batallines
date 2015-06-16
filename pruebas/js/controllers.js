    angular.module('controllerModule', ['factoryModule','ui.bootstrap'])
        .controller("navCtrl", function($location){
                var map = this;
                map.estoy = function(ruta){
                    return $location.path() == ruta;
                }
        })
        .controller("combotemp", function(servicios){
            var vc = this;
            vc.temporadas=[];
            servicios.recuperatemp().success(function(data){
                data.push({"temporada":"Todas"});
                vc.temporadas=data;
                vc.select = vc.temporadas[vc.temporadas.length - 1]; 
            }); 
        })        
        .controller("estadisticas", function($location,servicios,$scope){
                var vs = this;
                vs.partidos=[];
                vs.cargapartidos = function(temp){
                    servicios.recuperapartidos(temp).success(function(data){
                        vs.partidos=data;
                        //console.log(vs.partidos);
                    });  
                }
                vs.cargapartidos('Todas');
                vs.actualizapartidos= function(obj){
                    console.log(obj);
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