angular.module('starter.controllers', [])
	.controller('LoginCtrl', [
		'$scope', 'OAuth', '$cookies', '$ionicPopup', function($scope, OAuth, $cookies, $ionicPopup){
		$scope.user = {
			username: '',
			password: ''
		};

		$scope.login = function(){
			OAuth.getAccessToken($scope.user)
				.then(function(data){ //fazemos a requisição do nosso token e passamos o username e o password
					console.log(data);
					console.log($cookies.getObject('token')); //pegar o cookie chamado token

			}, function(responseError){ //entra aqui qdo não tiver sucesso
				$ionicPopup.alert({
					title: 'Advertência',
					template: 'Login e/ou senha inválidos'
				})
				console.debug(responseError);
			});
		}
	}]);