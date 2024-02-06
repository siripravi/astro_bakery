<?php
if (Yii::app()->request->isAjaxRequest) {
  //  $cs = Yii::app()->clientScript;
  //  $cs->scriptMap['jquery.js'] = false;
  //  $cs->scriptMap['jquery.min.js'] = false;
}
?>
<?php $this->renderPartial('_search', array('search' => $search), false, true); ?>

<?php
//echo CDateTimeParser::parse('01-06-2016', 'MM-dd-yy');
/* @var $this SearchFormController */
/* @var $model SearchForm */
/* @var $form CActiveForm */
?>

<div class="row-fluid">
  <div class="card">
    <div clss="header">
      <h4 class="title">Invoice Search Results</h4>
    </div>
    <div class="content">
      <div class="panel-body table-responsive table-full-width">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
          'id' => 'statement-grid',
          'dataProvider' => $dp,
          'filter' => false,
          'itemsCssClass' => 'table table-hover',
          'pagerCssClass' => 'pagination pagination-sm no-margin pull-right',
          //   'template' => '{items}{summary}',
          //  'ajaxUpdate' => false,
          //'afterAjaxUpdate'=>'function(slash, care) { $.appendFilter("Invoice[is_paid]", "paidFilterStatus"); }',
          'afterAjaxUpdate' => "function() {                                   
                                           jQuery('#SearchForm_from_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['en'], {'showAnim':'fold','dateFormat':'mm-dd-yy','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
                                           jQuery('#SearchForm_to_date').datepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['en'], {'showAnim':'fold','dateFormat':'mm-dd-yy','changeMonth':'true','showButtonPanel':'true','changeYear':'true','constrainInput':'false'}));
                            }",
          'filter' => $model,
          'columns' => array(
            array(
              'header' => 'SN',
              'value' => '++$row',
            ),
            array(
              'name' => 'invoice_id',
              'header' => 'Invoice#',
              'type' => 'raw',
              'filter' => false,
              'value' => '(isset($data))? CHtml::link($data->invoice_id,"/invoice/update/id/".$data->invoice_id,array("target"=>"_blank")):""',
              'htmlOptions' => array("style" => "text-decoration:underline;"),
              // 'headerHtmlOptions' => array('style' => 'width:4%;'),
              //  'filterHtmlOptions' => array('id' => 'filter_id','placeholder'=>'Invoice number', 'style' => 'width:5%; '),
            ),
            array(
              'name' => 'is_paid',
              'header' => '',
              'type' => 'raw',
              'value' => array($this, 'getPaid'),
              //  'filter' => array("0" => "Unpaid", '1' => 'Paid'),
              'filter' => false,
              // 'htmlOptions' => array("style" => "text-decoration:underline;"),
              // 'filterHtmlOptions' => array('style' => 'width:24px; display:none'),
              // 'headerHtmlOptions' => array("style" => "width:24px;")
            ),
            array(
              'name' => 'ship_date',
              // 'filter' => $evFilter,
              'filter' => false,
              //'filter'=>CHtml::activeTextField($model, 'ship_date',  array('placeholder'=>'mm-dd-yyyy')),
              // 'htmlOptions' => array('style' => 'text-align: center', 'placeholder' => 'YYY-MM-DD'),
              'value' => 'Yii::app()->dateFormatter->formatDateTime($data->statement-> ship_date,"medium",null)',
              //----  'filterHtmlOptions'=>array('style'=>'width:12%; display:none'),
              //  'filterHtmlOptions' => array('style' => 'width:12%;display:none'),
              //  'headerHtmlOptions' => array('style' => 'width:12%; '),
            ),
            array(
              'name' => 'customer_name',
              'type' => 'raw',
              'filter' => false,
              'value' => 'ucwords($data->statement->customer->first_name.\' \'.$data->statement->customer->last_name)',
              // 'headerHtmlOptions' => array('style' => 'width:12%; '),
              // 'filterHtmlOptions' => array('style' => 'width:0%; display:none'),
            ),
            /* array(
              'name' =>'customer_no',
              'value'=>'$data->customer->fullName',
              'header'=>'Customer',
              'type'=>'raw',
              'filter' =>CHtml::listData(Customer::model()->findAll(),'customer_no',function($post) {
              return CHtml::encode($post->first_name.' '.$post->last_name);

              }),
              ),
             */
            array(
              'name' => 'ship_name',
              'value' => '$data->statement->venue->ship_name',
              'filter' => false,
              'header' => 'Venue',
              'type' => 'raw',
              // 'filterHtmlOptions' => array('style' => 'width:0%; display:none'),
              /* 'filter' =>CHtml::listData(Venue::model()->findAll(),'venue_id',function($post) {
                return CHtml::encode($post->ship_name);

                }), */
            ),
            array(
              'header' => 'Amount',
              'value' => '(isset($data))?Payments::makeMoney($data->itemsTotal):""',
              'headerHtmlOptions' => array('style' => 'width:6%; '),
              'filterHtmlOptions' => array('style' => 'width:0%; display:none'),
            ),
            array(
              'header' => 'Paid',
              'value' => '(isset($data))?Payments::makeMoney($data->paymentsTotal):""',
              'headerHtmlOptions' => array('style' => 'width:6%; '),
              'filterHtmlOptions' => array('style' => 'width:0%; display:none'),
            ),
            array(
              'header' => 'Due',
              'value' => '(isset($data))?Payments::makeMoney($data->balance):""',
              'headerHtmlOptions' => array('style' => 'width:6%; '),
              'filterHtmlOptions' => array('style' => 'width:0%; display:none'),
            ),

            //'id',
            //'st_type',
            //'customer_no',
            //'venue_id',
            //'ship_date',
            /*   array(
              'name' => 'CREATE_DATE',
              'htmlOptions' => array('style' => 'text-align: center'),
              'filterHtmlOptions'=>array('style'=>'width:0%; display:none'),
              //    'value'=>'date_format(date_create($data->CREATE_DATE), "d-m-Y")',
              ), */
            /*
              'closed',
              'notes',
             */
            array(
              'name' => 'cuser_id',
              'header' => 'created by',
              'type' => 'raw',
              'value' => '$data->statement->getUserName($data->cuser_id)',
              'filter' => false,
              'filterHtmlOptions' => array('style' => 'width:0%; display:none')
            ),

            array(
              'name' => 'created',
              'type' => 'raw',
              'value' => 'Yii::app()->dateFormatter->formatDateTime($data->create_time,"long",null)',
              'filter' => false,
              /*CHtml::activeTextField(
   $model, 'created', array(
'placeholder' => 'mm-dd-yyyy', 'style' => 'width:123px;'
   )*/

              // 'filterHtmlOptions' => array('style' => 'width:0%; display:none'),
            ),
            array(
              'name' => 'uuser_id',
              'header' => 'updated by',
              'type' => 'raw',
              'value' => '$data->statement->getUserName($data->uuser_id)',
              'filter' => false,
              'filterHtmlOptions' => array('style' => 'width:0%; display:none')
            ),
            /*  array(
              'name' => 'modified',
              'type' => 'raw',
              'value' => 'Yii::app()->dateFormatter->formatDateTime($data -> create_date,"medium",null)',
              'filter' => CHtml::activeTextField($model, 'modified', array('placeholder' => 'mm-dd-yyyy'))
              ), */
            array(
              'class' => 'CButtonColumn',
              'template' => '{delete}',
              'buttons' => array(
                'delete' => array('visible' => "'" . Yii::app()->user->isAdmin . "'")
              )
            ),
          ),
          //  'deleteConfirmation'=>'Está seguro que desea terminar la sesión seleccionada?',
          //  'deleteButtonUrl'=>'$this->grid->owner->createUrl("productSession/delete", $data->primaryKey)'
        

          //   'htmlOptions' => array('class' => "table table-hover")
        
          'htmlOptions' => array('class' => 'table table-hover')
        ));
        ?>
      </div>
    </div>
  </div>
</div>
<?php
Yii::app()->clientScript->registerScript(
  'pay-status', "$('.btn-paid').click( 
        function(){
        if ($(this).is(':checked')) {
        alert( $(this).val());
          $.fn.yiiGridView.update('statement-grid','Invoice[is_paid]',$(this).val());
          }
        });",

  CClientScript::POS_END
);

?>
<?php
Yii::app()->clientScript->registerScript('daterange', "$('#event-dt-range').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1,'days'), moment().subtract(1,'days')],
                    'Next 7 Days': [moment().add(1,'days'), moment().add(6,'days')],
                    'Next 30 Days': [moment(), moment().add(29,'days')],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Next Month': [moment().add(1,'month').startOf('month'), moment().add(1,'month').endOf('month')],
                    'This Year': [moment(), moment().endOf('year')],
                    'Next Year': [moment(), moment().add(1,'year').endOf('year')],
                  },
                  startDate: moment().add(1,'days'),
                  endDate: moment().add(1,'month').endOf('month')
                },
        function (start, end, label) {            
            $('event-dt-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            $('#SearchForm_from_date').val(start.format('YYYY-MM-DD'));
                  $('#SearchForm_to_date').val(end.format('YYYY-MM-DD'));
            $('#statement-grid').yiiGridView('update');  
        }
        );
        $('#event-dt-range').on('hide.daterangepicker', function(ev, picker) { 
           
                  $('#SearchForm_from_date').val(picker.startDate.format('YYYY-MM-DD'));
                  $('#from_dt').html(picker.startDate.format('YYYY-MM-DD'));
                  $('#SearchForm_to_date').val(picker.endDate.format('YYYY-MM-DD'));
                  $('#to_dt').html(picker.endDate.format('YYYY-MM-DD'));
                  
                  $('#filter_id').find('input').val('');
               
                  $('#ev-dt-filter-div').show();
                  
                  $('#search-form-search-form').submit();
                 //  $('#statement-grid').yiiGridView('update');
                  
        });", CClientScript::POS_END);