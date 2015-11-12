angular.module('myApp', [])

.controller('mainController', ['$scope', function($scope) {
    $scope.dcoptions = ['abc', 'bcd', 'cde', 'def', 'abc2', 'bcd2', 'cde2', 'def2'];
    $scope.dcoptions2 = ['abc2', 'bcd2', 'cde2', 'def2'];
    $scope.data = [
        [ "Tiger Nixon", "System Architect", "Edinburgh", "5421", "2011/04/25", "$320,800" ],
        [ "Garrett Winters", "Accountant", "Tokyo", "8422", "2011/07/25", "$170,750" ],
        [ "Ashton Cox", "Junior Technical Author", "San Francisco", "1562", "2009/01/12", "$86,000" ],
        [ "Cedric Kelly", "Senior Javascript Developer", "Edinburgh", "6224", "2012/03/29", "$433,060" ],
        [ "Airi Satou", "Accountant", "Tokyo", "5407", "2008/11/28", "$162,700" ]
    ];
    $scope.$on('doUpdateTable', function () {
        $scope.data.splice(0,1);
        $scope.$broadcast('doUpdateData', {data: $scope.data});
    });



    //angular.element('#example').DataTable();
}])
.directive('widDdcb', ['$document', function($document) {
    return {
        restrict: 'EA',
        transclude: false,
        replace: false,
        scope: { options: '=widDdcbOptions' },
        link: function (scope, element, attrs) {
            angular.forEach(scope.options, function (value, key) {
                $('<option />', {value: value, text: value, selected: true}).appendTo(element);
            });
            var config = scope.$eval(attrs.widDdcb);
            element.css({width: "350px"});
            element.multiselect({
                noneSelectedText: config.label,
                selectedText: config.label,
                classes: config.id,
                click: function (event, ui) {
                    scope.$emit('doUpdateTable');
                },
                checkAll: function () {
                    scope.$emit('doUpdateTable');
                },
                uncheckAll: function () {
                    scope.$emit('doUpdateTable');
                },
                open: function (event, ui) {
                    $document.find("div." + config.id + " input[type='search']").focus();
                }
            })
            .multiselectfilter({
                label: '',
                width: 145
            });
        }
    };
}])
.directive('widTable', ['$document', function ($document) {
    return {
        restrict: 'EA',
        transclude: false,
        replace: false,
        scope: {},
        link: function (scope, element, attrs) {

            var table = element.DataTable({
                searching: false,
                data: scope.$parent.data,
                columns: [
                    { title: "Name" },
                    { title: "Position" },
                    { title: "Office" },
                    { title: "Extn." },
                    { title: "Start date" },
                    { title: "Salary" }
                ]
            });

            scope.$on('doUpdateData', function (event, value) {
                table.clear().rows.add(value.data).draw();
            });
        }
    };
}]);
