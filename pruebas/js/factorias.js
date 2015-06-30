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
                        method: 'GET',
                        cache: false
                    })
                    return temporadas;
                },
                recuperapartidos:function(temp) {
                    //console.log(temp);
                    url="../json/json_recupera_partidos.php?orden=jornada";
                    if(temp!=''){
                       url='../json/json_recupera_partidos.php?temporada=' + temp + '&orden=jornada'; 
                    }
                    partidos=$http({
                        url: url,
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
                actualizapartidos:function(obj) {
                    partidos=[];
                    partidos=$http({
                        url: '../json/json_actualiza_partidos.php',
                        method: 'POST',
                        data: obj
                    })
                    //temporadas.push({"temporada":"Todas"});
                    //console.log(usuarios);
                    return partidos;
                },
                actualizadetallepartidos:function(obj) {
                    detalle=[];
                    detalle=$http({
                        url: '../json/json_actualiza_detalle_partidos.php',
                        method: 'POST',
                        data: obj
                    })
                    //temporadas.push({"temporada":"Todas"});
                    //console.log(usuarios);
                    return detalle;
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
                },
                recuperajugadorespart:function(temporada,jornada) {
                    detalle=[];
                    detalle=$http({
                        url: '../json/json_recupera_jugadores_partido.php?temporada=' + temporada + '&jornada=' + jornada,
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