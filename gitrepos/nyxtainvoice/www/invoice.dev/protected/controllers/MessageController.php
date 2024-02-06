<?php

class MessageController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/bs-main';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }


    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                // allow all users to perform 'index' and 'view' actions
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array(
                'allow',
                // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('sendEmail'),
                'expression' => '$user->isAuthor',
            ),
            array(
                'allow',
                // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'expression' => '$user->isAdmin',
            ),
            array(
                'deny',
                // deny all users
                'users' => array('*'),
            ),
        );
    }


    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('statement');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        )
        );
    }

    public function actionSendEmail($id)
    {
        //$this -> layout = '//layouts/dialoglayout';
        $model = new ContactForm();
        $invoice = $this->loadModel($id);
        //$invoice = $stmt -> invoice;
        $model->name = "Prime Party Rentals";
        $model->subject = "Invoice from Prime Party Rentals";
        $model->email = $invoice->statement->customer->email1;
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
                    //    DialogBox::closeDialogBox('success', '/quotation/viewPdf/id/' . $id . '?sent=true');
                    //return;
                    //return $this->refresh();
                    //Yii::app()->end();//$this->redirect(array('view','id'=>$id));
                } else {
                    return $this->renderPartial('contact', array('model' => $model, ), false, true);
                }
            }
        }
        $this->renderPartial('contact', array('model' => $model), false, true);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return statement the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $statement = statement::model()->findByPk($id);
        $model = $statement->relModel;
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param statement $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'statement-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /**
     * Performs the AJAX validation.
     * @param Invoice $model the model to be validated
     */
    protected function performAjaxValidation2($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'payments-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public static function getPaid($data, $row)
    {
        //if(is_null($paid)) return $paid; //null shows all records
        //if(is_numeric($switch)) return $paid; //here we save an ability to search with `0` or `1` value
        //if(empty($data->paid)) ;
        if ($data->paid == 1) {
            return '<small class="badge pull-left bg-green">P</small>'; //all fields with `switch` = 1
        } else {
            return '<small class="badge pull-left bg-red">U</small>'; //all fields
        }
    }

}