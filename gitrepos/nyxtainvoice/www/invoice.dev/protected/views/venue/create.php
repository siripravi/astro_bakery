<?php
/* @var $this VenueController */
/* @var $model Venue */
?>

<?php
$this->breadcrumbs = array(
	'Venues' => array('index'),
	'Create',
);

$this->menu = array(
	array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Venue', 'url' => array('index')),
	array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Venue', 'url' => array('admin')),
);
?>

<?php //echo BsHtml::pageHeader('Create','Venue') ?>

<?php $this->renderPartial('_form', array('model' => $model)); ?>