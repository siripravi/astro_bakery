<?php
$this->beginWidget('zii.widgets.CPortlet', array(
	'title' => "Create New user",
	'htmlOptions' => array('style' => "border:none;")
)
);

?>
<div class="span6 clearfix" style="min-height:220px">


	<?php //echo $form->errorSummary($pmt); ?>
	<?php //echo $form->hiddenField($stmt,'id');?>
	<?php //echo $form->textFieldControlGroup($model,'INVOICE_ID'); ?>

	<div class="row-fluid" style="margin-bottom:6px;">
		<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
			'action' => Yii::app()->createUrl($this->route),
			'method' => 'get',
		)
		); ?>

		<div class="span5">
			<?php echo $form->label($model, 'id'); ?>
			<?php echo $form->textField($model, 'id'); ?>

		</div>

		<div class="span5">
			<?php echo $form->label($model, 'username'); ?>
			<?php echo $form->textFieldRow($model, 'username', array('size' => 60, 'maxlength' => 128)); ?>
		</div>
	</div>
	<div class="row-fluid" style="margin-bottom:6px;">
		<div class="span5">
			<?php echo $form->label($model, 'email'); ?>
			<?php echo $form->textFieldRow($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
		</div>
		<div class="span5" id="venue-id">
			<?php echo $form->label($model, 'profile'); ?>
			<?php echo $form->textAreaRow($model, 'profile', array('rows' => 6, 'cols' => 50)); ?>
		</div>
	</div>

	<div class="row-fluid"">  
			  <?php echo CHtml::submitButton('Search'); ?>

	</div>

<?php $this->endWidget(); ?>
</div>
<?php $this->endWidget(); ?>
 

<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class=" wide form">

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
			<?php echo $form->label($model, 'username'); ?>
			<?php echo $form->textField($model, 'username', array('size' => 60, 'maxlength' => 128)); ?>
		</div>

		<div class="row">
			<?php echo $form->label($model, 'email'); ?>
			<?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
		</div>

		<div class="row">
			<?php echo $form->label($model, 'profile'); ?>
			<?php echo $form->textArea($model, 'profile', array('rows' => 6, 'cols' => 50)); ?>
		</div>

		<div class="row buttons">
			<?php echo CHtml::submitButton('Search'); ?>
		</div>

		<?php $this->endWidget(); ?>

	</div><!-- search-form -->