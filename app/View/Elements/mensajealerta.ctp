<div class="modal fade" id="modalbox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="padding-top: 5px;padding-bottom: 5px;padding-left: 20px;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $title?></h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-warning" ><span class='glyphicon glyphicon-exclamation-sign  btn-lg' id='mensaje'></span></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info btn-lw" data-dismiss="modal">
        	<span class="glyphicon glyphicon glyphicon-off"></span><?php echo $buttondesc?>
        </button>
      </div>
    </div>
  </div>
</div>