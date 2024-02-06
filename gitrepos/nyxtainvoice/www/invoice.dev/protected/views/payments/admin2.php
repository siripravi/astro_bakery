<?php $this->renderPartial('_search', array('model' => $model)); ?>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $model->search(),
    'itemView' => '_list',
    // refers to the partial view named '_post'
    'pager' => array('cssFile' => Yii::app()->theme->baseUrl . '/css/rotating-card.css'),
    'cssFile' => Yii::app()->theme->baseUrl . '/css/gridView.css',
    'sortableAttributes' => array(
    ),

)
); ?>