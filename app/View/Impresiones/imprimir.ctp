
<?php echo $this->element('modalboxcabecera',array('title'=>__('Panel de Impresión'),'paneltipo'=>'panel-primary'));?>
<div class="row">
  <div class="col-md-12">
    <embed src="<?php echo $link?>" type="application/pdf" style="width:100%;height:400px;"></embed>
  </div>
</div>
<?php echo $this->element('modalboxpie');?>
