var app = angular.module('myApp', []);

app.run(function ($http, $cookies) {
    $http.defaults.headers.post['x-csrf-token'] = $cookies._csrf;
  });

app.config(function($httpProvider) {

    $httpProvider.defaults.useXDomain = true;

    delete $httpProvider.defaults.headers.common['X-Requested-With'];
});
app.controller('MainCtrl', function($scope,SessionService,Login) {
  

  $scope.submit=function()
  {
    

     if($scope.username && $scope.password)
     {
   
  
      var auth = Login.auth($scope.username,$scope.password);
 
   
 
     }else{
       alert("Invalid Login");
     }
  

  }
});



app.factory('Login',function($http){


return{

auth:function(degree){

 console.log(degree);

var authUser = $http({method:'POST',url:'http://54.183.86.60/v1/session',params:degree});

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
