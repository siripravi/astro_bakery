<div class="card">
    <div class="header">
        <h4 class="title">Add Payment</h4>
    </div>
    <div class="content">
        <?php

        //  $pmt->invoice_id = $stmt->primaryKey;
        
        $this->widget('editable.EditableDetailView', array(
            'data' => $pmt,
            //you can define any default params for child EditableFields 
            'url' => $this->createUrl('payments/updatePmt'),
            //common submit url for all fields
            'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
            //params for all fields
            'emptytext' => 'no value',
            //'apply' => false, //you can turn off applying editable to all attributes
        
            'attributes' => array(
                array(
                    'name' => 'invoice_id',
                    'label' => false,

                    //'type' => 'raw',
                    //'visible' => false,
                    'value' => $stmt->primaryKey,
                    'editable' => array(
                        'disabled' => true,
                        'type' => 'text',
                        //'value' => $stmt->primaryKey,
                        //  'text' => $stmt->invoice_id,
                        'inputclass' => 'input-medium',
                        'emptytext' => '',
                        'validate' => 'function(value) {
                    if(!value) return "invoicce is required"
                }',
                        'htmlOptions' => array('style' => 'display:none;')
                    )
                ),
                array(
                    'name' => 'deposited_by',
                    'editable' => array(
                        'type' => 'text',
                        'inputclass' => 'input-medium',
                        'emptytext' => 'person name',
                    )
                ),
                array(
                    'name' => 'amount',
                    'editable' => array(
                        'type' => 'text',
                        'inputclass' => 'input-medium',
                        'emptytext' => 'amount here',
                        'validate' => 'function(value) {
                    if(!value) return "please enter amount"
                }'
                    )
                ),

                array(
                    //select loaded from database
                    'name' => 'mode_id',
                    'editable' => array(
                        'type' => 'select',
                        'source' => Editable::source(Mode::model()->findAll(), 'mode_id', function ($post) {
                            return CHtml::encode($post->mode_description);
                        }),
                        'validate' => 'function(value) {
                    if(!value) return "please specify mode of payment"
                }',
                    )
                ),

                array(
                    'name' => 'pay_date',
                    'editable' => array(
                        'type' => 'date',
                        'viewformat' => 'dd/mm/yyyy',
                        'validate' => 'function(value) {
                    if(!value) return "date of payment is required"
                }',
                    )
                ),
                array(
                    'name' => 'details',
                    'editable' => array(
                        'type' => 'textarea',

                    )
                ),

                // 'deposited_by',
                // 'created'
        

                /*  array( //edit related record
                      'name' => 'profile.language',
                      'editable' => array(
                          'url'  => array('site/updateProfile') //related record requires own submit url
                      )
                  ),        
                  'user_comment',
                  'created_at', //will not be editable as attribute is not safe
                 * 
                 */
            ),
            'htmlOptions' => array('class' => 'table table-hover')
        )
        );
        ?>
        <hr>
        <div id="msg" class="alert hide"></div>
        <div style="text-align: center"><button id="pmt-btn" class="btn btn-fill btn-round btn btn-info">Pay</button>
        </div>

    </div>
</div>

<?php if ($pmt->isNewRecord) {
    Yii::app()->clientScript->registerScript('new-payment', '
       
            $("#pmt-btn").click(function() {
                $(this).parent().parent().find(".editable").editable("submit", {
                    url: "' . $this->createUrl('payments/createPmt') . '",
                    data: ' . CJSON::encode(array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken)) . ',
                    ajaxOptions: { dataType: "json" },                    
                    success: function(data, config) {
                        if(data && data.id) {
                            $(this).editable("option", "pk", data.id);
                            $(this).removeClass("editable-unsaved");
                            $("#msg").removeClass("alert-warning").addClass("alert-success")
                                     .html("Payment created! Now you can update it.").show();
                            $("#save-btn").hide();
                            location.reload();
                        } else {
                            config.error.call(this, data && data.errors ? data.errors : "Unknown error");
                        }
                    },
                    error: function(errors) {
                        var msg = "";
                        if(errors && errors.responseText) { 
                            msg = errors.responseText;
                        } else {
                            $.each(errors, function(k, v) { msg += v+"<br>"; });
                        } 
                        $("#msg").removeClass("hide").addClass("alert-warning")
                                 .html(msg).show();         
                     }
                });
            });
        ');
}
?>