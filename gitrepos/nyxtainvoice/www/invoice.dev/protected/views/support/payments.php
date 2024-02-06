<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">Payments</h4>
    </div>
    <div class="panel-body">
        <div class="table table-hover table-striped">
            <?php

            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'payments-grid',
                'itemsCssClass' => 'table table-hover table-striped',
                'dataProvider' => $dp,
                //'filter'=>$model,
                'columns' => array(
                    array(
                        'header' => 'Payed On',
                        'name' => 'PAY_DATE',
                        'htmlOptions' => array('style' => 'text-align: center', 'placeholder' => 'MM-DD-YYYY'),
                        //'value'=>'Yii::app()->dateFormatter->formatDateTime($data -> PAY_DATE,"medium",null)',
                        'value' => 'date("F jS, Y", strtotime($data->PAY_DATE))',
                        //'headerHtmlOptions' => array('style' => 'width:18%; '),
                        'footer' => " Paid: " . Payments::makeMoney($stmt->paymentsTotal),
                    ),
                    /* array(
                         'header' => 'Mode',
                         'type' => 'raw',
                         'value' => array($this, 'getPayMode'),
                         'headerHtmlOptions' => array("style" => "width:3%;")
                     ),*/
                    array(
                        'header' => 'Amount',
                        'name' => 'AMOUNT',
                        'type' => 'raw',
                        'value' => 'Payments::makeMoney($data->AMOUNT)',
                        'footer' => " Total: " . Payments::makeMoney($stmt->itemsTotal)
                        // 'headerHtmlOptions' => array("style"=>"float:right;width:10%")
                    ),

                    array(
                        'header' => 'Details',
                        'name' => 'DETAILS',
                        'footer' => " Due: " . Payments::makeMoney($stmt->itemsTotal - $stmt->paymentsTotal)
                    ),
                    array(
                        'header' => 'Deposited By',
                        'name' => 'DEPOSITED_BY',
                    ),
                    array('header' => 'Posted By', 'type' => 'raw', 'value' => '$data->getUserName($data->cuser_id)', 'filter' => false),
                    array('header' => 'Updated By', 'type' => 'raw', 'value' => '$data->getUserName($data->uuser_id)', 'filter' => false),
                    //array(
                    //	'class'=>'bootstrap.widgets.BsButtonColumn',
                    //),
                ),
                //'htmlOptions' => array('class' => 'jtable')
                // 'htmlOptions' => array('class="jtable table table-hover"')
            )
            );
            ?>

        </div>

    </div>