<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'cards-grid',
    'itemsCssClass' => 'table table-bordered table-condensed table-hover table-striped dataTable',
    'dataProvider' => $dp,
    //'filter'=>$model,
    'columns' => array(
        array(
            'header' => 'Type',
            'type' => 'raw',
            'value' => '$data->type->card_type',
            'headerHtmlOptions' => array("style" => "width:3%;")
        ),
        array(
            'header' => 'Card#',
            'type' => 'raw',
            'value' => '$data->card_number',
            'headerHtmlOptions' => array("style" => "width:16%;")
        ),
        array(
            'header' => 'Name',
            'type' => 'raw',
            'value' => '$data->card_name',
            'headerHtmlOptions' => array("style" => "width:20%;")
        ),
        array(
            'header' => 'CVV',
            'type' => 'raw',
            'value' => '$data->card_csc',
            'headerHtmlOptions' => array("style" => "width:4%;")
        ),
        array(
            'header' => 'Validity',
            'type' => 'raw',
            'value' => '$data->card_expiry_mn."/".$data->card_expiry_yr',
            'headerHtmlOptions' => array("style" => "width:8%;")
        ),
    ),
    //'htmlOptions' => array('class' => 'jtable')
    'htmlOptions' => array('class="jtable table table-hover"')
)
); ?>