angular.module('myApp', [])

.controller('mainController', ['$scope', function($scope) {

}])
.directive('widDropdownCheckbox', function() {
    return {
        restrict: 'EA',
        transclude: false,
        //templateUrl: 'wid-dropdown.tpl.html',
        scope: {

        },
        link: function (scope, element, attr) {
            element.multiselect().multiselectfilter();
        }
    };
});
