var app = angular.module("app", []);

app.controller("AppCtrl", function($http) {
    var app = this;
    $http.get("http://54.183.86.60/v1/session")
      .success(function(data) {
        app.people = data;
      })

    app.addPerson = function(person) {
        $http.post("http://54.183.86.60/v1/session", person)
          .success(function(data) {
            app.people = data;
          })
    }
})