<div class="col-lg-6">
    <a class="btn btn-primary" href="/customer/admin"><i class="pe-7s-back-2"></i> Back</a>
</div>

<div class="panel-heading">
    <h3><i class="fa fa-user"></i>&nbsp;
        <?php echo $model->first_name . " " . $model->last_name; ?>
    </h3>

</div>
<div class="content">
    <div class="box">
        <div class="box-header">

            <?php
            /*         $this->widget('zii.widgets.jui.CJuiButton', array(
                         'buttonType' => 'link',
                         'name' => 'btnEdtCust',
                         'caption' => '<i class="fa fa-pencil"></i> Edit Customer',
                         'onclick' => new CJavaScriptExpression('function(){
                                      BootstrapDialog.show({
                                       title: "Update Customer",
                                       type: BootstrapDialog.TYPE_SUCCESS,
                                     message: $("<div></div>").load("/customer/update/id/'.$model->primaryKey.'"),
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
                                     return false;}'),
                         'htmlOptions' => array('id' => 'btn-edit-customer', 'class' => 'btn btn-info btn-sm')
                     ));*/
            //  echo CHtml::link('Edit Customer',array('customer/update','id'=>$model->primaryKey));
            ?>

        </div>
        <div class="box-body">
            <?php $this->widget('zii.widgets.CDetailView', array(
                'htmlOptions' => array(
                    'class' => 'table table-striped table-condensed table-hover',
                ),
                'data' => $model,
                'attributes' => array(
                    'customer_no',
                    'first_name',
                    'last_name',
                    'address1',
                    'address2',
                    'city',
                    'state',
                    'zip',
                    'phone1',
                    'phone2',
                    'email1',
                    'email2',
                    'notes',
                ),
            )
            ); ?>
        </div>
    </div>
</div>