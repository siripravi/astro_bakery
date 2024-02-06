<?php

class MenuWidget extends CWidget
{
	public $model;
	public $id;
	public $link;
	public $vlink;
	public $sLink;
	public $uLink;
	public $header;
	public $chdr;
	public $uhdr;

	public static function actions()
	{
		return
			array(
				'pdf' => 'application.components.actions.getPdf',
				'items' => 'application.components.actions.getItems',
			);
	}

	public function publishAssets()
	{
		//$assDir = Yii::app()->assetManager->publish(dirname(__FILE__).'/assets');
		//Yii::app()->clientScript->registerScriptFile( $assDir. '/js/tabs.js',CClientScript::POS_END);

	}
	public function init()
	{
		$this->publishAssets();
		$this->id = !empty($_GET['id']) ? $_GET['id'] : '';
		$this->model = $this->controller->loadModel($this->id);
		$this->link = "/document/doc.pdf/id/" . $this->id;
		$this->uLink = "/document/update/id/" . $this->id;
		//$this->vlink = $this->model->getFileName();
		//$this->sLink = ($this->model->st_type == 2)?"/document/slip/id/".$this->id: '#';
		//$this->header = $this->model->getHeader2()." ".$this->model->{$this->model->getKeyField()};
		// $this->chdr = $this->model->getUserName($this->model->cuser_id)." on ".Yii::app()->dateFormatter->formatDateTime($this->model -> created,"medium",null);
		//	$this->uhdr = $this->model->getUserName($this->model->uuser_id)." on ".Yii::app()->dateFormatter->formatDateTime($this->model -> modified,"medium",null);
	}

	public function hasRef()
	{
		return (!empty($this->model->invoice->ref_id));
	}
	/**
	 * Run Widget and display
	 */
	public function run()
	{
		$this->render('myMenu', array(
			'link' => $this->link,
			'vlink' => $this->vlink,
			'sLink' => $this->sLink,
			'ulink' => $this->uLink,
			'header' => $this->header,
			'chdr' => $this->chdr,
			'uhdr' => $this->uhdr
		)
		);
	}

}