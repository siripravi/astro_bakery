<?php
/* @var $this PaymentsController */
/* @var $data Payments */
?>

<div class="view">

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:
	</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id' => $data->ID)); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('INVOICE_ID')); ?>:
	</b>
	<?php echo CHtml::encode($data->INVOICE_ID); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('mode_id')); ?>:
	</b>
	<?php echo CHtml::encode($data->mode_id); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:
	</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('pay_date')); ?>:
	</b>
	<?php echo CHtml::encode($data->pay_date); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('details')); ?>:
	</b>
	<?php echo CHtml::encode($data->details); ?>
	<br />

	<b>
		<?php echo CHtml::encode($data->getAttributeLabel('deposited_by')); ?>:
	</b>
	<?php echo CHtml::encode($data->deposited_by); ?>
	<br />


</div>