<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'chg_delivery_form',
    // Please note: When you enable ajax validation, make sure the corresponding
    // controller action is handling ajax validation correctly.
    // There is a call to performAjaxValidation() commented in generated controller code.
    // See class documentation of CActiveForm for details on this.
    'layout' => TbHtml::FORM_LAYOUT_INLINE,
    'enableAjaxValidation' => false,
    'action' => Yii::app()->createUrl('invoice/chgDelivery', array('id' => $stmt->id)),
    'htmlOptions' => array()
)
);
?>
<div class="row input-daterange input-group" id="delv-datepicker">
    <span class="input-group-addon">From </span>
    <?php echo TbHtml::activeTextField(
        $stmt,
        'delv_from',
        array(
            /*'ajax' => array(
                    "url" => "/statement/chgDelivery/id/". $stmt->st_id,
                    "type" => "POST",           
                    "success" => 'function (data) {
                            console.log(data);              
                            var obj = jQuery.parseJSON(data);
                            var result = $("#delivery-details");
                            result.find(".delv_from").text(obj.delv_from);
                         //   BootstrapDialog.alert({title: \"success!\", message: \"Delivery and Pickup times Changed Successfully!\"});
                        }',
              'data' => array('delvFrom' => 'js:document.getElementById("statement_delv_from").value'),
            ),*/
            'append' => '<span class="glyphicon glyphicon-calendar"></span>',
            'placeholder' => 'start time',
            'size' => TbHtml::INPUT_SIZE_LARGE
        )
    ); ?>
    <span class="input-group-addon"> To </span>
    <?php echo TbHtml::activeTextField(
        $stmt,
        'delv_to',
        array(
            'append' => '<span class="glyphicon glyphicon-calendar"></span>',
            'placeholder' => 'end time',
            'size' => TbHtml::INPUT_SIZE_LARGE
        )
    ); ?>
</div>

<?php echo TbHtml::submitButton('Submit'); ?>

<?php $this->endWidget(); ?>