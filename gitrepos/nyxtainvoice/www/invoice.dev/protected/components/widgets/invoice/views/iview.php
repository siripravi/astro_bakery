<?php
Yii::import('application.controllers.InvoiceController');
//$dueDate = $this->calcDueDate($this->stmt->created, $this->stmt->ship_date);
$dueDate = $this->stmt->created;
// $model = $this->model;
// $stmt = $this->stmt;                                  
?>
<section class="content">
    <p>
        <?php
        if (Yii::app()->user->hasFlash("chgCust"))
            echo Yii::app()->user->getFlash("chgCust");
        ?>
    </p>
    <?php
    $nginvoice = $this->beginWidget(
        'ext.yii-angularjs-helper.YiiAngularjsHelper',
        array(
            'appName' => 'InvApp',
            'appFolder' => dirname(__FILE__) . '/../assets/js/app4',
            'appScripts' => array('ui-select.js', 'accounting.min.js', 'inv.js'),
            'commonAppScripts' => array(
                //  dirname(__FILE__) . '/../assets/js/common/config_httpProvider.js',
                //  dirname(__FILE__) . '/../assets/js/common/config_locationProvider.js',
            ),
            'requiredModulesScriptNames' => array('route', 'sanitize'),
            'concatenateAppScripts' => false,
            'debug' => false,
        )
    );
    ?>

    <div ng-controller="InvCtrl">

        <section class="container">
            <?php $this->widget('application.components.MenuWidget'); ?>
        </section>
        <div class="col-lg-10" style="float:left;top:20%">
            <div class="row equal">
                <div class="col-sm-6">
                    <div class="box box-primary">
                        <div id="cust-adrs-div"></div>
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-user"></i> Customer</h3>
                            <div class="box-tools pull-right">

                                <?php
                                $this->widget('zii.widgets.jui.CJuiButton', array(
                                    'buttonType' => 'link',
                                    'name' => 'btnSaveCust',
                                    'caption' => '<i class="fa fa-exchange"></i> Change',
                                    'onclick' => new CJavaScriptExpression('function(){
                                                 BootstrapDialog.show({
                                                  title: "Edit Customer",
                                                  type: BootstrapDialog.TYPE_SUCCESS,
                                                message: $("<div></div>").load("/statement/chgCustomer?id=' . $this->stmt->getRelModel()->st_id . '"),
                                               /* onshown: function(dialogRef){
                                                            alert(dialogRef.getModal().html());
                                                            alert("Dialog is popped up.");
                                                },*/
                                                onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                                buttons: [{
                                                    label: "Done",
                                                    action: function(dialogRef){
                                                        dialogRef.close();
                                                    }
                                                }]
                                            });
                                                this.blur(); 
                                                return false;}'),
                                    'htmlOptions' => array('id' => 'btn-chg-customer', 'class' => 'btn btn-default btn-sm')
                                )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="box-body">
                            <div id="hcard-<?php echo $this->stmt->customer->first_name . '-' . $this->stmt->customer->last_name; ?>"
                                class="vcard">
                                <div class="org">
                                    <?php echo $this->stmt->customer->first_name . ' ' . $this->stmt->customer->last_name; ?>
                                </div>
                                <a class="email" href="mailto:<?php echo $this->stmt->customer->email1; ?>"><?php echo $this->stmt->customer->email1; ?></a>

                                <div class="adr">
                                    <div class="street-address">
                                        <?php echo $this->stmt->customer->address1; ?>
                                    </div>
                                    <span class="locality">
                                        <?php echo $this->stmt->customer->address2; ?>
                                    </span>

                                </div>

                                <div class="tel">
                                    <?php echo $this->stmt->customer->phone1; ?>
                                </div>
                            </div><!-- e: vcard -->
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title"><i class="fa fa-truck"></i> Shipping &nbsp;&nbsp;<span
                                    class="label label-info">
                                    <?php echo Yii::app()->dateFormatter->formatDateTime($this->stmt->ship_date, "medium", null); ?>
                                </span></h3>
                            <div class="box-tools pull-right">

                                <?php
                                $this->widget('zii.widgets.jui.CJuiButton', array(
                                    'buttonType' => 'link',
                                    'name' => 'btnSaveCust',
                                    'caption' => '<i class="fa fa-exchange"></i> Change',
                                    'onclick' => new CJavaScriptExpression('function(){
                                                 BootstrapDialog.show({
                                                  title: "Edit Shipping",
                                                  type: BootstrapDialog.TYPE_SUCCESS,
                                                message: $("<div></div>").load("/statement/chgShip?id=' . $this->stmt->getRelModel()->st_id . '"),
                                                onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                                buttons: [{
                                                    label: "Done",
                                                    action: function(dialogRef){
                                                        dialogRef.close();
                                                    }
                                                }]
                                            });
                                                this.blur(); 
                                                return false;}'),
                                    'htmlOptions' => array('id' => 'btn-chg-ship', 'class' => 'btn btn-default btn-sm')
                                )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="box-body">

                            <p>
                                <?php if ($this->stmt->venue_id > 0): ?>
                                    <?php //print_r($this->stmt->venue->attributes); ?>
                                <div class="vcard">
                                    <div class="org">
                                        <?php echo $this->stmt->venue->ship_name; ?>
                                    </div>
                                    <div class="adr">
                                        <div class="street-address">
                                            <?php echo $this->stmt->venue->ship_add1; ?>
                                        </div>
                                        <span class="locality">
                                            <?php echo $this->stmt->venue->ship_add2; ?>
                                        </span>
                                        <span class="locality">
                                            <?php echo $this->stmt->venue->ship_city; ?>
                                        </span>
                                        <span class="state-name">
                                            <?php echo $this->stmt->venue->ship_state; ?>-
                                            <?php echo $this->stmt->venue->ship_zip; ?>
                                        </span>


                                    </div>

                                    <div class="tel">
                                        <span class="skype_c2c_print_container notranslate"><i
                                                class="fa fa-phone-square"></i>&nbsp;
                                            <?php echo $this->stmt->venue->ship_phone1; ?>
                                        </span>
                                    </div>
                                </div><!-- e: vcard -->


                            <?php elseif ($this->stmt->venue_id == 0): ?> <!-- same as customer -->

                                <div id="hcard-<?php echo $this->stmt->customer->first_name . '-' . $this->stmt->customer->last_name; ?>"
                                    class="vcard">
                                    <div class="org">
                                        <?php echo $this->stmt->customer->first_name . ' ' . $this->stmt->customer->last_name; ?>
                                    </div>
                                    <a class="email" href="mailto:<?php echo $this->stmt->customer->email1; ?>"><?php echo $this->stmt->customer->email1; ?></a>

                                    <div class="adr">
                                        <div class="street-address">
                                            <?php echo $this->stmt->customer->address1; ?>
                                        </div>
                                        <span class="locality">
                                            <?php echo $this->stmt->customer->address2; ?>
                                        </span>

                                    </div>

                                    <i class="fa fa-phone"></i>
                                    <div class="tel">
                                        <?php echo $this->stmt->customer->phone1; ?>
                                    </div>
                                </div><!-- e: vcard -->
                            <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="row">

                    <?php if ($this->stmt->primaryKey !== null): ?>
                        <form name="invForm">
                            <div class="pul-left"> </div>
                            <span class="pull-right">
                                <a href="javascript:void(0)" class=" btn btn-success btn-sm add-item"
                                    title="Add new row (Ctrl+Enter)" ng-click="addRow()">
                                    <i class="fa fa-plus"></i> Add Row
                                </a></span>


                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <th>Sr#</th>
                                        <th>description</th>
                                        <th>Qty</th>
                                        <th>price($)</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>

                                    <tr class="grid-row ng-scope" ng-repeat="item in invoice.items"
                                        ng-hide="item.status == 3">

                                        <td>
                                            <a href="javascript:void(0)" title="Insert new row"
                                                ng-click="insertRow($index)">
                                                <i class="fa fa-arrow-circle-o-down fa-2x"></i>
                                            </a>
                                        </td>
                                        <td><b>{{$index + 1}}</b>
                                            <input style="width:38px;display:none"
                                                id="<?php echo 'StatementItems_'; ?>{{$index}}<?php echo 'sequence'; ?>"
                                                name="<?php echo 'StatementItems['; ?>{{$index}}<?php echo ']sequence'; ?>"
                                                placeholder="1" type="text" value="{{$index + 1}}">
                                        </td>
                                        <td>
                                            <textarea style="width:423px" ng-model="item.description"
                                                name="<?php echo 'StatementItems['; ?>{{$index}}<?php echo ']description'; ?>"
                                                id="<?php echo 'StatementItems_'; ?>{{$index}}<?php echo '_description'; ?>"></textarea>
                                        </td>
                                        <td>
                                            <input style="width:80px" ng-change="rowTotal($index)"
                                                class="invoiceColThreeDetails text-center ng-valid ng-dirty" id="cel3-row1"
                                                name="<?php echo 'StatementItems['; ?>{{$index}}<?php echo ']quantity'; ?>"
                                                ng-model="item.quantity" placeholder="0" type="text" value="">
                                        </td>
                                        <td>
                                            <input style="width:80px" ng-change="rowTotal($index)"
                                                class="invoiceColFourDetails text-center ng-valid ng-dirty" id="cel4-row1"
                                                name="<?php echo 'StatementItems['; ?>{{$index}}<?php echo ']price'; ?>"
                                                ng-model="item.price" placeholder="0" type="text" real-time-currency>
                                        </td>
                                        <td style="font-weight:bolder">
                                            <b>{{rowTotal(item)}}</b>
                                        </td>
                                        <!-- <td>{{item.sequence}}</td>  -->
                                        <td>
                                            <a href="javascript:void(0)" class="remove-item"
                                                title="Delete row (Ctrl+Delete)" ng-click="deleteRow($index)">
                                                <i class="fa fa-cut"></i>
                                        </td>
                                    </tr>
                                    <!-- end ngRepeat: item in invoice.items -->

                                </tbody>

                            </table>
                        </form>

                        <table class=" pull-right">
                            <tr>
                                <td class="col-span2 editable">
                                    <span class="pull-left"> Total&nbsp;&nbsp; </span>
                                </td>

                                <td class="col-span2 editable no-border-left disabled-field">
                                    <b>{{subTotal()}}</b>
                                </td>
                            </tr>

                        </table>

                    </div>
                </div>
            </div>
            <?php if ($this->stmt->st_type == Statement::TYPE_INVOICE): ?>
                <div class="col-lg-2">
                    <div class="box box-primary">
                        <div class="box-tools pull-right">

                        </div>
                        <div class="box-body">

                            <span class="pull-left"><strong>Total</strong></span><span class="pull-right">{{subTotal()}}</span>
                            <div class="clearfix"></div>
                            <span class="pull-left"><strong>Paid</strong></span><span class="pull-right">
                                <?php if ($this->stmt->st_type == Statement::TYPE_INVOICE)
                                    echo Payments::makeMoney($this->stmt->getRelModel()->paymentsTotal); ?>
                            </span>
                            <div class="clearfix"></div>
                            <span class="pull-left"><strong>Balance</strong></span><span class="pull-right">
                                <?php echo Payments::makeMoney($this->stmt->getBalance()); ?>
                            </span>
                            <div class="clearfix"></div>
                            <div class="box-footer">
                                <?php echo CHtml::ajaxLink('<i class="fa fa-credit-card"></i> Detail ', '', array(
                                    'beforeSend' => 'function(){
                                                   BootstrapDialog.show({
                                                   title : "Payment History",
                                                    message: $("<div></div>").load("/statement/payments/id/' . $_GET["id"] . '.html")
                                                });
                                                   }'
                                ), array());
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
    </section>

<?php endif; ?>


<?php $this->endWidget('ext.yii-angularjs-helper.YiiAngularjsHelper'); ?>


<script>

    // Passing parameters to the script / controller without using placeholders:
    function setYiiParams(params) {
        // (setting them by reference)
        params.id = "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>";
        params.kf = "<?php echo $this->stmt->getRelModel()->{$this->stmt->getKeyField()}; ?>";
        params.todoDone = <?php echo (rand(0, 1) > 0 ? 'true' : 'false'); ?>;
        params.assetsFolder = '<?php echo $nginvoice->getAppAssetsUrl(); ?>';
    }
</script>