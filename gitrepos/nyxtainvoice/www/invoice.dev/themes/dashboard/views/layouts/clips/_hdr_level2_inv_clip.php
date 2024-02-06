<style>
 
</style>
<?php $dp = null; ?>
<?php $this->beginClip('hdrLevel2InvClip'); ?>  
        <?php $this->widget('HdrLevel2',array('statement' =>$this->invoice));?>
<section class="content-header">
    

    <span style="margin-left: 10px;" class="label label-default">Not Viewed</span>
    <?php   if (($this->invoice->itemsTotal) <= ($this->invoice->paymentsTotal) && (Yii::app()->user->admin)): ?>
        <p class="lead"><?php //echo $dueDate; ?></p>
        <div class="btn-group btn-toggle">
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'ajaxSubmit',
                "url" => '/invoice/setPaid/id/' . $this->invoice->primaryKey,
                'type' => ($this->invoice->is_paid == 0) ? 'default' : 'success',
                'label' => 'Paid ' . Payments::makeMoney($this->invoice->paymentsTotal),
                "url" => '/invoice/setPaid/id/' . $this->invoice->primaryKey,
                'ajaxOptions' => array(
                    "type" => "POST",
                    "data" => array("paid" => 1),
                    'beforeSend' => new CJavaScriptExpression('function(){
                                                           // $(this).text("Working..");
                                                           // $(this).prop("disabled", true);
                                                        }'
                    ),
                    "success" => new CJavaScriptExpression('function (result) {                                                   
                                                            BootstrapDialog.alert({title: "success!", message: "Invoice set as paid!",
                                                                callback: function (result) {
                                                                    location.reload();
                                                                }});
                                                        }'),
                //  'htmlOptions' => array("class" => ($this->invoice->paid == 0) ? 'btn-default ' : 'btn-success  active')
                ))
            );
            ?>
            <?php
            $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'ajaxSubmit',
                'type' => ($this->invoice->is_paid == 0) ? 'warning' : 'default',
                'label' => 'Due ' . Payments::makeMoney($this->invoice->getBalance()),
                "url" => '/invoice/setPaid/id/' . $this->invoice->primaryKey,
                'ajaxOptions' => array(
                    "type" => "POST",
                    "data" => array("paid" => 0),
                    'beforeSend' => new CJavaScriptExpression('function(){
                                  //  $(this).text("Working..");
                                  //  $(this).prop("disabled", true);
                                }'
                    ),
                    "success" => new CJavaScriptExpression('function (result) {                                                   
                                    BootstrapDialog.alert({title: "success!", message: "Invoice set as Due!",
                                        callback: function (result) {
                                            location.reload();
                                        }});
                                }'),
                // 'htmlOptions' => array("class" => ($this->invoice->paid == 0) ? 'btn-default ' : 'btn-success  active')
                ))
            );
            ?>
        </div>            
    <?php endif; ?>
    <div class="pull-right">
        <div class="btn-group">
            <button type="button" class="btn btn-info btn-fill dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-file"></i> P D F <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu"> 
                <li>
                    <?php
                            echo CHtml::link('Generate PDF', "#", array(
                                "ajax" => array(
                                    "url" => "/invoice/doc.pdf/id/" . $this->invoice->primaryKey,
                                    "type" => "POST",
                                    "data" => '{ event_type: js:$(this).data("ev")}',
                                    "beforeSend" => 'function () {                
                                        //  $(this).prop("disabled", true);
                                    }',
                                    "success" => 'function (result) {                   
                                        alert("PDF conversion successfull");
                                    }'
                                ), "class" => ""
                                    //'htmlOptions' => array('id'=>'gen-pdf-btn-'.rand())
                                    )
                            );
                            ?>
                </li>
                <li class="divider"></li>
                <li>
                     <?php
            echo CHtml::link('<i class="fa fa-globe"></i> View Pdf', '/invoice/viewPdf/id/' . $this->invoice->st_id,  array('target'=>'_blank','class' => ''));
            ?>
                </li>          
            </ul>
        </div>    
        <?php
            echo CHtml::link('<i class="icon icon-envelope"></i> Email', '#',array(
                'ajax' =>array(
                'beforeSend' => new CJavaScriptExpression('function(){
                        BootstrapDialog.show({
                            title: "Send Message",
                            type: "BootstrapDialog.TYPE_SUCCESS",
                            message: $("<div></div>").load("/message/sendEmail?id=' . $this->invoice->st_id . '"),
                            onhidden: function(dialogRef){
                            // alert("Dialog is popped down.");
                            location.reload();
                        },
                    buttons: [{
                        label: "Cancel",
                        action: function(dialogRef){
                                    dialogRef.close();
                                }
                    }]
                });
                this.blur(); 
                return false;}'
            )),
            'id' => 'btn-send-msg', 'class' => 'btn btn-info btn-fill'
            ));
        ?>
        <div class="btn-group">
            <button type="button" class="btn btn-info btn-fill dropdown-toggle" data-toggle="dropdown">
                Payment <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <?php
                        /*    echo CHtml::link('As Invoice', "#", array(
                                "ajax" => array(
                                    "type" => "POST",
                            'beforeSend' => new CJavaScriptExpression('function(){                                               
                                                 BootstrapDialog.show({
                                                 title : "Save as Invoice",
                                                 message: $("<div></div>").load("/quotation/makeInv?id=' . $this->invoice->id . '"),
                                                closeByBackdrop: false,
                                                 
                                                 onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                            });
                                                this.blur(); return false;}')
                        ),
                        'id' => 'convert-' . rand()
                    ));*/
                             echo CHtml::link('Add Payment', "#", array(
                                "ajax" => array(
                                    "type" => "POST",
                                'beforeSend' => new CJavaScriptExpression('function(){
                                                $(\'[data-toggle="dropdown"]\').parent().removeClass("open");
                                                 BootstrapDialog.show({
                                                  title: "Add Payment",
                                                  type: BootstrapDialog.TYPE_SUCCESS,
                                                message: $("<div></div>").load("/invoice/pay?id=' . $this->invoice->primaryKey . '"),
                                                onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                                buttons: [{
                                                    label: "X",
                                                    action: function(dialogRef){
                                                        dialogRef.close();
                                                    }
                                                }]
                                            });
                                                this.blur(); 
                                                return false;}')
                                    ),
                                'id' => 'btn-add-payment'. rand(), 'class' => 'enter-payment', "ng-disabled" => "isSaving")
                            );
                            ?>  </li>
                        

                <li>
                    <?php
                        echo CHtml::ajaxLink('<i class="fa fa-credit-card"></i> Payment Detail ', '', 
                                array(
                                    'beforeSend' => 'function(){
                                                   BootstrapDialog.show({
                                                   title : "Payment History",
                                                    message: $("<div></div>").load("/invoice/payments/id/' . $this->invoice->primaryKey . '.html")
                                                });
                                             }'
                                    ), 
                                array('class' => ''));
                    ?>
                </li>                    
            </ul>
        </div>
    </div>
    <hr>
    <div class="clearfix"></div>
     <?php  
    $this->widget('bootstrap.widgets.TbTabs', array(
        //'type' => 'pills',
        'id' => 'hdr-tabs',
        'tabs' => array(
            array('label' => $this->invoice->getHeader2() . " " . $this->invoice->primaryKey, 'content' => $this->renderPartial('_invTabBasic', array('stmt' => $this->invoice,'dp'=>$dp), TRUE), 'active' => true),
            array('label' => 'Delivery', 'content' => $this->renderPartial('_invTabDelv', array('stmt' => $this->invoice), TRUE)),
            array('label' => 'Pickup', 'content' => $this->renderPartial('_invTabPick', array('stmt' => $this->invoice), TRUE)),
        ),
    ));
    ?>
</section>
<?php $this->endClip(); ?>