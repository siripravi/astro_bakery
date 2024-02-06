<?php
// $cs = Yii::app()->clientScript;
//      $baseUrl = Yii::app()->theme->baseUrl;
//$cs->registerScriptFile($baseUrl . '/js/script.js', CClientScript::POS_END);

$statements = array();
$statements[0] = $stmt;
?>
<?php $this->widget('zii.widgets.CListView', array(
    'id' => "stmt-list-view",
    'dataProvider' => new CArrayDataProvider($statements, array(
        'keyField' => 'st_id',
        // PRIMARY KEY attribute of $list member objects
        'id' => 'foo'
    )
    ),
    'itemView' => '_view',
    'template' => '{items}'
)
);