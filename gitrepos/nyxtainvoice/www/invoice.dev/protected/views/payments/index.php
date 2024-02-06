<?php
/* @var $this PaymentsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs = array(
	'Payments',
);

$this->menu = array(
	array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Payments', 'url' => array('create')),
	array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Payments', 'url' => array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Payments') ?>
<?php $this->widget('bootstrap.widgets.BsListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)
); ?>