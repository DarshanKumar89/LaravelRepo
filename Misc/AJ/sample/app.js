var app = angular.module('se',['LoginCtrl','AuthSrvc']);
 
 app.run(function(){
 
 });
 
 //This will handle all of our routing
 app.config(function($routeProvider, $locationProvider){
 
$routeProvider.when('/',{
templateUrl:'index.html',
controller:'LoginController'
});
 
});