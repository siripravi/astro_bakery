<?php
/*foreach ($results as $row){ 
switch($row->st_type){
    case statement::TYPE_INVOICE:
        $rKey = "invoice_id";  break;
    case statement::TYPE_QUOTATION:
        $rKey = "quotation_id"; break;

}
    echo '<a class="" href="#">';
    echo '<img src="img/Joseph Barish.jpg" class="img-rounded pull-left">';
 //   echo '<h4 class="list-group-item-heading">'.$row->{$rKey}.'</h4>';
    echo '<p class="list-group-item-text">'.$row->customer->showAddress().'</p>';
    echo '</a>';
 
}*/
//print_r($results->criteria);
$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $results,
    'template' => '{items}',
    'itemView' => '_list',
    // refers to the partial view named '_post'
    'sortableAttributes' => array(

    ),
)
);
?>