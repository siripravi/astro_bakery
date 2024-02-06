<div class="panel-heading">
	<h3>
		<?php echo $model->ship_name; ?>
	</h3>

</div>
<div class="content">
	<div class="box">
		<div class="box-header">
			<div class="col-lg-6">
				<a class="btn btn-primary" href="/venue/admin"><i class="pe-7s-back-2"></i> Back</a>
			</div>
		</div>
		<div class="box-body">

			<?php $this->widget('zii.widgets.CDetailView', array(
				'htmlOptions' => array(
					'class' => 'table table-striped table-condensed table-hover',
				),
				'data' => $model,
				'attributes' => array(
					//'venue_id',
					'ship_name',
					'ship_add1',
					'ship_add2',
					'ship_city',
					'ship_state',
					'ship_zip',
					'ship_pone1',
					'ship_pone2',
					'ship_email1',
					'ship_details',
				),
			)
			); ?>
		</div>
	</div>
</div>