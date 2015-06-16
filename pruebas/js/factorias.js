    angular.module('factoryModule', [])
        .factory ('servicios',  function ($http) {
 
            return {
                sumar:function() {
                  return 1+1;
                },
                recuperatemp:function() {
                    temporadas=[];
                    temporadas=$http({
                        url: '../json/json_temporadas.php',
                        method: 'GET'
                    })
                    //temporadas.push({"temporada":"Todas"});
                    return temporadas;
                },
                recuperapartidos:function(temp) {
                    partidos=[];
                    partidos=$http({
                        url: '../json/json_recupera_partidos.php?temporada=' + temp + '&orden=jornada',
                        method: 'GET'
                    })
                    //temporadas.push({"temporada":"Todas"});
                    return partidos;
                },                
                recuperausuariosmov:function() {
                    usuarios=[];
                    usuarios=$http({
                        url: '../json/json_recupera_usuarios_movil.php',
                        method: 'GET'
                    })
                    //temporadas.push({"temporada":"Todas"});
                    //console.log(usuarios);
                    return usuarios;
                },                
                recuperadetallepart:function(temporada,jornada) {
                    detalle=[];
                    detalle=$http({
                        url: '../json/json_recupera_estadisticas_partido.php?temporada=' + temporada + '&jornada=' + jornada,
                        method: 'GET',
                        cache: true
                        
                    })
                    //console.log(detalle);
                    //temporadas.push({"temporada":"Todas"});
                    return detalle;
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
        });