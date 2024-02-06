<style>
    .modal-dialog {
        overflow-y: initial !important
    }

    .modal-body {
        height: 550px;
        overflow-y: auto;
    }
</style>


<!--  venue create form  -->
<!--  Please put this file inside venue folder  -->
<div class="row">
    <div id="venue-err-div" class="alert alert-warning alert-dismissible" style="display:none">
        <i class="fa fa-warning"></i>
        <p id="error-message"></p>
    </div>

    <?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id' => 'venue-form',
        'type' => 'horizontal',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('class' => 'form-horizontal')
    )
    ); ?>

    <?php echo $form->errorSummary($model); ?>
    <div class="col-lg-12">
        <?php echo $form->textFieldRow($model, 'ship_name', array('maxlength' => 80, 'placeholder' => 'Venue name', 'class' => 'form-control')); ?>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-5">
            <?php echo $form->textFieldRow($model, 'ship_add1', array('maxlength' => 225, 'placeholder' => 'Address Line 1', 'class' => 'form-control')); ?>
        </div>
        <div class="col-lg-5">
            <?php echo $form->textFieldRow($model, 'ship_add2', array('maxlength' => 225, 'placeholder' => 'Address Line 2', 'class' => 'form-control')); ?>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-4">
            <?php echo $form->textFieldRow($model, 'ship_city', array('maxlength' => 225, 'placeholder' => 'city', 'class' => 'form-control')); ?>

        </div>
        <div class="col-lg-4">
            <?php echo $form->textFieldRow($model, 'ship_state', array('maxlength' => 2, 'placeholder' => 'state', 'class' => 'form-control')); ?>

        </div>
        <div class="col-lg-4">
            <?php echo $form->textFieldRow($model, 'ship_zip', array('maxlength' => 10, 'placeholder' => 'zip', 'class' => 'form-control')); ?>

        </div>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-5">
            <?php echo $form->textFieldRow($model, 'ship_phone1', array('maxlength' => 20, 'placeholder' => 'Phone 1', 'class' => 'form-control')); ?>
        </div>
        <div class="col-lg-5">
            <?php echo $form->textFieldRow($model, 'ship_phone2', array('maxlength' => 20, 'placeholder' => 'Phone 2', 'class' => 'form-control')); ?>

        </div>


    </div>

    <div class="col-lg-12">
        <div class="col-lg-5">
            <?php echo $form->textFieldRow($model, 'ship_email1', array('maxlength' => 225, 'placeholder' => 'Email 1', 'class' => 'form-control')); ?>
        </div>
        <div class="col-lg-5">
            <?php echo $form->textFieldRow($model, 'ship_details', array('maxlength' => 255, 'class' => 'form-control')); ?>

        </div>

    </div>
    <div class="col-lg-12">
        <div class="form-group pull-right" style="margin-top:22px;border-bottom:none;">
            <?php echo CHtml::ajaxSubmitButton(
                'Submit', ($model->isNewRecord) ? '/venue/create' : '/venue/update/id/' . $model->primarykey,
                array(
                    'beforeSend' => 'function(){
                                       $("#venue-err-div").hide();
				        // js:alert("sending..");  
				}',
                    'complete' => 'function() {
				}',
                    //	'dataType'=>'json',
            
                    'success' => 'function(data){			  //   js:alert(data);   	  
			     	     var obj = jQuery.parseJSON(data);  
			     	     if(obj.posted == "success") 
						      window.location.href = "/venue/view/id/"+ obj.id;
						 else{
						 var str = "<b>Please correct the following errors and resubmit the form.</b>"; //alert(obj);
						for (var i=0; i<obj.length; i++){
								var j = i+1;
								str = str + "<li>" + obj[i] + "</li>";
						}
						str = "<ol>"+str+"</ol>";
						$("#venue-err-div").show();
                                                $("#error-message").html(str);
							jQuery(this).parents("form").html(data.contents);			     	
						 }
			     }'
                ),
                array('id' => 'submit-venue-' . rand(), 'class' => 'btn btn btn-info')
            ); ?>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>