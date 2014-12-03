var app=angular.module('customerProfile',[]);

app.config(['$httpProvider',function ($httpProvider) {
    $httpProvider.defaults.useXDomain = true;
    delete $httpProvider.defaults.headers.common['X-Requested-With'];
 }]);
app.controller('customerLoginController', function($scope, $http, $location) {
    $scope.customer = {
        username: '',
        password: ''
    },

    $scope.login = function(customer) {
              
            $http.post('http://54.183.86.60/v1/session', customer)
            .success(function(data, status, headers, config) {
               console.log(data);
            
                      window.location = "home.html"
                      
                           
            })
            .error(function() {
                alert("wrong username and password");
                console.log("Error ");

            })


    };


 $scope.logout = function(customer) {
      $http.get('http://54.183.86.60/v1/session/delete',customer).success(function() {
       
        return  window.location = "index.html";
                 
      });

    }


});