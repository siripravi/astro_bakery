<div class="panel panel-info">
    <div class="panel-heading">
        <h4 class="panel-title">Delivery</h4>
    </div>
    <div class="panel-body">
        <div class="row-fluid" id="delv-datepicker">
            <span class="input-group-prepend"><b> From </b> </span>
            <?php echo isset($stmt->delv_from) ? Yii::app()->dateFormatter->formatDateTime($stmt->delv_from, "medium", "medium") : ''; ?>

            <span class="input-group-prepend"><b> To </b> </span>
            <?php echo isset($stmt->delv_from) ? Yii::app()->dateFormatter->formatDateTime($stmt->delv_to, "medium", "medium") : ''; ?>


            <h4><i class="icon icon-truck"></i>Packing Instructions</h4>

            <?php isset($stmt->pack_instr) ? $stmt->pack_instr : ''; ?>

        </div>
    </div>
</div>