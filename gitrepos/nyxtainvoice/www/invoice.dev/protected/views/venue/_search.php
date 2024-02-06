<?php
/* @var $this VenueController */
/* @var $model Venue */
/* @var $form BSActiveForm */
?>

<?php $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
)
); ?>

<?php echo $form->textFieldControlGroup($model, 'venue_id'); ?>
<?php echo $form->textFieldControlGroup($model, 'ship_name', array('maxlength' => 30)); ?>
<?php echo $form->textFieldControlGroup($model, 'ship_add1', array('maxlength' => 30)); ?>
<?php echo $form->textFieldControlGroup($model, 'ship_add2', array('maxlength' => 30)); ?>
<?php echo $form->textFieldControlGroup($model, 'SHIP_city', array('maxlength' => 30)); ?>
<?php echo $form->textFieldControlGroup($model, 'SHIP_state', array('maxlength' => 2)); ?>
<?php echo $form->textFieldControlGroup($model, 'SHIP_zip', array('maxlength' => 6)); ?>
<?php echo $form->textFieldControlGroup($model, 'SHIP_phone1', array('maxlength' => 15)); ?>
<?php echo $form->textFieldControlGroup($model, 'SHIP_phone2', array('maxlength' => 15)); ?>
<?php echo $form->textFieldControlGroup($model, 'SHIP_email1', array('maxlength' => 45)); ?>
<?php echo $form->textFieldControlGroup($model, 'SHIP_DETAILS', array('maxlength' => 255)); ?>

<div class="form-actions">
    <?php echo BsHtml::submitButton('Search', array('color' => BsHtml::BUTTON_COLOR_PRIMARY, )); ?>
</div>

<?php $this->endWidget(); ?>