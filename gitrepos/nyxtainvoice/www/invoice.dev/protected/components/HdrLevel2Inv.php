<?php

Yii::import('zii.widgets.CPortlet');

class HdrLevel2Inv extends CPortlet
{
	public $docId;
	public function init()
	{

		$this->title = "xx "; //CHtml::encode(Yii::app()->controller->id);
		parent::init();
	}

	protected function renderContent()
	{
		// $this->docId = (isset($_GET['id'])) ? $_GET['id'] : '';
		// $stmt = $this->loadDoc($this->docId);
		//	$this->render('hdrLevel2Inv');//, array('stmt' => $stmt));
	}


}