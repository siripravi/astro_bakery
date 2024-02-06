<?php echo CHtml::activeHiddenField($model, "[$index]id"); ?>

<div class="row">
    <div class="span10">
        <div class="form-horizontal span5 well pull-left">
            <div class="control-group">
                <label class="control-label">Card Holder's Name</label>
                <div class="controls">
                    <?php echo CHtml::activeTextField($model, "[$index]card_name", array('class' => 'form-control', 'placeholder' => 'Name on Card')); ?>
                </div>
            </div>

            <div class="control-group">
                <label class="control-label">Card Number</label>
                <div class="controls">
                    <div class="row-fluid">
                        <div class="span3">
                            <?php echo CHtml::activeTextField($model, "[$index]cc1", array('class' => 'input-block-level', 'placeholder' => '0000', "autocomplete" => "off")); ?>

                        </div>
                        <div class="span3">
                            <?php echo CHtml::activeTextField($model, "[$index]cc2", array('class' => 'input-block-level', 'placeholder' => '0000', "autocomplete" => "off")); ?>
                        </div>
                        <div class="span3">
                            <?php echo CHtml::activeTextField($model, "[$index]cc3", array('class' => 'input-block-level', 'placeholder' => '0000', "autocomplete" => "off")); ?>
                        </div>
                        <div class="span3">
                            <?php echo CHtml::activeTextField($model, "[$index]cc4", array('class' => 'input-block-level', 'placeholder' => '0000', "autocomplete" => "off")); ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="control-group">
                <div class="row-fluid">
                    <label class="control-label">Card Type/Status</label>
                    <div class="input-group">

                        <?php
                        echo CHtml::activeDropDownList(
                            $model,
                            "[$index]card_type", CHtml::listData(CardType::model()->findAll(), 'id', 'card_type')
                            ,
                            array('empty' => 'Select Card Type', 'class' => 'input-block-level', "style" => "width:176px;")
                        );
                        ?>
                        <div class="input-append">
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
                                array('class' => 'input-block-level')
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="control-group">
                <label class="control-label">Card Expiry Date/CVV</label>
                <div class="controls">
                    <div class="row-fluid">
                        <div class="span3">
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
                                array('empty' => 'MM', 'class' => 'input-block-level')
                            );
                            ?>
                        </div>
                        <div class="span3">
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
                                array('empty' => 'YY', 'class' => 'input-block-level')
                            );
                            ?>
                        </div>
                        <div class="span3">

                            <?php echo CHtml::activeTextField($model, "[$index]card_csc", array('class' => 'input-block-level', 'placeholder' => '***')); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-horizontal span4">
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
               ?>
            </div>
            <table id="address-<?php echo $index; ?>">
                <tbody>
                    <tr>
                        <td class="label">Door/Apt#/Building#</td>
                        <td class="slimField">
                            <?php echo CHtml::activeTextField($model, "[$index]street_number", array('maxlength' => 225, 'class' => 'form-control', 'placeholder' => 'building/street')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Street Address</td>
                        <td class="wideField">
                            <?php echo CHtml::activeTextField($model, "[$index]route", array('maxlength' => 225, 'placeholder' => 'route', 'class' => 'form-control')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">city</td>
                        <td class="wideField" colspan="3">
                            <?php echo CHtml::activeTextField($model, "[$index]locality", array('maxlength' => 225, 'placeholder' => 'city', 'class' => 'form-control')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">state</td>
                        <td class="slimField">
                            <?php echo CHtml::activeTextField($model, "[$index]administrative_area_level_1", array('maxlength' => 225, 'placeholder' => 'state', 'class' => 'form-control')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="label">zip code</td>
                        <td class="wideField">
                            <?php echo CHtml::activeTextField($model, "[$index]postal_code", array('maxlength' => 10, 'placeholder' => 'zip', 'class' => 'form-control')); ?>
                        </td>

                    </tr>
                    <tr>
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

<hr>