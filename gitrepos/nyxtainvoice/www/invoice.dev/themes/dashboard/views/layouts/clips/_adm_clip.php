<?php $this->beginClip('adminMenuClip'); ?>
<div id="leftmenu" >
	<?php  $this->widget(
	'zii.widgets.CMenu',
	 //'application.extensions.menu.SMenu',         
	        array(
			'items'=>$this->adminMenu
			)
		); ?>
</div><!-- mainmenu -->
<?php  $this->endClip(); ?>