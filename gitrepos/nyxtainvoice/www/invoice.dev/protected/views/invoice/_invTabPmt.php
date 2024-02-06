<div class="content">
    <div class="row">
        <div class="clo-lg-3" style="float:left;">
            <?php $this->renderPartial('_addPayment', array('stmt' => $stmt, 'pmt' => new Payments)); ?>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="header">
                    <h4 class="title">Payments</h4>
                </div>
                <?php if (Yii::app()->user->isAdmin): ?>
                    <div class="btn-group btn-toggle pull-right">
                        <?php
                        $this->widget(
                            'bootstrap.widgets.TbButton',
                            array(
                                'buttonType' => 'ajaxSubmit',
                                "url" => '/invoice/setPaid/id/' . $stmt->primaryKey,
                                //'type' => ($stmt->is_paid == 0) ? 'default' : 'success',
                                'label' => 'Paid ' . Payments::makeMoney($stmt->paymentsTotal),
                                "url" => '/invoice/setPaid/id/' . $stmt->primaryKey,
                                'ajaxOptions' => array(
                                    "type" => "POST",
                                    "data" => array("paid" => 1),
                                    'beforeSend' => new CJavaScriptExpression('function(){
                                                           // $(this).text("Working..");
                                                           // $(this).prop("disabled", true);
                                                        }'
                                    ),
                                    "success" => new CJavaScriptExpression('function (result) {                                                   
                                                            BootstrapDialog.alert({title: "success!", message: "Invoice set as paid!",
                                                                callback: function (result) {
                                                                    location.reload();
                                                                }});
                                                        }'),
                                ),
                                'htmlOptions' => array("class" => ($stmt->is_paid == 0) ? 'btn-default ' : 'btn btn-fill btn-success  active')
                            )
                        );
                        ?>
                        <?php
                        $this->widget(
                            'bootstrap.widgets.TbButton',
                            array(
                                'buttonType' => 'ajaxSubmit',
                                // 'type' => ($stmt->is_paid == 0) ? 'warning' : 'default',
                                'label' => 'Due ' . Payments::makeMoney($stmt->getBalance()),
                                "url" => '/invoice/setPaid/id/' . $stmt->primaryKey,
                                'ajaxOptions' => array(
                                    "type" => "POST",
                                    "data" => array("paid" => 0),
                                    'beforeSend' => new CJavaScriptExpression('function(){
                                  //  $(this).text("Working..");
                                  //  $(this).prop("disabled", true);
                                }'
                                    ),
                                    "success" => new CJavaScriptExpression('function (result) {                                                   
                                    BootstrapDialog.alert({title: "success!", message: "Invoice set as Due!",
                                        callback: function (result) {
                                            location.reload();
                                        }});
                                }'),
                                ),
                                'htmlOptions' => array("class" => ($stmt->is_paid == 1) ? 'btn-default ' : 'btn btn-fill btn-success  active')
                            )
                        );
                        ?>
                    </div>

                    <?php
                    $this->widget('bootstrap.widgets.TbGridView', array(
                        'id' => 'usergrid',
                        'itemsCssClass' => 'table table-hover',
                        'dataProvider' => $dp,
                        'columns' => array(
                            array(
                                'class' => 'editable.EditableColumn',
                                'name' => 'deposited_by',
                                'header' => 'Deposited By',
                                'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'editable' => array( //editable section
                                    // 'apply'      => '$data->user_status != 4', //can't edit deleted users
                                    'url' => $this->createUrl('payments/updatePmt'),
                                    'placement' => 'right',
                                )
                            ),
                            array(
                                'class' => 'editable.EditableColumn',
                                'name' => 'amount',
                                'headerHtmlOptions' => array('style' => 'width: 110px'),
                                'editable' => array( //editable section
                                    // 'apply'      => '$data->user_status != 4', //can't edit deleted users
                                    'url' => $this->createUrl('payments/updatePmt'),
                                    'placement' => 'right',
                                )
                            ),
                            array(
                                'class' => 'editable.EditableColumn',
                                'name' => 'mode_id',
                                'header' => 'Mode',
                                'headerHtmlOptions' => array('style' => 'width: 100px'),
                                'editable' => array(
                                    'type' => 'select',
                                    'url' => $this->createUrl('payments/updatePmt'),
                                    'source' => CHtml::listData(Mode::model()->findAll(), 'mode_id', function ($post) {
                                        return CHtml::encode($post->mode_description);
                                    }),
                                    'options' => array( //custom display 
                                        /* 'display' => 'js: function(value, sourceData) {
                                          var selected = $.grep(sourceData, function(o){ return value == o.value; }),
                                          colors = {1: "green", 2: "blue", 3: "red", 4: "gray"};
                                          $(this).text(selected[0].text).css("color", colors[value]);
                                          }' */
                                    ),
                                    //onsave event handler 
                                    'onSave' => 'js: function(e, params) {
                      console && console.log("saved value: "+params.newValue);
                 }',
                                    //source url can depend on some parameters, then use js function:
                                    /*
                                      'source' => 'js: function() {
                                      var dob = $(this).closest("td").next().find(".editable").text();
                                      var username = $(this).data("username");
                                      return "?r=site/getStatuses&user="+username+"&dob="+dob;
                                      }',
                                      'htmlOptions' => array(
                                      'data-username' => '$data->user_name'
                                      )
                                     */
                                )
                            ),
                            array(
                                'class' => 'editable.EditableColumn',
                                'name' => 'pay_date',
                                'header' => 'Date',
                                'headerHtmlOptions' => array('style' => 'width: 87px'),
                                'editable' => array(
                                    'type' => 'date',
                                    'viewformat' => 'dd.mm.yyyy',
                                    'url' => $this->createUrl('payments/updatePmt'),
                                    'placement' => 'right',
                                )
                            ),
                            array(
                                'class' => 'editable.EditableColumn',
                                'name' => 'details',
                                'editable' => array(
                                    'type' => 'textarea',
                                    'url' => $this->createUrl('payments/updatePmt'),
                                    'placement' => 'left',
                                )
                            ),
                            'created'
                            //editable related attribute with sorting.
                            //see http://www.yiiframework.com/wiki/281/searching-and-sorting-by-related-model-in-cgridview  
                            /*  array( 
                              'class' => 'editable.EditableColumn',
                              'name' => 'virtual_field',
                              'value' => 'CHtml::value($data, "profile.language")',
                              'editable' => array(
                              'type'      => 'text',
                              'attribute' => 'profile.language',
                              'url'       => $this->createUrl('site/updateProfile'),
                              'placement' => 'left',
                              )
                              ), */
                        ),
                    )
                    );
                    ?>
                <?php else: ?>
                    <?php $this->renderPartial('payments', array('dp' => $dp, 'stmt' => $stmt)); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?php
Yii::app()->clientScript->registerScript('set-paid', '    
   
            $("#btn-status-paid").on("click", function (e) {     
                e.preventDefault();
                var that  = this;
                $.ajax({
                    url: "' . Yii::app()->createAbsoluteUrl("/invoice/setPaid", array("id" => $stmt->primaryKey)) . ';",
                    type: "POST",
                    beforeSend : function(){$(that).text("Working..");$(that).prop("disabled", true);},
                    data: {
                        paid: "1"
                    },
                    success: function(result) { 
                        BootstrapDialog.alert({title:"success!", message:"Invoice set as paid!",
                            callback : function(result){ location.reload(); }});
                     
                    }
                });
            });
            $("#btn-status-unpaid").on("click", function (e) {     
                e.preventDefault();
                var that  = this;
                $.ajax({
                    url: "' . Yii::app()->createAbsoluteUrl("/invoice/setPaid", array("id" => $stmt->primaryKey)) . ';",
                    type: "POST",
                    beforeSend : function(){$(that).text("Working..");$(that).prop("disabled", true);},
                    data: {
                        paid: "0"
                    },
                    success: function(result) { 
                        BootstrapDialog.alert({title:"success!", message:"Invoice set as Unpaid!",
                            callback : function(result){ location.reload(); }});
                      
                    }
              });  });', CClientScript::POS_END);
?>