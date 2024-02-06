<?php
/* @var $this PaymentsController */
/* @var $model Payments */
/* @var $form BSActiveForm */
?>

<?php $form = $this->beginWidget('CActiveForm', array(
   'id' => 'convert-form',
   // Please note: When you enable ajax validation, make sure the corresponding
   // controller action is handling ajax validation correctly.
   // There is a call to performAjaxValidation() commented in generated controller code.
   // See class documentation of CActiveForm for details on this.
   'enableAjaxValidation' => false,
   'clientOptions' => array(
      //  'validateOnSubmit' => true ,
      //  'beforeValidate'=>'js:beforevalidate'

   ),
)
); ?>

<?php //echo $form->errorSummary($model); ?>
<div id="convert-error-div"></div>
<p>Prev. Invoice Number:<span class="label label-info">
      <?php echo statement::getInvNumberRange(); ?>
   </span></p>
<br>
<?php echo $form->textField($model, 'invoice_id', array('placeholder' => 'Invoice Number')); ?>
<?php echo CHtml::error($model, 'invoice_id'); ?>
<?php echo CHtml::submitButton('Submit', array('id' => 'btn-convert')); ?>
</div>

<?php $this->endWidget(); ?>

<script>
   function beforevalidate(form) {
      //if (form.data('submitObject')) {
      alert("submit");
      // }
      return true;
   }
</script>