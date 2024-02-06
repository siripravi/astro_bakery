<div class="card">
    <div class="header">
        <h5 class="typo-line">Search Payments</h5>
    </div>
    <div class="content">
        <?php

        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
            'id' => 'payment-search-form',
            'type' => 'horizontal',
            'method' => 'get',
            // Please note: When you enable ajax validation, make sure the corresponding
            // controller action is handling ajax validation correctly.
            // See class documentation of CActiveForm for details on this,
            // you need to use the performAjaxValidation()-method described there.
            // 'action' => array('/search/admin'),
            'enableAjaxValidation' => false,
        )
        );
        ?>
        <fieldset>
            <div class="form-group">
                <div class="col-lg-4">
                    <label class="control-label">Pay Date</label>
                    <br>
                    <span class="form-inline">
                        <?php

                        //you can replace the DateField inputs with CJuiDatePicker
                        //echo $form->dateField($model, 'from_date');
                        //echo $form->dateField($model, 'to_date');
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'from_date',
                            // 'name' => 'Quotation[from_date]',
                            // 'language' => 'id',
                            'value' => $model->from_date,
                            'i18nScriptFile' => 'jquery.ui.datepicker-eng.js',
                            // (#2)
                            // additional javascript options for the date picker plugin
                            'options' => array(
                                'showAnim' => 'fold',
                                // 'dateFormat'=>'yy-mm-dd',
                                'dateFormat' => 'mm-dd-yy',
                                'changeMonth' => 'true',
                                'changeYear' => 'true',
                                'constrainInput' => 'false',
                            ),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                                'style' => 'width:123px'
                            )
                        )
                        );
                        echo '  To  ';
                        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                            'model' => $model,
                            'attribute' => 'to_date',
                            //'name' => 'Quotation[to_date]',
                            // 'language' => 'id',
                            'value' => $model->from_date,
                            'i18nScriptFile' => 'jquery.ui.datepicker-eng.js',
                            // (#2)
                            // additional javascript options for the date picker plugin
                            'options' => array(
                                'showAnim' => 'fold',
                                // 'dateFormat'=>'yy-mm-dd',
                                'dateFormat' => 'mm-dd-yy',
                                'changeMonth' => 'true',
                                'changeYear' => 'true',
                                'constrainInput' => 'false',
                            ),
                            'htmlOptions' => array(
                                'class' => 'form-control',
                                'style' => 'width:123px'
                            )
                        )
                        ); ?>
                    </span>
                </div>
                <div class="col-lg-3 col-lg-offset-1">
                    <div class="form-group">
                        <?php echo $form->checkBoxListInlineRow(
                            $model,
                            'mode_id', CHtml::listData(Mode::model()->findAll(), 'mode_id', 'mode_description'),
                            array('class' => 'btn-paid', 'data-toggle' => 'checkbox')
                        ); ?>
                    </div>

                </div>

                <div class="col-lg-3">
                    <label class="control-label">Invoice#</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="pe-7s-file"></i></span>
                        <?php echo $form->textField($model, 'invoice_id', array('class' => 'form-control', 'placeholder' => 'invoice Id')); ?>
                    </div>

                </div>

            </div>

            <div class="col-sm-8 col-sm-offset-1">

                <?php echo CHtml::submitButton('Show Results', array('class' => 'btn btn-warning btn-fill btn-wd pull-right')); ?>
            </div>

        </fieldset>
        <?php $this->endWidget(); ?>
    </div>
</div>
<div class="clearfix"></div>