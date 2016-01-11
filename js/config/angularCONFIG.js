/**
 * 
 */

var myApp = angular.module("GSS",[]);

myApp .config(['$routeProvider',
    function($routeProvider){
        $routeProvider.
                when ('/dashboard',{templateUrl:'templates/dashboard/index.html', controller:'DashboardController'}).
                when ('/about',{
                    templateUrl: 'templates/about/index.html',
                    controller: 'AboutController'
            }).
                
                otherwise({redirectTo: '/dashboard'});
    }]);




//myApp .config(['$routeProvider',
//    function($routeProvider){
//        $routeProvider.
//                when ('/Show',{templateUrl:'pages/Show.html', controller:'ShowController'}).
//                when ('/Show/:param',{templateUrl: 'pages/ShowParam.html?:param', controller:'ShowParamController'}).
//                when ('/Add',{
//                    templateUrl: 'pages/Add.html',
//                    controller: 'AddController'
//        }).
//                when ('/Local',{
//                    //templateUrl: 'pages/Local.html',
//                    templateUrl: 'pages/Add.html',
//                    controller: 'LocalTemplateController'
//        }).
//                when ('/Data',{
//                    templateUrl: 'pages/CommonData.html',
//                    controller: 'CommonDataController',
//                    foodata : 'Common Data'
//        }).
//                otherwise({redirectTo: '/Show'});
//    }]);
//
//myApp.controller('ShowController',function($scope){
//    $scope.message = 'This is the Show Controller';
//});
//
//myApp.controller('AddController',function($scope){
//    $scope.message = 'This is the Add Controller';
//});
//
//myApp.controller('ShowParamController',function($scope, $routeParams){
//    $scope.message = 'This is the ShowParam Controller with param = '/*+$routeParams.param*/;
//    $scope.param = $routeParams.param;
//    
//});
//
//myApp.controller('LocalTemplateController',function($scope){
//    $scope.message = 'This is the Local Temp Controller ';
//});
//
//myApp.controller('CommonDataController',function($scope, $route){
//    $scope.message = 'This is the Common Data Controller & Data = ';
//    $scope.data = $route.current.foodata;
//});


