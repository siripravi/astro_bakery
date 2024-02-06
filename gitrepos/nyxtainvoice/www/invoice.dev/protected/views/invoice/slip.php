<div id="page-wrap">

    <?php if ($print == "inst"): ?>
        <br>
        <br>
        <h4 id="header1" class="text-center" style="float:right">PACKAGE INSTRUCTIONS</h4>
        <br>
        <hr>
        <br>
    <?php else: ?>

        <p id="header">PACKING SLIP</p>
    <?php endif; ?>
    <div id="identity">
        <div id="logo">
            <img id="image" src="/images/prime_logo.jpg" alt="logo">
        </div>
        <div id="address">
            <h2 class="name">Prime Party Rentals</h2>
            <div>28971 Hopkins, St #7, Hayward,CA 94545</div>
            <div>Phone: 5107854555, Fax:5102250175</div>
            <div><a href="mailto:sales@primepartyrentals.com">sales@primepartyrentals.com</a> </div>
        </div>
        <div style="float:right;width:40%">
            <table id="meta">
                <tbody>
                    <tr>
                        <td class="meta-head">Invoice #</td>
                        <td>
                            <p>
                                <?php echo $model->invoice_id; ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="meta-head">Date</td>
                        <td>
                            <p id="date">
                                <?php echo date('F j, Y', strtotime($model->create_time)); ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="meta-head">Event Date</td>
                        <td>
                            <div class="date">
                                <?php echo Yii::app()->dateFormatter->formatDateTime($model->statement->ship_date, 'long', null); ?>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div style="clear:both"></div>


    <?php if ($print !== "inst"): ?>
        <div id="customer">
            <h3 class="name">Customer Details</h3>
            <div id="hcard"><strong>
                    <?php echo $model->statement->customer->first_name . ' ' . $model->statement->customer->last_name; ?>
                </strong>
                <!--<a class="email" href="mailto:<php echo $model->statement->customer->email1;?>"><php echo $model->statement->customer->email1;?></a>-->
                <div class="adr">
                    <div class="street-address">
                        <?php echo $model->statement->customer->address1 . ', ' . $model->statement->customer->address2; ?>
                    </div>
                    <div class="xlocality">
                        <?php echo $model->statement->customer->city; ?>&nbsp;
                        <?php echo $model->statement->customer->state; ?>&nbsp;
                        <?php echo $model->statement->customer->zip; ?>
                    </div>
                </div>
                <div class="tel">
                    <?php echo $model->statement->customer->phone1; ?>,&nbsp;
                    <?php echo $model->statement->customer->phone2; ?>
                </div>
            </div><!-- e: vcard -->
        </div>
        <div id="venue">
            <h3 class="name">Event/Delivery Place</h3>
            <?php if ($model->statement->venue->venue_id == 0): ?>
                <div id="xcustomer-title"><strong>
                        <?php echo $model->statement->customer->first_name . ' ' . $model->statement->customer->last_name; ?>
                    </strong>
                    <!--<a class="email" href="mailto:<php echo $model->statement->customer->email1;?>"><php echo $model->statement->customer->email1;?></a>-->
                    <div class="adr">
                        <div class="street-address">
                            <?php echo $model->statement->customer->address1 . ', ' . $model->statement->customer->address2; ?>
                        </div>
                        <div class="xlocality">
                            <?php echo $model->statement->customer->city; ?>&nbsp;
                            <?php echo $model->statement->customer->state; ?>&nbsp;
                            <?php echo $model->statement->customer->zip; ?>
                        </div>
                    </div>
                    <div class="tel">
                        <?php echo $model->statement->customer->phone1; ?>,&nbsp;
                        <?php echo $model->statement->customer->phone2; ?>
                    </div>
                </div><!-- e: vcard -->

            <?php else: ?>

                <div class="vcard">
                    <div class="xcustomer-title"><strong>
                            <?php echo $model->statement->venue->ship_name; ?>
                        </strong></div>

                    <div class="adr">
                        <div class="street-address">
                            <?php echo $model->statement->venue->ship_add1; ?>,&nbsp;
                            <?php echo $model->statement->venue->ship_add2; ?>
                        </div>
                        <div class="locality">
                            <?php echo $model->statement->venue->ship_city; ?>&nbsp;
                            <?php echo $model->statement->venue->ship_state; ?> &nbsp;
                            <?php echo $model->statement->venue->ship_zip; ?>
                        </div>
                        <span class="tel">
                            <?php echo $model->statement->venue->ship_phone1; ?>,&nbsp;
                            <?php echo $model->statement->venue->ship_phone2; ?>
                        </span>

                    </div>

                </div><!-- e: vcard -->
            <?php endif; ?>

        </div>
        <table id="items">
            <tbody>
                <tr>
                    <th>Sr#</th>
                    <th>Description</th>
                    <th>Quantity</th>
                </tr class="item-row">
                <?php
                $tot = 0.0;

                $items = $model->items;
                ?>

                <?php
                foreach ($items as $i => $item):
                    $class = ($i % 2 == 0) ? "even" : "odd";
                    ?>

                    <tr class="<?php echo $class; ?>">
                        <td class="item-name">
                            <?php echo $i + 1; ?>
                        </td>
                        <td class="description">
                            <?php echo $item->description; ?>
                        </td>
                        <td class="qty">
                            <?php echo $item->quantity; ?>
                        </td>

                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>
    <?php endif; ?>
    <?php if ($print !== "slip"): ?>
        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
            <strong>Packing Instructions</strong><br>
            <?php echo $model->pack_instr; ?>
        </p>
    <?php endif; ?>
</div>