<?php
/* @var $this EmployeeController */
/* @var $data Employee */
?>

<div class="view">

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:
	</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('emp_type_id')); ?>:
	</b>
	<?php echo CHtml::encode($data->empType->designation); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:
	</b>
	<?php echo CHtml::encode($data->title1); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:
	</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('mid_name')); ?>:
	</b>
	<?php echo CHtml::encode($data->mid_name1); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:
	</b>
	<?php echo CHtml::encode($data->last_name1); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('address1')); ?>:
	</b>
	<?php echo CHtml::encode($data->address1); ?>
	<br />

	<?php /*
  <b><?php echo CHtml::encode($data->getAttributeLabel('address2')); ?>:</b>
  <?php echo CHtml::encode($data->address2); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('city')); ?>:</b>
  <?php echo CHtml::encode($data->city); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('state_id')); ?>:</b>
  <?php echo CHtml::encode($data->state_id); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('postal_code')); ?>:</b>
  <?php echo CHtml::encode($data->postal_code); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('country')); ?>:</b>
  <?php echo CHtml::encode($data->country); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('phone1')); ?>:</b>
  <?php echo CHtml::encode($data->phone1); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('phone2')); ?>:</b>
  <?php echo CHtml::encode($data->phone2); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
  <?php echo CHtml::encode($data->email); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('date_created')); ?>:</b>
  <?php echo CHtml::encode($data->date_created); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('notes')); ?>:</b>
  <?php echo CHtml::encode($data->notes); ?>
  <br />

  */?>

</div>