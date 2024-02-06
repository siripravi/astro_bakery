<?php
Yii::import('application.controllers.statementController');
Yii::app()->clientScript->registerScript(
    'initRefresh',
    <<<JS
    $('#update-grid-button').on('click',function(e) {
        e.preventDefault();
        $('#inv-pmt-grid').yiiGridView('update');
    });
JS
    , CClientScript::POS_READY
);
?>
<div class="card">
    <div class="header" <h4>Payments <small>Administration</small></h4>
    </div>
    <div class="content">
        <div class="table table-condensed table-full-width">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'inv-pmt-grid',
                'dataProvider' => $model->search(),
                'itemsCssClass' => 'table table-hover',
                'htmlOptions' => array('class' => 'grid-view rounded'),
                'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/gridView.css'),
                'cssFile' => Yii::app()->theme->baseUrl . '/css/gridView.css',

                'filter' => $model,
                'afterAjaxUpdate' => "function() {
            jQuery('#Payments_pay_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['en'], {'showAnim':'fold','dateFormat':'mm-dd-yy','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
         }",
                'columns' => array(
                    array
                    (
                        'header' => 'Payed On',
                        'name' => 'pay_date',
                        'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            // 'model'=>$model,
                            'name' => 'Payments[pay_date]',
                            // 'language' => 'id',
                            'value' => $model->pay_date,
                            'options' => array(
                                'showAnim' => 'fold',
                                'dateFormat' => 'mm-dd-yy',
                                'changeMonth' => 'true',
                                'changeYear' => 'true',
                                'constrainInput' => 'false',
                            ),
                            'htmlOptions' => array(
                                'style' => 'height:20px;width:80px',
                            )
                        ), true),
                        'htmlOptions' => array('style' => 'text-align: center', 'placeholder' => 'MM-DD-YYYY'),
                        //'value'=>'Yii::app()->dateFormatter->formatDateTime($data -> pay_date,"medium",null)',
                        'headerHtmlOptions' => array('style' => 'width:12%; '),
                    ),
                    array(
                        'header' => 'Mode',
                        'name' => 'mode_id',
                        'type' => 'raw',
                        'value' => array($this, 'getPayMode'),
                        'filter' => CHtml::listData(
                            Mode::model()->findAll(),
                            'mode_id',
                            function ($post) {
                                return CHtml::encode($post->mode_description);
                            }
                        )
                    ),
                    array(
                        'header' => 'amount',
                        'name' => 'amount',
                        'type' => 'raw',
                        'value' => 'Payments::makeMoney($data->amount)',
                        'footer' => "<strong>Total: </strong>" . Payments::makeMoney($model->fetchTotal($model->search()->getData())),
                    ),
                    array(
                        'header' => 'Invoice#',
                        'name' => 'invoice_id',
                        'type' => 'raw',
                        //'value' => '$data->invoice->invoice_id',
                        'value' => '(isset($data))? CHtml::link($data->invoice->invoice_id,"/invoice/update/id/".$data->invoice->invoice_id,array("target"=>"_blank")):""',

                        //  'value' => '(isset($data->invoice))? CHtml::link($data->invoice->invoice_id,"/statement/update/id/".(isset($data->statement->id))?$data->statement->id:""):""'
                    ),
                    //'INVOICE_ID',
            


                    /* array(
                      'header' => 'Details',
                      'name' => 'details',

                      ), */

                    /* 	array(
                      'header' => 'Deposited By',
                      'name' => 'deposited_by',

                      ),
                     */
                    /*
                      'deposited_by',
                     */

                    array(
                        'class' => 'CButtonColumn',
                        'template' => '{view}',
                        'buttons' => array(
                            'view' =>
                            array(
                                'url' => 'Yii::app()->createUrl("payments/view", array("id"=>$data->ID,"asDialog"=>1))',
                                'options' => array(
                                    //   "class"=>"btn btn-success",
                                    'ajax' => array(
                                        'type' => 'POST',
                                        // ajax post will use 'url' specified above 
                                        'url' => "js:$(this).attr('href')",
                                        'update' => '#id_view',
                                    ),
                                ),
                            ),
                            'delete' => array(
                                'visible' => function ($row, $data) {
                                    return Yii::app()->user->isAdmin;
                                },
                                //    'options'=> array("class"=>"btn btn-danger"),
                            ),
                        ),
                    ),
                ),


            )
            );
            ?>

        </div>
    </div>

</div>

<div id="id_view"></div>