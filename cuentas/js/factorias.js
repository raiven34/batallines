    angular.module('factoryModule', [])
        .factory ('servicios',  function ($http) {
 
            return {      
                enviarlogin:function(obj) {
                    //console.log(obj);
                    respuesta=[];
                    respuesta=$http({
                        url: 'json/login.php',
                        method: 'POST',
                        data: obj
                    })
                    //temporadas.push({"temporada":"Todas"});
                    
                    return respuesta;
                },
               enviargastos:function(obj) {
                    //console.log(obj);
                    respuesta=[];
                    respuesta=$http({
                        url: 'json/actualiza_gastos.php',
                        method: 'POST',
                        data: obj
                    })
                    //temporadas.push({"temporada":"Todas"});
                    
                    return respuesta;
                },                
                recuperagastos:function() {
                    //console.log(obj);
                    respuesta=[];
                    respuesta=$http({
                        url: 'json/recupera_gastos.php',
                        method: 'GET',
                        cache:false
                    })
                    return respuesta;
                },
                recuperapagadores:function() {
                    //console.log(obj);
                    respuesta=[];
                    respuesta=$http({
                        url: 'json/recupera_pagadores.php',
                        method: 'GET'
                    })
                    return respuesta;
                }, 
                recuperagrupos:function() {
                    //console.log(obj);
                    respuesta=[];
                    respuesta=$http({
                        url: 'json/recupera_grupos.php',
                        method: 'GET'
                    })
                    return respuesta;
                }                 
            }
        })
        .factory ('utilidades',  function ($location) {
            return{
                changeView:function(url) {
                  console.log("sssssssssss");  
                  $location.path(url);
                }
            }
        })
        .factory ('datosusuario',  function () {
            return{
                changeView:function(url) {
                  console.log("sssssssssss");  
                  $location.path(url);
                }
            }
        });        