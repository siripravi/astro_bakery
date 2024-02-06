<h1>
    <?php echo $this->model->getHeader2() . " <strong><i>" . $this->model->getRelModel()->{$this->model->getKeyField()} . "</i></strong>"; ?>

    <small><b>Created By</b>:</td>
        <td> <span>
                <?php echo $this->stmt->getUserName($this->stmt->cuser_id) . " on " . Yii::app()->dateFormatter->formatDateTime($this->stmt->created, "medium", null) . " - "; ?>
            </span>
            Updated By:</b> <span>
                <?php echo $uhdr; ?>
            </span>
    </small>
</h1>
<ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
    <li class="active">Here</li>
</ol>
<?php if (($this->model->st_type == statement::TYPE_INVOICE) && ($this->model->itemsTotal) <= ($this->model->paymentsTotal) && (Yii::app()->user->admin))
: ?>
    <div class="btn-group btn-toggle pull-left">
        <button class="btn btn <?php echo ($this->model->paid == 0) ? 'btn-default ' : 'btn-success  active'; ?>"
            id="btn-status-paid">PAID</button>
        <button class="btn btn <?php echo ($this->model->paid == 0) ? 'btn-info active' : 'btn-default '; ?>"
            id="btn-status-unpaid">UNPAID</button>
    </div>
<?php endif; ?>

<div class="row col-lg-10">

    <div class="pull-right" style="position:relative">

        <div class="btn-group">
            <span style="margin:8px;">
                <?php
                if ($this->model->st_type == statement::TYPE_QUOTATION)
                    DialogBox::createDialogBox(
                        $this
                        ,
                        "myDialog1"
                        ,
                        "Make Invoice"
                        , '/statement/makeInv/id/' . $this->model->id
                        ,
                        "testinput"
                        ,
                        "btn btn-info btn-flat"
                        ,
                        "Make Invoice"
                        ,
                        320,
                        300
                        ,
                        '200px'
                    );
                ?>
            </span>

            <a id="pdf-gen-btn" class="btn btn-info btn" ng-disabled="invForm.$dirty"><i
                    class="fa fa-print"></i>&nbsp;PDF</a>
            <button class="btn btn-info btn dropdown-toggle" data-toggle="dropdown" name="yt11" type="button"
                ng-disabled="invForm.$dirty">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <?php echo CHtml::link('<i class="fa fa-globe"></i> View Pdf', array("statement/viewPdf", "id" => $this->model->id), array("target" => "_blank")); ?>

                </li>
            </ul>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown"
                aria-expanded="true" ng-disabled="invForm.$dirty">
                Other <span class="caret"></span>
            </button>
            <?php if ($this->model->st_type == statement::TYPE_INVOICE): ?>
                <ul class="dropdown-menu" role="menu">
                    <li>
                        <!--<a href="javascript:void(0)" id="btn-enter-payment" class="enter-payment" data-invoice-id="5" data-invoice-balance="795.60" data-redirect-to="http://demo.fusioninvoice.com/invoices/5/edit"><i class="fa fa-credit-card"></i> Enter Payment</a> -->
                        <?php
                        $this->widget('zii.widgets.jui.CJuiButton', array(
                            'buttonType' => 'link',
                            'name' => 'btnPay',
                            'caption' => '<i class="fa fa-credit-card"></i> Add Payment',
                            'onclick' => new CJavaScriptExpression('function(){
                                                $(\'[data-toggle="dropdown"]\').parent().removeClass("open");
                                                 BootstrapDialog.show({
                                                  title: "Add Payment",
                                                  type: BootstrapDialog.TYPE_SUCCESS,
                                                message: $("<div></div>").load("/statement/pay?id=' . $this->model->id . '"),
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
                            'htmlOptions' => array('id' => 'btn-add-payment', 'class' => 'enter-payment')
                        )
                        );

                        ?>

                    </li>
                    <li>
                        <?php if ($this->sLink !== "#"): ?>
                            <a href="<?php echo $sLink; ?>.html" class="" target="_blank">
                                <i class="fa fa-location-arrow"></i> Packing Slip
                            </a>
                        <?php endif; ?>
                    </li>
                    <li>

                    </li>
                    <!--<li><a href="javascript:void(0)" id="btn-copy-invoice"><i class="fa fa-copy"></i> Copy Invoice</a></li>
                <li><a href="javascript:void(0)" id="btn-recur-invoice"><i class="fa fa-refresh"></i> Recur Invoice</a></li>
        <li><a href="http://demo.fusioninvoice.com/client_center/invoice/oszJtemCmoJUGSwml3c9idqoo04IUiQT" target="_blank"><i class="fa fa-globe"></i> Public</a></li>
                <li class="divider"></li>
                <li><a href="http://demo.fusioninvoice.com/invoices/5/delete" onclick="return confirm('Are you sure you wish to delete this record?');"><i class="fa fa-trash-o"></i> Delete</a></li>
                -->
                </ul>
            <?php endif; ?>
            <?php if ($this->model->st_type == statement::TYPE_QUOTATION): ?>
                <ul class="dropdown-menu" role="menu">
                    <li>

                    </li>
                    <li>

                    </li>
                </ul>
            <?php endif; ?>
        </div>

        <div class="btn-group">
            <!--<a href="http://demo.fusioninvoice.com/quotes" class="btn btn-default"><i class="fa fa-backward"></i> Back</a>  -->
        </div>

        <div class="btn-group">
            <ng-form>
                <fieldset ng-disabled="isSaving">
                    <span>
                        <?php
                        $event = null;
                        $this->widget(
                            'zii.widgets.jui.CJuiButton',
                            array(
                                'name' => 'myButton',
                                'caption' => 'Save',
                                'buttonType' => 'link',
                                //'type' => 'primary',
                                // 'buttonType'=>'submit', // this was needed
                                'options' => array(
                                    'icons' => array(
                                        'primary' => 'ui-icon-disk input-prepend',
                                    )
                                ),
                                'htmlOptions' => array("class" => "btn btn-success btn-save-invoice", "id" => "submit_item_button", "ng-click" => "load($event)",
                                ),
                                'onclick' => 'js:function(){
						    	$(this).attr("value","Saving...");
								//$("#btn-done").
						        //alert("Data saved");
						        return false;}',
                            )
                        );
                        ?>
                    </span>

                    <!--<input  id="submit_item_button" type="submit"  value="Save" class="btn btn-lg bg-olive btn-save-invoice"   ng-click="load($event)"/> -->
                    <!--    	<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
           -->
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#" class="btn-save-invoice" data-apply-exchange-rate="1">Save and Apply Exchange
                                Rate</a></li>
                    </ul>
                </fieldset>
            </ng-form>
        </div>
    </div>

    <h1 class="pull-left">

        <span>
            <?php /* $this->widget('zii.widgets.jui.CJuiButton',array(
                                  'buttonType'=>'link',
                                  'name'=>'btnSaveCust',
                                  'caption'=>'<i class="fa fa-exchange"></i> Change',
                                  'onclick'=>new CJavaScriptExpression('function(){
                                           BootstrapDialog.show({
                                            title: "Edit Invoice",
                                            type: "BootstrapDialog.TYPE_SUCCESS",
                                          message: $("<div></div>").load("/statement/chgHdr?id='.$this->model->getRelModel()->st_id.'"),
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
                                  'htmlOptions' => array('id'=>'btn-chg-hdr','class'=>'btn btn-default btn-sm')
                              ));
                 */?>
        </span>
    </h1>
    <span class="label label-info" ng-show="invForm.$dirty">
        <blink>Not Saved!</blink>
    </span>

    <!--<span style="margin-left: 10px;" class="label label-default">Not Viewed</span>  -->
    <div class="clearfix"></div>


</div>
<div class="clearfix"></div>
<script>
    $(function () {


        $('#btn-status-paid').on('click', function (e) {
            e.preventDefault();
            var that = this;
            $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl('/statement/setPaid', array('id' => $this->model->id)); ?>",
                type: "POST",
                beforeSend: function () { $(that).text("Working.."); $(that).prop('disabled', true); },
                data: {
                    paid: "1"
                },
                success: function (result) {
                    //$(that).text("PDF"); //$(that).prop('disabled', false);
                    BootstrapDialog.alert({
                        title: "success!", message: "Invoice set as paid!",
                        callback: function (result) { location.reload(); }
                    });

                }
            });


        });
        $('#btn-status-unpaid').on('click', function (e) {
            e.preventDefault();
            var that = this;
            $.ajax({
                url: "<?php echo Yii::app()->createAbsoluteUrl('/statement/setPaid', array('id' => $this->model->id)); ?>",
                type: "POST",
                beforeSend: function () { $(that).text("Working.."); $(that).prop('disabled', true); },
                data: {
                    paid: "0"
                },
                success: function (result) {
                    //$(that).text("PDF"); //$(that).prop('disabled', false);
                    BootstrapDialog.alert({
                        title: "success!", message: "Invoice set as Unpaid!",
                        callback: function (result) { location.reload(); }
                    });

                }
            });


        });
        $('#pdf-gen-btn').on('click', function (e) {

            e.preventDefault();
            var that = this;
            $.ajax({
                url: "<?php echo $link; ?>",
                type: "POST",
                beforeSend: function () { $(that).text("Working.."); $(that).prop('disabled', true); },
                data: {
                    event_type: $(that).data("ev")
                },
                success: function (result) {
                    $(that).data("ev", "10");
                    $(that).text("PDF"); //$(that).prop('disabled', false);
                    BootstrapDialog.alert({ title: "success!", message: "PDF successfully generated!" });

                }
            });


        });
    });
</script>