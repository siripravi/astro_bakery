<?php
/* @var $this PaymentsController */
/* @var $model Payments */
?>

<?php
$this->breadcrumbs = array(
	'Payments' => array('index'),
	$model->ID => array('view', 'id' => $model->ID),
	'Update',
);

$this->menu = array(
	array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Payments', 'url' => array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Payments', 'url' => array('create')),
	array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View Payments', 'url' => array('view', 'id' => $model->ID)),
	array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Payments', 'url' => array('admin')),
);
?>

<?php //echo BsHtml::pageHeader('Update','Payments '.$model->ID) ?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>