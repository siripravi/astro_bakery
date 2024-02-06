<?php $formatter = Yii::app()->numberFormatter; ?>

<div class="col-sm-6" style="width:50%;float:left">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="pe-7s-user"></i>Customer</h4>
        </div>
        <div class="panel-body">
            <div id="cust-detail-adrs">
                <strong>
                    <?php echo $stmt->statement->customer->first_name . ' ' . $stmt->statement->customer->last_name; ?>

                </strong>
            </div>
            <div id="cust-adrs-div">
                <?php echo $stmt->statement->customer->showAddress(); ?>
            </div>

            <div class="footer">

            </div>

        </div>
    </div>
</div>
<div class="col-lg-5">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title"><i class="pe-7s-plane"></i>Shipping</h4>
        </div>
        <div class="panel-body">
            <div id="ven-details-adrs">
                <p class="category"><i class="pe-7s-date"></i>
                    <?php //echo Yii::app()->dateFormatter->formatDateTime($stmt->ship_date, "medium", null);  ?>
                    <strong>
                        <?php echo date("F jS, Y", strtotime($stmt->statement->ship_date)); ?>
                    </strong>

                    <?php //echo date("F jS, Y", strtotime($stmt->ship_date)); ?>
                </p>

                <div class="org"><strong>
                        <?php echo $stmt->statement->venue->ship_name; ?>

                    </strong></div>
                <div class="adr">
                    <div class="ven-street-address">
                        <?php echo $stmt->statement->venue->ship_add1; ?>
                    </div>
                    <span class="ven-locality">
                        <?php echo $stmt->statement->venue->ship_add2; ?>
                    </span>
                    <span class="ven-locality2">
                        <?php echo $stmt->statement->venue->SHIP_city; ?>
                    </span>
                    <span class="ven-state-name">
                        <?php echo $stmt->statement->venue->SHIP_state; ?>-
                        <?php echo $stmt->statement->venue->SHIP_zip; ?>
                    </span>
                </div>
                <div class="ven-tel">
                    Phone:
                    <?php echo $stmt->statement->venue->SHIP_phone1; ?>
                </div>
            </div>

            <div class="footer">

                <div class="stats">

                    <!--  <i class="fa fa-circle text-danger"></i> Bounce
<i class="fa fa-circle text-warning"></i> Unsubscribe -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($stmt->primaryKey !== null): ?>
    <div class="col-xs-12 table-responsive">
        <div class="box box-default">
            <div class="box-header h4">Items</div>
            <div class="content table-responsive table-full-width">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Item </th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Amount</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($items as $i => $item): ?>
                            <tr>
                                <td class="srno">
                                    <?php echo $i + 1; ?>
                                </td>
                                <?php
                                //$lines = explode("\n", wordwrap($item->DESCRIPTION, 80, "\n"));
                                $lines = wordwrap($item->DESCRIPTION, 80, "<br />\n");
                                // foreach($lines as $line):
                                ?>
                                <td class="desc">
                                    <?php echo $lines; ?>
                                </td>
                                <?php //endforeach;  ?>
                                <td class="qty">
                                    <?php echo (int) $item->QUANTITY; ?>
                                </td>
                                <td class="unit">
                                    <?php if (!$slip)
                                        echo $formatter->formatCurrency($item->PRICE, 'USD'); ?>
                                </td>
                                <td class="total">
                                    <?php if (!$slip)
                                        echo $formatter->formatCurrency($item->PRICE * $item->QUANTITY, 'USD'); ?>
                                </td>
                            </tr>
                            <tr>
                                <?php
                                $start += 1;
                        endforeach;
                        ?>

                        <tr>
                            <td colspan="4" class="subtotal">GRAND TOTAL</td>
                            <td class="total">
                                <?php echo $formatter->formatCurrency($stmt->itemsTotal, 'USD'); ?>
                            </td>
                        </tr>
                        <?php if ($stmt->st_type == statement::TYPE_INVOICE): ?>
                            <tr>
                                <td colspan="4">PAYMENTS/CREDITS</td>
                                <td class="total">
                                    <?php echo $formatter->formatCurrency($stmt->paymentsTotal, 'USD'); ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">BALANCE DUE</td>
                                <td class="grand">
                                    <?php echo $formatter->formatCurrency($stmt->itemsTotal - $stmt->paymentsTotal, 'USD'); ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                    <!-- end ngRepeat: item in invoice.items -->
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>