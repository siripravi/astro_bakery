<?php
/* @var $this EmployeeController */
/* @var $model Employee */
/* @var $form CActiveForm */
?>
<div id="emp-err-div" class="alert alert-warning alert-dismissible" style="display:none">
    <i class="fa fa-warning"></i>
    <p id="error-message"></p>
</div>
<div class="well" style="background:#fff;border:none;">
    <div id="emp-err-div"></div>
    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'employee-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal')
    )
    ); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="form-group">
        <label class="control-label"><i class="fa fa-arrow-circle-o-down"></i>&nbsp;
            <?php echo "<strong>Employee Name</strong>"; ?>
        </label>
        <div class="input-group col-lg-12">
            <span>
                <?php echo $form->dropDownList($model, 'title', array(
                    'Mr' => 'Mr',
                    'Mrs' => 'Mrs',
                    'Ms' => 'Ms',

                ), array('maxlength' => 20, 'class' => 'form-control', 'style' => "width:20%;")); ?>
            </span>
            <span>
                <?php echo $form->textField($model, 'first_name', array('maxlength' => 30, 'placeholder' => 'first name', 'class' => 'form-control', 'style' => "width:40%;")); ?>
            </span>
            <span>
                <?php echo $form->textField($model, 'last_name', array('maxlength' => 30, 'placeholder' => 'last name', 'class' => 'form-control', 'style' => "width:40%;")); ?>
            </span>
        </div>
        <div class="input-group col-lg-4">
            <?php echo $form->labelEx($model, 'emp_type_id'); ?>
            <?php echo $form->dropDownList(
                $model,
                'emp_type_id',
                CHtml::listData(Designation::model()->findAll(), 'emp_type_id', function ($post) {
                return CHtml::encode($post->designation . ' ' . $post->design_abbr);
            }),
                array('maxlength' => 225, 'placeholder' => 'Designation', 'class' => 'form-control')
            ); ?>
        </div>
    </div>

    <div class="form-group" style="margin-top:5px;">
        <label class="control-label"><i class="fa fa-arrow-circle-o-down"></i>&nbsp;
            <?php echo "<strong>Address</strong>"; ?>
        </label>
        <div class="input-group col-lg-12">
            <?php echo $form->textField($model, 'address1', array('maxlength' => 225, 'placeholder' => 'Address Line 1', 'class' => 'form-control')); ?>
        </div>
        <div class="input-group col-lg-12">
            <?php echo $form->textField($model, 'address2', array('maxlength' => 225, 'placeholder' => 'Address Line 2', 'class' => 'form-control')); ?>
        </div>
        <div class="input-group col-lg-12">
            <span>
                <?php echo $form->textField($model, 'city', array('maxlength' => 225, 'placeholder' => 'city', 'class' => 'form-control', 'style' => "width:30%;")); ?>
            </span>
            <span>
                <?php echo $form->textField($model, 'state', array('maxlength' => 2, 'placeholder' => 'state', 'class' => 'form-control', 'style' => "width:40%;")); ?>
            </span>
            <span>
                <?php echo $form->textField($model, 'postal_code', array('maxlength' => 10, 'placeholder' => 'zip', 'class' => 'form-control', 'style' => 'width:20%')); ?>
            </span>
        </div>
    </div>

    <div class="form-group" style="margin-top:5px;">
        <div class="input-group col-lg-12">
            <span class="input-group-addon" id="cust-phone1"><i class="fa fa-phone"></i></span>
            <span>
                <?php echo $form->textField($model, 'phone1', array('maxlength' => 20, 'placeholder' => 'Phone 1', 'class' => 'form-control')); ?>
            </span>
            <span class="input-group-addon" id="cust-phone2"><i class="fa fa-phone"></i></span>
            <span>
                <?php echo $form->textField($model, 'phone2', array('maxlength' => 20, 'placeholder' => 'Phone 2', 'class' => 'form-control')); ?>
            </span>
        </div>
        <div class="input-group col-lg-12">
            <span class="input-group-addon" id="cust-mail2"><i class="fa fa-envelope"></i></span>
            <span>
                <?php echo $form->emailField($model, 'email', array('maxlength' => 225, 'placeholder' => 'Email', 'class' => 'form-control')); ?>
            </span>
        </div>
    </div>

    <div class="form-group" style="margin-top:5px;">
        <label class="control-label">Notes</label>
        <div class="input-group col-lg-12 pull-right">
            <?php echo $form->textField($model, 'notes', array('maxlength' => 255, 'class' => 'form-control')); ?>
        </div>
    </div>

    <div class="form-group pull-right" style="margin-top:22px;border-bottom:none;">
        <?php
        echo CHtml::ajaxSubmitButton('Submit', ($model->isNewRecord) ? '/employee/create' : '/employee/update/id/' . $model->primarykey, array(
            'beforeSend' => 'function(){
                                $("#emp-err-div").hide();
				// js:alert("sending..");  
			}',
            'complete' => 'function(){	}',
            'success' => 'function(data){
                //js:alert(data);   	  
		var obj = jQuery.parseJSON(data);  
		if(obj.posted == "success") 
		window.location.href = "/employee/view/id/"+ obj.id;
		else{
                    var str = "<p><b>Please correct the following errors and resubmit the form.</b></p>";
                    //alert(obj);
                    for (var i=0; i<obj.length; i++){
                    var j = i+1;
                    str = str + "<li>" + obj[i] + "</li>";
		}
                    str = "<ol>"+str+"</ol>";
                    $("#emp-err-div").show();
                    $("#error-message").html(str);
                    jQuery(this).parents("form").html(data.contents);			     	
		}
		}'
        ), array('name' => 'submit-emp', 'id' => 'emp-save-' . rand(), 'class' => 'btn btn btn-primary'));
        ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->