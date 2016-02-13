
function AboutController($scope,$location){
    
    $scope.header = function(){
        return $location.path() == '/about';
    }
}
