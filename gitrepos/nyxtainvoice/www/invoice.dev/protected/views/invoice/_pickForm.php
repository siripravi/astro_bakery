<?php
/*
  $minDelDate = str_replace('-', '/', date('Y-m-d', strtotime('-7 days', strtotime($stmt->ship_date))));
  $delDate = $stmt->ship_date;
  $maxDelDate = $stmt->ship_date.' 23:59:59';
  $minPicDate = $maxDelDate;
  $maxPicDate = str_replace('-', '/', date('Y-m-d', strtotime('+7 days', strtotime($stmt->ship_date))));
 */
?>
<div class="card">
    <div class="header">
        <h4 class="title">Pickup</h4>
        <div class="content">
            <div class="row" id="delv-datepicker">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="input-group-addon"><i class="pe-7s-alarm"></i> From </label>
                        <h4 class="text-center">
                            <?php
                            $this->widget('editable.EditableField', array(
                                'type' => 'datetime',
                                'model' => $stmt,
                                'attribute' => 'pick_from',
                                //define value directly as it should match the format of combodate: Y-m-d H:i --> YYYY-MM-DD HH:mm 
                                'value' => isset($stmt->pick_from) ? date('Y-m-d H:i', strtotime($stmt->pick_from)) : '',
                                'url' => $this->createUrl('invoice/chgInv'),
                                'placement' => 'right',
                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                //in this format date sent to server  
                                'viewformat' => 'dd MM yyyy - HH:ii P',
                                // 'template'    => 'DD / MMM / YYYY HH:mm', //template for dropdowns
                                // 'combodate'   => array('minYear' => 2016, 'maxYear' => 2016), 
                            )
                            );
                            ?>
                        </h4>
                    </div>
                    <div class="form-group">
                        <label class="input-group-addon"><i class="pe-7s-alarm"></i> To </label>
                        <h4 class="text-center">
                            <?php
                            $this->widget('editable.EditableField', array(
                                'type' => 'datetime',
                                'model' => $stmt,
                                'attribute' => 'pick_to',
                                //define value directly as it should match the format of combodate: Y-m-d H:i --> YYYY-MM-DD HH:mm 
                                'value' => isset($stmt->pick_to) ? date('Y-m-d H:i', strtotime($stmt->pick_to)) : '',
                                'url' => $this->createUrl('invoice/chgInv'),
                                'placement' => 'right',
                                'format' => 'yyyy-mm-dd hh:ii:ss',
                                //in this format date sent to server  
                                'viewformat' => 'dd MM yyyy - HH:ii P', //in this format date is displayed
                                //  'template'    => 'DD / MMM / YYYY HH:mm', //template for dropdowns
                                //'combodate'   => array('minYear' => 2016, 'maxYear' => 2016), 
                            )
                            );
                            ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>