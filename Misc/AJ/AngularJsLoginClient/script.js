var app = angular.module('myApp', []);


app.config(function($httpProvider) {

    $httpProvider.defaults.useXDomain = true;

    delete $httpProvider.defaults.headers.common['X-Requested-With'];
});
app.controller('MainCtrl', function($scope,SessionService,Login) {
  
                app.config(['$httpProvider', function($httpProvider) {
        delete $httpProvider.defaults.headers.common["X-Requested-With"]
    }]);

  $scope.submit=function()
  {
    

     if($scope.username && $scope.password)
     {
   
     // alert('login'+$scope.username);

      var auth = Login.auth($scope.username,$scope.password);
    alert('login:'+$scope.username);
   //SessionService.set('auth',true);
   
  $location.absUrl() = 'home.html';
     }else{
       alert("Invalid Login");
     }
  

  }
});



 
 
app.factory('Login',function($http){


return{

auth:function(credentials){
  console.log(credentials);

var authUser = $http({method:'POST',url:'http://54.183.86.60/v1/session',params:credentials});

return authUser;
}
}
});





app.factory('SessionService',function(){
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
