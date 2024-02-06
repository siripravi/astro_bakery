<?php

class SupportController extends Controller
{
    public $ship_date;
    public $model;
    public function beforeRender($view)
    {
        $model = new statement("search");
        $this->ship_date = (isset(Yii::app()->session['ship_date'])) ? Yii::app()->session['ship_date'] : '';

        if ($this->ship_date) {
            $results = $model->freeSearch($this->ship_date);
            $this->renderPartial('//layouts/clips/_search_clip', array('results' => $results));

        }
        return parent::beforeRender($view);
    }

    public function accessRules()
    {
        return array(

            array(
                'allow',
                'actions' => array('index'),
                'expression' => '$user->isSupport'
            ),
            array(
                'deny',
                // deny all users
                'users' => array('*'),
            ),
        );
    }


    public function actionIndex()
    {
        //$this->render('index');
        $this->layout = 'support';
        $model = new Statement('search');
        $flag = false;
        $key = null;
        $header = 'INVOICE';
        if (Yii::app()->user->isGuest)
            $this->redirect(array('/site/login'));
        if (isset($_GET['query']) && isset($_GET['doc_type'])) {
            $flag = true;
            $query = $_GET['query'];
            $doc_type = $_GET['doc_type'];


            switch ($doc_type) {
                case '1':
                    $key = "quotation_id";
                    $header = "QUOTE";
                    $this->model = Quotation::model()->find(
                        'quotation_id = :someVarName',
                        array(
                            ':someVarName' => $query,
                        )
                    );
                    // echo $model->primaryKey; die();
                    break;
                case '2':
                    $key = "invoice_id";
                    $header = "INVOICE";
                    $this->model = Invoice::model()->find(
                        'invoice_id = :someVarName',
                        array(
                            ':someVarName' => $query,
                        )
                    );

                    break;
            }
            $results = $model->freeSearch($this->model->statement->ship_date);
        }
        if ($flag)
            $this->render('index', array('model' => $this->model, 'key' => $key, 'header' => $header, 'results' => $results));
        else
            $this->render('index', array('model' => $this->model, 'key' => $key, 'header' => $header));

    }

    public function actionSearchEngine($keyword)
    {
        //  echo "THIS IS IAJAXX  ".$keyword;

        $model = new statement();
        $model->unsetAttributes(); // clear any default values
        $results = $model->freeSearch($keyword);
        $this->renderPartial('_ajax_search', array(
            'results' => $results,
        )
        );
    }


    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        // Yii::app()->theme = "fusion";
        $this->layout = "login";
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    public function actionLogout()
    {
        Yii::app()->user->logout(false);
        $this->redirect(Yii::app()->getModule('support')->user->loginUrl);
    }

}