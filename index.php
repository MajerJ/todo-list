<!DOCTYPE html>
<html ng-app="ToDo">
<head>
    <title>ToDo List 2.0 (AngularJS)</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.5/angular.min.js"></script>
    <link rel="stylesheet" href="css/styles.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
</head>
<body ng-controller="MyTaskList" ng-keydown="removeByCtrlD($event)">
    <div id="header">
        <h1>ToDo List 2.0</h1>
        <p>Created using AngularJS</p>
    </div>
    <div id="form">
        <form name="submitTask" ng-submit="addTask()">
            <h3>Nova uloha</h3>
            <textarea ng-model="newTask.task" placeholder="Napis ulohu..." ng-keydown="addByEnter($event)"></textarea>
            <input type="submit" value="Pridat">
        </form> 
    </div>
    <div id="list">
        <h3>Zoznam uloh</h3>
        <ul ng-show="list.length" ng-repeat="item in list | orderBy:propertyName:reverse" ng-click="updateTask()">
            <li>
                <label class="label">
                    <input  class="label__checkbox" type="checkbox" ng-model="item.done">
                    <span class="label__text">
                        <span class="label__check">
                            <i class="fa fa-check icon"></i>
                        </span>
                    </span>
                </label>                
                <a ng-class="{done: item.done}">{{item.task}}<em> ({{item.date | date}})</em></a>      
            </li>
        </ul>
    </div>
    <div id="buttons">
        <div>
            <button ng-show="list.length" ng-click="removeSelected()">Zmazat splnene ulohy (Ctrl+D)</button>
        </div>
        <div>
            <button ng-show="list.length" ng-click="sortBy('task')">Zoradit podla abecedy
                <i class="fa fa-angle-double-up" ng-show="propertyName === 'task'" ng-class="{reverse: reverse}"></i>
            </button>            
        </div>
        <div>
            <button ng-show="list.length" ng-click="sortBy('date')">Zoradit podla datumu
                <i class="fa fa-angle-double-up" ng-show="propertyName === 'date'" ng-class="{reverse: reverse}"></i>
            </button>
        </div>
    </div>
<script src="javascript/app.js"></script>
<script src="javascript/controllers/task-list.js"></script>
</body>
</html>
