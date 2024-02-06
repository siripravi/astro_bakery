<?php
/* @var $this CustomerController */
/* @var $model Customer */
/* @var $form BSActiveForm */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
)
); ?>

<?php echo $form->textFieldControlGroup($model, 'customer_no'); ?>
<?php echo $form->textFieldControlGroup($model, 'first_name', array('maxlength' => 30)); ?>
<?php echo $form->textFieldControlGroup($model, 'last_name', array('maxlength' => 30)); ?>
<?php echo $form->textFieldControlGroup($model, 'address1', array('maxlength' => 30)); ?>
<?php echo $form->textFieldControlGroup($model, 'address2', array('maxlength' => 30)); ?>
<?php echo $form->textFieldControlGroup($model, 'city', array('maxlength' => 30)); ?>
<?php echo $form->textFieldControlGroup($model, 'state', array('maxlength' => 2)); ?>
<?php echo $form->textFieldControlGroup($model, 'zip', array('maxlength' => 6)); ?>
<?php echo $form->textFieldControlGroup($model, 'phone1', array('maxlength' => 15)); ?>
<?php echo $form->textFieldControlGroup($model, 'phone2', array('maxlength' => 15)); ?>
<?php echo $form->textFieldControlGroup($model, 'email1', array('maxlength' => 45)); ?>
<?php echo $form->textFieldControlGroup($model, 'email2', array('maxlength' => 45)); ?>
<?php echo $form->textFieldControlGroup($model, 'notes', array('maxlength' => 255)); ?>

<div class="form-actions">
    <?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, )); ?>
</div>

<?php $this->endWidget(); ?>