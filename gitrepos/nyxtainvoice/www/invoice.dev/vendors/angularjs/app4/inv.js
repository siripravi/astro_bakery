
// the todoApp module is not really used, but it is here to show how it can be
// used with the common application scripts ($commonAppScripts)
var invApp = angular.module('InvApp', ['ngRoute']);

function InvCtrl($scope,$http, $window,$timeout) {

    $scope.yiiParams = {};
    setYiiParams($scope.yiiParams);
    console.log($scope.yiiParams.id);
    
    $scope.header = {invoice_id:null, venue_id:null, customer_id:null, event_date:null};
    $scope.header.invoice_id = $scope.yiiParams.id;
    $scope.invoice = {
    	
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
                url: '/angularHelper/default/items?id=' + $scope.id,
               // data: note,  //param method from jQuery
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function (response) {
                console.log(response);     
                if(response.length) $scope.invoice.items = response;       
                /******* STORE DATA INSIDE SESSION FOr FURTHER RETRIEVAL***/
                    //  localStorage["invoice"] = JSON.stringify($scope.invoice);
               // Notes2.update({ id: $scope.id }, '');
            });
           $scope.saved = 1;
           $scope.foredit = 1;
          
           $scope.isSaving = undefined;
            
            			
    $scope.invoiceNumber = function (invNum) {
        InvoiceObj.invoiceNumber(invNum);
    }  

    $scope.addRow = function () {
      
        $scope.invoice.items.push({ID: '0', st_id:$scope.invoice.st_id,st_type:$scope.invoice.st_type,QUANTITY: '0', PRICE: '0', DESCRIPTION: "", status: '0'});
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
       
        $scope.invoice.items.splice(index, 0, obj)
    };

    $scope.deleteRow = function (index) {
    	var item = $scope.invoice.items[index];
    	if (item.status == 1) item.status = 3;
            else if (item.status == 3) item.status = 1;
            else  
        $scope.invoice.items.splice(index, 1);
        $scope.subTotal();
    };
    
    $scope.rowTotal = function (row) {
        return accounting.formatMoney(row.QUANTITY * row.PRICE, "$", 2, ",", ".");
    };

    $scope.subTotal = function () {
        var sum = 0;

        angular.forEach($scope.invoice.items, function (item) {
            sum += item.QUANTITY * item.PRICE;
        });
        return accounting.formatMoney(sum, "$", 2, ",", ".");
    };
    
    $scope.calculate_tax = function () {
            return (($scope.taxVal * $scope.subTotal()) / 100);
        }
        $scope.total = function () {
           // localStorage["invoice"] = JSON.stringify($scope.invoice);
           return accounting.formatMoney($scope.calculate_tax() + $scope.subTotal(), "$", 2, ",", ".");
            
        }
        
     $scope.saveItems = function(){
            console.log($scope.invoice.items);
            var note = $scope.invoice.items;         
      
            
           $http({
                method: 'POST',
                url: '/angularHelper/default/items?id=' + $scope.id+"&customer_id="+$scope.header.customer_id+
                                             "&venue_id="+$scope.header.venue_id+"&event_date="+$scope.header.event_date,
                data: note,  //param method from jQuery
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }  //set the headers so angular passing info as form data (not request payload)
            }).success(function (response) {
                console.log(response);     
                if(response.length) $scope.invoice.items = response;
                $window.location.href = '/angularHelper/default/invApp/id/'+$scope.id+".html";  
                //$location.path();       
                /******* STORE DATA INSIDE SESSION FOr FURTHER RETRIEVAL***/
                    //  localStorage["invoice"] = JSON.stringify($scope.invoice);
               // Notes2.update({ id: $scope.id }, '');
               // $scope.isSaving = false;
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