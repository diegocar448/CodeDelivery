angular.module('starter.services')
.factory('$localStorage', ['$window', function($window){
	return{
		set: function(key, value){
			$window.localStorage[key] = value; //qdo a gente passa a key ja cria o espaço e nosso container
			return $window.localStorage[key]; //retornar o valor baseado na chave q acabou de criar //set é so para dado puro
		},
		get: function(key, defaultValue){
			return $window.localStorage[key] || defaulValue; //procure em nosso locaSto.. com chave tal senão passe a defaultValue
		},
		setObject: function(key, value){
			$window.localStorage[key] = JSON.stringify(value);
			return this.getObject(key); //pegar o um objeto q ja esta pronto
		},
		getObject: function(key){
			//para pegar o objeto fazemos o processo ao controrio do setObject
			return JSON.parse($window.localStorage[key] || null); //se nao tiver ($window.localStorage[key]) passamos o null
		}
	}
}]);