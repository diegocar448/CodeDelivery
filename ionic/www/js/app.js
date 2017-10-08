// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starter.controllers', []);

angular.module('starter', ['ionic', 'starter.controllers', 'angular-oauth2', 'ngResource'])


.constant('appConfig', {
    baseUrl: 'http://localhost:8000'
})

.run(function($ionicPlatform) {
        
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
.config(function($stateProvider, $urlRouterProvider, OAuthProvider, 
                OAuthTokenProvider, appConfig ){

    OAuthProvider.configure({
      baseUrl: appConfig.baseUrl,
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
            controller: function($scope){

            }
        })
        .state('client', {
            abstract:true, //tudo vai passar por ela mas não quer dizer q estará nela
            url: '/client',
            template: '<ui-view/>'
        })
        .state('client.checkout', {
            url: '/checkout',
            templateUrl: 'templates/client/checkout.html',
            controller: 'ClientCheckoutCtrl'
        })
        .state('client.checkout_item_detail', {
            url: '/checkout/detail/:index',
            templateUrl: 'templates/client/checkout_item_detail.html',
            controller: 'ClientCheckoutDetailCtrl'
        })
        .state('client.view_products', {
            url: '/view_products',
            templateUrl: 'templates/client/view_products.html',
            controller: 'ClientViewProductCtrl'
        })

    //$urlRouterProvider.otherwise('/'); //rota padrão caso tente acessar rota inexistente
});



