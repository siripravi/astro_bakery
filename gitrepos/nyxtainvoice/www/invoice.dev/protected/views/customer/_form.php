<style>
    .modal-dialog {
        overflow-y: initial !important
    }

    .modal-body {
        height: 550px;
        overflow-y: auto;
    }
</style>

<!--  customer create form  -->
<!--  Please put this file inside customer folder  -->

<div id="cust-err-div" class="alert alert-warning alert-dismissible" style="display:none">
    <i class="fa fa-warning"></i>
    <p id="error-message"></p>
</div>

<div id="cust-err-div"></div>
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'customer-form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'type' => 'horizontal',
    'enableAjaxValidation' => false,
    // 'htmlOptions' => array( 'class'=>'form-horizontal')
)
);
?>

<?php echo $form->errorSummary($model); ?>

<div class="card">
    <h4 class="header">Contact</h4>
    <div class="content">
        <div class="form-group">
            <div class="col-sm-5">
                <?php echo $form->textFieldRow($model, 'first_name', array('maxlength' => 30, 'placeholder' => 'first name', 'class' => 'form-control')); ?>
            </div>
            <div class="col-sm-5">
                <?php echo $form->textFieldRow($model, 'last_name', array('maxlength' => 30, 'placeholder' => 'last name', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-5">
                <?php echo $form->textFieldRow($model, 'phone1', array('maxlength' => 20, 'placeholder' => 'Phone 1', 'class' => 'form-control')); ?>
            </div>
            <div class="col-sm-5">
                <?php echo $form->textFieldRow($model, 'phone2', array('maxlength' => 20, 'placeholder' => 'Phone 2', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <?php echo $form->emailField($model, 'email1', array('maxlength' => 225, 'placeholder' => 'Email 1', 'class' => 'form-control')); ?>
            </div>
            <div class="col-sm-5">
                <?php echo $form->emailField($model, 'email2', array('maxlength' => 225, 'placeholder' => 'Email 2', 'class' => 'form-control')); ?>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <h4 class="header">Address</h4>
    <div class="content">
        <div class="form-group">
            <div class="col-sm-5">
                <?php echo $form->textFieldRow($model, 'address1', array('maxlength' => 225, 'placeholder' => 'Address Line 1', 'class' => 'form-control')); ?>
            </div>

            <div class="col-sm-5">
                <?php echo $form->textFieldRow($model, 'address2', array('maxlength' => 225, 'placeholder' => 'Address Line 2', 'class' => 'form-control')); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <?php echo $form->textFieldRow($model, 'city', array('maxlength' => 225, 'placeholder' => 'city', 'class' => 'form-control')); ?>
            </div>

            <div class="col-sm-3">
                <?php echo $form->textFieldRow($model, 'state', array('maxlength' => 2, 'placeholder' => 'state', 'class' => 'form-control')); ?>
            </div>

            <div class="col-sm-3">
                <?php echo $form->textFieldRow($model, 'zip', array('maxlength' => 10, 'placeholder' => 'zip', 'class' => 'form-control')); ?>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="content">
        <?php echo $form->textFieldRow($model, 'notes', array('maxlength' => 255, 'class' => 'form-control', 'class' => 'form-control')); ?>
    </div>
</div>
<div class="form-group col-sm-4 pull-right" style="">
    <?php
    echo CHtml::ajaxSubmitButton('Submit', ($model->isNewRecord) ? '/customer/create' : '/customer/update/id/' . $model->primarykey, array(
        'beforeSend' => 'function(){
                                         $("#cust-err-div").hide();
				        // js:alert("sending..");  
				}',
        'complete' => 'function() {
				}',
        //	'dataType'=>'json',
        'success' => 'function(data){			  //   js:alert(data);   	  
			     	     var obj = jQuery.parseJSON(data);  
			     	     if(obj.posted == "success") 
						      window.location.href = "/customer/view/id/"+ obj.id;
						 else{
						 var str = "<p><b>Please correct the following errors and resubmit the form.</b></p>"; //alert(obj);
						for (var i=0; i<obj.length; i++){
								var j = i+1;
								str = str + "<li>" + obj[i] + "</li>";
						}
						str = "<ol>"+str+"</ol>";
						$("#cust-err-div").show();
                                                $("#error-message").html(str);
							jQuery(this).parents("form").html(data.contents);			     	
						 }
			     }'
    ), array('name' => 'submit-cust', 'id' => 'cust-save-' . rand(), 'class' => 'btn btn btn-fill btn-primary'));
    ?>


</div>
<?php $this->endWidget(); ?>