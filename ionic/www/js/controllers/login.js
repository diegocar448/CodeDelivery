angular.module('starter.controllers', [])
	.controller('LoginCtrl', ['$scope', 'OAuth', function($scope, OAuth){
		$scope.user = {
			username: '',
			password: ''
		};

		$scope.login = function(){
			OAuth.getAcessToken($scope.user)
				.then(function(data){ //fazemos a requisição do nosso token e passamos o username e o password
				console.log("login funcionando");

			}, function(responseError){ //entra aqui qdo não tiver sucesso

			});
		}
	}]);