<div id="ven-details-adrs">
    <p class="category"><span class="label white label-success" id="lbl-evdt"
            style="color:white;padding: 1.2em 1.6em .3em;"><i class="pe-7s-date"></i>
            <?php //echo Yii::app()->dateFormatter->formatDateTime($stmt->ship_date, "medium", null);  ?>
            <?php $this->widget(
                'editable.EditableField',
                array(
                    'type' => 'date',
                    'model' => $stmt->statement,
                    'text' => date("F jS, Y", strtotime($stmt->statement->ship_date)),
                    'attribute' => 'ship_date',
                    'inputclass' => 'input-large',

                    'success' => 'js: function(data) {
                                        $.fn.yiiListView.update("stmt-list-view");
                                        location.reload();
                                        if(typeof data == "object" && !data.success) return data.msg;
                                    }',
                    'url' => $this->createUrl('statement/chgStmt'),
                    'htmlOptions' => array("style" => "color:white;font-size:21px;", "title" => "click to eidt")
                )
            );
            ?>
            <?php //echo date("F jS, Y", strtotime($stmt->ship_date)); ?>
        </span>
    </p>

    <div class="org"><strong>
            <?php
            $this->widget('editable.EditableField', array(
                'type' => 'select2',
                'text' => $stmt->statement->venue->ship_name,
                'model' => $stmt->statement,
                'attribute' => 'venue_id',
                'url' => $this->createUrl('statement/chgStmt'),
                'source' => CHtml::listData(Venue::model()->findAll(), 'venue_id', function ($post) {
                    return CHtml::encode($post->ship_name . ' ' . $post->ship_add1);
                }),
                'placement' => 'right',
                'inputclass' => 'input-large',
                'success' => 'js: function(data) {
                                        $.fn.yiiListView.update("stmt-list-view");
                                        location.reload();
                                        if(typeof data == "object" && !data.success) return data.msg;
                                    }',
                'select2' => array(
                    // 'multiple' => true
                )
            )
            ); ?>
        </strong></div>
    <div class="adr">
        <div class="ven-street-address">
            <?php echo $stmt->statement->venue->ship_add1; ?>
        </div>
        <span class="ven-locality">
            <?php echo $stmt->statement->venue->ship_add2; ?>
        </span>
        <span class="ven-locality2">
            <?php echo $stmt->statement->venue->ship_city; ?>
        </span>
        <span class="ven-state-name">
            <?php echo $stmt->statement->venue->ship_state; ?>-
            <?php echo $stmt->statement->venue->ship_zip; ?>
        </span>
    </div>
    <div class="ven-tel">
        Phone:
        <?php echo $stmt->statement->venue->ship_phone1; ?>
    </div>
</div>