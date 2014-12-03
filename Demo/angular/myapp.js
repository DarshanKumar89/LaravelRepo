var app=angular.module('customerProfile',[]);
app.controller('customerLoginController', function($scope, $http, $location) {
    $scope.customer = {
        username: '',
        password: ''
    },

    $scope.login = function(customer) {
        console.log("Submitting user details");
            $http.post('http://54.183.86.60/v1/session', customer)
            .success(function(data, status, headers, config) {
                console.log(msg.data);
            })
            .error(function() {
                console.log("Error ");
            })


    };

});