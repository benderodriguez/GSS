
function MainController($scope,$location){
    
    $scope.header = function(){
        return $location.path() == '/Home';
    }
}
