<?php
/* @var $this EmployeeController */
/* @var $model Employee */
/* @var $form CActiveForm */
?>

<div class="wide form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'action' => Yii::app()->createUrl($this->route),
		'method' => 'get',
	)
	); ?>

	<div class="row">
		<?php echo $form->label($model, 'id'); ?>
		<?php echo $form->textField($model, 'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'emp_type_id'); ?>
		<?php echo $form->textField($model, 'emp_type_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'title'); ?>
		<?php echo $form->textField($model, 'title', array('size' => 8, 'maxlength' => 8)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'first_name'); ?>
		<?php echo $form->textField($model, 'first_name', array('size' => 32, 'maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'last_name'); ?>
		<?php echo $form->textField($model, 'last_name1', array('size' => 32, 'maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'address'); ?>
		<?php echo $form->textField($model, 'address1', array('size' => 60, 'maxlength' => 64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'address2'); ?>
		<?php echo $form->textField($model, 'address2', array('size' => 32, 'maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'city'); ?>
		<?php echo $form->textField($model, 'city', array('size' => 32, 'maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'state'); ?>
		<?php echo $form->textField($model, 'state_id', array('size' => 32, 'maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'postal_code'); ?>
		<?php echo $form->textField($model, 'postal_code', array('size' => 16, 'maxlength' => 16)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'country'); ?>
		<?php echo $form->textField($model, 'country', array('size' => 32, 'maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'phone1'); ?>
		<?php echo $form->textField($model, 'phone1', array('size' => 32, 'maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'phone2'); ?>
		<?php echo $form->textField($model, 'phone2', array('size' => 32, 'maxlength' => 32)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'email'); ?>
		<?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 64)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'date_created'); ?>
		<?php echo $form->textField($model, 'date_created'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model, 'notes'); ?>
		<?php echo $form->textArea($model, 'notes', array('rows' => 6, 'cols' => 50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- search-form -->