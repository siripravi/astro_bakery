<div id="cust-detail-adrs">
    <div class="name">
        <strong>
            <?= $stmt->statement->customer->first_name . ' ' . $stmt->statement->customer->last_name; ?>
        </strong>
    </div>
</div>
<div id="cust-adrs-div">
    <?php echo $stmt->statement->customer->showAddress(); ?>
</div>