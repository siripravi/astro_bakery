<?php if ($stmt->st_type == statement::TYPE_INVOICE): ?>
    <div class="invoice-col">
        <?php if (substr($stmt->delv_from, 0, 1) !== "0"): ?>
            <?php $this->renderPartial('_pickForm', array('stmt' => $stmt)); ?>
        <?php else: ?>
            <?php echo "No Data"; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>