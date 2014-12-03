angular.module('se', []);

var login = angular.module('LoginCtrl',[]);
 
 login.controller('LoginController',function($scope,$location,Login,SessionService){
 
 $scope.loginSubmit = function(){
 var auth = Login.auth($scope.loginData);
 auth.success(function(response){
 if(response.id){
 SessionService.set('auth',true); //This sets our session key/val pair as authenticated
 }else alert('could not verify your login');
 });
 }


 });


 login.factory('Login',function($http){
return{
auth:function(credentials){
var authUser = $http({method:'POST',url:'http://54.183.86.60/v1/session',params:credentials});
return authUser;
}
}
});


login.factory('SessionService',function(){
return{
get:function(key){
return sessionStorage.getItem(key);
},
set:function(key,val){
return sessionStorage.setItem(key,val);
},
unset:function(key){
return sessionStorage.removeItem(key);
}
}
});