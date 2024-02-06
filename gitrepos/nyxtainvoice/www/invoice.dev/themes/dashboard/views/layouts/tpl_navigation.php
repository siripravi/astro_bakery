<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
    <div class="container">
    	
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
           
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
     
          <!-- Be sure to leave the brand out there if you want it shown -->
         <div style="width:auto; float:left;"> <img src="/images/prime_logo.png"></div>
          
          <div class="nav-collapse">
			 <?php
$this->widget('application.extensions.menu.SMenu',
array(
"menu"=>array(
  array("url"=>array(
               "route"=>"/site/index"),
               "label"=>'<i class="fa fa-home"></i>&nbsp;Home',
         /* array("url"=>array(
                       "route"=>"/invoice"
					   ),
                       "label"=>"Invoices",),  */
         /* array("url"=>array(
                      "route"=>"/quotation"),
                      "label"=>"Quotes",),*/
          /*array("url"=>"",
                       "label"=>"View Products",
          array("url"=>array(
                       "route"=>"/product/show",
                       "params"=>array("id"=>3),
                       "htmlOptions"=>array("title"=>"title")),
                       "label"=>"Product 3"),
            array("url"=>array(
                         "route"=>"/product/show",
                         "params"=>array("id"=>4)),
                         "label"=>"Product 4",
                array("url"=>array(
                             "route"=>"/product/show",
                             "params"=>array("id"=>5)),
                             "label"=>"Product 5")))*/
			),
          array("url"=>array(
                     //  "route"=>"/invoice"
                     ),
                       "label"=>"Invoices",
                       array("url"=>array(
                       "route"=>"/statement/create/type/2"),
                       "label"=>"New Invoice"), 
                       array("url"=>array(
                       "route"=>"/search/invoices"),
                       "label"=>"Search Invoice"), 
		),
          array("url"=>array(
                      // "route"=>"/quotation"
					  ),
                       "label"=>"Quotes",
					    array("url"=>array(
                       "route"=>"/statement/create/type/1"),
                       "label"=>"New Quote"), 
                       array("url"=>array(
                       "route"=>"/search/quotations"),
                       "label"=>"Search Quotes"), 
		), 
          array("url"=>array(
                       "route"=>"/payments/admin"),
                       "label"=>"Payments"),                          
          array("url"=>array(),
                       "label"=>"Master Data",
              
                  array("url"=>array(
                               "route"=>"/venue/admin"),
                               "label"=>"Venues"),
                  array("url"=>array(
                               "route"=>"/customer/admin"),
                               "label"=>"Customers",
                               "disabled"=>false),
					array("url"=>array(
                           "route"=>"/user/admin"),
                           "label"=>'<i class="fa  fa-lock"></i>&nbsp;Users',
						   "disabled"=>!Yii::app()->user->admin)		   
							   ),
		 array('label'=>'<i class="fa  fa-ok"></i>&nbsp;Login', "url"=>array('route'=>'/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', "url"=>array('route'=>'/site/logout'), 'visible'=>!Yii::app()->user->isGuest)	,				   
       /*   array("url"=>array(),
                       "label"=>"Documentation",
              array("url"=>array(
                           "link"=>"http://www.yiiframework.com",
                           "htmlOptions"=>array("target"=>"_BLANK")),
                           "label"=>"Yii Framework"),
              array("url"=>array(
                           "route"=>"site/spinnerDoc"),
                           "label"=>"Sspinner"),
              array("url"=>array(
                           "route"=>"site/calendarDoc"),
                           "label"=>"Scalendar"),
              array("url"=>array(
                           "route"=>"site/menuDoc"),
                           "label"=>"Smenu"),
                )*/
          ),
"stylesheet"=>"menu_green.css",
"menuID"=>"myMenu",
"delay"=>3
)
);
?>
	
    	</div>
    </div>
	</div>
</div>

<div class="subnav navbar navbar-fixed-top">
    <div class="navbar-inner">
    	<div class="container">
        
        	<div class="style-switcher pull-left">
                <a href="javascript:chooseStyle('none', 60)" checked="checked"><span class="style" style="background-color:#0088CC;"></span></a>
                <a href="javascript:chooseStyle('style2', 60)"><span class="style" style="background-color:#7c5706;"></span></a>
                <a href="javascript:chooseStyle('style3', 60)"><span class="style" style="background-color:#468847;"></span></a>
                <a href="javascript:chooseStyle('style4', 60)"><span class="style" style="background-color:#4e4e4e;"></span></a>
                <a href="javascript:chooseStyle('style5', 60)"><span class="style" style="background-color:#d85515;"></span></a>
                <a href="javascript:chooseStyle('style6', 60)"><span class="style" style="background-color:#a00a69;"></span></a>
                <a href="javascript:chooseStyle('style7', 60)"><span class="style" style="background-color:#a30c22;"></span></a>
          	</div>
           <form class="navbar-search pull-right" action="">
           	 
           <input type="text" class="search-query span2" placeholder="Search">
           
           </form>
    	</div><!-- container -->
    </div><!-- navbar-inner -->
</div><!-- subnav -->