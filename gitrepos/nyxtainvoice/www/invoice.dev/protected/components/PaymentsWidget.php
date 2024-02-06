<?php

class PaymentsWidget extends CWidget
{
    public $model;
    public $id;

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
        // $assDir = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets');
        // Yii::app()->clientScript->registerScriptFile($assDir . '/js/tabs.js', CClientScript::POS_END);
    }

    public function init()
    {
        $this->publishAssets();
        $this->id = !empty($_GET['id']) ? $_GET['id'] : '';
        $this->model = $this->controller->loadModel($this->id);
        /*$this->link = "/statement/doc.pdf/id/" . $this->id;
        $this->uLink = "/statement/update/id/" . $this->id;
        $this->vlink = $this->model->getFileName();
        $this->sLink = ($this->model->st_type == 2) ? "/statement/slip/id/" . $this->id : '#';
        $this->header = $this->model->getHeader2() . " " . $this->model->{$this->model->getKeyField()};
        $this->chdr = $this->model->getUserName($this->model->cuser_id) . " on " . Yii::app()->dateFormatter->formatDateTime($this->model->created, "medium", null);
        $this->uhdr = $this->model->getUserName($this->model->uuser_id) . " on " . Yii::app()->dateFormatter->formatDateTime($this->model->modified, "medium", null);
         * 
         */
    }

    public function hasRef()
    {
        return (!empty($this->model->invoice->ref_id));
    }

    public static function getPayMode($data, $row)
    {
        //if(is_null($paid)) return $paid; //null shows all records
        //if(is_numeric($switch)) return $paid; //here we save an ability to search with `0` or `1` value
        //if(empty($data->paid))
        //   ;
        switch ($data->MODE_ID) {
            case '1':
                return '<small class="badge pull-left bg-green">Chq</small>';
                //all fields with `switch` = 1
                break;
            case '2':
                return '<small class="badge pull-left bg-purple">Csh</small>';
                //all fields with `switch` = 1
                break;
            case '3':
                return '<small class="badge pull-left bg-orange">Ccd</small>';
                //all fields with `switch` = 1
                break;
            case '4':
                return '<small class="badge pull-left bg-olive">Dep</small>';
                //all fields with `switch` = 1
                break;
        }
    }

    /**
     * Run Widget and display
     */
    public function run()
    {
        $pmt = new Payments;
        $this->render('payments', array(
            'pmt' => $pmt,
            'stmt' => $this->model,
            'dp' => new CArrayDataProvider($this->model->payments, array('keyField' => 'ID'))
        )
        );
    }

}