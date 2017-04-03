<?php echo $this->Html->script(array('angpaginator.js','taxorders/getorderang.js'),array('block'=>'scriptjs'));?>
<script type="text/javascript" src='http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js'>
</script>
<form name='myform' ng-app='myapp' ng-controller='customersCtrl'  novalidate>
	<input value='<?= $keyjwt ?>'>
<div>
<input type='hidden' ng-model='key'>
<div>
	<p>Usuario:</p><input type="text" name="user" ng-model="user" required>
	<span style="color:red" ng-show="myform.user.$dirty && myform.user.$invalid">
	<span ng-show='myform.user.$error.required'>Ingrese Usuario</span>
	<span>
</div>
<div>
	<p>Password:</p><input type='password' ng-model='password'>
</div>
<div>
	<p userinfo></p>
</div>
<div>
	<input type='Submit' ng-disabled="myform.user.$dirty && myform.user.$invalid" ng-click='ingresar()'>
	<!-- <button ng-click="ingresar()">Ingresar</button>-->
</div>
</form>
<ul>
<li ng-repeat="x in token">
	{{x.keyacces+'-'+x.error}}
</li>
</ul>
<p>Usuario Filtrar:<input type='text' name='userfilter' ng-model='userfilter'><input type='Submit' ng-click='filtrar()'> </p>
<table class="table table-bordered table-hover table-striped" id="listChoferes">
	<thead>
	<tr>
			<th ng-click="sort('username')">
					<?php echo __('Usuario'); ?>
			</th>
			<th><?php echo $this->Paginator->sort('created',__('Created')); ?></th>
	</tr>
	</thead>
	<tr ng-repeat="user in users">
		<td>{{user.User.username}}</td>
		<td>{{user.User.created}}</td>
	</tr>
</table>
<div ng-controller="OtherController" class="other-controller">
	<small>this is in "OtherController"</small>
	<div class="text-center">
		<dir-pagination-controls boundary-links="true" on-page-change="pageChangeHandler(newPageNumber)" template-url="/taxorders/paginatorpage"></dir-pagination-controls>
	</div>
</div>
</div>
