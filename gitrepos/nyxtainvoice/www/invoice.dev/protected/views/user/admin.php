<?php
/* @var $this PaymentsController */
/* @var $model Payments */


$this->breadcrumbs = array(
    'Users' => array('index'),
    'Manage',
);


Yii::app()->clientScript->registerScript('newuser', "
$('.search-button').click(function(){
	$('.user-form').toggle();
	return false;
});

");
?>

<?php //echo BsHtml::pageHeader('Manage','Users') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php echo CHtml::button('Create User', array('class' => 'search-button'), '#'); ?>
        </h3>
    </div>
    <div class="panel-body">

        <div class="user-form" style="display:none">
            <?php $this->renderPartial('_form', array(
                'model' => $model,
            )
            ); ?>
        </div>
        <!-- search-form -->

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'user-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'id',
                'username',
                //'password',
                array(
                    'name' => 'level',
                    'value' => '$data->getLevelList($data->level)',
                ),
                'email',
                'profile',
                array(
                    'class' => 'CButtonColumn',
                ),
            ),
        )
        ); ?>
    </div>
</div>