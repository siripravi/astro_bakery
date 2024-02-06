<?php
/* 	   $id = !empty($_GET['id'])? $_GET['id']:"";
  $this->widget('application.components.widgets.editable.InvWidget',
  array('pk' => $id));
 * 
 */
?>
<?php
/*$minDelDate = str_replace('-', '/', date('Y-m-d', strtotime('-7 days', strtotime($stmt->ship_date))));
$delDate = $stmt->ship_date;
$maxDelDate = str_replace('-', '/', date('Y-m-d', strtotime('1 days', strtotime($stmt->ship_date)))); //.' 23:59:59';
$minPicDate = $maxDelDate;
$maxPicDate = str_replace('-', '/', date('Y-m-d', strtotime('+7 days', strtotime($stmt->ship_date))));
$assDir = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets');*/
?>

<?php
Yii::import('application.controllers.InvoiceController');
?>
<?php //$this->renderPartial('invoice/_hdrOps', array('stmt' => $stmt)); ?>
<hr>
<div class="row">

  <?php
  /*  $this->widget('bootstrap.widgets.TbTabs', array(
    //'type' => 'pills',
    'tabs' => array(
    array('label' => $stmt->getHeader2() . " " . $stmt->getRelModel()->{$stmt->getKeyField()}, 'content' => $this->renderPartial('invoice/_invTabBasic', array('stmt' => $stmt,'dp'=>$dp), TRUE), 'active' => true),
    array('label' => 'Delivery', 'content' => $this->renderPartial('invoice/_invTabDelv', array('stmt' => $stmt), TRUE)),
    array('label' => 'Pickup', 'content' => $this->renderPartial('invoice/_invTabPick', array('stmt' => $stmt), TRUE)),
    ),
    )); */
  ?>


  <?php if ($stmt->primaryKey !== null): ?>

    <?php
    $id = $stmt->primaryKey;
    $this->widget('application.components.widgets.invoice.InvWidget', array('pk' => $id));
    ?>

    <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
      <strong>NOTE</strong><br>
      Prices do not include setup of Chairs, Tables, Linen, China, Silverware unless explicitly specified as a separate
      line item.<br>
      <b>Payment Terms:</b> 50% deposite due on Order Confirmation and the Balance is due to 2 weeks prior to the event.
    </p>

  <?php endif; ?>
</div>

<?php //$this->renderPartial('invoice/_invRightSide', array('stmt' => $stmt, 'dueDate' => $this->calcDueDate($stmt->created, $stmt->ship_date))); ?>