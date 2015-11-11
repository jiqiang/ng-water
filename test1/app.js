angular.module('myApp', [])

.controller('mainController', ['$scope', function($scope) {
    $scope.dcoptions = ['abc', 'bcd', 'cde', 'def'];
    $scope.dcoptions2 = ['abc2', 'bcd2', 'cde2', 'def2'];
}])
.directive('widDropdownCheckbox', function() {
    return {
        restrict: 'EA',
        transclude: false,
        //templateUrl: 'wid-dropdown.tpl.html',
        replace: false,
        scope: { options: '=dcOptions' },
        link: function (scope, element, attrs) {
            angular.forEach(scope.options, function (value, key) {
                $('<option />', {value: value, text: value, selected: true}).appendTo(element);
            });
            element.css({width: "370px"});
            var config = scope.$eval(attrs.widDropdownCheckbox);
            element.multiselect({
                noneSelectedText: config.label,
                selectedText: config.label,
                click: function (event, ui) {
                    console.log(ui);
                }
            })
            .multiselectfilter();
        }
    };
});
