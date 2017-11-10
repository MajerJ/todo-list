angular.module('TaskList', [])
.controller('MyTaskList', function($scope, $http, $httpParamSerializerJQLike) {
    $scope.list = [];
    $http({
        method: 'GET',
        url: 'https://todo20-be.herokuapp.com/tasks',
    }).then(function(response) {
        $scope.list = response.data;
    });

    $scope.newTask = {};    

    $scope.addTask = function() {        
        $http({                      
            method: 'POST',
            url: 'https://todo20-be.herokuapp.com/tasks',            
            data: $httpParamSerializerJQLike({task: $scope.newTask.task}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            $scope.list.push(response.data);                            
        });
        $scope.newTask = {}
    }
    
    $scope.addByEnter = function(keyEvent) {
        if (keyEvent.which === 13) {
            keyEvent.preventDefault();
            $scope.addTask();
        }
    };

    $scope.removeSelected = function() {
        for (var i = ($scope.list.length)-1; i >= 0 ; i--) {
            if ($scope.list[i].done) {                
                $http({                    
                    method: 'DELETE',
                    url: 'https://todo20-be.herokuapp.com/tasks/' + $scope.list[i]._id                   
                }).then(function(response) {                    
                    console.log(response.data)                    
                });
            $scope.list.splice([i], 1);
            }
        }    
    };

    $scope.updateTask = function() {
        for (var i = 0; i < ($scope.list.length); i++) {                            
                $http({                    
                    method: 'PUT',
                    url: 'https://todo20-be.herokuapp.com/tasks/' + $scope.list[i]._id,
                    data: $httpParamSerializerJQLike({done: $scope.list[i].done}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function(response) {                    
                    console.log(response.data)
                });
        } 
    };

    $scope.removeByCtrlD = function(keyEvent) {
        if (keyEvent.which === 68 && keyEvent.ctrlKey) {
            keyEvent.preventDefault();
            $scope.removeSelected();
        }
    };

    $scope.sortBy = function(propertyName) {
        $scope.reverse = ($scope.propertyName === propertyName) ? !$scope.reverse : false;
        $scope.propertyName = propertyName;
    };    
});
