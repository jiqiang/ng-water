<!DOCTYPE html>
<html lang="e">
  <head>
      <meta charset="utf-8">
      <title>BOM Water Information Dashboard</title>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular.min.js"></script>
      <script src="http://underscorejs.org/underscore-min.js"></script>
      <style>
        .dropdown-menu div.checkbox {
          padding: 3px 10px;
          margin-top: 0;
          margin-bottom: 0;
        }
        .dropdown-menu label {
          width: 100%;
        }
        .dropdown-menu input.checkbox-filter {
          background-color: #FFFFF0
        }
        .dropdown-menu li:hover {
          background-color: #f5f5f5;
        }
      </style>
  </head>
  <body>
    <div class="container" ng-app="sortApp" ng-controller="mainController">
      <div class="row">
        <div class="col-lg-2">
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Select taste level
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu manual-toggle" aria-labelledby="dropdownMenu1">
              <li>
                <input type="text" class="form-control checkbox-filter" ng-model="searchTasty.code">
              </li>
              <li>
                <div class="checkbox">
                  <label><input type="checkbox" ng-model="globalCheckAll.isChecked" ng-click="toggleCheckAll()">{{globalCheckAll.code}}</label>
                </div>
              </li>
              <li ng-repeat="tastiness in tastiLevels | filter:searchTasty">
                <div class="checkbox"><label><input type="checkbox" ng-model="tastiness.isChecked">{{tastiness.code}}</label></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Select sushi roll
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu manual-toggle" aria-labelledby="dropdownMenu1">
              <li>
                <input type="text" class="form-control checkbox-filter" ng-model="searchSushiRoll.code">
              </li>
              <li>
                <div class="checkbox">
                  <label><input type="checkbox" ng-model="globalCheckAllSushiRolls.isChecked" ng-click="toggleCheckAllSushiRolls()">{{globalCheckAllSushiRolls.code}}</label>
                </div>
              </li>
              <li ng-repeat="sr in sushiRolls | filter:searchSushiRoll">
                <div class="checkbox"><label><input type="checkbox" ng-model="sr.isChecked">{{sr.code}}</label></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2">
          <!--<select class="form-control" ng-model="fishType" ng-options="ft.code for ft in fishTypes"></select>-->
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              {{fishType.code}}
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <li ng-repeat="ft in fishTypes">
                <a href="#" ng-click="updateSelectedFishType(ft)">{{ft.code}}</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6"></div>
      </div>
      <div class="row">
        <div class="col-lg-12">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <td>
                  <a href="#" ng-click="sortType = 'name'; sortReverse = !sortReverse">
                    Sushi Roll
                    <span ng-show="sortType == 'name' && !sortReverse" class="fa fa-caret-down"></span>
                    <span ng-show="sortType == 'name' && sortReverse" class="fa fa-caret-up"></span>
                  </a>
                </td>
                <td>
                  <a href="#" ng-click="sortType = 'fish'; sortReverse = !sortReverse">
                    Fish Type
                    <span ng-show="sortType == 'fish' && !sortReverse" class="fa fa-caret-down"></span>
                    <span ng-show="sortType == 'fish' && sortReverse" class="fa fa-caret-up"></span>
                  </a>
                </td>
                <td>
                  <a href="#" ng-click="sortType = 'tastiness'; sortReverse = !sortReverse">
                    Taste Level
                    <span ng-show="sortType == 'tastiness' && !sortReverse" class="fa fa-caret-down"></span>
                    <span ng-show="sortType == 'tastiness' && sortReverse" class="fa fa-caret-up"></span>
                  </a>
                </td>
              </tr>
            </thead>
            <tbody>
              <tr ng-repeat="roll in sushi | orderBy:sortType:sortReverse | filter:filterByTastiness">
                <td>{{roll.name}}</td>
                <td>{{roll.fish}}</td>
                <td>{{roll.tastiness}}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="app.js"></script>
  </body>
</html>
