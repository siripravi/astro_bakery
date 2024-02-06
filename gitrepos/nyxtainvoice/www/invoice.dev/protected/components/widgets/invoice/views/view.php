<?php
$nginvoice = $this->beginWidget(
    'ext.yii-angularjs-helper.YiiAngularjsHelper',
    array(
        'appName' => 'invApp',
        'appFolder' => dirname(__FILE__) . '/../assets/js/app4',
        'appScripts' => array('accounting.min.js', 'inv.js'),
        'commonAppScripts' => array(
            dirname(__FILE__) . '/../assets/js/common/config_httpProvider.js',
            dirname(__FILE__) . '/../assets/js/common/config_locationProvider.js',
        ),
        'requiredModulesScriptNames' => array('route', 'sanitize'),
        'concatenateAppScripts' => false,
        'debug' => false,
    )
);
?>
<div ng-app="invApp" ng-controller="InvCtrl">
    <div class="row">

    </div>
    <section class="invoice">
        <?php if ($this->stmt->primaryKey !== null): ?>
            <div class="card">
                <div class="header">
                    <h4 class="title"><i class="pe-7s-note2"></i> Item Details</h4>
                    <p class="category pull-right">
                        <ng-form>
                            <fieldset ng-disabled="isSaving" ng-show="invForm.$dirty">
                                <?php $event = null; ?>
                                <a class="btn btn-fill btn-warning" id="submit_item_button" ng-click="load($event)"
                                    name="myButton" role="button" aria-disabled="true"><i class="pe-7s-diskette"></i>
                                    SAVE</a>
                            </fieldset>
                        </ng-form>
                    </p>

                </div>
                <div class="content">

                    <form name="invForm">
                        <table class="table table-hover" id="table-sever-list">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Sr#</th>
                                    <th>Item </th>
                                    <th>Qty</th>
                                    <th>price</th>
                                    <th>Amount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in invoice.items" ng-hide="item.status == 3">
                                <tr class="grid-row ng-scope" ng-repeat="item in invoice.items" ng-hide="item.status == 3">
                                    <td>
                                        <a class="rowOption btn btn-sm" href="javascript:void(0)" title="Insert new row"
                                            ng-click="insertRow($index)">
                                            <i class="pe-7s-bottom-arrow"></i>
                                        </a>
                                    </td>
                                    <td><b>{{$index + 1}}</b>
                                        <input style="width:38px;display:none"
                                            id="<?php echo 'StatementItems_'; ?>{{$index}}<?php echo 'sequence'; ?>"
                                            name="<?php echo 'StatementItems['; ?>{{$index}}<?php echo ']sequence'; ?>"
                                            placeholder="1" type="text" value="{{$index + 1}}">
                                    </td>
                                    <td>
                                        <div ng-hide="editingData[$index + 1]"> {{item.description}} </div>
                                        <div ng-show="editingData[$index + 1] || (item.id == 0)"><textarea
                                                style="width:423px" ng-model="item.description"
                                                name="<?php echo 'StatementItems['; ?>{{$index}}<?php echo ']description'; ?>"
                                                id="<?php echo 'statemetItems_'; ?>{{$index}}<?php echo '_description'; ?>"></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div ng-hide="editingData[$index + 1]"> {{item.quantity}} </div>
                                        <textarea ng-show="editingData[$index + 1] || (item.id == 0)" style="width:80px"
                                            ng-change="rowTotal($index)"
                                            class="invoiceColThreeDetails text-center ng-valid ng-dirty" id="cel3-row1"
                                            name="<?php echo 'StatementItems['; ?>{{$index}}<?php echo ']quantity'; ?>"
                                            ng-model="item.quantity" placeholder="0" type="text" value=""
                                            ng-focus="item.quantity = null" ng-click="item.quantity = null"></textarea>
                                    </td>
                                    <td>
                                        <div ng-hide="editingData[$index + 1]"> {{item.price}} </div>
                                        <textarea ng-show="editingData[$index + 1] || (item.id == 0)" style="width:80px"
                                            ng-change="rowTotal($index)"
                                            class="invoiceColFourDetails text-center ng-valid ng-dirty" id="cel4-row1"
                                            name="<?php echo 'StatementItems['; ?>{{$index}}<?php echo ']price'; ?>"
                                            ng-model="item.price" placeholder="0" ng-click="item.price = null"
                                            ng-focus="item.price = null" type="text" real-time-currency></textarea>
                                    </td>
                                    <td style="font-weight:bolder">
                                        <b>{{rowTotal(item)}}</b>
                                    </td>
                                    <td>
                                        <div class="mailbox-controls" style="padding:5px;">
                                            <a class="rowOption  btn btn-sm" href="javascript:void(0)"
                                                title="Delete row (Ctrl+Delete)" ng-click="deleteRow($index)">
                                                <i class="pe-7s-junk"></i>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a class="rowOption  btn btn-sm" ng-hide="editingData[$index + 1]"
                                                ng-click="modify($index + 1)"><i class="pe-7s-pen"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            <!-- end ngRepeat: item in invoice.items -->
                        </table>

                    </form>
                    <div class="footer">
                        <a href="javascript:void(0)" class="add-item " title="Add new row (Ctrl+Enter)" ng-click="addRow()">
                            <i class="pe-7s-plus"></i> <b>Add Row</b>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th style="width:50%">Total:</th>
                                    <td>{{subTotal()}}</td>
                                </tr>
                                <?php if ($this->stmt->st_type == Statement::TYPE_INVOICE): ?>
                                    <tr>
                                        <th>Paid</th>
                                        <td>
                                            <?php if ($this->stmt->st_type == Statement::TYPE_INVOICE)
                                                echo Payments::makeMoney($this->stmt->getRelModel()->paymentsTotal); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Balance:</th>
                                        <td>
                                            <?php echo Payments::makeMoney($this->stmt->getRelModel()->getBalance()); ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        <?php endif; ?>
    </section>
</div>
<?php $this->endWidget('ext.yii-angularjs-helper.YiiAngularjsHelper'); ?>
<script>

    // Passing parameters to the script / controller without using placeholders:
    function setYiiParams(params) {
        // (setting them by reference)
        params.id = "<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>";
        params.kf = "<?php echo $pk; ?>";
        params.todoDone = <?php echo (rand(0, 1) > 0 ? 'true' : 'false'); ?>;
        params.assetsFolder = '<?php echo $nginvoice->getAppAssetsUrl(); ?>';
    }
</script>