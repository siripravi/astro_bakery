<div class="row-fluid col-lg-12 col-md-12" style="">
    <div class="col-lg-5" style="width:50%;float:left">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">Customer</h4>
            </div>
            <div class="panel-body">
                <?php
                echo CHtml::link('<i class="fa fa-credit-card"></i>', '', array(
                    "ajax" => array(
                        'beforeSend' => 'function(){
                                               BootstrapDialog.show({
                                               title : "Customer Card Info",
                                               message: $("<div></div>").load("/customer/cards/id/' . $data->statement->customer->customer_no . '.html")
                                            });
                                               }'
                    ),
                    'class' => 'btn btn-primary btn-sm pull-right'
                )
                );
                ?>
                <?php $this->renderPartial('_custForm', array('stmt' => $data)); ?>
                <div class="footer">
                    <div class="stats">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">Shipping</h4>
            </div>
            <div class="panel-body">
                <?php $this->renderPartial('_shipForm', array('stmt' => $data)); ?>
                <div class="footer">
                    <div class="stats">
                        <!--  <i class="fa fa-circle text-danger"></i> Bounce
                        <i class="fa fa-circle text-warning"></i> Unsubscribe -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>