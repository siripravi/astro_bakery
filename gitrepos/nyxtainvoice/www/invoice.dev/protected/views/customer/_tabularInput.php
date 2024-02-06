<div class="row">
    <div class="col-lg-12">
        <div class="col-md-5">
            <div class="credit-card-div">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo CHtml::activeHiddenField($model, "[$index]id"); ?>

                        <div class="row">
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <h5 class="text-muted"> Credit Card Number</h5>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <?php echo CHtml::activeTextField($model, "[$index]cc1", array('class' => 'form-control', 'placeholder' => '0000')); ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <?php echo CHtml::activeTextField($model, "[$index]cc2", array('class' => 'form-control', 'placeholder' => '0000')); ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <?php echo CHtml::activeTextField($model, "[$index]cc3", array('class' => 'form-control', 'placeholder' => '0000')); ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <?php echo CHtml::activeTextField($model, "[$index]cc4", array('class' => 'form-control', 'placeholder' => '0000')); ?>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <span class="help-block text-muted small-font"> Expiry Month</span>
                                <?php
                                echo CHtml::activeDropDownList(
                                    $model,
                                    "[$index]card_expiry_mn",
                                    array(
                                        '01' => '01',
                                        '02' => '02',
                                        '03' => '03',
                                        '04' => '04',
                                        '05' => '05',
                                        '06' => '06',
                                        '07' => '07',
                                        '08' => '08',
                                        '09' => '09',
                                        '10' => '10',
                                        '11' => '11',
                                        '12' => '12',
                                    )
                                    ,
                                    array('empty' => 'MM', 'class' => 'form-control')
                                );
                                ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <span class="help-block text-muted small-font"> Expiry Year</span>
                                <?php
                                echo CHtml::activeDropDownList(
                                    $model,
                                    "[$index]card_expiry_yr",
                                    array(
                                        '15' => '15',
                                        '16' => '16',
                                        '17' => '17',
                                        '18' => '18',
                                        '19' => '19',
                                        '20' => '20',
                                        '21' => '21',
                                        '22' => '22',
                                        '23' => '23',
                                        '24' => '24',
                                        '25' => '25',
                                        '26' => '26',
                                    )
                                    ,
                                    array('empty' => 'YY', 'class' => 'form-control')
                                );
                                ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <span class="help-block text-muted small-font"> CCV</span>
                                <?php echo CHtml::activeTextField($model, "[$index]card_csc", array('class' => 'form-control', 'placeholder' => '***')); ?>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <img src="data:image/png;base64,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"
                                    class="img-rounded" />
                            </div>
                        </div>
                        <div class="row  form-group col-md-12 pad-adjust">
                            <?php echo CHtml::activeTextField($model, "[$index]card_name", array('class' => 'form-control', 'placeholder' => 'Name on Card')); ?>
                        </div>
                        <div class="row  form-group ">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <?php
                                echo CHtml::activeDropDownList(
                                    $model,
                                    "[$index]card_type", CHtml::listData(CardType::model()->findAll(), 'id', 'card_type')
                                    ,
                                    array('empty' => 'Select Card Type', 'class' => 'form-control')
                                );
                                ?>
                            </div>
                            <div class="col-md-5 col-sm-5 col-xs-5">
                                <?php
                                echo CHtml::activeDropDownList(
                                    $model,
                                    "[$index]status",
                                    array(
                                        '1' => 'active',
                                        '2' => 'inactive',
                                        '03' => 'removed',
                                        '4' => 'invalid',
                                    )
                                    ,
                                    array('class' => 'form-control')
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 pull-left">
            <div class="credit-card-div">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <div class="row">
                            <div id="locationField-<?php echo $index; ?>"> <?php
                               /* $this->widget('ext.gplacesautocomplete.GPlacesAutoComplete', array(
                                 'objectName' => 'autocomplete',
                                 'name' => 'locationField-'.$index,
                                 'options' => array(
                                 'types' => array(
                                 '(cities)'
                                 ),
                                 'componentRestrictions' => array(
                                 'country' => 'us',
                                 )
                                 ),
                                 'afterScript' =>'autocomplete.addListener("place_changed", fillInAddress);',
                                 'htmlOptions' => array('class'=>'form-control','placeholder'=>'Enter the card address')
                                 )); */
                               ?> </div>
                            <table id="address-<?php echo $index; ?>">
                                <tbody>
                                    <tr class="col-lg-12">
                                        <td class="label">Address</td>
                                        <td class="slimField">
                                            <?php echo CHtml::activeTextField($model, "[$index]street_number", array('maxlength' => 225, 'class' => 'form-control', 'placeholder' => 'building/street')); ?>
                                        </td>
                                        <td class="wideField" colspan="2">
                                            <?php echo CHtml::activeTextField($model, "[$index]route", array('maxlength' => 225, 'placeholder' => 'route', 'class' => 'form-control')); ?>
                                        </td>
                                    </tr>
                                    <tr class="col-lg-12">
                                        <td class="label">city</td>
                                        <td class="wideField" colspan="3">
                                            <?php echo CHtml::activeTextField($model, "[$index]locality", array('maxlength' => 225, 'placeholder' => 'city', 'class' => 'form-control')); ?>
                                        </td>
                                    </tr>
                                    <tr class="col-lg-12">
                                        <td class="label">state</td>
                                        <td class="slimField">
                                            <?php echo CHtml::activeTextField($model, "[$index]administrative_area_level_1", array('maxlength' => 225, 'placeholder' => 'state', 'class' => 'form-control')); ?>
                                        </td>
                                        <td class="label">zip code</td>
                                        <td class="wideField">
                                            <?php echo CHtml::activeTextField($model, "[$index]postal_code", array('maxlength' => 10, 'placeholder' => 'zip', 'class' => 'form-control')); ?>
                                        </td>
                                    </tr>
                                    <tr class="col-lg-12">
                                        <td class="label">Country</td>
                                        <td class="wideField" colspan="3">
                                            <?php echo CHtml::activeTextField($model, "[$index]country", array('maxlength' => 225, 'placeholder' => 'country', 'class' => 'form-control')); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>