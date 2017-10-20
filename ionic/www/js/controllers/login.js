angular.module('starter.controllers')
	.controller('LoginCtrl', [
		'$scope', 'OAuth', '$ionicPopup', '$state',  function($scope, OAuth, $ionicPopup, $state){

		$scope.user = {
			username: '',
			password: ''
		};

		$scope.login = function(){
			OAuth.getAccessToken($scope.user)			
				.then(function(data){ //fazemos a requisição do nosso token e passamos o username e o password					
					$state.go('home');//redirecionar para home

			}, function(responseError){ //entra aqui qdo não tiver sucesso
				$ionicPopup.alert({
					title: 'Advertência',
					template: 'Login e/ou senha inválidos'
				})
				console.debug(responseError);
			});
		}
	}]);