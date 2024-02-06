<?php $formatter = Yii::app()->numberFormatter; ?>
<header class="clearfix">
  <div id="hdrl">
    <div id="logo">
      <img src="/images/prime_logo.jpg">
    </div>

    <div id="primeparty">

      <h2 class="name">Prime Party Rentals</h2>
      <div>28971 Hopkins, St #7, Hayward,CA 94545</div>
      <div>Phone: 5107854555, Fax:5102250175</div>
      <div><a href="mailto:info@primepartyrentals.com">info@primepartyrentals.com</a></div>

    </div>
  </div>
  <div id="rtdates">
    <div class='title'>
      <?php echo $relmod->quotation->getHeader2(); ?> &nbsp;<small>
        <?php echo $relmod->quotation->quotation_id; ?>
      </small>
    </div>
    <span class="rtb">Created On:</span>&nbsp;<span>
      <?php echo $created; ?>
    </span><br />
    <span class="rtb">Event Date:</span>&nbsp;<span>
      <?php echo Yii::app()->dateFormatter->formatDateTime($relmod->ship_date, 'long', null); ?>
    </span><br />

  </div>
</header>
<section id="parties">
  <div id="project">
    <h3 class="name">Customer Details</h3>
    <div id="hcard"><strong>
        <?php echo $relmod->customer->first_name . ' ' . $relmod->customer->last_name; ?>
      </strong>
      <!--<a class="email" href="mailto:<php echo $relmod->customer->email1;?>"><php echo $relmod->customer->email1;?></a>-->
      <div class="adr">
        <div class="street-address">
          <?php echo $relmod->customer->address1 . ', ' . $relmod->customer->address2; ?>
        </div>
        <div class="xlocality">
          <?php echo $relmod->customer->city; ?>&nbsp;
          <?php echo $relmod->customer->state; ?>&nbsp;
          <?php echo $relmod->customer->zip; ?>
        </div>
      </div>
      <div class="tel">
        <?php echo $relmod->customer->phone1; ?>,&nbsp;
        <?php echo $relmod->customer->phone2; ?>
      </div>
    </div><!-- e: vcard -->

  </div>

  <div id="company2">


    <h3 class="name">Event/Delivery Place</h3>
    <?php if ($relmod->venue->venue_id == 0): ?>
      <div id="hcard"><strong>
          <?php echo $relmod->customer->first_name . ' ' . $relmod->customer->last_name; ?>
        </strong>
        <!--<a class="email" href="mailto:<php echo $relmod->customer->email1;?>"><php echo $relmod->customer->email1;?></a>-->
        <div class="adr">
          <div class="street-address">
            <?php echo $relmod->customer->address1 . ', ' . $relmod->customer->address2; ?>
          </div>
          <div class="xlocality">
            <?php echo $relmod->customer->city; ?>&nbsp;
            <?php echo $relmod->customer->state; ?>&nbsp;
            <?php echo $relmod->customer->zip; ?>
          </div>
        </div>
        <div class="tel">
          <?php echo $relmod->customer->phone1; ?>,&nbsp;
          <?php echo $relmod->customer->phone2; ?>
        </div>
      </div><!-- e: vcard -->

    <?php else: ?>

      <div class="vcard">
        <div class="org"><strong>
            <?php echo $relmod->venue->ship_name; ?>
          </strong></div>

        <div class="adr">
          <div class="street-address">
            <?php echo $relmod->venue->ship_add1; ?>,&nbsp;
            <?php echo $relmod->venue->ship_add2; ?>
          </div>
          <div class="locality">
            <?php echo $relmod->venue->ship_city; ?>&nbsp;
            <?php echo $relmod->venue->ship_state; ?> &nbsp;
            <?php echo $relmod->venue->ship_zip; ?>
          </div>
          <span class="tel">
            <?php echo $relmod->venue->ship_phone1; ?>,&nbsp;
            <?php echo $relmod->venue->ship_phone2; ?>
          </span>

        </div>
      <?php endif; ?>
    </div><!-- e: vcard -->

  </div>

</section>


<!--  <div class="title"><?php if (!$slip): ?>Invoice<?php else: ?>Packing Slip<?php endif; ?></div> -->

<main>

  <?php //echo date('Y-m-d', strtotime($invoice->statement->CREATE_DATE ));?>

  <table autosize="1">
    <thead>
      <tr>
        <th class="srno">SR#</th>
        <th class="desc">DESCRIPTION</th>
        <th class="price">QTY</th>
        <th class="qty">
          <?php if (!$slip): ?>PRICE
          <?php endif; ?>
        </th>
        <th class="total">
          <?php if (!$slip): ?>TOTAL
          <?php endif; ?>
        </th>
      </tr>

    </thead>
    <tbody>
      <?php foreach ($items as $i => $item): ?>
        <tr>
          <td class="srno">
            <?php echo $start; ?>
          </td>
          <?php //$lines = explode("\n", wordwrap($item->DESCRIPTION, 80, "\n"));
            $lines = wordwrap($item->description, 80, "<br />\n");
            // foreach($lines as $line):
            ?>
          <td class="desc">
            <?php echo $lines; ?>
          </td>
          <?php //endforeach; ?>
          <td class="qty">
            <?php echo (int) $item->quantity; ?>
          </td>
          <td class="unit">
            <?php if (!$slip)
              echo $formatter->formatCurrency($item->price, 'USD'); ?>
          </td>
          <td class="total">
            <?php if (!$slip)
              echo $formatter->formatCurrency($item->price * $item->quantity, 'USD'); ?>
          </td>
        </tr>
        <tr>
          <?php $start += 1; endforeach; ?>
    <tfoot>
      <?php echo $page++; ?>{PAGENO}
      <?php if (!$slip): ?>

        <?php if ($grandtotal): ?>
          <tr>
            <td colspan="4" class="subtotal">GRAND TOTAL</td>
            <td class="total">
              <?php echo $formatter->formatCurrency($grandtotal, 'USD'); ?>
            </td>
          </tr>
          <?php if ($relmod->st_type == 2): ?>
            <tr>
              <td colspan="4">PAYMENTS/CREDITS</td>
              <td class="total">
                <?php echo $formatter->formatCurrency($relmod->paymentsTotal, 'USD'); ?>
              </td>
            </tr>
            <tr>
              <td colspan="4">BALANCE DUE</td>
              <td class="grand">
                <?php echo $formatter->formatCurrency($grandtotal - $relmod->paymentsTotal, 'USD'); ?>
              </td>
            </tr>
          <?php endif; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="grand total">SUB TOTAL</td>
            <td class="grand">
              <?php echo $formatter->formatCurrency($subtotal, 'USD'); ?>
            </td>
          </tr>
        <?php endif; ?>

      <?php endif; ?>
    </tfoot>
    </tbody>
  </table>
  <div id="notices">
    <div>NOTE:</div>
    <div class="notice">
      Prices do no include setup of Chairs, Tables, Linen, China, Silverware unless explicitly specified as a separate
      line item.
      Payment Terms: 50% deposit due on Order Confirmation and the Balance is due 2 weeks prior to the event.
      <!--A finance charge of 1.5% will be made on unpaid balances after 30 days.-->
    </div>
  </div>
</main>
<footer>
  <!-- Invoice was created on a computer and is valid without the signature and seal. -->
</footer>