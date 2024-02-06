<?php

Yii::import('zii.widgets.CPortlet');

class HdrLevel2 extends CPortlet
{


	public function init()
	{


		parent::init();
	}

	protected function renderContent()
	{
		// $this->docId = (isset($_GET['id'])) ? $_GET['id'] : '';
		// $stmt = $this->loadDoc($this->docId);
		$this->render('hdrLevel2'); //, array('stmt' => $stmt));

	}


}