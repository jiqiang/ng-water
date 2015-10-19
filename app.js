angular.module('sortApp', [])
.controller('mainController', function($scope) {
  $scope.sortType = 'name';
  $scope.sortReverse = false;
  $scope.searchFish = '';
  
  $scope.globalCheckAll = {code: 'ALL', isChecked: true};
  $scope.tastiLevels = [
    {code: 1, isChecked: true},
    {code: 2, isChecked: true},
    {code: 3, isChecked: true},
    {code: 4, isChecked: true},
    {code: 5, isChecked: true},
    {code: 6, isChecked: true},
    {code: 7, isChecked: true},
    {code: 8, isChecked: true}
  ];
  
  $scope.toggleCheckAll = function() {
    $scope.tastiLevels.map(function(value, index) {
      $scope.tastiLevels[index].isChecked = $scope.globalCheckAll.isChecked;
    });
  };
  
  $scope.sushi = [
    { name: 'Cali Roll', fish: 'Crab', tastiness: 2 },
    { name: 'Philly', fish: 'Tuna', tastiness: 4 },
    { name: 'Tiger', fish: 'Eel', tastiness: 7 },
    { name: 'Rainbow', fish: 'Variety', tastiness: 6 }
  ];
});
