
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Prime Invoice</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        // $cs->registerCssFile($baseUrl . '/css/page.css');
        $cs->registerCssFile($baseUrl . '/css/font-awesome.min.css');
        ?>	


        <!-- Fav and Touch and touch icons -->
        <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/img/icons/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl; ?>/img/icons/apple-touch-icon-57-precomposed.png">

        <?php
        $cs->registerCssFile($baseUrl . '/css/font-awesome.min.css');
        $cs->registerCssFile($baseUrl . '/assets/css/bootstrap.min.css');
      //  $cs->registerCssFile($baseUrl . '/css/AdminLTE.css');
      //--  $cs->registerCssFile($baseUrl . '/css/style.css');
        //   $cs->registerCssFile($baseUrl.'/css/select2.min.css');
        //  $cs->registerCssFile($baseUrl.'/css/select2-bootstrap.css');
        ?>
        <!-- styles for style switcher -->


        <?php
        $cs->registerScriptFile($baseUrl . '/assets/js/bootstrap.min.js');
        $cs->registerScriptFile($baseUrl . '/js/select2.min.js');
        $cs->registerScriptFile($baseUrl . '/js/app.js');
        $cs->registerScriptFile($baseUrl . '/js/bootstrap-dialog.js');
        ?>

    </head>

    <body class="skin-blue fixed" style="min-height: 857px;">

        <header class="header">
            <a href="#" class="logo">PrimeInvoice</a>
            <nav class="navbar navbar-static-top" role="navigation">

                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>

                <div class="navbar-right">
                    <ul class="nav navbar-nav">

                    </ul>
                </div>
            </nav>

        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left" style="min-height: 857px;">
            <?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>
            <?php endif;?>
              <?php echo $content; ?>
            <div id="modal-placeholder"></div>

    </body>
</html>