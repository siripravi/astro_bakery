<?php
/* @var $this PaymentsController */
/* @var $model Payments */
?>

<?php
$this->breadcrumbs = array(
	'Payments' => array('index'),
	'Create',
);

$this->menu = array(
	array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Payments', 'url' => array('index')),
	array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Payments', 'url' => array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Create', 'Payments') ?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>