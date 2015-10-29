<!DOCTYPE html>
<html ng-app="waterApp">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-route.js"></script>
<style>

</style>
</head>
<body>

    <div ng-controller="mainController">
        <a href="#tableau" ng-click="switchView()">Tableau</a>
        <a href="#plain" ng-click="switchView()">Plain</a>
        <div ng-view></div>
    </div>



<script type="text/javascript">
    var waterApp = angular.module('waterApp', [
        'ngRoute',
        'myService',
        'myService2',
        'mainController',
        'tableauController',
        'plainController'
    ])
    .config(['$routeProvider', '$locationProvider',function($routeProvider, $locationProvider) {
        $routeProvider
        .when('/tableau', {
            templateUrl: 'templates/tableau.tpl.html',
            controller: 'tableauController'
        })
        .when('/plain', {
            templateUrl: 'templates/plain.tpl.html',
            controller: 'plainController'
        })
        .otherwise({
            redirectTo: '/tableau'
        });
    }]);

    var myService = angular.module('myService', []);
    myService.factory('myService', ['$http', function ($http) {

        var getData = function () {
            return $http({method: 'GET', url: 'server.php'});
        };

        return {
            getData: getData
        };
    }]);

    var myService2 = angular.module('myService2', []);
    myService2.factory('myService2', function ($http) {
        var environment;

        var getEnv = function () {
            return environment;
        };

        var setEnv = function (value) {
            environment = value;
        }

        return {
            getEnv: getEnv,
            setEnv: setEnv
        };
    });

    var mainController = angular.module('mainController', ['myService2']);
    mainController.controller('mainController', [
        '$scope',
        '$route',
        '$routeParams',
        '$location',
        'myService',
        'myService2',
        function($scope, $route, $routeParams, $location, myService, myService2) {
            console.log('main controller');

            $scope.$on('$viewContentLoaded', function (event) {
                console.log('view content loaded');

                myService.getData().then(function (response) {
                    $scope.name = response.data.name;
                    $scope.age = response.data.age;
                    $scope.timestamp = response.data.timestamp;
                });

            });

            myService2.setEnv('dev');
        }
    ]);

    var tableauController = angular.module('tableauController', []);
    tableauController = waterApp.controller('tableauController', ['$scope', function($scope) {
        console.log('tableau controller');
    }]);

    var plainController = angular.module('plainController', ['myService2']);
    plainController = waterApp.controller('plainController', ['$scope', 'myService2', function($scope, myService2) {
        console.log('plain controller');
        console.log(myService2.getEnv());
    }]);

</script>
</body>
</html>
