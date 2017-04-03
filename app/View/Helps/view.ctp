<?php //echo $this->Html->script(array('/js/clientes/seleccionarcliente.js','jquery.maskedinput'),array('block'=>'scriptjs'));?>
<script>
	//var clientlink="<?php echo $this->Html->url(array('controller'=>'clientes','action'=>'listarclientes')) ?>"
</script>
<?php echo $this->element('modalboxcabecera',array('title'=>__('Ayuda en Linea'),'paneltipo'=>'panel-primary'));?>
<div class="table-responsive">
	<div class='row'>

	<?php if(!empty($help)){
		echo $help['Help']['helpdetail'];
	}else{?>
      <div class="jumbotron">
        <h1>Ooop, Sin ayuda...</h1>
        <p class="lead">No tenemos una ayuda generada para la opción, si necesitas ayuda contacta con el administrador.</p>
        <p></p>
      </div>
    <?php }?>	
	</div>
</div>
<?php echo $this->element('modalboxpie');?>
