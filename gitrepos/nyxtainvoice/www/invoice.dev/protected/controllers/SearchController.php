<?php

class SearchController extends Controller
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
                'actions' => array('admin', 'index'),
                'expression' => '$user->isAuthor',
            ),
            array(
                'allow',
                // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
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

        $model = new SearchForm("search");
        if (isset($_POST['SearchForm'])) {
            $model->attributes = $_GET['SearchForm'];
        }
        $this->render('search', array(
            'model' => $model,
            'dp' => $model->search(),
        )
        );

    }
    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        //  $this->layout = 'search';
        if (isset($_POST['statement'])) {
            //  print_r($_POST);
            //  Yii::app()->end();
        }
        $model = new statement('search');
        $model->unsetAttributes(); // clear any default values

        $type = (isset($_GET['type'])) ? $_GET['type'] : null;
        $st_type = 0;

        if (isset($_GET['statement']))
            $model->attributes = $_GET['statement'];
        if (isset($_GET['invoice_id']))
            $model->invoice_id = (empty($model->to_date)) ? $_GET['invoice_id'] : null;

        if (isset($_GET['quotion_id']))
            $model->quotation_id = (empty($model->to_date)) ? $_GET['quotation_id'] : null;

        if (isset($_GET['customer_no']))
            $model->customer_name = $_GET['customer_no'];

        if (isset($_POST['from_date'])) {
            Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', $_POST['from_date']);
            $model->from_date = $_POST['from_date'];
        } else {
            if (isset(Yii::app()->request->cookies['from_date']))
                $model->from_date = Yii::app()->request->cookies['from_date'];
        }
        if (isset($_POST['to_date'])) {
            Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', $_POST['to_date']);
            $model->to_date = $_POST['to_date'];
        } else {
            if (isset(Yii::app()->request->cookies['to_date']))
                $model->to_date = Yii::app()->request->cookies['to_date'];
        }

        //echo $st_type;Yii::app()->end();
        switch ($type) {
            case 'invoices':
                $st_type = 2;
                $model->st_type = $st_type;
                $this->render('admin', array(
                    'model' => $model,
                    'dp' => $model->search(),
                )
                );
                break;
            case 'quotes':
                $st_type = 1;
                $model->st_type = $st_type;
                $this->render('admin2', array(
                    'model' => $model,
                    'dp' => $model->search(),
                )
                );
                break;
        }
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
        $model = statement::model()->findByPk($id);
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