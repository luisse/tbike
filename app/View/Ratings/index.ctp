<table width="50%" id="">
<tbody>
<?php
print_r($ratings);
	foreach ($ratings as $rating): ?>
	<tr>
		<td>
		 <ul class="list-group">
			<li class="list-group-item clearfix">

			<div class="row">
				<div class="col-lg-2">
					<div class="pull-left mr15">
						<?= $this->Html->image('favplace.jpg',
							array ('class'=>'img-circle','width'=>'80px','height'=>'80px'));?>
					</div>
				</div>
				<div class="col-lg-10">
					<div class="row">
							<span><i class="fa fa-user fa-fw"></i></span>
							<span class="name strong"><?= h($rating['People']['firstname'].', '.$rating['People']['secondname']) ?></span>
					</div>
					<div class="row">
								<span><i class="fa fa-tachometer fa-fw"></i></span>
								<span class="name strong"><?= h($rating['rating']['valprom']) ?>&nbsp;%&nbsp;<?= __('Votos Positivos') ?></span>
								<a class="see-more small pull-right" href="#">
									<?php if($rating['rating']['valprom'] <= 80):?>
										<button type="button" id="statusBtn" class="btn btn-danger btn-circle btn-sm" title="<?= __('Ranking Bajo')?>">
											<i class="fa fa-exclamation-triangle"></i>
										</button>
									<?php endif;?>
									<?php if($rating['rating']['valprom'] >= 80):?>
										<button type="button" id="statusBtn" class="btn btn-success btn-circle btn-sm" title="<?= __('Ranking Bueno')?>">
											<i class="fa fa-check"></i>
										</button>
									<?php endif;?>
							</a>
					</div>
				</div>
			</div>
			</li>
	 </ul>
		</td>
	</tr>
	<?php endforeach; ?>
</tbody>
</table>
