<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="language" content="en" />

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <?php Yii::app()->bootstrap->register(); ?>
    <?php
        $cs = Yii::app()->clientScript;
        $baseUrl = Yii::app()->theme->baseUrl;
        $skin = 'green';
    ?>  
    <?php
       $cs->registerCssFile($baseUrl.'/assets/css/pe-icon-7-stroke.css');
       //$cs->registerCssFile($baseUrl . '/assets/css/bootstrap.min.css');
       $cs->registerCssFile($baseUrl . '/assets/css/animate.min.css');
       //$cs->registerCssFile($baseUrl . '/css/daterangepicker.css');
        $cs->registerCssFile($baseUrl . '/assets/css/light-bootstrap.css');
        $cs->registerCssFile($baseUrl . '/assets/css/icons.css');
        $cs->registerCssFile($baseUrl . '/assets/css/font-awesome.css');
        //$cs->registerCssFile($baseUrl . '/css/skins/skin-'.$skin.'.min.css');
        $cs->registerCssFile($baseUrl . '/css/bootstrap-dialog.css');
        $cs->registerCssFile($baseUrl.'/css/ccard.css');
        $cs->registerCssFile($baseUrl.'/css/jquery.timepicker.css');
     //   $cs->registerCssFile($baseUrl.'/assets/css/rotating-card.css');
        
     //   $cs->registerCssFile($baseUrl.'/plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css');
        $cs->registerCssFile($baseUrl.'/css/invoice.css');
  //      $cs->registerCssFile($baseUrl.'/css/invstyle.css');
    //   $cs->registerCssFile( $baseUrl. '/plugins/bootcards-1.1.2/dist/css/bootcards-desktop.min.css');
       // $cs->registerCssFile($baseUrl.'/css/demo.css'); 
         $cs->registerCssFile($baseUrl.'/plugins/bootstrap-daterangepicker/daterangepicker.css');
         $cs->registerCssFile($baseUrl.'/plugins/sweetalert/dist/sweetalert.css');
        ?>
        <style>
            .navbar{margin-bottom:0;}
            .sidebar[data-color="purple"]:after, .bootstrap-navbar[data-color="purple"]:after {
                background: #797979;
            }
            .nav-pills > li > a { border: 1px solid #333;}
            .sidebar .nav li:hover > a, .sidebar .nav > li.active > a, .sidebar .nav > li > a:hover, .sidebar .nav > li.active > a:focus{
                background-color: #666;
            }
           /* .container-fluid{padding-left:0px;}*/
            .main-panel{    width: calc(100% - 60px);}
                      
            section{padding:0;}
            .sidebar .nav li > a {
                color: #FFFFFF;
                margin: 20px 15px;
                opacity: .86;
                border-radius: 4px;
            }
            .sidebar .nav p{
                  margin: 0;
                  line-height: 30px;
                  font-size: 12px;
                  font-weight: 600;
                  text-transform: uppercase;
            }
            #hdr-tabs .tab-content{
                float: left;
                padding: 5px 15px;
                border: 3px solid #fff;
                height: auto;
                background-color: #fff;
            }
            #hdr-tabs .tab-content .panel{ border:none;}
            #hdr-tabs .tab-content .panel-info{ border: 1px solid #bce8f1; min-height:245px;}
            #exTab2 h3{
              color : white;
              background-color: #428bca;
              padding : 5px 15px;
            }
            /* remove border radius for the tab */
            #exTab1 .nav-pills > li > a {
              border-radius: 0;
            }

            /* change border radius for the tab , apply corners on top*/
            #exTab3 .nav-pills > li > a {
              border-radius: 4px 4px 0 0 ;
            }

            #exTab3 .tab-content {
              color : white;
              background-color: #428bca;
              padding : 5px 15px;
            }
        </style>
</head>

<body>
    <?php $this->renderPartial('//layouts/_side_nav2');  ?> 
<div class="wrapper">   
    <nav class="navbar navbar-default">
            <div class="container-fluid">    
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Invoicing</a>
                </div>  
                <ul class="nav navbar-nav navbar-left">
                    <li class="active"><a href="/site/index.html"><i class="pe-7s-home"></i> Home</a></li>
                  
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="pe-7s-search"></i> Search <span class="caret"></span></a><ul id="yw2" class="dropdown-menu">
                            <li><a tabindex="-1" href="/quotation/search"><i class="pe-7s-note2"></i> Quotes</a></li>
                            <li class="active"><a tabindex="-1" href="/invoice/search.html"><i class="pe-7s-news-paper"></i> Invoice</a></li>
                            <li><a tabindex="-1" href="/payments/admin"><i class="pe-7s-credit"></i> Payments</a></li>
                            
                        </ul>                            
                    </li>                    
                </ul>
                
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'New Quote',
                    'type' => 'info',
                    'icon'=>'pe-7s-plus',
                    'buttonType' => 'ajaxLink',
                    'ajaxOptions' => array(
                        'beforeSend' => new CJavaScriptExpression('function(){                                               
                                 BootstrapDialog.show({
                                 title : "Create New Quote",
                                message: $("<div></div>").load("/quotation/create"),
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
                                  // location.reload();
                                },
                            });
                                 return false;}')
                ),  'htmlOptions' =>array('class'=>'btn btn-fill btn-round')
                    ));
                ?> 
                      
            <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => ' New Invoice',
                    'type' => 'info',
                    'icon'=>'pe-7s-plus',
                    'buttonType' => 'ajaxLink',
                    'ajaxOptions' => array(
                        'beforeSend' => new CJavaScriptExpression('function(){                                               
                                 BootstrapDialog.show({
                                 title : "Create New Invoice",
                                message: $("<div></div>").load("/invoice/create"),
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
                                  // location.reload();
                                },
                            });
                                 return false;}')
                ),
                    'htmlOptions' =>array('class'=>'btn btn-success btn-round')
                    ));
                ?>
               <ul class="nav navbar-nav navbar-right">   
                   
              <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="pe-7s-server"></i> Master Data <span class="caret"></span></a>
                        <ul id="yw1" class="dropdown-menu">
                            <li><a tabindex="-1" href="/venue/admin"><i class="pe-7s-drop"></i> Venues</a></li>
                            <li><a tabindex="-1" href="/customer/admin"><i class="pe-7s-users"></i> Customers</a></li>
                            <li><a tabindex="-1" href="/employee/admin"><i class="pe-7s-user-female"></i> Employees</a></li>
                            
                        </ul>                            
                    </li>
                   <li class="dropdown"> <a class="btn btn-success btn-round btn btn-info">
                            <span class="label label-info"><?php echo Statement::getQtnNumberRange(); ?></span>&nbsp;|&nbsp;
                            <label class="label label-success">   <?php echo Statement::getInvNumberRange(); ?></label>
                            </a>
                        </li>
               </ul>    
             <?php $this->widget('bootstrap.widgets.TbMenu',array(
            'htmlOptions'=>array('class'=>'nav navbar-nav navbar-right'),
            'items'=>array(
                    array('label'=>'Login', 'url'=>array('/site/login'),'visible'=>Yii::app()->user->isGuest), 
                    
                    array('label'=> Yii::app()->user->name, 'url'=>'#', 'items'=>array(
                    
                    // array('label'=>'Another action', 'url'=>'#'),
                    // array('label'=>'Something else here', 'url'=>'#'),
                    
                    array('label'=>'User Admin','icon'=>'user', 'url'=>array('/user/admin'),'visible'=>(Yii::app()->user->isAdmin)),
                    array('label'=>'Logout ('.Yii::app()->user->name.')','icon'=>'off', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    
                )),
            ),
        ));
        ?>
                </div>
        </nav>
    <div class="main-panel">
    
        <div class="content">
             
            <div class="container-fluid">
                
                <?php $this->widget('HdrLevel2');  ?>
                <?php echo $content;?>             
            </div>      
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="/site/index.html">
                                 Home
                            </a>
                        </li>
                        
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; 2016 <a href="#">caringtutors.com</a>
                </p>
            </div>
        </footer>        
    </div>   
</div>
<?php
      //   $cs->registerScriptFile($baseUrl . '/assets/js/bootstrap.min.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/assets/js/bootstrap-checkbox-radio-switch.js', CClientScript::POS_END);
      //  $cs->registerScriptFile($baseUrl . '/assets/js/chartist.min.js', CClientScript::POS_END);
      //  $cs->registerScriptFile($baseUrl . '/assets/js/bootstrap-notify.js', CClientScript::POS_END);
         
   /*     $cs->registerScriptFile($baseUrl . '/js/bootstrap-dialog.js', CClientScript::POS_END);
        
        $cs->registerScriptFile($baseUrl . '/js/moment.min.js', CClientScript::POS_END);
        
        $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.date.extensions.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.extensions.js', CClientScript::POS_END);
        
        $cs->registerScriptFile($baseUrl . '/js/daterangepicker.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js', CClientScript::POS_END);
    */
    ?> 
    <?php
      //    $cs->registerScriptFile($baseUrl.'/bootcards-1.1.2/dist/js/bootcards.min.js',CClientScript::POS_END);
         //   $cs->registerScriptFile($baseUrl.'/js/select2.min.js',CClientScript::POS_END);
          
        $cs->registerScriptFile($baseUrl . '/js/bootstrap-dialog.js', CClientScript::POS_END);
           
        $cs->registerScriptFile($baseUrl . '/js/moment.min.js', CClientScript::POS_END);
        
       // $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.js', CClientScript::POS_END);
       // $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.date.extensions.js', CClientScript::POS_END);
       // $cs->registerScriptFile($baseUrl . '/plugins/input-mask/jquery.inputmask.extensions.js', CClientScript::POS_END);
        
        $cs->registerScriptFile($baseUrl . '/plugins/bootstrap-daterangepicker/daterangepicker.js', CClientScript::POS_END);
        $cs->registerScriptFile($baseUrl . '/plugins/sweetalert/dist/sweetalert.min.js', CClientScript::POS_END);
       // $cs->registerScriptFile($baseUrl.'/assets/js/light-bootstrap-dashboard.js',CClientScript::POS_END);
    ?>  
 
    <script>
        
    </script>    
    
</body>
    

</html>
