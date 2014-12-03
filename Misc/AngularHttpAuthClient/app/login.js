(function() {
  'use strict';
  angular.module('login',['http-auth-interceptor'])
  
  .controller('LoginController', function ($scope, $http, authService) {
    $scope.submit = function() {
      $http.post('http://54.183.86.60/v1/session').success(function() {
        authService.loginConfirmed();
      });
    }
  });
})();
