<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
	<?php
            $cs = Yii::app()->clientScript;
            $baseUrl = Yii::app()->theme->baseUrl;
            $cs->registerCssFile($baseUrl . '/plugins/select2/select2.css');
            $cs->registerScriptFile($baseUrl . '/plugins/select2/select2.min.js');
        ?>   

    <style>
    .row{margin-left:5px;}
    	.iframeDialog{
	height:500px;
}

    </style>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
</head>
<body>
  <div style="border: 1px solid #eee; border-radius: 5px; padding: 10px;margin-top: 10px;">
     
  	<?php echo $content; ?>
  </div>
</body>    
</html>
