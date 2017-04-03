var app = angular.module('myapp',['angularUtils.directives.dirPagination']);
app.controller('customersCtrl',function($scope,$rootScope, $http){
	$scope.user='';
	$scope.password='';
	$scope.token = '';
	$scope.currentPage = 1;
	$scope.pageSize = 10;
	$scope.meals = [];
	/**$http.get({url:'http://taxiup/taxorders/getmyorders.json',
		method: 'POST',
		data:{fechadesde:$scope.fechadesde,fechasta:$scope.fechasta,key:$scope.key},
		 headers: {
			   'Content-Type': 'application/json'
			 }
		}).then(function successCallback(response){
					$scope.names = response.records;
				},
				function errorCallback(response){
					alert(reponse)
				}
		)***/



		/***$http({
			method:'POST',
			url:"/taxorders/getmyorders.json",
			data:{fechadesde : $scope.fechadesde,
				  fechasta : $scope.fechasta,
				  key : 'e7c05b5d09559defd8a1f26f86a37456e467214b',
				  headers:{	"Content-Type" : "application/x-www-form-urlencoded"}}
		}).then(function successCallback(response){
			alert(response)
		})***/
		$scope.order = function(){

		}

		$scope.ingresar = function(){
			$http({
				method:'POST',
				url:"/users/userajaxloginremote.json",
				data:{user : $scope.user,password : $scope.password},
			     headers:{	"Security-Access-PublicToken" : "A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S"}
			}).then(function successCallback(response){
				//alert(response)
				$scope.token = response.data;
				//console.log($scope.token.data);
			})
			$http({
				method:'POST',
				url:"http://taxiup/users/listusersjson.json",
				data:{user : $scope.user,password : $scope.password},
			     headers:{	"Security-Access-PublicToken" : "A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S"}
			}).then(function successCallback(response){
				//alert(response)
				$scope.users = response.data;

				//console.log(response);
			})

		}
		//permite realizar el filtrado de los datos
		$scope.filtrar = function(){
			$http({
				method:'POST',
				url:"http://taxiup/users/listusersjson.json",
				data:{user : $scope.userfilter},
			     headers:{"Security-Access-PublicToken" : "A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S"}
			}).then(function successCallback(response){
				//alert(response)
				$scope.users = response.data;
				//console.log(response);
			})
		}

		$scope.pageChangeHandler = function(num) {
			$http({
				method:'POST',
				url:"http://taxiup/users/listusersjson.json/page:"+num,
				data:{user : $scope.userfilter},
					 headers:{"Security-Access-PublicToken" : "A33esaSP9skSjasdSfFSssEwS2IksSZxPlA4asSJ4GEW4S"}
			}).then(function successCallback(response){
				//alert(response)
				$scope.users = response.data;
				//console.log(response);
			})
		};



	/***$http({
			method:'POST',
			url:"/gpspoints/returnallgpspoint.json",
			//data:{fechadesde : $scope.fechadesde,
			//	  fechasta : $scope.fechasta,
				  //key : 'e7c05b5d09559defd8a1f26f86a37456e467214b',
				  //headers:{	"Content-Type" : "application/x-www-form-urlencoded"}}
		}).then(function successCallback(response){
			alert(response)
		})****/



		/**$http.post({url:"/taxorders/getmyorders.json",data:{fechadesde:'01/01/2015'}}).
			success(function(response){
				//$scope.names = response.records;
				alert(response);
			})**/
	/**$http.get({url:'http://taxiup/taxorders/getmyorders.json',
				method: 'POST',
				data:{fechadesde:$scope.fechadesde,fechasta:$scope.fechasta,key:$scope.key},
				 headers: {
					   'Content-Type': 'application/json'
					 }
				}).then(function successCallback(response){
							$scope.names = response.records;
						},
						function errorCallback(response){
							alert(reponse)
						}
				)***/
			/***$http.get("http://www.w3schools.com/angular/customers.php")
			    .success(function(response) {
			    	$scope.names = response.records;
			    });	***/

	//$scope.names=[{Name:'Burra'}]

})

function OtherController($scope) {
  $scope.pageChangeHandler = function(num) {
    console.log('going to page ' + num);
  };
}

app.directive('userinfo',function(){
	return{
		result:'Usuario confirmado con key {{token}}'
	}
})

app.directive('filtrarusuarios',function(){
	return{
		restrict:'AE',
		scope:{

		}
	}
})
