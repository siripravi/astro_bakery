<?php
//print_r($model->search()->criteria); 

?>
<div class="card">
    <div class="header">
        <h4 class="title">Manage Quotes </h4>
    </div>
    <div class="content">
        <div class="col-lg- 5 pull-right">
            <?php

            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'type' => 'inline',
                'method' => 'get',
                'id' => 'extended-filters'
            )
            );
            //you can replace the DateField inputs with CJuiDatePicker
//echo $form->dateField($model, 'from_date');
//echo $form->dateField($model, 'to_date');
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'from_date',
                // 'name' => 'Quotation[from_date]',
                // 'language' => 'id',
                'value' => $model->from_date,
                'i18nScriptFile' => 'jquery.ui.datepicker-eng.js',
                // (#2)
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    // 'dateFormat'=>'yy-mm-dd',
                    'dateFormat' => 'mm-dd-yy',
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                    'constrainInput' => 'false',
                ),
                'htmlOptions' => array(
                    'class' => 'form-control',
                )
            )
            );
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'model' => $model,
                'attribute' => 'to_date',
                //'name' => 'Quotation[to_date]',
                // 'language' => 'id',
                'value' => $model->from_date,
                'i18nScriptFile' => 'jquery.ui.datepicker-eng.js',
                // (#2)
                // additional javascript options for the date picker plugin
                'options' => array(
                    'showAnim' => 'fold',
                    // 'dateFormat'=>'yy-mm-dd',
                    'dateFormat' => 'mm-dd-yy',
                    'changeMonth' => 'true',
                    'changeYear' => 'true',
                    'constrainInput' => 'false',
                ),
                'htmlOptions' => array(
                    'class' => 'form-control',
                )
            )
            );
            echo CHtml::submitButton();
            $this->endWidget();
            ?>
        </div>
        <br>
        <div class="panel-body table-responsive table-full-width">
            <?php
            $this->widget('zii.widgets.grid.CGridView', array(
                'id' => 'statement-grid',
                'dataProvider' => $model->search(),
                'itemsCssClass' => 'table table-hover',
                'pagerCssClass' => 'pagination pagination-sm no-margin pull-right',
                //'afterAjaxUpdate'=>'function(slash, care) { $.appendFilter("Quotation[paid]", "paidFilterStatus"); }',
                'afterAjaxUpdate' => "function() {                                   
          //   jQuery('#Quotation_from_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['en'], {'showAnim':'fold','dateFormat':'mm-dd-yy','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
          //   jQuery('#Quotation_to_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['en'], {'showAnim':'fold','dateFormat':'mm-dd-yy','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
    }",
                'filter' => $model,
                'columns' => array(
                    array(
                        'header' => 'SN.',
                        'value' => '++$row',
                    ),
                    array
                    (
                        'class' => 'DateColumn',
                        // 'name'=>'close_date',
                        'from_date' => 'from_date',
                        'to_date' => 'to_date',
                        'name' => 'ship_date',
                        'filterHtmlOptions' => array('readonly' => 'readonly'),

                        //   'type'=>'date',
                        // 'filter' => $dateisOn,
                        // 'headerHtmlOptions' => array('style' => 'width:257px;text-align:center', 'colspan' => 1, 'class' => 'ts-grid-date-range'),
                        //   'value' => 'date_format(date_create($data->statement->ship_date), "j F")',
                        //  'htmlOptions'=>array('style'=>'text-align: center','placeholder'=>'MM-DD-YYYY'),
                        'value' => 'Yii::app()->dateFormatter->formatDateTime($data->statement->ship_date,"medium",null)',
                        // 'headerHtmlOptions' => array('style' => 'width:12%; ',),
                    ),
                    array(
                        'name' => 'quotation_id',
                        'type' => 'raw',
                        'value' => '($data->st_type == Statement::TYPE_QUOTATION)?CHtml::link($data->quotation_id,"/quotation/update/id/".$data->quotation_id,array("target"=>"_blank")):CHtml::link($data->quotation_id,"/invoice/update/id/".$data->statement->invoice->invoice_id,array("target"=>"_blank"))',
                        'htmlOptions' => array("target" => "_blank", "style" => "text-decoration:underline;"),
                        'headerHtmlOptions' => array('style' => 'width:12%; '),
                    ),
                    array(
                        'name' => 'customer_name',
                        'value' => 'ucwords($data->statement->customer->first_name.\' \'.$data->statement->customer->last_name)',
                    ),
                    /* array(
                      'name' =>'CUSTOMER_NO',
                      'value'=>'$data->customer->fullName',
                      'header'=>'Customer',
                      'type'=>'raw',
                      'filter' =>CHtml::listData(Customer::model()->findAll(),'CUSTOMER_NO',function($post) {
                      return CHtml::encode($post->first_name.' '.$post->last_name);

                      }),
                      ), */
                    array(
                        'name' => 'ship_name',
                        'value' => '$data->statement->venue->ship_name',
                        'header' => 'Venue',
                        'type' => 'raw',
                        /* 'filter' =>CHtml::listData(Venue::model()->findAll(),'VENUE_ID',function($post) {
                          return CHtml::encode($post->ship_name);

                          }), */
                    ),
                    array(
                        'header' => 'Amount',
                        'value' => '(isset($data))?Payments::makeMoney($data->itemsTotal):""',
                        'headerHtmlOptions' => array('style' => 'width:6%; '),
                    ),
                    // 'approved',
                    //'id',
                    //'st_type',
                    //'CUSTOMER_NO',
                    //'VENUE_ID',
                    //'SHIP_DATE',
                    /* array
                      (
                      'name'=>'CREATE_DATE',
                      'htmlOptions'=>array('style'=>'text-align: center'),
                      //    'value'=>'date_format(date_create($data->CREATE_DATE), "d-m-Y")',
                      ), */
                    /*
                      'CLOSED',
                      'NOTES',
                     */
                    //  array('name' => 'cuser_id', 'type' => 'raw', 'value' => 'getUserName($data->cuser_id)', 'filter' => false),
                    //  array('name' => 'uuser_id', 'type' => 'raw', 'value' => '$data->getUserName($data->uuser_id)', 'filter' => false),
                    //  array('name' => 'created', 'type' => 'raw', 'value' => 'Yii::app()->dateFormatter->formatDateTime($data -> created,"medium",null)',
                    //      'filter' => CHtml::activeTextField($model, 'created', array('placeholder' => 'mm-dd-yyyy'))),
                    //  array('name' => 'modified', 'type' => 'raw', 'value' => 'Yii::app()->dateFormatter->formatDateTime($data -> created,"medium",null)',
                    //      'filter' => CHtml::activeTextField($model, 'modified', array('placeholder' => 'mm-dd-yyyy'))),
                    array(
                        'class' => 'CButtonColumn',
                        'template' => '{delete}',
                        'buttons' => array(
                            'delete' => array('visible' => "'" . Yii::app()->user->isAdmin . "'")
                        )
                    ),
                ),
                'htmlOptions' => array('class' => 'table table-hover')
            )
            );
            ?>

        </div>
    </div>
</div>
<?php
Yii::app()->clientScript->registerScript('search', "
$('#extended-filters').submit(function(){
    $('#statement-grid').yiiGridView('update', {
        data: $(this).serialize()
    });
    return false;
});
", CClientScript::POS_END);