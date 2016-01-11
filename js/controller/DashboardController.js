
function DashboardController($scope,$location){
    
    $scope.header = function(){
        return $location.path() == '/dashboard';
    }
}
