<?php
/* @var $this VenueController */
/* @var $data Venue */
?>

<div class="view">

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('venue_id')); ?>:
	</b>
	<?php echo CHtml::link(CHtml::encode($data->venue_id), array('view', 'id' => $data->venue_id)); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('ship_name')); ?>:
	</b>
	<?php echo CHtml::encode($data->ship_name); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('ship_add1')); ?>:
	</b>
	<?php echo CHtml::encode($data->ship_add1); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('ship_add2')); ?>:
	</b>
	<?php echo CHtml::encode($data->ship_add2); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('ship_city')); ?>:
	</b>
	<?php echo CHtml::encode($data->ship_city); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('ship_state')); ?>:
	</b>
	<?php echo CHtml::encode($data->ship_state); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('ship_zip')); ?>:
	</b>
	<?php echo CHtml::encode($data->ship_zip); ?>
	<br />

	<?php /*
  <b><?php echo CHtml::encode($data->getAttributeLabel('SHIP_phone1')); ?>:</b>
  <?php echo CHtml::encode($data->SHIP_phone1); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('SHIP_phone2')); ?>:</b>
  <?php echo CHtml::encode($data->SHIP_phone2); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('SHIP_email1')); ?>:</b>
  <?php echo CHtml::encode($data->SHIP_email1); ?>
  <br />

  <b><?php echo CHtml::encode($data->getAttributeLabel('SHIP_DETAILS')); ?>:</b>
  <?php echo CHtml::encode($data->SHIP_DETAILS); ?>
  <br />

  */?>

</div>