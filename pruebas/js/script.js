//Creamos el modulo de nuestra aplicación
var clienteApp = angular.module('clienteApp', ['ngSanitize','factoryModule']);


/*
	Creamos el controlador diciendole que tendremos $scope 
	y una llamada de ajax por eso le pasamos el $http
	si no le agrgamos el $http tendremos un bucle infinito de error xD
	as la prueba para que veas de lo que estamos hablando
*/

function clienteCtrl($scope, $http,serviciotemporadas) {
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

        $scope.precargaResumenes = function() {
            for(i=0;i<$scope.resumenes.length;i++){  
                $scope.resumenes[i]['foto']="../img/cargando.gif";
            }
        }
        //$scope.temp = "Todas";
        $scope.cargaEstilo = function(cab) {
            //console.log("asdsadasd" + cab);
            if(cab==""){
                return  { padding : '14px'};
            }else{
                return  {color: 'rgb(255, 242, 0)' , background: 'url(../flecha_' + cab + '.gif) no-repeat center left' , padding : '14px'};
            }
        }
//        $scope.cargaTemporadas = function() {
//            $scope.temporadas =[];
//            $http.get("../json/json_temporadas.php").success(function(data){
//                    data.push({"temporada":"Todas"});
//                    //console.log(data);
//                    $scope.temporadas = data;
//                    //console.log($scope.myColor['temporada']);
//                    $scope.myColor = $scope.temporadas[$scope.temporadas.length - 1];                    
//                    //console.log($scope.myColor.temporada);
//                    
//            });
//        }
        $scope.temporadas=[];
        serviciotemporadas.recuperatemp().success(function(data){
            data.push({"temporada":"Todas"});
            $scope.temporadas=data;
            $scope.myColor = $scope.temporadas[$scope.temporadas.length - 1]; 
        });  
    
        
        $scope.cargaCliente = function(temp,orden,res) {
		
                //console.log(temp)
                //console.log(orden)
                $scope.currPage = 0;
		$scope.pageSize = 10;

                
                //$scope.predicate = '-apodo';
                $scope.totgoles = 0 ;
                $scope.maxgoles = "" ;
                $scope.imggoles = "img/anonimo.jpg";
                $scope.totamarillas = 0 ;
                $scope.maxamarillas = "" ;
                $scope.imgamarillas = "img/anonimo.jpg";
                $scope.totasistencias = 0 ;
                $scope.maxasistencias = "" ;
                $scope.imgasistencias = "img/anonimo.jpg";
                $scope.totrojas = 0 ;
                $scope.maxrojas = "" ;
                $scope.imgrojas = "img/anonimo.jpg";
                $scope.totpuntos=0;
                $scope.maxpuntos="";
                $scope.imgpuntos="img/anonimo.jpg";
                //$scope.myColor = "";
                
                for(i=0;i<$scope.clientes.length;i++){                    
                    $scope.clientes[i]["foto"] = "../img/cargando.gif";
                    $scope.clientes[i]["apodo"] = "-";
                    $scope.clientes[i]["partidos"] = "-";
                    $scope.clientes[i]["goles"] = "-";
                    $scope.clientes[i]["asistencias"] = "-";
                    $scope.clientes[i]["amarillas"] = "-";
                    $scope.clientes[i]["rojas"] = "-";
                    $scope.clientes[i]["puntos"] = "-";
                    
                }
                //console.log($scope.clientes);
                
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
                                $scope.cabeceras[i]["clase"]="abajo";
                                orden= orden + "";
                                $scope.cabeceras[i]["sentido"]="";
                            }else{
                                $scope.cabeceras[i]["clase"]="arriba";
                                $scope.cabeceras[i]["sentido"]="desc";
                                orden= orden + " desc";
                            }    
                        }else{
                            $scope.cabeceras[i]["clase"]="";
                            $scope.cabeceras[i]["sentido"]="";
                        }
                        $scope.cabeceras[i]["temporada"]=temp;
                    }
                    //console.log($scope.cabeceras);
                    
                    
                    $http.get("http://batallines.es/json/json_recupera_estadisticas.php?temporada=" + temp + "&jornada=1&orden=" + orden,{ cache: true}).success(function(data){
                    $scope.clientes = data;
                    if(res){
                        for(i=0;i<$scope.clientes.length;i++){    

                            if(parseInt($scope.clientes[i]["goles"]) > $scope.totgoles){
                                //console.log($scope.clientes[i]["apodo"] + " " + $scope.clientes[i]["goles"]);
                                $scope.maxgoles = $scope.clientes[i]["apodo"];
                                $scope.totgoles = $scope.clientes[i]["goles"];
                                $scope.imggoles = $scope.clientes[i]["foto"];
                            }
                            if(parseFloat($scope.clientes[i]["puntos"]) > $scope.totpuntos){
                                console.log($scope.clientes[i]["puntos"]);
                                $scope.maxpuntos = $scope.clientes[i]["apodo"];
                                $scope.totpuntos = $scope.clientes[i]["puntos"];
                                $scope.imgpuntos = $scope.clientes[i]["foto"];
                            }if(parseInt($scope.clientes[i]["asistencias"]) > $scope.totasistencias){
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
                     }
                    console.log($scope.resumenes);
                
                    
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
//partidos

function partidoCtrl($scope, $http,serviciotemporadas) {
        $scope.partidos = [];
        $scope.resumenes =[];
        $scope.detallepart = [
            {
                id : 0,
                text:'local',
                valor : 'Local',
            },            {
                id : 1,
                text:'Jornada',
                valor : '-',

            },            {
                id : 2,
                text:'Local',
                valor : '-',

            },
            {
                id : 3,
                text:'Visitante',
                valor : '-',

            },
            {
                id : 4,
                text:'goleslocal',
                valor : '-',

            }, 
            {
                id : 5,
                text:'golesvisitante',
                valor : '-',

            }
        
        ];        
        $scope.cabeceras = [
            {
                id : 0,
                text:'Temporada',
                orden : 'temporada',
                sentido : "",
                temporada : "",
                clase : ""
            },            {
                id : 1,
                text:'Jornada',
                orden : 'jornada',
                sentido : "",
                temporada : "",
                clase : ""
            },            {
                id : 2,
                text:'Local',
                orden : 'local',
                sentido : "",
                temporada : "",
                clase : ""
            },
            {
                id : 3,
                text:'Visitante',
                orden : 'visitante',
                sentido : "",
                temporada : "",
                clase : ""
            },
             
            {
                id : 6,
                text:'Fecha',
                orden : 'fecha',
                sentido : "",
                temporada : "",
                clase : ""
            },
            {
                id : 7,
                text:'Hora',
                orden : 'hora',
                sentido : "",
                temporada : "",
                clase : ""
            },
      
        ];

        $scope.precargaResumenes = function() {
            for(i=0;i<$scope.resumenes.length;i++){  
                $scope.resumenes[i]['foto']="../img/cargando.gif";
            }
        }
        //$scope.temp = "Todas";
        $scope.cargaModal = function(temp,jor) {
            $scope.incidencias=[];
            //console.log("asdsadasd" + cab);
            serviciotemporadas.recuperadetallepart(temp,jor).success(function(data){
                $scope.detallepart = data;
                for(i=0;i<parseInt($scope.detallepart[1]["goles"]);i++){
                    console.log("aaaaaaaaa");
                }

                
            });
            
        }
//        $scope.cargaIncidencias = function(goles,asistencias,rojas,amarillas) {
//            total=parseInt(goles) + parseInt(asistencias) + parseInt(rojas) + parseInt(amarillas);
//            for(i=0;i<total;i++){ 
//                $scope.incidencias=[];
//                for(a=0;a<parseInt(goles);a++){
//                    $scope.incidencias.push({"valor":"../balon.png"})
//                }
//                for(a=0;a<parseInt(asistencias);a++){
//                    $scope.incidencias.push({"valor":"../asistencias.gif"})
//                }
//                for(a=0;a<parseInt(amarillas);a++){
//                    $scope.incidencias.push({"valor":"../amarillas.png"})
//                }
//                for(a=0;a<parseInt(rojas);a++){
//                    $scope.incidencias.push({"valor":"../rojas.png"})
//                }                
//               
//            }
//            $scope.detallepart[1].push($scope.incidencias);
//            console.log($scope.detallepart);
//        }
        $scope.getNumber = function(num) {
            return new Array(num);   
        }
        $scope.cargaEstilo = function(cab) {
            //console.log("asdsadasd" + cab);
            if(cab==""){
                return  { padding : '14px'};
            }else{
                return  {color: 'rgb(255, 242, 0)' , background: 'url(../flecha_' + cab + '.gif) no-repeat center left' , padding : '14px'};
            }
        }
        $scope.temporadas=[];
        serviciotemporadas.recuperatemp().success(function(data){
            data.push({"temporada":"Todas"});
            $scope.temporadas=data;
            $scope.myColor = $scope.temporadas[$scope.temporadas.length - 1]; 
        });  
        $scope.cargaPartido = function(temp,orden,res) {
		
                //console.log(temp)
                //console.log(orden)
                $scope.currPage = 0;
		$scope.pageSize = 10;

                
                //$scope.predicate = '-apodo';
                $scope.totganados = 0 ;
                $scope.totempatados = 0 ;
                $scope.totperdidos = 0 ;
                //$scope.myColor = "";
                
                for(i=0;i<$scope.partidos.length;i++){                    
                    $scope.partidos[i]["temporada"] = "-";
                    $scope.partidos[i]["jornada"] = "-";
                    $scope.partidos[i]["local"] = "-";
                    $scope.partidos[i]["visitante"] = "-";
                    $scope.partidos[i]["resultado"] = "-";
                    $scope.partidos[i]["fecha"] = "-";
                    $scope.partidos[i]["hora"] = "-";
                    
                }
                //console.log($scope.partidos);
                
		/* 
			con esta scope function estamos contando el total de registros
			para indicar en cual pagina estamos de cuanta existentes
			el math.ceil es para rendodear el resultado
		*/
		$scope.totalPartido = function() {
			return Math.ceil($scope.partidos.length / $scope.pageSize);
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
                                $scope.cabeceras[i]["clase"]="abajo";
                                orden= orden + "";
                                $scope.cabeceras[i]["sentido"]="";
                            }else{
                                $scope.cabeceras[i]["clase"]="arriba";
                                $scope.cabeceras[i]["sentido"]="desc";
                                orden= orden + " desc";
                            }    
                        }else{
                            $scope.cabeceras[i]["clase"]="";
                            $scope.cabeceras[i]["sentido"]="";
                        }
                        $scope.cabeceras[i]["temporada"]=temp;
                    }
                    if(orden==''){
                        $scope.cabeceras[0]["clase"]="arriba";
                        $scope.cabeceras[1]["clase"]="arriba";
                    }
                    //console.log($scope.cabeceras);
                    
                    
                    
                    $http.get("http://batallines.es/json/json_recupera_partidos.php?temporada=" + temp + "&orden=" + orden,{ cache: true}).success(function(data){
                    $scope.partidos = data;
                    if(res){
                        for(i=0;i<$scope.partidos.length;i++){    
                            $scope.partidos[i] == new Object();
                            if($scope.partidos[i]["jugado"]=="S"){
                                if($scope.partidos[i]["local"] == "BATALLINES FC"){
                                    //console.log(parseInt($scope.partidos[i]["goleslocal"]));
                                    if(parseInt($scope.partidos[i]["goleslocal"]) > parseInt($scope.partidos[i]["golesvisitante"])){
                                        $scope.totganados = $scope.totganados + 1 ;
                                        $scope.partidos[i].res = "success";

                                    }else if(parseInt($scope.partidos[i]["goleslocal"]) < parseInt($scope.partidos[i]["golesvisitante"])){
                                        $scope.totperdidos = $scope.totperdidos + 1 ;
                                        $scope.partidos[i].res = "danger";
                                    }else{
                                        $scope.totempatados = $scope.totempatados + 1 ;
                                        $scope.partidos[i].res = "warning";
                                    }

                                }else{
                                    if(parseInt($scope.partidos[i]["goleslocal"]) > parseInt($scope.partidos[i]["golesvisitante"])){
                                        $scope.totperdidos = $scope.totperdidos + 1 ;
                                        $scope.partidos[i].res = "danger";
                                    }else if(parseInt($scope.partidos[i]["goleslocal"]) < parseInt($scope.partidos[i]["golesvisitante"])){                                    
                                        $scope.totganados = $scope.totganados + 1 ;
                                        $scope.partidos[i].res = "success";
                                    }else{
                                        $scope.totempatados = $scope.totempatados + 1 ;
                                        $scope.partidos[i].res = "warning";
                                    }                                
                                }
                            }
                        }
                        //console.log($scope.maxgoles + " " + $scope.totgoles);
                        $scope.resumenes[0] = ({"total" :$scope.totganados , "foto" : $scope.imggoles , "tipo" : "Partidos Ganados"});
                        $scope.resumenes[1] = ({"total" :$scope.totempatados , "foto" : $scope.imggoles , "tipo" : "Partidos Empatados"});
                        $scope.resumenes[2] = ({"total" :$scope.totperdidos , "foto" : $scope.imggoles , "tipo" : "Partidos Perdidos"});
                     }
                    console.log($scope.partidos);
                
                    
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
function noticiasCtrl($scope, $http) {
        $scope.noticias = [];
        $scope.cargaNoticias = function() {
		
                //console.log(temp)
                //console.log(orden)
                $scope.currPage = 0;
		$scope.pageSize = 5;

                
                

                //console.log($scope.partidos);
                
		/* 
			con esta scope function estamos contando el total de registros
			para indicar en cual pagina estamos de cuanta existentes
			el math.ceil es para rendodear el resultado
		*/
		$scope.totalNoticias = function() {
			return Math.ceil($scope.noticias.length / $scope.pageSize);
		}

		/*
			Hacemos una llamada AJAX por medio de getJSON ya que desde
			PHP le mandaremos un JSON 
	    */
                

                    
                    
                    $http.get("http://batallines.es/json/json_recupera_noticias.php?",{ cache: false}).success(function(data){
                    $scope.noticias = data;
                    console.log($scope.noticias);
                
                    
                });
                //console.log("fin");
                
                
                
                

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