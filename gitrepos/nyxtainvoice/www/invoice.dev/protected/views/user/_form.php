<?php
$this->beginWidget('zii.widgets.CPortlet', array(
  'title' => "Create New user",
  'htmlOptions' => array('style' => "border:none;")
)
);

?>
<div class="card">
  <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'type' => 'horizontal',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'enableAjaxValidation' => false,

    'htmlOptions' => array(
      //    'onsubmit'=>"return false;",/* Disable normal form submit */
      //    'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
    ),
  )
  ); ?>

  <div id="user-error-div"></div>
  <?php echo $form->hiddenField($model, 'id'); ?>

  <?php echo $form->textFieldRow($model, 'username', array('class' => 'form-control')); ?>
  <?php echo $form->passwordFieldRow($model, 'password', array('class' => 'form-control')); ?>
  <?php echo $form->textFieldRow($model, 'email', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)); ?>
  <?php echo $form->dropDownListRow($model, 'level', $model->levelList); ?>
  <?php echo $form->textArea($model, 'profile', array('class' => 'form-control', 'rows' => 6, 'cols' => 50)); ?>

  <?php if ($model->isNewRecord): ?>
    <?php echo CHtml::ajaxSubmitButton(
      $model->isNewRecord ? 'Create' : 'Update',
      array('user/create'),
      array(
        'type' => "POST",
        //'url'=> array('user/create'),
        //	'data'=> $("#user-form").serialize(),
        'success' => 'function(data){
              // alert("User Successfully Created");
              var obj = jQuery.parseJSON(data);
			var str = "Please correct the following errors and resubmit the form.\n\n"; //alert(obj);
						for (var i=0; i<obj.length; i++){
								var j = i+1;
								str = str + j + ".) " + obj[i] + "\n";
						}
						str = "<pre>"+str+"</pre>";
						$("#user-error-div").html(str);//js:alert(obj);
		 if(obj.msg === "success") window.location.reload();
		 
		// window.location.reload();
              }',
        'error' => 'function(data) { // if error occured
        // alert("Error occured.please try again");
         var obj = jQuery.parseJSON(data);
		 
    }',

        'dataType' => 'html'
      ),
      array(
        //'color' => CHtml::BUTTON_COLOR_PRIMARY
      )
    ); ?>
  <?php else: ?>
    <?php echo CHtml::submitButton('Update'); ?>

  <?php endif; ?>

  <?php $this->endWidget(); ?>

  <?php $this->endWidget(); ?>
</div>