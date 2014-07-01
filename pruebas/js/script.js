//Creamos el modulo de nuestra aplicación
var clienteApp = angular.module('clienteApp', []);


/*
	Creamos el controlador diciendole que tendremos $scope 
	y una llamada de ajax por eso le pasamos el $http
	si no le agrgamos el $http tendremos un bucle infinito de error xD
	as la prueba para que veas de lo que estamos hablando
*/

function clienteCtrl($scope, $http) {
        $scope.clientes = [];
        $scope.resumenes =[];
        $scope.cabeceras = [
            {
                id : 0,
                text:'Apodo',
                orden : 'apodo',
                sentido : "",
                temporada : "",
                clase : ""
            },
            {
                id : 1,
                text:'Partidos',
                orden : 'partidos',
                sentido : "",
                temporada : "",
                clase : ""
            },
            {
                id : 2,
                text:'Goles',
                orden : 'goles',
                sentido : "",
                temporada : "",
                clase : ""
            },                        
            {
                id : 3,
                text:'Asistencias',
                orden : 'asistencias',
                sentido : "",
                temporada : "",
                clase : ""
            },
            {
                id : 4,
                text:'Amarillas',
                orden : 'amarillas',
                sentido : "",
                temporada : "",
                clase : ""
            },
            {
                id : 5,
                text:'Rojas',
                orden : 'rojas',
                sentido : "",
                temporada : "",
                clase : ""
            },
            {
                id : 6,
                text:'Valoración',
                orden : 'puntos',
                sentido : "",
                temporada : "",
                clase : ""
            }                        
        ];

        //$scope.temp = "Todas";
        $scope.cargaTemporadas = function() {
            $scope.temporadas =[];
            $http.get("../json/json_temporadas.php").success(function(data){
                    data.push({"temporada":"Todas"});
                    //console.log(data);
                    $scope.temporadas = data;
                    //console.log($scope.myColor['temporada']);
                    $scope.myColor = $scope.temporadas[$scope.temporadas.length - 1];                    
                    //console.log($scope.myColor.temporada);
                    
            });
        }
        $scope.cargaCliente = function(temp,orden) {
		
                console.log(temp)
                console.log(orden)
                $scope.currPage = 0;
		$scope.pageSize = 10;

                
                //$scope.predicate = '-apodo';
                $scope.totgoles = 0 ;
                $scope.maxgoles = "" ;
                $scope.imggoles = "";
                $scope.totamarillas = 0 ;
                $scope.maxamarillas = "" ;
                $scope.imgamarillas = "";
                $scope.totasistencias = 0 ;
                $scope.maxasistencias = "" ;
                $scope.imgasistencias = "";
                $scope.totrojas = 0 ;
                $scope.maxrojas = "" ;
                $scope.imgrojas = "";
                $scope.totpuntos="";
                $scope.maxpuntos="";
                $scope.imgpuntos="";
                //$scope.myColor = "";
                
                for(i=0;i<$scope.clientes.length;i++){                    
                    $scope.clientes[i]["foto"] = "-";
                    $scope.clientes[i]["apodo"] = "-";
                    $scope.clientes[i]["partidos"] = "-";
                    $scope.clientes[i]["goles"] = "-";
                    $scope.clientes[i]["asistencias"] = "-";
                    $scope.clientes[i]["amarillas"] = "-";
                    $scope.clientes[i]["rojas"] = "-";
                    $scope.clientes[i]["puntos"] = "-";
                    
                }
                console.log($scope.clientes);
                
		/* 
			con esta scope function estamos contando el total de registros
			para indicar en cual pagina estamos de cuanta existentes
			el math.ceil es para rendodear el resultado
		*/
		$scope.totalCliente = function() {
			return Math.ceil($scope.clientes.length / $scope.pageSize);
		}

		/*
			Hacemos una llamada AJAX por medio de getJSON ya que desde
			PHP le mandaremos un JSON 
	    */
                
                
                    if(temp==''){
                        temp='Todas';
                    }
                    for(i=0;i<$scope.cabeceras.length;i++){
                        if($scope.cabeceras[i]["orden"]==orden){
                            
                            if($scope.cabeceras[i]["sentido"]=="desc"){
                                //console.log('wwww');
                                $scope.cabeceras[i]["clase"]="color: red;background-image: url(../flecha_abajo.gif);background-repeat: no-repeat;background-position: center left;padding-left : 14px;";
                                orden= orden + "";
                                $scope.cabeceras[i]["sentido"]="";
                            }else{
                                $scope.cabeceras[i]["clase"]="color: red;background-image: url(../flecha_arriba.gif);background-repeat: no-repeat;background-position: center left;padding-left : 14px;";
                                $scope.cabeceras[i]["sentido"]="desc";
                                orden= orden + " desc";
                            }    
                        }else{
                            $scope.cabeceras[i]["clase"]="";
                            $scope.cabeceras[i]["sentido"]="";
                        }
                        $scope.cabeceras[i]["temporada"]=temp;
                    }
                    console.log($scope.cabeceras);
                    
                    
                    $http.get("http://batallines.es/json/json_recupera_estadisticas.php?temporada=" + temp + "&jornada=1&orden=" + orden,{ cache: true}).success(function(data){
                    $scope.clientes = data;
                    for(i=0;i<$scope.clientes.length;i++){    
                        
                        if(parseInt($scope.clientes[i]["goles"]) >= $scope.totgoles){
                            //console.log($scope.clientes[i]["apodo"] + " " + $scope.clientes[i]["goles"]);
                            $scope.maxgoles = $scope.clientes[i]["apodo"];
                            $scope.totgoles = $scope.clientes[i]["goles"];
                            $scope.imggoles = $scope.clientes[i]["foto"];
                        }
                        if(parseInt($scope.clientes[i]["puntos"]) >= $scope.totpuntos){
                            //console.log($scope.clientes[i]["apodo"] + " " + $scope.clientes[i]["goles"]);
                            $scope.maxpuntos = $scope.clientes[i]["apodo"];
                            $scope.totpuntos = $scope.clientes[i]["puntos"];
                            $scope.imgpuntos = $scope.clientes[i]["foto"];
                        }if(parseInt($scope.clientes[i]["asistencias"]) >= $scope.totasistencias){
                            //console.log($scope.clientes[i]["apodo"] + " " + $scope.clientes[i]["asistencias"]);
                            $scope.maxasistencias = $scope.clientes[i]["apodo"];
                            $scope.totasistencias = $scope.clientes[i]["asistencias"];
                            $scope.imgasistencias = $scope.clientes[i]["foto"];
                        }
                    }
                    //console.log($scope.maxgoles + " " + $scope.totgoles);
                    $scope.resumenes[0] = ({"apodo" :$scope.maxgoles , "total" :$scope.totgoles , "foto" : $scope.imggoles , "tipo" : "Máximo Goleador"});
                    $scope.resumenes[1] = ({"apodo" :$scope.maxasistencias , "total" :$scope.totasistencias , "foto" : $scope.imgasistencias , "tipo" : "Máximo Asistente"});
                    $scope.resumenes[2] = ({"apodo" :$scope.maxpuntos , "total" :$scope.totpuntos , "foto" : $scope.imgpuntos , "tipo" : "Mejor Valorado"});
                    
                    //console.log($scope.resumenes[1]["foto"]);
                
                    
                });
                //console.log("fin");
                
                
                
                
//                $.ajax({
//                        url: "http://batallines.es/json/json_recupera_estadisticas.php",
//                        type: "POST",
//                        crossDomain: true,
//                        data: { temporada: "2013/2014", jornada: "1" },
//                        success: function (data) {
//                                    console.log(data);	
//                                    $scope.$apply(function() { /* Este seria el resultado devuelto desde PHP */
//                                        console.log("json");
//                                        $scope.clientes = data;
//                                    });
//                        },
//                        error: function (xhr, ajaxOptions, thrownError) {
//                        }
//                 });
    
//                $.getJSON('json_recupera_estadisticas.php?jornada=1&temporada=2013/2014', function(data) {
//		    console.log(data);	
//                    $scope.$apply(function() { /* Este seria el resultado devuelto desde PHP */
//				$scope.clientes = data;
//			});
//		});
	}

}
function resumen($scope) {
    $scope.resumenes = [];
    
}
/*
	Creamos el filtro que estamos utilizando desde nuestro HTML
	para la paginacion y la navegación de las paginas
*/
clienteApp.filter('startFrom', function() {
	return function(input, start) {
		start = +start;
		return input.slice(start);
	}
});