<style>
    .datepicker {
        z-index: 1151 !important;
    }

    .modal-dialog {
        width: 100%;
        height: 100%;
        padding: 0;
    }

    .modal-content {
        height: 100%;
        border-radius: 0;
    }
</style>
<div class="row">
    <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-1">
        <?php
        //if (Yii::app()->request->isAjaxRequest) {
        //   $cs = Yii::app()->clientScript;
        //   $cs->scriptMap['jquery.js'] = false;
        //   $cs->scriptMap['jquery.min.js'] = false;
        //}
        ?>
        <div id="inv-err-div" style="display:none">
            <div class="box box-warning alert alert-warning">
                <div class="box-header">
                    <h4><span><i class="fa fa-warning"></i></span><span>Please correct these errors and resubmit the
                            form!</span></h4>
                </div>
                <div id="error-message" class="box-body"></div>
            </div>
        </div>
        <?php
        /** @var BootActiveForm $form */
        $form = $this->beginWidget(
            'CActiveForm',
            array(
                'id' => 'invoice_form',
                //  'type' => 'vertical',
                'enableAjaxValidation' => false,
            )
        );
        ?>

        <div class="row">
            <div class="col-md-6" style="">
                <div class="form-group" style="position: static;">
                    <?php echo $form->labelEx($invoice, 'invoice_id', array('class' => 'control-label')); ?>
                    <?php echo $form->textField($invoice, 'invoice_id', array('class' => 'form-control')); ?>
                    <p class="help-block">Example block-level help text here.</p>
                </div>
                <div class="form-group" style="position: static;">
                    <?php echo $form->labelEx($statement, 'ship_date', array('class' => 'control-label')); ?>
                    <div class="input-group">
                        <?php
                        echo $form->dateField($statement, 'ship_date');
                        ?>
                        <span class="input-group-addon"><i class="pe-7s-date"></i></span>
                        <?php echo $form->error($statement, 'ship_date'); ?>
                    </div>
                    <p class="help-block">Example block-level help text here.</p>
                </div>
            </div>
            <div class="col-md-6" style="">
                <div class="form-group" style="position: static;">
                    <?php echo $form->labelEx($statement, 'venue_id', array('class' => 'control-label')); ?>
                    <div class="input-group">
                        <?php
                        $this->widget(
                            'ext.select2.ESelect2',
                            array(
                                'model' => $statement,
                                'attribute' => 'venue_id',
                                // 'placeholder' => 'Type Venue Name',
                                'data' => CHtml::listData(Venue::model()->findAll(), 'venue_id', function ($post) {
                                    return CHtml::encode($post->ship_name . ' ' . $post->ship_add1);
                                }),
                                'options' => array(
                                    'placeholder' => 'Type Venue Name',
                                    'allowClear' => true,
                                ),
                                'htmlOptions' => array(
                                    'id' => 'venue-sel2',
                                    'empty' => '---select one--',
                                    // 'class' => 'form-control',
                                    'style' => 'width:260px;',
                                    'ng-model' => 'header.venue_id',
                                    'placeholder' => 'Type Venue Name',
                                ),
                            )
                        );
                        ?>
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <div class="form-group" style="position: static;">
                        <?php echo $form->labelEx($statement, 'customer_no', array('class' => 'control-label')); ?>
                        <?php echo $form->textField($statement, 'customer_no', array('class' => 'form-control')); ?>

                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                </div>
            </div>

            <div class="footer text-center">
                <?php
                $iurl = !empty($invoice->st_id) ?
                    '/invoice/create?id=' . $invoice->st_id :
                    '/invoice/create';
                echo CHtml::ajaxSubmitButton(
                    'Submit',
                    $iurl,
                    array(

                        'beforeSend' => 'function(){
                                    // js:alert("sending.."); 
                                    $("#inv-err-div").hide();
                            }',
                        'complete' => 'function() {
                                    }',
                        //	'dataType'=>'json',
                        'success' => 'function(data){	  //   js:alert(data);   	  
                                         var obj = jQuery.parseJSON(data);  
                                         if(obj.posted == "success") 
                                                          window.location.href = "/invoice/update/id/"+ obj.id;
                                                     else{
                                                     var str = "";
                                                    for (var i=0; i<obj.length; i++){
                                                                    var j = i+1;
                                                                    str = str + "<li>" + obj[i] + "</li>";
                                                    }
                                                    str = "<ol>"+str+"</ol>";
                                                    $("#inv-err-div").show();
                                                    $("#error-message").html(str);
                                                        jQuery(this).parents("form").html(data.contents);			     	
                                                     }
                                 }'
                    ),
                    array('name' => 'submit-stmt', 'class' => 'btn btn-round btn-success btn-fill btn-wd')
                );
                ?>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
</div>
<?php
if (!empty($statement->customer))
    Yii::app()->clientScript->registerScript(
        'def-cust-iv',
        '$("#Statement_customer_no").select2("data", {id: ' . $statement->customer_no . ',text:"' . $statement->customer->first_name . ' ' . $statement->customer->last_name . '"});
   '
    );
?>
<script>
    function getItemFormat(item) {
        var format = '<div>' + item.text + '</div>';
        return format;
    }
    jQuery(function () {
        jQuery('#Statement_customer_no').select2({
            minimumInputLength: 2,
            placeholder: 'Search for customer',
            allowClear: true,
            ajax: {
                url: '/copyright.json',
                dataType: 'json',
                quietMillis: 250,
                data: function (term, page) {
                    return {
                        q: term
                    };
                },
                results: function (data, page) {
                    return { results: data, id: 'ItemId', text: 'ItemText' };
                }
            },
            formatResult: getItemFormat,
            dropdownCssClass: "bigdrop",
            escapeMarkup: function (m) {
                return m;
            }
        });
    });

</script>