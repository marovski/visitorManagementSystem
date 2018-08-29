// angular.module('deliverService', [])

// 	.factory('Deliver', function($http) {

// 		return {

// 			//Retrieve all Deliveries

// 			get : function() {
// 				return $http.get('delivers/indexJ');
// 			},

// 			//Execute checkOut of the indicated delivery
// 			insertExitTime : function(id) {
// 				return $http.put('delivers/checkOut/' + id);
// 			}
// 			, 
			

// 			//Insert the exit weight of the indicated delivery
// 			insertWeight : function(id, x) {
// 				return $http.put('delivers/checkOut/weight/' + id + '/'+ x);
// 			},

// 			//Show the specific delivery through laravel function
// 			show : function(id) {
// 				return $http.get('delivers/show/' + id);
// 			},
		
// 		}

// 	});