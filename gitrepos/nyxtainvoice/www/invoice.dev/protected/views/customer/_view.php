<?php
/* @var $this CustomerController */
/* @var $data Customer */
?>

<div class="view">

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('customer_no')); ?>:
	</b>
	<?php echo CHtml::link(CHtml::encode($data->customer_no), array('view', 'id' => $data->customer_no)); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:
	</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:
	</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('address1')); ?>:
	</b>
	<?php echo CHtml::encode($data->address1); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('address2')); ?>:
	</b>
	<?php echo CHtml::encode($data->address2); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:
	</b>
	<?php echo CHtml::encode($data->city); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:
	</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />

	<?php /*
  <b><?php echo CHtml::encode($data->getAttributeLabel('zip')); ?>:</b>
  <?php echo CHtml::encode($data->zip); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('phone1')); ?>:</b>
  <?php echo CHtml::encode($data->phone1); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('phone2')); ?>:</b>
  <?php echo CHtml::encode($data->phone2); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('email1')); ?>:</b>
  <?php echo CHtml::encode($data->email1); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('email2')); ?>:</b>
  <?php echo CHtml::encode($data->email2); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
  <?php echo CHtml::encode($data->notes); ?>
  <br />

  */?>

</div>