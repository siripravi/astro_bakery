<?php
//print_r($data);
//echo $data->customer->showAddress();
$kFld = $data->relModel->{$data->getKeyField()};
//echo CHtml::link($kFld,array('/support/support/index','query'=>$kFld));
$active = ((!empty($_GET['query'])) && ($_GET['query'] == $kFld)) ? " active" : "";
$docUrl = Yii::app()->createAbsoluteUrl("support/index", array("query" => $kFld, "doc_type" => $data->relModel->st_type));
?>
<?php if (!empty($kFld)): ?>

    <div class="list-group">
        <a class="list-group-item <?php echo $active; ?>" href="<?php echo $docUrl; ?>">

            <h4 class="list-group-item-heading">
                <?php echo $data->customer->first_name . ' ' . $data->customer->last_name; ?>
            </h4>

            <div class="row">
                <div class="col-sm-4">
                    <!--<i class="fa fa-3x fa-building-o pull-left"></i>-->
                    <?php echo $data->header2 . ' <br>' . $kFld; ?>
                </div>
                <div class="col-sm-6">
                    <p class="list-group-item-text">
                        <?php echo $data->venue->ship_name; ?>
                    </p>
                    <p class="list-group-item-text">
                        <?php echo date("F jS, Y", strtotime($data->ship_date)); ?>
                    </p>
                    <p class="list-group-item-text">
                        <?php echo Yii::app()->numberFormatter->formatCurrency($data->relModel->itemsTotal, 'USD'); ?>
                    </p>

                </div>
            </div>
        </a>
    </div>
<?php endif; ?>