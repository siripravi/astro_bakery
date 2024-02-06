<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="google" value="notranslate">

  <title>Prime Support</title>

  <?php   
           $cs = Yii::app()->clientScript;
           //Yii::app()->theme = "fusion";
           $baseUrl = Yii::app()->theme->baseUrl;
           // $cs->registerCssFile($baseUrl . '/css/page.css');
          // $cs->registerCssFile($baseUrl . '/css/font-awesome.min.css');
            $cs->registerScriptFile($baseUrl . '/assets/js/jquery.min.js');
        ?>   
        <?php Yii::app()->bootstrap->register(); ?>
  <?php $cs->registerCssFile($baseUrl.'/plugins/bootcards-1.1.2/dist/css/bootcards-desktop.css'); 
      //  $this->model->ship_date = (isset(Yii::app()->session['ship_date'])) ? Yii::app()->session['ship_date'] : '';
                    
  ?>
  
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" />

</head >

<body  onload="document.search_form.query.focus()">

  <!-- fixed top navbar -->
  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <button type="button" class="btn btn-default btn-back pull-left hidden" onclick="history.back()">
        <i class="fa fa-lg fa-chevron-left"></i>
        <span>Back</span>
      </button>
      <!-- menu button to show/ hide the off canvas menu -->
      <button type="button" class="btn btn-default btn-menu pull-left" data-toggle="offcanvas">
        <i class="fa fa-lg fa-bars"></i><span>Menu</span>
      </button>

      <a class="navbar-brand" title="Bootcards Starter" href="/">Prime Support</a>  

      <!--navbar menu options: shown on desktop only -->
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
        <!--  <li>
            <a href="#">
              <i class="fa fa-dashboard"></i> Dashboard
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-building-o"></i> Companies
            </a>
          </li>
          <li class="active">
            <a href="#">
              <i class="fa fa-font"></i> Contacts
            </a>
          </li>  -->
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
    </div>
  </div>   


  <div class="container bootcards-container push-right">
  
    <!-- This is where you come in... -->
    <!-- I've added some sample data below so you can get a feel for the required markup -->

    <div class="row">
      <!-- left list column -->
      <div class="col-sm-4 bootcards-list" id="list" data-title="Contacts">
        <div class="panel panel-success">       
          <div class="panel-heading">
            <form  name="search_form">
            <div class="search-form">
              <div class="row">
                <div class="col-xs-8">
                  <div class="form-group">
                      <div class="input-group">
                         
                    <?php
         $this->widget('zii.widgets.jui.CJuiDatePicker', array(                
                       // 'model' => $model,
                        'name' => 'ship_date',
                       // 'attribute' => 'ship_date',
                        'value' => (isset(Yii::app()->session['ship_date'])) ? Yii::app()->session['ship_date'] : '',
                        'options' => array(
                            // 'showOn' => 'both',
                            'dateFormat' => 'M-dd-yy',
                            //  'altFormat' => 'mm-dd-yy',
                          //  'altFormat' => 'yy-mm-dd',
                            'showAnim' => 'slide',
                          //  'altField' => '#Statement_ship_date',
                            // 'buttonImage' => '<i class="fa fa-save"></i>',
                            // 'buttonImageOnly' => false,
                           // 'minDate' => '0'
                        ),
                        'htmlOptions' => array(                           
                            'style' => 'width:176px',
                            'maxlength' => 20,
                            'class' => 'evDate form-control',
                            'placeholder' => 'Event Date',
                            //'readonly' => 'readonly',
                            //'value'=>CTimestamp::formatDate('m-d-Y'),
                            'style' => 'z-index:9999;',
                            "autocomplete" => "off"
                        ),
                    ));
                         ?>   <span class="input-group-addon"><i class="fa fa-calendar"></i></span>   
                    <!--<input type="hidden" name="query"  id="faq_search_input" class="form-control" > -->
                    <?php //echo CHtml::activeHiddenField($model, 'ship_date'); ?>
                      </div>
                  </div>
                </div>
               
              </div>                
            </div> 
              </form>
              
          </div><!--panel heading-->
          <div class="panel-body">
          <div class="list-group" id="searchresultdata">
               <?php    if (isset($this->clips['searchClip']))
                           echo $this->clips['searchClip']; 
         
              ?>
          </div><!--list-group-->
          </div>  
          <div class="panel-footer">
            <small class="pull-left">Results</small>
            <a class="btn btn-link btn-xs pull-right" href="#">
              Top</a>
          </div>
        </div><!--panel-->

        </div><!--list-->

        <!--list details column-->
        <div class="col-sm-8 bootcards-cards hidden-xs">
             <?php echo $content;  ?>
        </div><!--list-details-->

    </div><!--row-->


  </div><!--container-->

  <!-- fixed tabbed footer -->
  <div class="navbar navbar-default navbar-fixed-bottom">

    <div class="container">

      <div class="bootcards-desktop-footer clearfix">
        <p class="pull-left">Prime Party Rentals</p>
      </div>
    </div>

  </div><!--footer-->

  

    <!-- Bootstrap & jQuery core JavaScript
    ================================================== -->
     <?php 
        
       $cs->registerScriptFile($baseUrl . '/plugins/bootcards-1.1.2/dist/js/bootcards.min.js', CClientScript::POS_END);
        ?>

    <script type="text/javascript">


    </script>
  </body>
</html>
