<?php
/* @var $this VenueController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs = array(
	'Venues',
);

$this->menu = array(
	array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Venue', 'url' => array('create')),
	array('icon' => 'glyphicon glyphicon-tasks', 'label' => 'Manage Venue', 'url' => array('admin')),
);
?>

<?php echo BsHtml::pageHeader('Venues') ?>
<?php $this->widget('bootstrap.widgets.BsListView', array(
	'dataProvider' => $dataProvider,
	'itemView' => '_view',
)
); ?>