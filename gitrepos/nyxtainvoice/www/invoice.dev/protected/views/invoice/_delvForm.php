<div class="card">
    <div class="header">
        <h4 class="title">Delivery</h4>
    </div>
    <div class="content">
        <div class="col-md-6 pull-right">
            <div class="btn-group">
                <button type="button" class="btn btn-success btn-fill dropdown-toggle" data-toggle="dropdown">
                    <i class="pe-7s-print"></i> Print <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="<?php echo ($stmt->st_type == 2) ? "/invoice/slip/mode/slip/id/" . $stmt->invoice_id : '#'; ?>.html"
                            class="" target="_blank">
                            <i class="fa fa-location-arrow"></i> Packing Slip Only
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo ($stmt->st_type == 2) ? "/invoice/slip/mode/inst/id/" . $stmt->invoice_id : '#'; ?>.html"
                            class="" target="_blank">
                            <i class="fa fa-location-arrow"></i> Packing Instructions Only
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo ($stmt->st_type == 2) ? "/invoice/slip/mode/full/id/" . $stmt->invoice_id : '#'; ?>.html"
                            class="" target="_blank">
                            <i class="fa fa-location-arrow"></i> Full Packing Slip(Single Page)
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" id="delv-datepicker">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="input-group-addon">From</label>

                    <h4 class="text-center">
                        <?php
                        /* $this->widget('editable.EditableField', array(
                          'type'        => 'combodate',
                          'model'       => $stmt,
                          'attribute'   => 'delv_from',
                          //define value directly as it should match the format of combodate: Y-m-d H:i --> YYYY-MM-DD HH:mm
                          'value'       => isset($stmt->delv_from) ? date('Y-m-d H:i', strtotime($stmt->delv_from)) : '',
                          'url'         => $this->createUrl('invoice/chgInv'),
                          'placement'   => 'right',
                          'format'      => 'YYYY-MM-DD HH:mm', //in this format date sent to server
                          'viewformat'  => 'MMM DD, YYYY hh:mm A', //in this format date is displayed
                          'template'    => 'DD / MMM / YYYY HH:mm', //template for dropdowns
                          'combodate'   => array('minYear' => 2016, 'maxYear' => 2016),
                          )); */

                        $this->widget('editable.EditableField', array(
                            'type' => 'datetime',
                            'model' => $stmt,
                            'attribute' => 'delv_from',
                            //define value directly as it should match the format of combodate: Y-m-d H:i --> YYYY-MM-DD HH:mm 
                            'value' => isset($stmt->delv_from) ? date('Y-m-d H:i', strtotime($stmt->delv_from)) : '',
                            'url' => $this->createUrl('invoice/chgInv'),
                            'placement' => 'right',
                            'format' => 'yyyy-mm-dd hh:ii:ss',
                            //database datetime format
                            //'viewformat'  => 'dd/mm/yyyy hh:ii',  
                            'viewformat' => 'dd MM yyyy - HH:ii P',
                        )
                        );
                        ?>
                    </h4>
                </div>
                <div class="form-group">
                    <label class="input-group-addon">To </label>
                    <h4 class="text-center">
                        <?php
                        $this->widget('editable.EditableField', array(
                            'type' => 'datetime',
                            'model' => $stmt,
                            'attribute' => 'delv_to',
                            //define value directly as it should match the format of combodate: Y-m-d H:i --> YYYY-MM-DD HH:mm 
                            'value' => isset($stmt->delv_to) ? date('Y-m-d H:i', strtotime($stmt->delv_to)) : '',
                            'url' => $this->createUrl('invoice/chgInv'),
                            'placement' => 'right',
                            'format' => 'yyyy-mm-dd hh:ii:ss',
                            //database datetime format
                            'viewformat' => 'dd MM yyyy - HH:ii P',
                        )
                        );
                        ?>
                    </h4>
                </div>
            </div>
            <div class="col-md-5">


            </div>
            <div class="col-md-4">
                <h4><i class="icon icon-truck"></i>Packing Instructions</h4>
                <div class="form-group">
                    <?php
                    $this->widget('editable.EditableField', array(
                        'type' => 'textarea',
                        'model' => $stmt,
                        'attribute' => 'pack_instr',
                        'mode' => 'inline',
                        // 'text'  => 'Edit Packing Instructions',
                        //define value directly as it should match the format of combodate: Y-m-d H:i --> YYYY-MM-DD HH:mm 
                        'value' => isset($stmt->pack_instr) ? $stmt->pack_instr : '',
                        'url' => $this->createUrl('invoice/chgInv'),
                        'placement' => 'right',
                        'showbuttons' => 'bottom',
                        // 'htmlOptions' => array('style'=> 'font-size:12px'),
                        'success' => 'js: function(data) {
                                location.reload();
                                if(typeof data == "object" && !data.success) return data.msg;
                    }',
                    )
                    );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>