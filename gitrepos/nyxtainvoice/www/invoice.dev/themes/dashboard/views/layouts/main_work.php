<!DOCTYPE html>
<html lang="en">
    <head content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Prime Party Rentals">
        <meta name="author" content="prime party rentals">
        <link href='http://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <?php
        $cs = Yii::app()->clientScript;
        $baseUrl = Yii::app()->theme->baseUrl;
        $skin = 'green';
        
        
        ?>   

        <!-- Fav and Touch and touch icons -->
        <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/img/icons/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-57-precomposed.png">

        <?php
        $cs->registerCssFile($baseUrl . '/css/font-awesome.min.css');
        $cs->registerCssFile($baseUrl . '/css/bootstrap.min.css');
        $cs->registerCssFile($baseUrl . '/css/AdminLTE.css');
       // $cs->registerCssFile($baseUrl . '/css/style.css');
        $cs->registerCssFile($baseUrl . '/plugins/daterangepicker/daterangepicker-bs3.css');
      //  $cs->registerCssFile($baseUrl . '/css/skins/skin-'.$skin.'.min.css');
        $cs->registerCssFile($baseUrl . '/css/bootstrap-dialog.css');
        $cs->registerCssFile($baseUrl.'/css/ccard.css');
        $cs->registerCssFile($baseUrl.'/css/jquery.timepicker.css');
        $cs->registerCssFile($baseUrl.'/css/style.css');
        ?>

        <?php
        $cs->registerScriptFile($baseUrl . '/js/bootstrap.min.js');
       // $cs->registerScriptFile($baseUrl . '/js/select2.min.js');
       // $cs->registerScriptFile($baseUrl . '/js/app.js');
        $cs->registerScriptFile($baseUrl . '/js/bootstrap-dialog.js');
        
         $cs->registerScriptFile($baseUrl . '/js/moment.min.js');
         $cs->registerScriptFile($baseUrl . '/plugins/daterangepicker/daterangepicker.js');
         $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.js');
         $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.date.extensions.js');
         $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.extensions.js');
         $cs->registerScriptFile($baseUrl . '/js/bootstrap-dialog.js');
         
     //    $cs->registerScriptFile($baseUrl . '/js/creditcardjs-v0.10.12.min.js');   
        ?>

    
    </head>

    <body class="skin-<?php echo $skin;?> fixed" style="min-height: 825px;">
        <header class="header">
            <a href="/" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>P</b>rimeINVOICING</span>
                <!-- logo for regular state and mobile devices -->               
              </a>
           
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle Navigtion</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li> <div class="">
                                <label class="badge"> <?php echo Statement::getQtnNumberRange(); ?></label>
                                &nbsp;/&nbsp;
                                <label class="badge"> <?php echo Statement::getInvNumberRange(); ?></label>
                            </div>
                        </li>
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Help">
                                <i class="fa fa-question-circle"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="https://www.fusioninvoice.com/docs" target="_blank">Documentation</a></li>
                                <li><a href="https://www.fusioninvoice.com/support" target="_blank">Customer Support</a></li>
                            </ul>
                        </li>
                        <?php if (Yii::app()->user->admin): ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="System">
                                    <i class="fa fa-cog"></i>
                                </a>

                                <ul class="dropdown-menu">
                                    <li><a href="/user/admin"><i class="fa fa-users"></i>User Accounts</a></li>
                                    <li><a href="#">Custom Fields</a></li>                            
                                </ul>

                            </li>
                        <?php endif; ?>
                        <li>
                            <?php echo CHtml::link('<i class="fa  fa-ok"></i>&nbsp;Login', array('/site/login'), array('style' => (Yii::app()->user->isGuest) ? 'display:block;' : 'display:none;')); ?>
                            <?php echo CHtml::link('<i class="fa fa-power-off"></i> (' . Yii::app()->user->name . ')', array('/site/logout'), array('title' => 'logout', 'style' => (Yii::app()->user->isGuest) ? 'display:none;' : 'display:block;')); ?>

                        </li>

                    </ul>
                </div>
              
            </nav>

        </header>
        
    <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 617px;">
        
         <aside class="left-side sidebar-offcanvas" style="min-height: 825px;">

                <section class="sidebar">
               
                    <ul class="sidebar-menu">
                        
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-building-o"></i>
                                <span>Venues</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="#" style="margin-left: 10px;">
                                        <?php
                                        $this->widget('zii.widgets.jui.CJuiButton', array(
                                            'buttonType' => 'link',
                                            'name' => 'btnSaveCust',
                                            'caption' => '<i class="fa fa-building-o"></i> New Venue',
                                            'onclick' => new CJavaScriptExpression('function(){
                                                 BootstrapDialog.show({
                                                  title: "<i class=\'fa fa-building-o\'>  Create New Venue",
                                                  type: BootstrapDialog.TYPE_SUCCESS,
                                                   closeByBackdrop: false,
                                                message: $("<div></div>").load("/venue/create"),
                                                onShown:function(dialog){
                                                  alert("showng..");
                                                  dialog.getModalFooter().hide();
                                                },
                                                onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                                buttons: [{
                                                    label: "Cancel",
                                                      cssClass: "label label-warning pull-left",
                                                    action: function(dialogRef){
                                                        dialogRef.close();
                                                    },
                                                   
                                                }]
                                            });
                                                this.blur(); 
                                                return false;}'),
                                            'htmlOptions' => array('id' => 'btn-new-venue', 'class' => '')
                                        ));
                                        ?>
                                </li>
                                <li>
                                    <a href="/venue/admin.html">
                                        <i class="fa fa-angle-double-right"></i>View Venues </a> 
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Customers</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiButton', array(
                                        'buttonType' => 'link',
                                        'name' => 'btnNewCust',
                                        'caption' => '<i class="fa fa-user"></i> New Customer',
                                        'onclick' => new CJavaScriptExpression('function(){
                                                 BootstrapDialog.show({
                                                  title: "<i class=\'fa fa-users\'></i> Create New Customer",
                                                  type: BootstrapDialog.TYPE_SUCCESS,
                                                   closeByBackdrop: false,
                                                message: $("<div></div>").load("/customer/create"),
                                                onshown:function(dialogRef){
                                                    $("#Customer_PHONE1").inputmask("mask", {"mask": "(999) 999-9999"});
                                                 },
                                                onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                                buttons: [{
                                                    label: "Cancel",
                                                    cssClass: "label label-warning  pull-left",
                                                    action: function(dialogRef){
                                                        dialogRef.close();
                                                    }
                                                }]
                                            });
                                                this.blur(); 
                                                return false;}'),
                                        'htmlOptions' => array('id' => 'btn-new-customer', 'class' => '')
                                    ));
                                    ?>
                                </li>
                                <li><a href="/customer/admin.html" style="margin-left: 10px;" ><i class="fa fa-angle-double-right"></i> View Customers</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-text-o"></i>
                                <span>Quotes</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li id="new-qtn-create" style="display:none">
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiButton', array(
                                        'buttonType' => 'link',
                                        'name' => 'btnSave',
                                        'caption' => 'Create Quote',
                                        'onclick' => new CJavaScriptExpression('function(){
                                               
                                                 BootstrapDialog.show({
                                                 title : "Create New Quote",
                                                message: $("<div></div>").load("/statement/create/type/1.html"),
                                                closeByBackdrop: false,
                                                  onshown: function(dialogRef){
                                                       $("[data-toggle=\"tooltip\"]").tooltip({
                                                        "placement": "top"
                                                    }); 
                                                    $("[data-toggle=\"popover\"]").popover({
                                                        trigger: "hover",
                                                            "placement": "top"
                                                    });
                                                    },
                                                 onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                            });
                                                this.blur(); return false;}'),
                                    ));
                                    ?>

                                </li>
                                <li><a href="/search/quotations.html" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> View Quotes</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-text"></i>
                                <span>Invoices</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <li id="new-inv-create" style="display:none">
                                    <?php
                                    echo CHtml::ajaxLink('<i class="fa fa-angle-double-right"></i>Create Invoice', '', array(
                                        'beforeSend' => 'function(){
                                              $(this).hide();
                                               BootstrapDialog.show({
                                                 title : "Create New Invoice",
                                                message: $("<div></div>").load("/statement/create/type/2.html"),
                                               closeByBackdrop: false,
                                               onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                                 onshown: function(dialogRef){
                                                       $("[data-toggle=\"tooltip\"]").tooltip({
                                                        "placement": "top"
                                                    }); 
                                                  $("[data-toggle=\"popover\"]").popover({
                                                        trigger: "hover",
                                                            "placement": "top"
                                                    });
                                                 },
                                            });
                                               }'
                                            ), array("style" => "margin-left: 10px;"));
                                    ?>

                                </li>
                                <li><a href="/search/invoices.html" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> View Invoices</a></li>
                            <!--    <li><a href="#" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> View Recurring Invoices</a></li>  -->
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-file-text"></i>
                                <span>Delivery</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <li id="new-delv-create">
                                   

                                </li>
                                <li><a href="/search/invoices.html" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> View Invoices</a></li>
                            <!--    <li><a href="#" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> View Recurring Invoices</a></li>  -->
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-credit-card"></i>
                                <span>Payments</span>
                                <i class="fa pull-right fa-angle-left"></i>
                            </a>
                            <ul class="treeview-menu" style="display: none;">
                                <li class="active"><a href="/payments/admin.html" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> View Payments</a></li>
                            </ul>
                        </li>

                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>Employees</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li>
                                    <?php
                                    $this->widget('zii.widgets.jui.CJuiButton', array(
                                        'buttonType' => 'link',
                                        'name' => 'btnNewEmp',
                                        'caption' => '<i class="fa fa-user"></i> New Employee',
                                        'onclick' => new CJavaScriptExpression('function(){
                                                 BootstrapDialog.show({
                                                  title: "<i class=\'fa fa-users\'></i> Create New Employee",
                                                  type: BootstrapDialog.TYPE_SUCCESS,
                                                   closeByBackdrop: false,
                                                message: $("<div></div>").load("/employee/create"),
                                                onshown:function(dialogRef){
                                                    $("#Customer_PHONE1").inputmask("mask", {"mask": "(999) 999-9999"});
                                                 },
                                                onhidden: function(dialogRef){
                                                       // alert("Dialog is popped down.");
                                                   location.reload();
                                                },
                                                buttons: [{
                                                    label: "Cancel",
                                                    cssClass: "label label-warning  pull-left",
                                                    action: function(dialogRef){
                                                        dialogRef.close();
                                                    }
                                                }]
                                            });
                                                this.blur(); 
                                                return false;}'),
                                        'htmlOptions' => array('id' => 'btn-new-employee', 'class' => '')
                                    ));
                                    ?>
                                </li>
                                <li><a href="/employee/admin.html" style="margin-left: 10px;" ><i class="fa fa-angle-double-right"></i> View Employees</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>

            </aside>    
            <aside class="right-side">     
                <?php echo $content; ?>            
            </aside> 
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Prime Party Rentals</a>.</strong> All rights reserved.
      </footer>      
        </div>   <!--  wrapper   -->
    

            <script>
                $(document).ready(function () {
                    $("#new-qtn-create").show();
                    $("#new-inv-create").show();
                    $("#new-delv-create").show();
                });
             
   
            </script> 
           
    </body>
</html>