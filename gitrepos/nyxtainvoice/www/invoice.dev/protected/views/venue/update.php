<?php
/* @var $this VenueController */
/* @var $model Venue */
?>
<div class="col-lg-6">
	<a class="btn btn-primary" href="/venue/admin"><i class="pe-7s-back-2"></i> Back</a>
</div>
<?php
$this->breadcrumbs = array(
	'Venues' => array('index'),
	$model->venue_id => array('view', 'id' => $model->venue_id),
	'Update',
);

$this->menu = array(
	array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Venue', 'url' => array('index')),
	array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Venue', 'url' => array('create')),
	array('icon' => 'glyphicon glyphicon-list-alt', 'label' => 'View Venue', 'url' => array('view', 'id' => $model->venue_id)),
	array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Venue', 'url' => array('admin')),
);
?>

<?php //echo BsHtml::pageHeader('Update','Venue '.$model->venue_id) ?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>