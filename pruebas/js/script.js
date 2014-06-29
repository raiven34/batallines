//Creamos el modulo de nuestra aplicación
var clienteApp = angular.module('clienteApp', []);


/*
	Creamos el controlador diciendole que tendremos $scope 
	y una llamada de ajax por eso le pasamos el $http
	si no le agrgamos el $http tendremos un bucle infinito de error xD
	as la prueba para que veas de lo que estamos hablando
*/

function clienteCtrl($scope, $http) {
	//$scope.myColor = "todas";
        $scope.cargaTemporadas = function() {
            $scope.temporadas =[];
            $http.get("../json/json_temporadas.php").success(function(data){
                    data.push({"temporada":"Todas"});
                    console.log(data);
                    $scope.temporadas = data;
                    //console.log($scope.myColor['temporada']);
                    $scope.myColor = $scope.temporadas[0];                    
                    //console.log($scope.myColor.temporada);
                    
            });
        }
        $scope.cargaCliente = function(temp) {
		
                console.log(temp)
                $scope.currPage = 0;
		$scope.pageSize = 10;
		$scope.clientes = [];
                $scope.resumenes =[];
                
                $scope.predicate = '-apodo';
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
                
                //$scope.myColor = "";
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
                        temp='2013/2014';
                    }
                    $http.get("http://batallines.es/json/json_recupera_estadisticas.php?temporada=" + temp + "&jornada=1").success(function(data){
                    $scope.clientes = data;
                    for(i=0;i<$scope.clientes.length;i++){    
                        
                        if(parseInt($scope.clientes[i]["goles"]) >= $scope.totgoles){
                            //console.log($scope.clientes[i]["apodo"] + " " + $scope.clientes[i]["goles"]);
                            $scope.maxgoles = $scope.clientes[i]["apodo"];
                            $scope.totgoles = $scope.clientes[i]["goles"];
                            $scope.imggoles = $scope.clientes[i]["foto"];
                        }
                        if(parseInt($scope.clientes[i]["amarillas"]) >= $scope.totamarillas){
                            //console.log($scope.clientes[i]["apodo"] + " " + $scope.clientes[i]["goles"]);
                            $scope.maxamarillas = $scope.clientes[i]["apodo"];
                            $scope.totamarillas = $scope.clientes[i]["amarillas"];
                            $scope.imgamarillas = $scope.clientes[i]["foto"];
                        }if(parseInt($scope.clientes[i]["asistencias"]) >= $scope.totasistencias){
                            //console.log($scope.clientes[i]["apodo"] + " " + $scope.clientes[i]["asistencias"]);
                            $scope.maxasistencias = $scope.clientes[i]["apodo"];
                            $scope.totasistencias = $scope.clientes[i]["asistencias"];
                            $scope.imgasistencias = $scope.clientes[i]["foto"];
                        }if(parseInt($scope.clientes[i]["rojas"]) >= $scope.totrojas){
                            //console.log($scope.clientes[i]["apodo"] + " " + $scope.clientes[i]["rojas"]);
                            $scope.maxrojas = $scope.clientes[i]["apodo"];
                            $scope.totrojas = $scope.clientes[i]["rojas"];
                            $scope.imgrojas = $scope.clientes[i]["foto"];
                        }
                    }
                    //console.log($scope.maxgoles + " " + $scope.totgoles);
                    $scope.resumenes.push({"apodo" :$scope.maxgoles , "total" :$scope.totgoles , "foto" : $scope.imggoles , "tipo" : "Máximo Goleador"});
                    $scope.resumenes.push({"apodo" :$scope.maxasistencias , "total" :$scope.totasistencias , "foto" : $scope.imgasistencias , "tipo" : "Máximo Asistente"});
                    $scope.resumenes.push({"apodo" :$scope.maxamarillas , "total" :$scope.totamarillas , "foto" : $scope.imgamarillas , "tipo" : "Jugador Con Más Amarillas"});
                    $scope.resumenes.push({"apodo" :$scope.maxrojas , "total" :$scope.totrojas , "foto" : $scope.imgrojas , "tipo" : "Jugador Con Más Rojas"});
                    //console.log($scope.resumenes[1]["foto"]);
                
                    
                });
                console.log("aaaa");
                
                
                
                
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