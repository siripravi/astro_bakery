<div id="ven-details-adrs">
    <p class="category"><span class="label white label-warning" id="lbl-evdt" style="color:white;">
            <?php //echo Yii::app()->dateFormatter->formatDateTime($stmt->ship_date, "medium", null);  ?>
            <?= date("F jS, Y", strtotime($stmt->statement->ship_date)); ?>

            <?php //echo date("F jS, Y", strtotime($stmt->ship_date)); ?>
        </span>
    </p>

    <div class="org"><strong>
            <?= $stmt->statement->venue->ship_name; ?>

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