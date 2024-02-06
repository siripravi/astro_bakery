<div id="cust-detail-adrs">
    <div class="label label-info" style="color:white;padding: 1.2em 1.6em .3em;"><strong>
            <?php
            $this->widget(
                'editable.EditableField',
                array(
                    'type' => 'select2',
                    'model' => $stmt->statement,
                    'attribute' => 'customer_no',
                    'text' => $stmt->statement->customer->first_name . ' ' . $stmt->statement->customer->last_name,
                    'placement' => 'right',
                    'inputclass' => 'col-lg-4',
                    'success' => 'js: function(data) {
                                        $.fn.yiiListView.update("stmt-list-view");
                                       location.reload();
                                        if(typeof data == "object" && !data.success) return data.msg;
                                    }',
                    'url' => $this->createUrl('statement/chgStmt'),
                    'htmlOptions' => array("style" => "color:white;font-size:21px;", "title" => "click to eidt"),
                    'select2' => new CJavaScriptExpression("{     
   'minimumInputLength':2,
        'placeholder':'Search for customer',
        'allowClear':true,
        'ajax':{'url':'/copyright.json.html',
                    'dataType':'json',
                    'quietMillis':250,
                    'data':function (term, page) {   return { q: term}; },
                    'processResults': function (data, page) {
                    return {
                        results: data
                    }},
                    'results':function (data, page) {
                          return {results: data, id: 'ItemId', text: 'ItemText'};
                          }}}")
                )
            );
            ?>
        </strong></div>
</div>
<div id="cust-adrs-div">
    <?php echo $stmt->statement->customer->showAddress(); ?>
</div>