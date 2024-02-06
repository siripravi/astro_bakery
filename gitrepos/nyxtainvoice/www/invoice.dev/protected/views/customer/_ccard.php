<?php //echo $this->layout; ?>
<div id="cust-cc-err-div" class="alert alert-warning alert-dismissible" style="display:none;">
  <i class="fa fa-warning"></i>
  <p id="cc-error-message"></p>
</div>
<div class="container">
  <div id="cust-cc-err-div"></div>
  <?php
  $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'customer-cc-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    // 'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
    'enableAjaxValidation' => false,
    'action' => array('/customer/batchUpdate', 'id' => $cid),
    'htmlOptions' => array('class' => 'form-horizontal')
  )
  );
  ?>


  <legend>Customer Cards</legend>
  <?php
  $this->widget('ext.tabularinput.XTabularInput', array(
    'models' => $cards,
    'inputView' => '_tabularInput',
    'inputUrl' => $this->createUrl('request/addTabularInputs'),
    // 'addCssClass' => 'btn btn-success',
    //  'removeCssClass' => 'btn btn-warning',
    'removeLabel' => '[X]',
    'addLabel' => 'Another Card',
    'removeTemplate' => '<div class="pull-right">{link}</div>',
    //  'addTemplate'=>'<div class="action">{link}</div>',
  )
  ); ?>



  <div class="form-group pull-right" style="margin-top:22px;border-bottom:none;">
    <?php
    echo CHtml::ajaxSubmitButton('Submit', '/customer/batchUpdate/id/' . $cid, array(
      'beforeSend' => 'function(){
                                         $("#cust-cc-err-div").hide();
				        // js:alert("sending..");  
				}',
      'complete' => 'function() {
				}',
      //	'dataType'=>'json',
    
      'success' => 'function(data){			  //   js:alert(data);   	  
			     	     var obj = jQuery.parseJSON(data);  
                                     //js:alert(obj.length);
			     	     if(obj.posted == "success") 
						      location.reload();
						 else{
						 var str = "<p><b>Validation Failed. Correct the errors and resubmit!</b></p>"; //alert(obj);
						//alert(str);
						$("#cust-cc-err-div").show();
                                                $("#cc-error-message").html(str);
							jQuery(this).parents("form").html(data.contents);			     	
						 }
			     }'
    ), array('name' => 'submit-cust', 'id' => 'cust-save-' . rand(), 'class' => 'btn btn btn-primary'));
    ?>


  </div>
  <?php $this->endWidget(); ?>
</div>