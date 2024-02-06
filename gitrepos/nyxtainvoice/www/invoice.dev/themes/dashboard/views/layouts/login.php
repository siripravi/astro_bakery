<!DOCTYPE html>
<html>
    
<!-- Mirrored from demo.fusioninvoice.com/login by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Oct 2014 19:32:01 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

        <link href="favicon.png" rel="icon" type="image/png">
          <?php
        $cs = Yii::app()->clientScript;
        $baseUrl = Yii::app()->theme->baseUrl;
        $skin = 'green';
    ?>  
        <?php Yii::app()->bootstrap->register(); ?>
    <?php
       $cs->registerCssFile($baseUrl.'/assets/css/pe-icon-7-stroke.css');
     //   $cs->registerCssFile($baseUrl . '/assets/css/bootstrap.min.css');
        $cs->registerCssFile($baseUrl . '/assets/css/animate.min.css');
     //   $cs->registerCssFile($baseUrl . '/css/daterangepicker.css');
        $cs->registerCssFile($baseUrl . '/assets/css/light-bootstrap.css');
        $cs->registerCssFile($baseUrl . '/assets/css/demo.css');
        
        ?>
       
     
        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,300italic,400italic,600italic' rel='stylesheet' type='text/css'>
        <style>
        
        </style>
    </head>
      <body class="windows-os">
    <div class="wrapper wrapper-full-page">
        
    <div class="full-page login-page" data-color="orange" data-image="../../assets/img/full-screen-image-1.jpg">   
        
    <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        <div class="content">
            <div class="container">
                <div class="row">                   
                    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                      
                         <?php echo $content; ?>                          
                         
                    </div>                    
                </div>
            </div>
        </div>
    	
   	<footer class="footer footer-transparent">
            <div class="container">
               <!--  <nav class="pull-left">
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
                        <li>
                            <a href="#">
                               Blog
                            </a>
                        </li>
                    </ul>
                </nav>  -->
                <p class="copyright pull-right">
                    © 2016 <a href="#">caringtutors.com</a>
                </p>
            </div>
        </footer>

    <div class="full-page-background" style="background-image: url(../../assets/img/full-screen-image-1.jpg) "></div>
        
    </div>                             
       
</div>
 
        
    </body>

</html>