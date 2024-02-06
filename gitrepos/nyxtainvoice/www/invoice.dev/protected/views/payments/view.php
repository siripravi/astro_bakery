<?php
/* @var $this PaymentsController */
/* @var $model Payments */
Yii::import('application.controllers.statementController');
?>
<?php
//------------ add the CJuiDialog widget -----------------
if (!empty($asDialog)):
	$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
		// the dialog
		'id' => 'dlg-payment-view-' . $model->ID,
		'options' => array(
			'title' => 'Payment Details',
			'autoOpen' => true,
			'modal' => false,
			'width' => 450,
			'height' => 320,
		),
	)
	);

else:
	//-------- default code starts here ------------------
	?>
	<?php
	$this->breadcrumbs = array(
		'Payments' => array('index'),
		$model->ID,
	);

	$this->menu = array(
		array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Payments', 'url' => array('index')),
		array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Payments', 'url' => array('create')),
		array('icon' => 'glyphicon glyphicon-edit', 'label' => 'Update Payments', 'url' => array('update', 'id' => $model->ID)),
		array('icon' => 'glyphicon glyphicon-minus-sign', 'label' => 'Delete Payments', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->ID), 'confirm' => 'Are you sure you want to delete this item?')),
		array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Payments', 'url' => array('admin')),
	);
	?>

	<?php //echo BsHtml::pageHeader('View','Payment') ?>
	//--------------------- begin added --------------------------
<?php endif; ?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'htmlOptions' => array(
		'class' => 'table table-striped table-condensed table-hover',
	),
	'data' => $model,
	'attributes' => array(
		//'ID',
		array(
			'label' => 'invoice#',
			'value' => $model->invoice->invoice_id,
		),
		array(
			'label' => 'Mode',
			'type' => 'raw',
			'value' => $this->getPayMode($model),
		),
		array(
			'label' => 'Paid',
			'type' => 'raw',
			'value' => Payments::makeMoney($model->amount),

		),
		'pay_date',
		'details',
		'deposited_by',
		array('label' => 'Created User', 'type' => 'raw', 'value' => $model->getUserName($model->cuser_id), 'filter' => ''),
		array('label' => 'Updated User', 'type' => 'raw', 'value' => $model->getUserName($model->uuser_id))
	),
)
); ?>


<?php
//----------------------- close the CJuiDialog widget ------------
if (!empty($asDialog))
	$this->endWidget();
?>