  
//Angular Module to hide and show forms
var app= angular.module('MyApp', []).controller('ShowController', ShowController).controller('showInputController', showInputController);


    function ShowController($scope, $timeout){


    $scope.loading = false;
      $timeout(function() {      
        $scope.loading = true;
      }, 1000);
          
            //This will hide the DIV by default.
            $scope.IsVisible=false;
            $scope.IsVisible2=false;
        
            console.log($scope.IsVisible);


            $scope.ShowHide = function () {
           //If DIV is visible it will be hidden and vice versa.
       

        $scope.IsVisible = $scope.IsVisible ? false : true;
        
        
              $scope.IsVisible2 = $scope.IsVisible2 ? false : true;
          
         
                
          



            }

        }
//Controller showInput to controller certain scopes in our forms

function showInputController($scope, $timeout){

   
    $scope.loading = false;
    $scope.driverIDType='3';
     $scope.visitorCitizenCardType='1';

      $scope.itemCategory='1';

      $timeout(function() {      
      $scope.loading = true;
      }, 750);
    

      

      console.log( $scope.visitorCitizenCardType);



    }


// function BarcodeCtrl($scope) {
//     $scope.model = {
//         barcode: 'none',
//     };
    
//     $scope.barcodeScanned = function(barcode) {        
//         console.log('callback received barcode: ' + barcode);                     
//         $scope.model.barcode = barcode;        
//     };  
// }

// app.directive('barcodeScanner', function() {
//   return {
//     restrict: 'A',    
//     scope: {
//         callback: '=barcodeScanner',        
//       },      
//     link:    function postLink(scope, iElement, iAttrs){       
//         // Settings
//         var zeroCode = 48;
//         var nineCode = 57;
//         var enterCode = 13;    
//         var minLength = 3;
//         var delay = 300; // ms
        
//         // Variables
//         var pressed = false; 
//         var chars = []; 
//         var enterPressedLast = false;
        
//         // Timing
//         var startTime = undefined;
//         var endTime = undefined;
        
//         jQuery(document).keypress(function(e) {            
//             if (chars.length === 0) {
//                 startTime = new Date().getTime();
//             } else {
//                 endTime = new Date().getTime();
//             }
            
//             // Register characters and enter key
//             if (e.which >= zeroCode && e.which <= nineCode) {
//                 chars.push(String.fromCharCode(e.which));
//             }
            
//             enterPressedLast = (e.which === enterCode);
            
//             if (pressed == false) {
//                 setTimeout(function(){
//                     if (chars.length >= minLength && enterPressedLast) {
//                         var barcode = chars.join('');                                                
//                         //console.log('barcode : ' + barcode + ', scan time (ms): ' + (endTime - startTime));
                                                
//                         if (angular.isFunction(scope.callback)) {
//                             scope.$apply(function() {
//                                 scope.callback(barcode);    
//                             });
//                         }
//                     }
//                     chars = [];
//                     pressed = false;
//                 },delay);
//             }
//             pressed = true;
//         });
//     }
//   };
// });



// //Angular module to use our deliver service created
// angular.module('main', []).controller('mainController', mainController).run(function($rootScope) {
//         $rootScope.delivers = _deliver;
//     });







// // inject the Deliver service into our controller
// function mainController($scope, $window, $http ,$location, $timeout, Deliver) {

//    $scope.loading = false;


//  $timeout(function() {      
//         $scope.loading = true;
//       }, 1000);
          
      
   
  


//   Deliver.get().then(function(response) {

   
//   $scope.delivers =  angular.fromJson(response.data);
  
//    console.log($scope.delivers);
//         });


// $scope.showDeliver = function(pid){
//                 //console.log(pid) ----> return 16

//                 Deliver.show(pid).then(function(response) {

//                   url= angular.fromJson(response.data);
//                   window.location.replace(url.url);
          
//                           });
//             };

//     // function to handle submitting the form
//     // SAVE A CheckOut and Exit Weight================
//     $scope.submitCheckOut = function($id) {

     


//      //Get the id of the specific Delivery
//        var id=$id;

//      //Ask user to input the exit weight!
//        var x= prompt("Please, add the exit weight!!");
       
//       //Verify if the value inputed is a number or if it was an empty field
//        if (isNaN(x) || x=="")
// {


//   alert("The following is not a number!");

    

//   Deliver.get().then(function(response) {
         

//          $scope.delivers =  angular.fromJson(response.data);


        
//          console.log($scope.delivers);
       
//       });


// }
//   else
//     {
  
//   alert("The exit weight you entered is " + x +"!");



//          // save the checkOut-setting the exit time
//         // use the function we created in our service
//     Deliver.insertWeight(id,x).then(function(response){
    

//     x= angular.fromJson(response.data);

//     console.log(x.success);

//       if (x.success==true) {

//         alert("The exit weight was correctly inserted!");


//         Deliver.get().then(function(response) {
         
    

//          $scope.delivers =  angular.fromJson(response.data);


        
//          console.log($scope.delivers);
       
//       });
       
//     }
//       else{ 

//         alert("The exit weight was not inserted!" + "\n" +"You already have one inserted!!");

//           Deliver.get().then(function(response) {
         


//          $scope.delivers =  angular.fromJson(response.data);


        
//          console.log($scope.delivers);
       
//       });
//     }
       

//     }).catch(function(data, status){
//       console.error(response.status,response.data);
     

//     }).finally(function(){

//       Deliver.insertExitTime(id).then(function(response){

//         y= angular.fromJson(response.data);
//         console.log(y.success);


//         if (y.success==true) {

//           alert("The CheckOut was correctly done!");
          
       

//           Deliver.get().then(function(response) {
         


//          $scope.delivers =  angular.fromJson(response.data);


        
//          console.log($scope.delivers);
       
//       });
         
//         }
//         else{
//            alert("The CheckOut process failed!" + "\n" +"CheckOut can only be done once!");

//          Deliver.get().then(function(response) {
         
         

//          $scope.delivers =  angular.fromJson(response.data);


        
//          console.log($scope.delivers);
       
//       });

//          }
               


//       }).catch(function(data, status){
//         console.error(response.status,response.data);

//         Deliver.get().then(function(response) {
         
     

//          $scope.delivers =  angular.fromJson(response.data);


        
//          console.log($scope.delivers);
       
//       });
        
//       })
//     });


   

//     };
//     }

// };











  