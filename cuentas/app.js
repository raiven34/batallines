'use strict';

// Declare app level module which depends on views, and components
angular.module('myApp', ['ngRoute','controllerModule'])


.config(function($routeProvider, $locationProvider) {
   
   $routeProvider
   .when('/login', {
    templateUrl: 'views/login.html',
    controllerAs:"vs",
    controller: 'login'
  })
  .when('/principal', {
    templateUrl: 'views/principal.html',
    controllerAs:"vs",
    controller: 'principal'
  })
  .when('/graficas', {
    templateUrl: 'views/graficas.html',
    controllerAs:"vs",
    controller: 'graficas'
  })
  .when('/admin/estadisticas', {
    templateUrl: 'views/estadisticas.html',
    controllerAs:"vs",
    controller: 'estadisticas'
  })  
  .otherwise({ redirectTo: '/login' });

  // configure html5 to get links working on jsfiddle
  
});