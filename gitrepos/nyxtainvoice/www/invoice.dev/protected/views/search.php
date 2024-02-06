<?php
/* @var $this SearchFormController */
/* @var $model SearchForm */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form = $this->beginWidget('CActiveForm', array(
		'id' => 'search-form-search-form',
		// Please note: When you enable ajax validation, make sure the corresponding
		// controller action is handling ajax validation correctly.
		// See class documentation of CActiveForm for details on this,
		// you need to use the performAjaxValidation()-method described there.
		'enableAjaxValidation' => false,
	)
	); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model, 'from_date'); ?>
		<?php echo $form->textField($model, 'from_date'); ?>
		<?php echo $form->error($model, 'from_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'to_date'); ?>
		<?php echo $form->textField($model, 'to_date'); ?>
		<?php echo $form->error($model, 'to_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'event_date'); ?>
		<?php echo $form->textField($model, 'event_date'); ?>
		<?php echo $form->error($model, 'event_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'st_type'); ?>
		<?php echo $form->textField($model, 'st_type'); ?>
		<?php echo $form->error($model, 'st_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'is_paid'); ?>
		<?php echo $form->textField($model, 'is_paid'); ?>
		<?php echo $form->error($model, 'is_paid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'cust_name'); ?>
		<?php echo $form->textField($model, 'cust_name'); ?>
		<?php echo $form->error($model, 'cust_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'ven_name'); ?>
		<?php echo $form->textField($model, 'ven_name'); ?>
		<?php echo $form->error($model, 'ven_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'invoice_id'); ?>
		<?php echo $form->textField($model, 'invoice_id'); ?>
		<?php echo $form->error($model, 'invoice_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'quote_id'); ?>
		<?php echo $form->textField($model, 'quote_id'); ?>
		<?php echo $form->error($model, 'quote_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'create_date'); ?>
		<?php echo $form->textField($model, 'create_date'); ?>
		<?php echo $form->error($model, 'create_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'update_date'); ?>
		<?php echo $form->textField($model, 'update_date'); ?>
		<?php echo $form->error($model, 'update_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'rememberMe'); ?>
		<?php echo $form->textField($model, 'rememberMe'); ?>
		<?php echo $form->error($model, 'rememberMe'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'password'); ?>
		<?php echo $form->textField($model, 'password'); ?>
		<?php echo $form->error($model, 'password'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div><!-- form -->