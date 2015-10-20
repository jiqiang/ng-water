$('.manual-toggle').click(function(e) {
  e.stopPropagation();
});

angular.module('sortApp', [])
.controller('mainController', function($scope) {
  $scope.sortType = 'name';
  $scope.sortReverse = false;
  $scope.searchFish = '';

  // Tasty level dropdown checkboxes.
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
  
  // Sushi roll dropdown checkboxes.
  $scope.globalCheckAllSushiRolls = {code: 'ALL', isChecked: true};
  $scope.sushiRolls = [
    {code: 'Cali Roll', isChecked: true},
    {code: 'Philly', isChecked: true},
    {code: 'Tiger', isChecked: true},
    {code: 'Rainbow', isChecked: true}
  ];
  $scope.toggleCheckAllSushiRolls = function() {
    $scope.sushiRolls.map(function(value, index) {
      $scope.sushiRolls[index].isChecked = $scope.globalCheckAllSushiRolls.isChecked;
    });
  };
  
  // Fish type dropdown list.
  $scope.fishTypes = [
    {code: 'All'},
    {code: 'Crab'},
    {code: 'Tuna'},
    {code: 'Eel'},
    {code: 'Variety'}
  ];
  $scope.fishType = {code: 'All'};
  $scope.updateSelectedFishType = function(ft) {
    $scope.fishType = ft;
  };
  
  $scope.filterByTastiness = function(value, index) {
    var found = _.findWhere($scope.tastiLevels, {code: value.tastiness, isChecked: true});
    var foundSushiRoll = _.findWhere($scope.sushiRolls, {code:value.name, isChecked: true});
    
    return found !== undefined && foundSushiRoll !== undefined && ($scope.fishType.code === 'All' || $scope.fishType.code === value.fish) ? true : false;
  }

  $scope.sushi = [
    { name: 'Cali Roll', fish: 'Crab', tastiness: 2, show: true },
    { name: 'Philly', fish: 'Tuna', tastiness: 4, show: true },
    { name: 'Tiger', fish: 'Eel', tastiness: 7, show: true },
    { name: 'Rainbow', fish: 'Variety', tastiness: 6, show: true }
  ];
});
