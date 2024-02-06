<?php
/* @var $this VenueController */
/* @var $model Venue */


$this->breadcrumbs = array(
    'Venues' => array('index'),
    'Manage',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Venue', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Venue', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#venue-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php //echo BsHtml::pageHeader('Manage','Venues') ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3>Manage Venues </h3>

    </div>
    <div class="panel-body">
        <?php
        $this->widget('zii.widgets.jui.CJuiButton', array(
            'buttonType' => 'link',
            'name' => 'btnNewVenue2',
            'caption' => '<i class="fa fa-plus"></i> New Venue',
            'onclick' => new CJavaScriptExpression('function(){
                                                 BootstrapDialog.show({
                                                  title: "Create New Venue",
                                                  type: BootstrapDialog.TYPE_SUCCESS,
                                                message: $("<div></div>").load("/venue/create"),
                                                onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                               /* buttons: [{
                                                    label: "Cancel",
                                                    action: function(dialogRef){
                                                        dialogRef.close();
                                                    }
                                                }]*/
                                            });
                                                this.blur(); 
                                                return false;}'),
            'htmlOptions' => array('id' => 'btn-new-venue2', 'class' => 'btn btn-flat btn-success')
        )
        );
        ?>


        <div class="search-form" style="display:none">
            <?php /*$this->renderPartial('_search',array(
           'model'=>$model,
       )); */?>
        </div>
        <!-- search-form -->

        <?php $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'venue-grid',
            'dataProvider' => $model->search(),
            'itemsCssClass' => 'table table-bordered table-condensed table-hover table-striped dataTable',
            'filter' => $model,
            'columns' => array(
                array(
                    'name' => 'venue_id',
                    'header' => 'ID#',
                    'headerHtmlOptions' => array('style' => 'width:36px;font-weight:300;text-align:center',
                    )
                    //'filter' => CHtml::dropDownList('EmpTsFinal[username]', $model->username, $model->userList(),array('empty'=>'--select a user---'))
                ),

                array(
                    'name' => 'ship_name',
                    'header' => 'Title',
                    'headerHtmlOptions' => array('style' => 'width:146px;font-weight:300;text-align:center',
                    )
                    //'filter' => CHtml::dropDownList('EmpTsFinal[username]', $model->username, $model->userList(),array('empty'=>'--select a user---'))
                ),
                array(
                    'name' => 'ship_adrs',
                    'header' => 'Address',
                    'type' => 'raw',
                    'filter' => false,
                    'value' => 'CHtml::link($data->ship_add1.",\n".$data->ship_add2, "")',

                    'headerHtmlOptions' => array('style' => 'width:86px;font-weight:300;text-align:center',
                    )
                    //'filter' => CHtml::dropDownList('EmpTsFinal[username]', $model->username, $model->userList(),array('empty'=>'--select a user---'))
                ),
                array(
                    'name' => 'ship_city',
                    'header' => 'city',
                    'headerHtmlOptions' => array('style' => 'width:86px;font-weight:300;text-align:center',
                    )
                    //'filter' => CHtml::dropDownList('EmpTsFinal[username]', $model->username, $model->userList(),array('empty'=>'--select a user---'))
                ),
                array(
                    'name' => 'ship_state',
                    'header' => 'state',
                    'headerHtmlOptions' => array('style' => 'width:46px;font-weight:300;text-align:center',
                    )
                    //'filter' => CHtml::dropDownList('EmpTsFinal[username]', $model->username, $model->userList(),array('empty'=>'--select a user---'))
                ),
                /*
                      'SHIP_zip',
                      'SHIP_phone1',
                      'SHIP_phone2',
                      'SHIP_email1',
                      'SHIP_DETAILS',
                      */
                array(
                    'class' => 'CButtonColumn',
                ),
            ),
        )
        ); ?>
    </div>
</div>