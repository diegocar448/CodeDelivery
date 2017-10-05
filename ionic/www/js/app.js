// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter', ['ionic', 'starter.controllers', 'angular-oauth2'])

.value('meuValue', { //criar o serviço meuValue com o nome Diego Cardoso
    name: "Diego Cardoso",
    endereco: "Rua xxx",
    minhaFuncao: function(){
        console.log("minha funcao");
    }
})

.run(function($ionicPlatform, meuValue) {
    console.log(meuValue);
    meuValue.name = "Outro nome";
    $ionicPlatform.ready(function() {
        if(window.cordova && window.cordova.plugins.Keyboard) {
          // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
          // for form inputs)
          cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

          // Don't remove this line unless you know what you are doing. It stops the viewport
          // from snapping when text inputs are focused. Ionic handles this internally for
          // a much nicer keyboard experience.
          cordova.plugins.Keyboard.disableScroll(true);
        }
        if(window.StatusBar) {
          StatusBar.styleDefault();
        }
    });
})

//ele busca a provider nesse caso o $stateProvider será $state opcional + Provider obrigatorio = $stateProvide
.config(function($stateProvider, $urlRouterProvider, OAuthProvider, OAuthTokenProvider){

    OAuthProvider.configure({
      baseUrl: 'http://localhost:8000',
      clientId: 'appid01',
      clientSecret: 'secret', // optional
      grantPath: '/oauth/access_token' //essa e o caminho para pegarmos o nosso token
    });

    OAuthTokenProvider.configure({
        name: 'token',
        options: {
            secure: false //ele vai usar encriptração como o https se for True
        }
    });


    $stateProvider
        .state('login', { 
            url: '/login',
            templateUrl: 'templates/login.html',
            controller: 'LoginCtrl'
        })
        .state('home', { 
            url: '/home',
            templateUrl: 'templates/home.html',
            controller: function($scope, meuValue){
                console.log(meuValue);
                meuValue.minhaFuncao();
            }
        });


    //$urlRouterProvider.otherwise('/'); //rota padrão caso tente acessar rota inexistente
});



