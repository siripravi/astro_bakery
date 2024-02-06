<?php $this->beginClip('hdrLevel2Clip'); ?>
<?php //$this->widget('HdrLevel2',array('statement' =>$this->document));  ?>
<!--     <span style="margin-left: 10px;" class="label label-default">Not Viewed</span>  -->
<div class="card">
    <div class="content">
        <div class="row">
            <div class="col-sm-7">
                <h2><?php echo $header; ?><?php
                    $this->widget(
                            'editable.EditableField', array(
                        'type' => 'text',
                        'model' => $statement,
                        'text' => $statement->{$key},
                        'attribute' => $key,
                        'success' => 'js: function(data,newVal) {   js:alert(newVal);                                   
                                     location.href = "/' . $this->id . '/update/id/"+newVal;
                                      // location.reload();
                                    }',
                        'url' => $url,
                        'htmlOptions' => array("style" => "color:green;", "title" => "click to eidt")
                            )
                    );
                    ?></h2>   

<?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Edit',
                    'type' => 'info',
                    'icon'=>'pe-7s-plus',
                    'buttonType' => 'ajaxLink',
                    'ajaxOptions' => array(
                        'beforeSend' => new CJavaScriptExpression('function(){                                               
                                 BootstrapDialog.show({
                                 title : "Edit Quote",
                                message: $("<div></div>").load("/quotation/create?id='.$statement->st_id.'"),
                                cssClass: "stmt-dialog",
                                closeByBackdrop: false,
                                  onshown: function(dialogRef){
                                       $("[data-toggle=\"tooltip\"]").tooltip({
                                        "placement": "top"
                                    }); 
                                    $("[data-toggle=\"popover\"]").popover({
                                        trigger: "hover",
                                            "placement": "top"
                                    });
                                    },
                                 onhidden: function(dialogRef){
                                       // alert("Dialog is popped down.");
                                  // location.reload();
                                },
                            });
                                 return false;}')
                ),  'htmlOptions' =>array('class'=>'btn btn-fill btn-round')
                    ));
                ?> 
                      
            </div>
            <div class="col-sm-5">
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="btn btn-fill btn-error dropdown-toggle" data-toggle="dropdown">
                            <i class="pe-7s-print"></i> P D F <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu"> 
                            <li>
                                <?php
                                echo CHtml::link('Generate PDF', "#", array(
                                    "ajax" => array(
                                        "url" => "/" . $this->id . "/doc.pdf/id/" . $statement->primaryKey,
                                        "type" => "POST",
                                        "data" => '{ event_type: js:$(this).data("ev")}',
                                        "beforeSend" => 'function () {                
                                            //  $(this).prop("disabled", true);
                                        }',
                                        "success" => 'function (result) {                  
                                            alert("PDF conversion successfull");
                                        }'
                                    ),
                                    'id' => 'gen-pdf-btn-' . rand()
                                        )
                                );
                                ?>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <?php
                                echo CHtml::link('<i class="fa fa-globe"></i> View Pdf', '/' . $this->id . '/viewPdf/id/' . $statement->st_id, array('target' => '_blank', 'class' => ''));
                                ?>
                            </li>
                            <li>     </li>       
                        </ul>
                    </div>  

                    <?php
                    echo CHtml::link('<i class="pe-7s-mail"></i> Send', '#', array(
                        'ajax' => array(
                            'beforeSend' => new CJavaScriptExpression(
                                    'function(){
                                                    BootstrapDialog.show({
                                                        title: "Send Message",
                                                       // type: "BootstrapDialog.TYPE_INFO",
                                                        message: $("<div></div>").load("/message/sendEmail?id=' . $statement->st_id . '"),
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
                    <?php if ($this->id == 'quotation'): ?>
                        <?php
                        $this->widget(
                                'bootstrap.widgets.TbButton', array(
                            'label' => 'Convert',
                            'type' => 'info',
                            'icon' => 'pe-7s-copy-file',
                            'buttonType' => 'ajaxLink',
                            'ajaxOptions' => array(
                                "type" => "POST",
                                'beforeSend' => new CJavaScriptExpression(
                                        'function(){                                             
                                                BootstrapDialog.show({
                                                    title : "Save as Invoice",
                                                    message: $("<div></div>").load("/' . $this->id . '/makeInv?id=' . $statement->primaryKey . '"),
                                                    closeByBackdrop: false,                                                 
                                                    onhidden: function(dialogRef){
                                                        //swal("success");
                                                        location.reload();
                                                    },
                                            });
                                            this.blur(); return false;}'
                                )
                            ),
                            'htmlOptions' => array(
                                'id' => 'convert-' . rand(),
                                'title' => 'convert to invoice',
                                'class' => 'btn btn-warning btn-fill btn-round'
                            )
                                )
                        );
                        ?>
                    <?php endif; ?>
                </div>
                <div class="clearfix"></div>                
            </div>            
        </div>
        <span>
            <b>Created by </b><?php echo $statement->statement->getUserName($statement->cuser_id) . " on " . Yii::app()->dateFormatter->formatDateTime($statement->create_time, "long", "long"); ?> 
            <b>Recently Updated by </b> <?php echo $statement->statement->getUserName($statement->uuser_id) . " on " . Yii::app()->dateFormatter->formatDateTime($statement->update_time, "long", "long"); ?> 
        </span>
    </div>
</div>

<?php if ($this->id == 'quotation'): ?>  
    <?php
    $dp = null;
    $this->renderPartial('_invTabBasic', array('stmt' => $statement, 'dp' => $dp));
    ?>
<?php else: ?>
    <?php  $dp = null;
    $this->widget('bootstrap.widgets.TbTabs', array(
        'type' => 'tabs',
        'id' => 'hdr-tabs',
        'tabs' => array(
            array('label' => $this->invoice->getHeader2() , 'content' => $this->renderPartial('_invTabBasic', array('stmt' => $statement, 'dp' => $dp), TRUE), 'active' => true),
            array('label' => 'Delivery', 'content' => $this->renderPartial('_invTabDelv', array('stmt' => $statement), TRUE)),
            array('label' => 'Pickup', 'content' => $this->renderPartial('_invTabPick', array('stmt' => $statement), TRUE)),
            array('label' => 'Payment', 'content' => $this->renderPartial('_invTabPmt', array('stmt' => $statement,
                    'dp' => new CArrayDataProvider($statement->payments, array('keyField' => 'id')),
                        ), TRUE)),
        ),
    ));
    ?>
<?php endif; ?>  

<?php $this->endClip(); ?>