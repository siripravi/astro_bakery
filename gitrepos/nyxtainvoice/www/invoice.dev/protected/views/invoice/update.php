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

<?php //$this->renderPartial('invoice/_hdrOps', array('stmt' => $stmt)); ?>
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