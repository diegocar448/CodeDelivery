angular.module('starter.controllers', []).
	controller('HomeCtrl', function($scope, $state, $stateParams){ //$stateParams serviço para pegar parametros //$state gerenciar o redirecionamento para outros estados e pegar inf do estado
                $scope.state  = $state.current; //pegar o estado q esta no momento
                $scope.nome = $stateParams.nome;
          	});