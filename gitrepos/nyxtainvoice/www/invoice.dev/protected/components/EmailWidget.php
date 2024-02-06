<?php

class EmailWidget extends CWidget
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
        //$assDir = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets');
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
        $model = new ContactForm();
        $invoice = $this->model;
        //$invoice = $stmt -> invoice;
        $model->name = "Prime Party Rentals";
        $model->subject = "Invoice from Prime Party Rentals";
        $model->email = $invoice->customer->email1;
        //$model -> cc = 'purnachandra.valluri@gmail.com';
        //$invoice->statement->customer->email2;
        $model->filename = Yii::app()->basePath . '/../' . $invoice->getFileName(); //Yii::app() -> basePath . '/../files/invoices/' . $id . '.pdf';

        $model->body = "Please find the attached invoice";

        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if (!empty($model->cc)) {
                $model->cc = preg_replace('/\s+/', '', $model->cc);
                $toMailStr = $model->email . ',' . $model->cc;
            } else {
                $toMailStr = $model->email;
            }
            $toMailArr = explode(",", $toMailStr);
            if ($model->validate()) {
                if ($model->contact($toMailArr)) {
                    Yii::app()->user->setFlash('contact', 'Email sent successfully');
                    //DialogBox::closeDialogBox('success', '/invoice/view/id/' . $id);
                    //return;
                    //return $this->refresh();
                    //Yii::app()->end();//$this->redirect(array('view','id'=>$id));
                } else {
                    return $this->renderPartial('message', array('model' => $model, ), false, true);
                }
            }
        }
        $this->render('message', array('model' => $model), false, true);
    }

}