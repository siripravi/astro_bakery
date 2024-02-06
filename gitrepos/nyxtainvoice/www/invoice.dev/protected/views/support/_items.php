<div class="col-xs-12 table-responsive">
    <div class="box box-default">
        <div class="box-header h4">aaa Items</div>
        <div class="box-body">
            <table class="todo-list table table-bordered table-responsive" id="table-sever-list">
                <thead>
                    <tr>
                        <th></th>
                        <th>Sr#</th>
                        <th>Item </th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in invoice.items" ng-hide="item.status == 3">
                    <tr class="grid-row ng-scope" ng-repeat="item in invoice.items" ng-hide="item.status == 3">

                        <td>
                            <a class="rowOption" href="javascript:void(0)" title="Insert new row"
                                ng-click="insertRow($index)">
                                <i class="fa fa-arrow-circle-o-down fa-2x"></i>
                            </a>
                        </td>
                        <td><b>{{$index + 1}}</b>
                            <input style="width:38px;display:none"
                                id="<?php echo 'statementItems_'; ?>{{$index}}<?php echo 'sequence'; ?>"
                                name="<?php echo 'statementItems['; ?>{{$index}}<?php echo ']sequence'; ?>"
                                placeholder="1" type="text" value="{{$index + 1}}">
                        </td>
                        <td>
                            <div ng-hide="editingData[$index + 1]"> {{item.DESCRIPTION}} </div>
                            <div ng-show="editingData[$index + 1] || (item.ID == 0)"><textarea style="width:423px"
                                    ng-model="item.DESCRIPTION"
                                    name="<?php echo 'statementItems['; ?>{{$index}}<?php echo ']DESCRIPTION'; ?>"
                                    id="<?php echo 'statemetItems_'; ?>{{$index}}<?php echo '_DESCRIPTION'; ?>"></textarea>
                            </div>
                        </td>
                        <td>
                            <div ng-hide="editingData[$index + 1]"> {{item.QUANTITY}} </div>
                            <input ng-show="editingData[$index + 1] || (item.ID == 0)" style="width:80px"
                                ng-change="rowTotal($index)"
                                class="invoiceColThreeDetails text-center ng-valid ng-dirty" id="cel3-row1"
                                name="<?php echo 'statementItems['; ?>{{$index}}<?php echo ']QUANTITY'; ?>"
                                ng-model="item.QUANTITY" placeholder="0" type="text" value="">
                        </td>
                        <td>
                            <div ng-hide="editingData[$index + 1]"> {{item.PRICE}} </div>
                            <input ng-show="editingData[$index + 1] || (item.ID == 0)" style="width:80px"
                                ng-change="rowTotal($index)" class="invoiceColFourDetails text-center ng-valid ng-dirty"
                                id="cel4-row1" name="<?php echo 'statementItems['; ?>{{$index}}<?php echo ']PRICE'; ?>"
                                ng-model="item.PRICE" placeholder="0" type="text" real-time-currency>
                        </td>
                        <td style="font-weight:bolder">
                            <b>{{rowTotal(item)}}</b>
                        </td>

                        <td>
                            <div class="mailbox-controls" style="padding:5px;">
                                <a class="rowOption" href="javascript:void(0)" title="Delete row (Ctrl+Delete)"
                                    ng-click="deleteRow($index)">
                                    <i class="fa fa-cut fa-2x"></i>
                                </a>
                                &nbsp;&nbsp;
                                <a class="rowOption" ng-hide="editingData[$index + 1]" ng-click="modify($index + 1)"><i
                                        class="fa fa-pencil-square-o fa-2x"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
                <!-- end ngRepeat: item in invoice.items -->
            </table>
        </div>
    </div>

</div>