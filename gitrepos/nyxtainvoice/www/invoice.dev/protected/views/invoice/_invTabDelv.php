<?php if ($stmt->st_type == statement::TYPE_INVOICE): ?>
    <div class="invoice-col">
        <?php $this->renderPartial('_delvForm', array('stmt' => $stmt)); ?>
        <br>
        <?php //$this->renderPartial('invoice/_pickForm', array('stmt' => $stmt)); ?>
    </div>
<?php endif; ?>