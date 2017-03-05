<?php echo $this->Html->script(array('jquery.orbit-1.2.3.min','/js/productimages/viewpictures','jquery.toastmessage'),
								array('block' => 'scriptUser')); ?>
<?php echo $this->Html->css('orbit-1.2.3');?>
<div id="featured"> 
	<?php foreach ($productimages as $productimage): ?>
		<?php  echo $this->Html->image(array ( 'controller' =>
		'productimages' , 'action' => 'mostrarimagencompleta' ,
		$productimage['Productimage']['id']),
		array ( 'title' =>$productimage['Productimage']['description'],'width'=>'600','height'=>'400' ) );
		?>		
	<?php endforeach;?>
</div>
