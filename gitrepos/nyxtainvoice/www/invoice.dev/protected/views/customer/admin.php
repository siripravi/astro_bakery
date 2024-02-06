<?php
/* @var $this CustomerController */
/* @var $model Customer */

$this->breadcrumbs = array(
    'Customers' => array('index'),
    'Manage',
);

$this->menu = array(
    array('icon' => 'glyphicon glyphicon-list', 'label' => 'List Customer', 'url' => array('index')),
    array('icon' => 'glyphicon glyphicon-plus-sign', 'label' => 'Create Customer', 'url' => array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#customer-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php //echo BsHtml::pageHeader('Manage','Customers') ?>
<div class="row-fluid">

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Manage Customers

            </h3>
        </div>
        <div class="panel-body">
            <?php
            $this->widget('zii.widgets.jui.CJuiButton', array(
                'buttonType' => 'link',
                'name' => 'btnNewCustGd',
                'caption' => '<i class="fa fa-plus"></i> New Customer',
                'onclick' => new CJavaScriptExpression('function(){
                                                 BootstrapDialog.show({
                                                  title: "Create New Customer",
                                                  type: BootstrapDialog.TYPE_SUCCESS,
                                                message: $("<div></div>").load("/customer/create"),
                                                onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                                buttons: [{
                                                    label: "Cancel",
                                                    action: function(dialogRef){
                                                        dialogRef.close();
                                                    }
                                                }]
                                            });
                                                this.blur(); 
                                                return false;}'),
                'htmlOptions' => array('id' => 'btn-new-customer-grid', 'class' => 'btn btn-success')
            )
            );
            ?>

            <div class="search-form" style="display:none">
                <?php /*$this->renderPartial('_search',array(
           'model'=>$model,
       )); */?>
            </div>
            <!-- search-form -->
            <div class="panel-body table-responsive table-full-width">
                <?php $this->widget('bootstrap.widgets.TbGridView', array(
                    'id' => 'customer-grid',
                    'dataProvider' => $model->search(),
                    'itemsCssClass' => 'table table-hover',
                    'pagerCssClass' => 'pagination pagination-sm no-margin pull-right',
                    // 'itemsCssClass'=>'table table-bordered table-condensed table-hover table-striped dataTable',
                    'filter' => $model,
                    'columns' => array(
                        //'customer_no',
                        array(
                            'name' => 'contact',
                            'header' => 'Customer',
                            'type' => 'raw',
                            'filter' => CHtml::activeTextField(
                                $model,
                                'customer_name',
                                array(
                                    'placeholder' => 'customer name',
                                    'style' => 'width:213px;'
                                )
                            ),
                            //call the method 'renderAddress' from the model
                            'value' => array($model, 'renderContact'),
                        ),
                        array(
                            'name' => 'address',
                            'type' => 'raw',
                            'filter' => false,
                            //call the method 'renderAddress' from the model
                            'value' => array($model, 'renderAddress'),
                        ),

                        //	'first_name',
                        //	'last_name',
                        //	'address1',
                        //	'address2',
                        //	'city',
                        /*
                              'state',
                              'zip',
                              'phone1',
                              'phone2',
                              'email1',
                              'email2',
                              'notes',
                              */
                        array(
                            'class' => 'CButtonColumn',
                            'template' => '<div class="btn-group"><div class="btn btn-sm">{view}</div><div class="btn btn-sm">{update}</div>&nbsp;&nbsp;{delete}</div>',
                            //'template' => '{view}{update}{delete}',
                            'buttons' => array(
                                'delete' => array('visible' => "'" . Yii::app()->user->isAdmin . "'")

                            ),
                            'htmlOptions' => array('class' => '')
                        ),
                    ),
                    'htmlOptions' => array('class' => "table table-hover")
                )
                ); ?>
            </div>
        </div>
    </div>
</div>