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
     //   $cs->registerCssFile( $baseUrl. '/plugins/select2/select2.css');
        
        ?>
</head>

<body>

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                 array('label'=>'Quotes', 'url'=>array('/search/quotations')),
                array('label'=>'Invoices', 'url'=>array('/search/invoices')),
                array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
    ),
)); ?>

<div class="container" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->
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
   
  