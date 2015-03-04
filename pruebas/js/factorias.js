    angular.module('factoryModule', [])
        .factory ('serviciotemporadas',  function ($http) {
 
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
        });