<?php $pageSize = $widget->dataProvider->getPagination()->pageSize; ?>

<?php if ($index == 0)
    echo '<div class="row">'; ?>
<div class="col-md-3 col-sm-3">
    <div class="card-container" style="height:212px;">
        <div class="card">
            <div class="front" style="height:212px;">
                <div class="header center-block has-success" style="height:36px;">
                    <h6 class="label label-default">
                        <?php echo date("F j, Y ", strtotime($data->pay_date)); ?>
                    </h6>
                </div>
                <div class="footer">
                    <div class="text-header typo-line">
                        <?php
                        echo CHtml::link($data->invoice->invoice_id, "/invoice/update/id/" . $data->invoice->invoice_id, array("target" => "_blank")); ?>
                    </div>
                    <h5 class="text-primary">
                        <?php echo Payments::makeMoney($data->amount); ?>
                    </h5>
                    <hr>
                    <h6>
                        <?php echo $data->mode->mode_description; ?>
                    </h6>
                    <hr>
                    <p class="small">
                        <?php echo Yii::app()->dateFormatter->formatDateTime($data->created, "medium", "medium"); ?>
                        by
                        <?php echo $data->getUserName($data->cuser_id); ?>
                    </p>
                </div>
            </div>

            <div class="back well" style="height:212px;">
                <?php $this->widget('zii.widgets.CDetailView', array(
                    'htmlOptions' => array(
                        'class' => 'table table-striped table-condensed table-hover',
                    ),
                    'data' => $data,
                    'attributes' => array(
                        //'ID',
                        array(
                            //'header' => 'Invoice#',
                            'name' => 'invoice_id',
                            'type' => 'raw',
                            //'value' => '$data->invoice->invoice_id',
                            'value' => CHtml::link($data->invoice->invoice_id, "/invoice/update/id/" . $data->invoice->invoice_id, array("target" => "_blank")),

                            //  'value' => '(isset($data->invoice))? CHtml::link($data->invoice->invoice_id,"/statement/update/id/".(isset($data->statement->id))?$data->statement->id:""):""'
                        ),
                        /* array(
                                           'label'  => 'Mode',
                                           'type' => 'raw',
                                           'value' => $this->getPayMode($data),
                               ),*/
                        /* array(
                                  'label' => 'Paid',		  
                                  'type' => 'raw',
                                  'value' => Payments::makeMoney($data->amount),
                                 
                              ),	
                              'pay_date',*/
                        'deposited_by',
                        'details',

                        //array( 'label' =>'User','type'=>'raw','value'=>$data->getUserName($data->cuser_id),'filter'=>''),
                        //array( 'label' =>'Updated User','type'=>'raw','value'=>$data->getUserName($model->uuser_id))
                    ),
                )
                ); ?>

            </div>
        </div>
    </div>
</div>

<?php if ($index != 0 && $index != $pageSize && ($index + 1) % 4 == 0)
    echo '</div><div class="row">'; ?>

<?php if (($index + 1) == $pageSize)
    echo '</div>'; ?>