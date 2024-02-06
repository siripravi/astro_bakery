<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>PrimeInvoice</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <?php
        $cs = Yii::app()->clientScript;
        $baseUrl = Yii::app()->theme->baseUrl;
        $skin = 'green';
    ?>  
    <?php
       
     ///   $cs->registerCssFile($baseUrl . '/assets/css/bootstrap.min.css');
        $cs->registerCssFile($baseUrl . '/assets/css/animate.min.css');
        $cs->registerCssFile($baseUrl . '/css/daterangepicker.css');
        $cs->registerCssFile($baseUrl . '/assets/css/light-bootstrap-dashboard.css');
       
      //  $cs->registerCssFile($baseUrl . '/css/skins/skin-'.$skin.'.min.css');
        $cs->registerCssFile($baseUrl . '/css/bootstrap-dialog.css');
        $cs->registerCssFile($baseUrl.'/css/ccard.css');
        $cs->registerCssFile($baseUrl.'/css/jquery.timepicker.css');
        $cs->registerCssFile($baseUrl.'/assets/css/demo.css');
        
        $cs->registerCssFile($baseUrl.'/plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css');
       // $cs->registerCssFile($baseUrl.'/css/invoice.css');
       // $cs->registerCssFile($baseUrl.'/css/invstyle.css');
        $cs->registerCssFile( $baseUrl. '/plugins/select2/select2.css');
        
        ?>
     <?php
        $scriptmap = Yii::app()->clientScript;
        $scriptmap->scriptMap = array(
            'jquery.min.js' => $baseUrl.'/js/jquery-2.0.2.min.js',
            'jquery-ui-1.9.2.min.js' =>$baseUrl.'/js/jquery-ui.min.js',
            'coreScriptPosition' => CClientScript::POS_END,
            'jquery.js' => false,
            //'jquery.min.js'=>false,
           // 'jquery-ui.min.js' => false
        );
        
           $cs->registerScriptFile('jquery.min.js', CClientScript::POS_HEAD);
        ?>   
      
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="<?php echo $baseUrl;?>/assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
    
</head>
<body> 

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="<?php echo $baseUrl;?>/assets/img/sidebar-5.jpg">    
    <!--   
        
        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" 
        Tip 2: you can also add an image using data-image tag
        
    -->
    
    <div class="sidebar-wrapper">
            <div class="logo">
                <a href="/" class="simple-text">
                    Prime Invoicing
                </a>
            </div>
                       
            <ul class="nav">
                <li class="active">
                    <a href="dashboard.html">
                        <i class="pe-7s-graph"></i> 
                        <p>Dashboard</p>
                    </a>            
                </li>
                <li>
                    <a href="/search/quotations.html">
                        <i class="fa fa-angle-double-right"></i><p>Quotes</p>
                    </a> 
                </li>
                <li>
                    <a href="/search/invoices.html" style="margin-left: 10px;">
                    <i class="fa fa-angle-double-right"></i> <p>Invoices</p>
                    </a>
                </li>
                <li>
                    <a href="table.html">
                        <i class="pe-7s-note2"></i> 
                        <p>Table List</p>
                    </a>        
                </li>
                <li>
                    <a href="typography.html">
                        <i class="pe-7s-news-paper"></i> 
                        <p>Typography</p>
                    </a>        
                </li>
                <li>
                    <a href="icons.html">
                        <i class="pe-7s-science"></i> 
                        <p>Icons</p>
                    </a>        
                </li>
                <li>
                    <a href="maps.html">
                        <i class="pe-7s-map-marker"></i> 
                        <p>Maps</p>
                    </a>        
                </li>
                <li>
                    <a href="notifications.html">
                        <i class="pe-7s-bell"></i> 
                        <p>Notifications</p>
                    </a>        
                </li>
                <li>
                    <a href="/venue/admin.html">
                        <i class="fa fa-angle-double-right"></i><p>Venues</p>
                    </a> 
                </li>
                <li>
                    <a href="/customer/admin.html">
                        <i class="fa fa-angle-double-right"></i><p>Customers</p>
                    </a> 
                </li>
                 
            </ul> 
       
    	</div>
    </div>
    
    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">    
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">       
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
                                    <span class="notification">5</span>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
                            </a>
                        </li> 
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">                        
                        <li>
                            <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Primary',
    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
    'size'=>'large', // null, 'large', 'small' or 'mini'
)); ?>
                             <?php
                                $this->widget('bootstrap.widgets.TbButton', array(
                                        'label'=> 'Add Quote', 
                                         'type'=>'primary',
                                        'buttonType' => 'ajaxLink',
                                        'ajaxOptions' => array(
                                        'beforeSend' => new CJavaScriptExpression('function(){                                               
                                                 BootstrapDialog.show({
                                                 title : "Create New Quote",
                                                message: $("<div></div>").load("/statement/create/type/1.html"),
                                                cssClass: "stmt-dialog",
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
                                                 return false;}')
                                    )));
                                ?>
                           
                        </li>
                        <li>
                          
                             <?php
                                $this->widget('bootstrap.widgets.TbButton', array(
                                        'label'=> 'Add Invice', 
                                        'type'=>'primary',
                                        'buttonType' => 'ajaxLink',
                                        'ajaxOptions' => array(
                                        'beforeSend' => new CJavaScriptExpression('function(){                                               
                                                 BootstrapDialog.show({
                                                 title : "Create New Invoice",
                                                message: $("<div></div>").load("/statement/create/type/2.html"),
                                                cssClass: "stmt-dialog",
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
                                                 return false;}')
                                    )));
                                ?>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Dropdown
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                  <li>
                                       <?php 
                                            /*  echo TbHtml::button(
                                                 'Generate PDF',
                                                array(
                                                'htmlOptions' => array(
                                                    'onclick' => 'js:$.ajax({
                                                        url: "/statement/doc.pdf/id/'.$stmt->id.'",
                                                        type: "POST",
                                                        data: { event_type: js:$(this).data("ev")},
                                                        beforeSend: function () {                
                                                            $(this).prop("disabled", true);
                                                        },
                                                        success: function (result) {                   
                                                            BootstrapDialog.alert({title: "success!", message: "PDF successfully generated!"});
                                                        }    
                                                    });',
                                                    "id"=>"pdf-gen-btn",
                                                )
                                            )
                                        );         */ ?>
                                  </li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                             
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
            </div>
        </nav>
                     
                     
        <div class="content">
            <div class="container-fluid">
                <?php echo $content;?>
                
           </div>      
        </div>
        
        
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Home
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Company
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                Portfolio
                            </a>
                        </li>
                        
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; 2015 <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                </p>
            </div>
        </footer>
        
    </div>   
</div>


</body>

 <?php
      
     
   //   $cs->registerScriptFile($baseUrl . '/assets/js/bootstrap.min.js', CClientScript::POS_END);
      //  $cs->registerScriptFile($baseUrl . '/assets/js/bootstrap-checkbox-radio-switch.js', CClientScript::POS_END);
      //  $cs->registerScriptFile($baseUrl . '/assets/js/chartist.min.js', CClientScript::POS_END);
      //  $cs->registerScriptFile($baseUrl . '/assets/js/bootstrap-notify.js', CClientScript::POS_END);
         
        $cs->registerScriptFile($baseUrl . '/js/bootstrap-dialog.js', CClientScript::POS_END);
        
        $cs->registerScriptFile($baseUrl . '/js/moment.min.js', CClientScript::POS_END);
        
        $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.date.extensions.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.extensions.js', CClientScript::POS_END);
        
        $cs->registerScriptFile($baseUrl . '/js/daterangepicker.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', CClientScript::POS_END);
     //   $cs->registerScriptFile($baseUrl . '/js/invoice.js', CClientScript::POS_END); 
     
    ///    $cs->registerScriptFile($baseUrl. '/plugins/select2/select2.min.js',CClientScript::POS_END);
    ?>      
   
<script>   
        $('#event-dt-range').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                   // 'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Next 7 Days': [moment().add('days', 6), moment()],
                  //  'Next 30 Days': [moment().add('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Next Month': [moment().startOf('month'), moment().add('month', 1).endOf('month')]
                  },
                  startDate: moment().add('days', 1),
                  endDate: moment().add('month', 1).endOf('month')
                },
        function (start, end, label) {
             console.log("Callback has been called!");
          $('#event-dt-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          $("#from_date").val(start.format('YYYY-MM-DD'));
                  $("#to_date").val(end.format('YYYY-MM-DD'));
                //  $('#statement-grid').yiiGridView('update');
              //    $.updateGridView("statement-grid", "Statement[to_date]", end.format('YYY-MM-DD'));
        }
        );
        $('#event-dt-range').on('hide.daterangepicker', function(ev, picker) { 
                  $("#from_date").val(picker.startDate.format('YYYY-MM-DD'));
                  $("#from_dt").html(picker.startDate.format('YYYY-MM-DD'));
                  $("#to_date").val(picker.endDate.format('YYYY-MM-DD'));
                  $("#to_dt").html(picker.endDate.format('YYYY-MM-DD'));
                  
                  $("#filter_id").find('input').val("");
                //  $('#statement-grid').yiiGridView('update');
                //  $.updateGridView("statement-grid", "to_date", picker.endDate.format('YYY-MM-DD'));
                  $("#ev-dt-filter-div").show();
                  
                  $("#page-form").submit();
                  
        });    


</script>
    
</html>