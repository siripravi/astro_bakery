<div class="col-lg-6 pull-right">
  <a class="btn btn-primary" href="/customer/admin"><i class="pe-7s-back-2"></i> Customer Admin</a>
</div>
<div class="clearfix"></div>
<?php
/* @var $this CustomerController */
/* @var $model Customer */
?>


<?php
$this->widget('bootstrap.widgets.TbTabs', array(
  'tabs' => array(
    array('label' => 'Customer', 'content' => $this->renderPartial('_form', array('model' => $model), TRUE), 'active' => true),
    array('label' => 'Card', 'content' => $this->renderPartial('_ccard', array('cards' => $cards, 'cid' => $model->primaryKey), TRUE)),
    /* array('label' => 'Messages', 'items' => array(
      array('label' => '@fat', 'content' => '...'),
      array('label' => '@mdo', 'content' => '...'),
      )), */
  ),
)
);
?>

<?php //echo BsHtml::pageHeader('Update','Customer '.$model->customer_no) ?>
<?php //$this->renderPartial('_form', array('model'=>$model)); ?>