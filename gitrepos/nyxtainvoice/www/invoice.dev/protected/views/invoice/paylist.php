<a class="list-group-item" href="#">
    <div class="row">
        <div class="col-sm-6">

            <h4 class="list-group-item-heading">
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'text',
                    'model' => $data,
                    'attribute' => 'AMOUNT',
                    'value' => Payments::makeMoney($data->AMOUNT),
                    'url' => $this->createUrl('payments/updatePmt'),
                    'placement' => 'right',
                    'liveTarget' => $widget->id, //for live update
                )
                );
                ?>$
            </h4>
            <p class="list-group-item-text">
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'text',
                    'model' => $data,
                    'attribute' => 'DEPOSITED_BY',
                    'value' => Payments::makeMoney($data->AMOUNT),
                    'url' => $this->createUrl('payments/updatePmt'),
                    'placement' => 'right',
                    'liveTarget' => $widget->id, //for live update
                )
                );
                ?>
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'date',
                    'model' => $data,
                    'attribute' => 'PAY_DATE',
                    'url' => $this->createUrl('payments/updatePmt'),
                    'placement' => 'right',
                    'format' => 'yyyy-mm-dd',
                    //format in which date is expected from model and submitted to server
                    'viewformat' => 'dd/mm/yyyy', //format in which date is displayed
                )
                );
                ?>
            </p>


            <p class="list-group-item-text">
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'select',
                    'model' => $data,
                    'attribute' => 'MODE_ID',
                    'value' => array($this, 'getPayMode'),
                    'url' => $this->createUrl('payments/updatePmt'),
                    'source' => CHtml::listData(Mode::model()->findAll(), 'MODE_ID', function ($post) {
                        return CHtml::encode($post->mode_description);
                    }),
                    'placement' => 'right',
                    'liveTarget' => $widget->id, //for live update
                )
                );

                ?>
            </p>
            <p class="list-group-item-text">
                <?php
                $this->widget('editable.EditableField', array(
                    'type' => 'textarea',
                    'model' => $data,
                    'attribute' => 'DETAILS',
                    'url' => $this->createUrl('payments/updatePmt'),
                    'placement' => 'right',
                    'showbuttons' => 'bottom',
                )
                );
                ?>
                <i class="fa fa-clock-o"></i> Entered by <strong>
                    <?php echo $data->getUserName($data->uuser_id); ?>
                </strong> on
                <?php echo date('j M G:i A', strtotime($data->created)); ?>
            </p>
        </div>
    </div>

</a>