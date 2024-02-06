
// the todoApp module is not really used, but it is here to show how it can be
// used with the common application scripts ($commonAppScripts)
var qtnApp = angular.module('QtnApp', ['ngRoute']);


function QtnCtrl($scope,$http, $window,$timeout) {

    $scope.yiiParams = {};
    setYiiParams($scope.yiiParams);
    console.log($scope.yiiParams.id);
    
     
    $scope.quotation = {
        items: [{
        	ID: null, 
        	st_id:null,
        	st_type:null,
        	QUANTITY: '0', 
        	PRICE: '0', 
        	DESCRIPTION: "", 
        	status: '0'
          }, {
            ID: null, 
        	st_id:null,
        	st_type:null,
        	QUANTITY: '0', 
        	PRICE: '0', 
        	DESCRIPTION: "", 
        	status: '0'
        }, {
            ID: null, 
        	st_id:null,
        	st_type:null,
        	QUANTITY: '0', 
        	PRICE: '0', 
        	DESCRIPTION: "", 
        	status: '0'
        }, {
            ID: null, 
        	st_id:null,
        	st_type:null,
        	QUANTITY: '0', 
        	PRICE: '0', 
        	DESCRIPTION: "", 
        	status: '0'
        }, {
            ID: null, 
        	st_id:null,
        	st_type:null,
        	QUANTITY: '0', 
        	PRICE: '0', 
        	DESCRIPTION: "", 
        	status: '0'
        }]
    };
	$scope.id = $scope.yiiParams.id;
	
	$scope.isSaving = false;
  $scope.load = function($event) {  //alert('saving...');
    $scope.loading = true;
    $scope.isSaving = true;
    $timeout(function() { $scope.loading = false; 
    	$scope.saveItems();
    	}, 0);
  }
	
	$http({
                method: 'POST',
                url: '/quotation/items?id=' + $scope.id,
               // data: note,  //param method from jQuery
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function (response) {
                console.log(response);     
                if(response.length) $scope.quotation.items = response;       
                /******* STORE DATA INSIDE SESSION FOr FURTHER RETRIEVAL***/
                    //  localStorage["invoice"] = JSON.stringify($scope.invoice);
               // Notes2.update({ id: $scope.id }, '');
            });
           $scope.saved = 1;
           $scope.foredit = 1;
          
        
    $scope.invoiceNumber = function (invNum) {
        InvoiceObj.invoiceNumber(invNum);
    }  

    $scope.addRow = function () {
      
        $scope.quotation.items.push({ID: '0', st_id:$scope.quotation.st_id,st_type:$scope.quotation.st_type,QUANTITY: '0', PRICE: '0', DESCRIPTION: "", status: '0'});
    };

    $scope.insertRow = function (index) {
        var obj = {
            ID: null, 
        	st_id:null,
        	st_type:null,
        	QUANTITY: '0', 
        	PRICE: '0', 
        	DESCRIPTION: "", 
        	status: '0'
        };
       
        $scope.quotation.items.splice(index, 0, obj)
    };

    $scope.deleteRow = function (index) {
    	var item = $scope.quotation.items[index];
    	if (item.status == 1) item.status = 3;
            else if (item.status == 3) item.status = 1;
            else  
        $scope.quotation.items.splice(index, 1);
        $scope.subTotal();
    };
    
    $scope.rowTotal = function (row) {
        return accounting.formatMoney(row.QUANTITY * row.PRICE, "$", 2, ",", ".");
    };

    $scope.subTotal = function () {
        var sum = 0;

        angular.forEach($scope.quotation.items, function (item) {
            sum += item.QUANTITY * item.PRICE;
        });
        return accounting.formatMoney(sum, "$", 2, ",", ".");
    };
    
    $scope.calculate_tax = function () {
            return (($scope.taxVal * $scope.subTotal()) / 100);
        }
        $scope.total = function () {
           // localStorage["invoice"] = JSON.stringify($scope.quotation);
           return accounting.formatMoney($scope.calculate_tax() + $scope.subTotal(), "$", 2, ",", ".");
            
        }
        
     $scope.saveItems = function(){
            console.log($scope.quotation.items);
            var note = $scope.quotation.items;         

           $http({
                method: 'POST',
                url: '/quotation/items?id=' + $scope.id,
                data: note,  //param method from jQuery
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function (response) {
                console.log(response);     
                if(response.length) $scope.quotation.items = response;
                $window.location.href = '/quotation/view/id/'+$scope.id+".html";  
                //$location.path();       
                /******* STORE DATA INSIDE SESSION FOr FURTHER RETRIEVAL***/
                    //  localStorage["invoice"] = JSON.stringify($scope.invoice);
               // Notes2.update({ id: $scope.id }, '');
            });
           $scope.saved = 1;
           $scope.foredit = 1;
        }    
        
        $scope.printDiv = function(divName) {
  			var printContents = document.getElementById(divName).innerHTML;
  			var originalContents = document.body.innerHTML;        
  			var popupWin = window.open('', '_blank', 'width=300,height=300');
  			popupWin.document.open()
  			popupWin.document.write('<html><head><link rel="stylesheet" type="text/css" href="style.css" /></head><body onload="window.print()">' + printContents + '</html>');
  			popupWin.document.close();
		}    

   
}