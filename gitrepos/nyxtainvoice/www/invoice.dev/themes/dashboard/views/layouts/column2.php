<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/bs-main'); ?>
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
             <?php $this->renderPartial('//layouts/_side_nav');  ?>           
        <!--     -->
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
<div class="row">
    <?php if($this->action->id == "view" || ($this->id !== "payments" && $this->action->id == "update")):?>                
                <?php //$this->widget('application.components.MenuWidget');?>
        <?php else: ?>
        	    <?php  //$this->widget('UserMenu'); ?>    
       <?php endif;?> 
</div>
<div class="row-fluid">
    <div class="span5">		
	<div class="sidebar-nav"> 
	        	
           	
		</div>
        <br>
     
		<div class="well">
       
         <?php // $this->widget('PaymentsWidget'); ?>    
      </div>
        <div class="well">
            <?php // $this->widget('EmailWidget'); ?> 
        </div>    
    </div><!--/span-->
    <div class="span7" style="float:left;">
    
   
    
    <!-- Include content pages -->
    <?php echo $content; ?>

	</div><!--/span-->
  </div><!--/row-->


<?php $this->endContent(); ?>