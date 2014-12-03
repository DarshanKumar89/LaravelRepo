controllers.controller('MainCtrl', function($scope, $location, Facebook, $rootScope, $http, $location, Upload, Auth, User, Question, Category, Serie, Record, Location, Popup, Process, Card, Question) {
  $scope.$on('authLoaded', function() {
		$scope.isExpert($scope.main.serieId);
		$scope.isMember($scope.main.serieId);
	});

	$scope.loadAuth = function() {
		Auth.load().success(function(data) {
			$scope.main.user = data.user;
			$scope.$broadcast("authLoaded");
			Popup.close();
		});
	}
  
  
	$scope.logoutUser = function() {
		Auth.logout().success(function(data) {
			toastr.info("You have been logged out.");
			$scope.main.user = {};
		});
	}

	$scope.loginUser = function() {
		Auth.login({
			username: $scope.main.credentials.email,
			password: $scope.main.credentials.password
		}).success(function(data) {
			if (data.error) {
				toastr.error(data.error);
			} else {
				toastr.success("You are signed in!");
				$scope.loadAuth();
				$scope.main.credentials = {};
				Popup.close();
			}
		});
	}

	$scope.registerUser = function() {
		Auth.register({
			serie_id: $scope.main.serieId,
			email: $scope.newUser.email,
			password: $scope.newUser.password,
			terms: $scope.newUser.terms,
			name: $scope.newUser.name,
		}).success(function(data) {
			if (data.error) {
				toastr.error(data.error);
			}

			if (data.success) {
				toastr.success("Welcome to " + $scope.main.serie.name + "!");
				$scope.loadAuth();
				$scope.newUser = {};
				Popup.close();
			}
		});
	}
 	
 	$scope.loadAuth();
	$scope.loadSerie();
});