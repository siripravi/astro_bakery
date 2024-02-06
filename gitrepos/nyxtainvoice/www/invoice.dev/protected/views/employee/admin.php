<?php
/* @var $this EmployeeController */
/* @var $model Employee */

$this->breadcrumbs = array(
	'Employees' => array('index'),
	'Manage',
);

$this->menu = array(
	array('label' => 'List Employee', 'url' => array('index')),
	array('label' => 'Create Employee', 'url' => array('create')),
);


?>

<h1>Manage Employees</h1>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'employee-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'empType.designation',
		'title',
		'first_name',
		'last_name',
		'address1',
		'address2',
		'city',
		'state',
		'postal_code',
		'country',
		'phone1',
		'phone2',
		'email',
		'date_created',
		'notes',

		array(
			'class' => 'CButtonColumn',
		),
	),
)
); ?>