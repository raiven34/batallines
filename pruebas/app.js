'use strict';

// Declare app level module which depends on views, and components
angular.module('myApp', ['ngRoute','controllerModule'])


.config(function($routeProvider, $locationProvider) {
   
   $routeProvider
   .when('/admin', {
    templateUrl: 'views/admin.html',
    controllerAs:"vs",
    controller: 'admin',
    resolve: {
      // I will cause a 1 second delay
      delay: function($q, $timeout) {
        var delay = $q.defer();
        $timeout(delay.resolve, 1000);
        return delay.promise;
      }
    }
  })
  .when('/admin/estadisticas/:idjornada', {
    templateUrl: 'views/detallepartido.html',
    controllerAs:"vs",
    controller: 'detallepartido'
  })
  .when('/admin/enviar_notificacion', {
    templateUrl: 'views/enviar_notificacion.html',
    controllerAs:"vs",
    controller: 'notificacion'
  })
  .when('/admin/estadisticas', {
    templateUrl: 'views/estadisticas.html',
    controllerAs:"vs",
    controller: 'estadisticas'
  })  
  .otherwise({ redirectTo: '/admin' });

  // configure html5 to get links working on jsfiddle
  
});