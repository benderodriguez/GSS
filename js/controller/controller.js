/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var uid = 1;
//alert('yes');
function ContactController($scope){
    $scope.newcontact = {};
    //$scope.contacts = [{id:null, 'name':null, 'mail':null, 'phone':null}];
    $scope.contacts = [{id:0, 'name': 'test', 'mail':'test@mail.com', 'phone': '12-15-12-15'}];
    $scope.contacts.splice(0,1);
    
    $scope.saveContact = function(){
        if($scope.newcontact.id == null)
        {
            $scope.newcontact.id = uid++;
            $scope.contacts.push($scope.newcontact);
            $scope.newcontact = {};
        }
        else
        {
            //alert('contact : '+$scope.newcontact.id);
            console.log('contact : '+$scope.newcontact.id);
            for(i in $scope.contacts){
                if($scope.contacts[i].id == $scope.newcontact.id){
                    $scope.contacts[i] = $scope.newcontact;
                }
            }
            $scope.newcontact = {};
        }
        
    }
    
    $scope.edit = function (id){
        $scope.newcontact.id = id;
        for(i in $scope.contacts){
            if($scope.contacts[i].id == id){
                /*$scope.newcontact.name = $scope.contacts[i].name;
                $scope.newcontact.mail = $scope.contacts[i].mail;
                $scope.newcontact.phone = $scope.contacts[i].phone;*/
                //$scope.newcontact = $scope.contacts[i];
                $scope.newcontact = angular.copy($scope.contacts[i]);
            }
        }
    }
    
    $scope.delete = function (id){
        $scope.newcontact.id = id;
        for(i in $scope.contacts){
            if($scope.contacts[i].id == id){
                $scope.contacts.splice(i,1);
            }
        }
    }
}
