<?php
/*
    $minDelDate = str_replace('-', '/', date('Y-m-d', strtotime('-7 days', strtotime($stmt->ship_date))));
    $delDate = $stmt->ship_date;
    $maxDelDate = $stmt->ship_date.' 23:59:59';
    $minPicDate = $maxDelDate;
    $maxPicDate = str_replace('-', '/', date('Y-m-d', strtotime('+7 days', strtotime($stmt->ship_date))));
*/
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">Pickup</h4>
    </div>
    <div class="panel-body">
        <div class="row-fluid">
            <span class="input-group-prepend"><b> From </b> </span>
            <?php echo isset($stmt->pick_from) ? Yii::app()->dateFormatter->formatDateTime($stmt->pick_from, "medium", "medium") : ''; ?>
            <span class="input-group-prepend"><b> To </b></span>
            <?php echo isset($stmt->pick_to) ? Yii::app()->dateFormatter->formatDateTime($stmt->pick_to, "medium", "medium") : ''; ?>

        </div>
    </div>
</div>