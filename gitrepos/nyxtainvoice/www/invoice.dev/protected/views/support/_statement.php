<div class="panel panel-success bootcards-richtext">
    <div class="panel-heading col-sm-12">
        <h2 class="text-header">
            <?php echo $header; ?>
            <?php echo $statement->{$key}; ?>
        </h2>
        <h8 class="small"> Created:
            <?php echo $statement->statement->getUserName($statement->cuser_id) . " on " . Yii::app()->dateFormatter->formatDateTime($statement->create_time, "long", "long"); ?>
            &nbsp;&nbsp;
            Last Updated:
            <?php echo $statement->statement->getUserName($statement->uuser_id) . " on " . Yii::app()->dateFormatter->formatDateTime($statement->update_time, "long", "long"); ?>
        </h8>
    </div>
    <div class="panel-body col-sm-12">
        <?php if ($key == 'quotation_id'): ?>
            <?php
            $this->renderPartial('_invTabBasic', array('stmt' => $statement, 'dp' => $dp, 'items' => $statement->items));

            ?>
        <?php endif; ?>
        <?php if ($key == 'invoice_id'): ?>
            <?php
            $this->widget('bootstrap.widgets.TbTabs', array(
                'type' => 'tabs',
                'id' => 'hdr-tabs',
                'tabs' => array(
                    array('label' => $header, 'content' => $this->renderPartial('_invTabBasic', array('stmt' => $statement, 'items' => $statement->items), TRUE), 'active' => true),
                    array('label' => 'Delivery', 'content' => $this->renderPartial('_invTabDelv', array('stmt' => $statement), TRUE)),
                    array('label' => 'Pickup', 'content' => $this->renderPartial('_invTabPick', array('stmt' => $statement), TRUE)),
                    array(
                        'label' => 'Payment',
                        'content' => $this->renderPartial('_invTabPmt', array(
                            'stmt' => $statement,
                            'dp' => new CArrayDataProvider($statement->payments, array('keyField' => 'ID')),
                        ), TRUE)
                    ),
                ),
            )
            );
            ?>
        <?php endif; ?>


    </div><!--list-details-->

</div>