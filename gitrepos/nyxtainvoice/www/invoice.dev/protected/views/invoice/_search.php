<div class="col-md-12">
    <div class="card">
        <div class="header">
            <h4 class="title"><span><i class="pe-7s-search"></i></span>Invoice Search</h4>
        </div>

        <div class="content">
            <?php
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
                'id' => 'search-form-search-form',
                'type' => 'horizontal',
                // Please note: When you enable ajax validation, make sure the corresponding
                // controller action is handling ajax validation correctly.
                // See class documentation of CActiveForm for details on this,
                // you need to use the performAjaxValidation()-method described there.
                // 'action' => array('/search/admin'),
                'enableAjaxValidation' => false,
            )
            );
            ?>
            <?php //echo CHtml::activeHiddenField($search, 'created'); ?>
            <!--   ////////////////////////////////////////////////////////////  -->
            <fieldset>
                <div class="row-fluid">
                    <div class="form-group">

                        <div class="col-md-5">
                            <label class="control-label">Invoice#</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="pe-7s-file"></i></span>

                                <?php echo $form->textField($search, 'invoice_id', array('class' => 'form-control', 'placeholder' => 'invoice Id')); ?>
                            </div>
                        </div>
                        <div class="col-md-6 pull-left">
                            <label class="control-label">Create Date</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="pe-7s-date"></i></span>
                                <?php echo $form->dateField($search, 'created', array('class' => 'form-control')); ?>
                                <?php
                                /* $this->widget('zii.widgets.jui.CJuiDatePicker', array(                
                                                'name' => 'dp_post_date',
                                                'options' => array(
                                                    // 'showOn' => 'both',
                                                    'dateFormat' => 'M-dd-yy',
                                                    //  'altFormat' => 'mm-dd-yy',
                                                    'altFormat' => 'yy-mm-dd',
                                                    'showAnim' => 'slide',
                                                    'altField' => '#SearchForm_created',
                                                    // 'buttonImage' => '<i class="fa fa-save"></i>',
                                                    // 'buttonImageOnly' => false,
                                                   // 'minDate' => '0'
                                                ),
                                                'htmlOptions' => array(
                                                    'style' => 'width:176px',
                                                    'maxlength' => 20,
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Create Date',
                                                   // 'readonly' => 'readonly',
                                                    //  'value'=>CTimestamp::formatDate('m-d-Y'),
                                                    'style' => 'z-index:9999;'
                                                ),
                                            ));  */
                                /*    $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                        'name' => 'created',
                                        'language' => 'en',
                                        'options' => array(
                                            'showAnim' => 'fold',
                                            'dateFormat' => 'dd.mm.yy',
                                            'changeMonth' => 'true',
                                            'altFormat' => 'dd.mm.yy', //IMP!!!
                                            'showAnim' => 'slide',
                                            'altField' => '#SearchForm_created',
                                            'changeYear' => 'true',
                                            'showButtonPanel' => 'true',
                                        ),
                                        'htmlOptions' => array(
                                            'class' => 'form-control', 'placeholder' => 'Create Date'
                                        ),
                                    ));*/
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend></legend>
                <div class="row-fluid">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label class="control-label">Event Date Range</label>
                            <div class="input-group">
                                <span class="input-group-addon" id="event-dt-range"><i class="pe-7s-date"></i></span>
                                <?php
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model' => $search,
                                    'attribute' => 'from_date',
                                    // name of post parameter
                                    'value' => (isset(Yii::app()->request->cookies['from_date'])) ? Yii::app()->request->cookies['from_date']->value : '',
                                    // value comes from cookie after submittion
                                    'options' => array(
                                        'showAnim' => 'fold',
                                        // 'dateFormat'=>'mm-dd-yy',
                                        'dateFormat' => 'yy-mm-dd',
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'form-control',
                                        'style' => 'width:202px;'
                                    ),
                                )
                                );
                                ?>
                                <?php
                                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                    'model' => $search,
                                    'attribute' => 'to_date',
                                    // name of post parameter
                                    'value' => (isset(Yii::app()->request->cookies['from_date'])) ? Yii::app()->request->cookies['from_date']->value : '',
                                    // value comes from cookie after submittion
                                    'options' => array(
                                        'showAnim' => 'fold',
                                        // 'dateFormat'=>'mm-dd-yy',
                                        'dateFormat' => 'yy-mm-dd',
                                    ),
                                    'htmlOptions' => array(
                                        'class' => 'form-control',
                                        'style' => 'width:202px'
                                    ),
                                )
                                );
                                ?>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="control-label">Customer</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="pe-7s-user"></i></span>
                                <?php echo $form->textField($search, 'customer_name', array('class' => 'form-control', 'placeholder' => 'Customer Name')); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Venue</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="pe-7s-drop"></i></span>
                                <?php echo $form->dropDownList(
                                    $search,
                                    'venue_id',
                                    CHtml::listData(Venue::model()->findAll(), 'venue_id', function ($post) {
                                        return CHtml::encode($post->ship_name . ' ' . $post->ship_add1);
                                    }),
                                    array('class' => 'form-control')
                                ); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-1">
                        <?php echo $form->checkBoxListInlineRow(
                            $search,
                            'is_paid',
                            array('Pending', 'Paid'),
                            array('class' => 'btn-paid', 'data-toggle' => 'checkbox')
                        ); ?>
                    </div>
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="button1id"></label>
                            <?php echo CHtml::submitButton('Show Results', array('class' => 'btn btn-warning btn-fill btn-wd')); ?>
                        </div>
                    </div>
                </div>
            </fieldset>


            <?php $this->endWidget(); ?>
        </div> <!--row-->

    </div>
</div>