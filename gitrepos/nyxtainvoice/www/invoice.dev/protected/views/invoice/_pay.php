<?php if (Yii::app()->user->hasFlash('pay-done')): ?>
    <div class="alert alert-success">
        <?php Yii::app()->user->getFlash('pay-done'); ?>
    </div>
<?php else: ?>

    <?php
    $invoice = $stmt;
    echo '<table class="table bordered"><tr><th>Invoice#</th><th>Amount</th><th>Paid</th><th>Balance</th></tr>';
    echo '<tr><td>' . $invoice->invoice_id . '</td>';
    echo '<td>' . Payments::makeMoney($invoice->itemsTotal) . '</td>';
    echo '<td>' . Payments::makeMoney($invoice->paymentsTotal) . '</td>';
    echo '<td>' . Payments::makeMoney($invoice->getBalance()) . '</td></tr></table>';
    if ($invoice->itemsTotal > $invoice->paymentsTotal):
        ?>

        <div class="well">

            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'payments-form',
                'type' => 'vertical',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // There is a call to performAjaxValidation() commented in generated controller code.
                // See class documentation of CActiveForm for details on this.
                //   'action' =>array('/statement/pay','id'=>$_GET['id']),
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    //   'afterValidate' => 'js:checkErrors'
                ),
                'stateful' => false,
                'htmlOptions' => array("class" => "")
            )
            );
            ?>
            <p id="pmt-err-div"> </p>
            <?php //echo $form->errorSummary($pmt); ?>
            <?php //echo $form->hiddenField($stmt,'id');?>
            <?php //echo $form->textFieldControlGroup($model,'INVOICE_ID');  ?>
            <div class="form-group">
                <div class="row-fluid">

                    <?php //echo $form->labelEx($pmt,'AMOUNT',array('class'=>'title'));  ?>
                    <div class="span5">
                        <?php echo $form->textField($pmt, 'AMOUNT', array('placeholder' => 'Amout', 'style' => 'width:150px', 'maxlength' => 10)); ?>
                        <?php //echo $form->error($pmt,'AMOUNT',array('style'=>'color:red'));  ?>
                    </div>

                    <div class="span3">
                        <?php //echo $form->labelEx($pmt,'MODE_ID',array('class'=>'title')); ?>
                        <?php
                        echo $form->dropDownList($pmt, 'MODE_ID',
                            CHtml::listData(
                                Mode::model()->findAll(),
                                'MODE_ID',
                                function ($post) {
                                    return CHtml::encode($post->mode_description);
                                }
                            ), array('maxlength' => '7', 'style' => 'width:80px', ));
                        ?>
                    </div>
                </div>

            </div>
            <br>
            <div class="form-group">
                <div class="row-fluid">
                    <div class="span3">
                        <?php
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $pmt,
                            'attribute' => 'PAY_DATE',
                            'options' => array(
                                'dateFormat' => 'mm-dd-yy',
                                'altFormat' => 'M-dd-yy',
                                'showAnim' => 'slide',
                            ),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                                'value' => CTimestamp::formatDate('m-d-Y'),
                                'style' => 'width:180px',
                            ),
                        )
                        );
                        ?>
                    </div>
                    <div class="pull-right">
                        <?php echo $form->textField($pmt, 'DEPOSITED_BY', array('placeholder' => 'Deposited By', 'class' => 'form-control', 'maxlength' => 25, 'style' => 'width:190px')); ?>

                    </div>
                </div>

            </div>
            <?php echo $form->textAreaRow($pmt, 'DETAILS', array('class' => '', 'rows' => 3, 'cols' => 62)); ?>
        </div>
        <div class="row pull-right">
            <?php /*echo CHtml::ajaxSubmitButton('Submit', '/invoice/pay/id/'.$invoice->primaryKey, array(
                  'beforeSend' => 'function(){
                  // js:alert("sending.."); 
                                  $("#pmt-err-div").hide();
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
                          $("#pmt-err-div").show();
                                                  $("#error-message").html(str);
                              jQuery(this).parents("form").html(data.contents);			     	
                           }
                   }'
                      ), array('name' => 'submit-stmt', 'class' => 'btn btn-round btn-success btn-fill btn-wd'));
            */

            echo CHtml::submitButton('Save') ?>
        </div>
        <?php $this->endWidget(); ?>

    <?php endif; ?>
<?php endif; ?>