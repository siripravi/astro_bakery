<?php $form = $this->beginWidget('CActiveForm', array(
  'id' => 'payments-form',
  // Please note: When you enable ajax validation, make sure the corresponding
  // controller action is handling ajax validation correctly.
  // There is a call to performAjaxValidation() commented in generated controller code.
  // See class documentation of CActiveForm for details on this.
  'enableAjaxValidation' => true,
)
); ?>
<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php echo $form->errorSummary($model); ?>

<?php //echo $form->textFieldControlGroup($model,'INVOICE_ID'); ?>
<div class="row-fluid">
  <div class="span5">
    <?php echo $form->labelEx($model, 'INVOICE_ID', array('class' => 'control-label')); ?>
    <?php $this->widget('ext.select2.ESelect2', array(
      'model' => $model,
      'attribute' => 'INVOICE_ID',
      'data' => CHtml::listData(Invoice::model()->findAll(), 'st_id', function ($post) {
            return CHtml::encode($post->invoice_id);

          }),
      'options' => array(
        'placeholder' => 'Type invoice Name',
        'allowClear' => true,
      ),
      'htmlOptions' => array(
        'class' => 'form-control',
        //   'style'=>'width:530px;',
      ),
    )
    ); ?>
  </div>
  <div class="span4">
    <?php echo $form->labelEx($model, 'amount', array('class' => 'control-label')); ?>
    <?php echo $form->textField($model, 'amount', array('maxlength' => 10)); ?>
  </div>
</div>
<div class="row-fluid">
  <?php //echo $form->textFieldControlGroup($model,'mode_id'); ?>
  <div class="span5">
    <?php echo $form->labelEx($model, 'mode_id'); ?>
    <?php echo $form->dropDownList($model, 'mode_id',
      CHtml::listData(
        Mode::model()->findAll(),
        'mode_id',
        function ($post) {
          return CHtml::encode($post->mode_description);
        }
      ), array()); ?>
    <?php echo $form->error($model, 'mode_id'); ?>
  </div>
  <div class="span5">
    <?php echo $form->labelEx($model, 'pay_date', array('class' => '')); ?>
    <?php
    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
      'model' => $model,
      'attribute' => 'pay_date',
      'options' => array(
        'dateFormat' => 'mm-yy-dd',
        'altFormat' => 'M-dd-yy',
        'showAnim' => 'slide',
      ),
      'htmlOptions' => array(
        'class' => 'form-control',
        'value' => CTimestamp::formatDate('m-d-Y'),
        // 'style'=>'width:120px;'
      ),

    )
    );
    ?>

    <?php echo $form->error($model, 'pay_date'); ?>
  </div>
</div>
<div class="row-fluid">
  <div class="span5">
    <?php echo $form->labelEx($model, 'details'); ?>
    <?php echo $form->textField($model, 'details', array('maxlength' => 100)); ?>
  </div>
  <div class="span5">
    <?php echo $form->labelEx($model, 'deposited_by'); ?>
    <?php echo $form->textField($model, 'deposited_by', array('maxlength' => 25)); ?>
  </div>
</div>
<?php echo CHtml::submitButton('Submit', array(
  //'color' => BsHtml::BUTTON_COLOR_PRIMARY
)
); ?>

<?php $this->endWidget(); ?>