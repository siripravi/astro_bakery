<?php

class SiteController extends Controller
{
    public $layout = '//layouts/bs-main';
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }


    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        // Yii::app()->theme = "support";
        // $this->layout = "main";
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $model = new statement('search');
        $key = null;
        $filepath = null;
        $header = null;
        if (Yii::app()->user->isGuest)
            $this->redirect(array('/site/login'));
        if (isset($_GET['query'])) {
            $filename = $_GET['query'];
            $fchar = substr($filename, 0, 1);
            switch ($fchar) {
                case '1':
                    $key = "quotation_id";
                    $header = "QUOTE";
                    $filepath = '/files/quotations/' . $filename . '.pdf';
                    $model = Quotation::model()->find(
                        'quotation_id = :someVarName',
                        array(
                            ':someVarName' => $filename,
                        )
                    );
                    // echo $model->primaryKey; die();
                    break;
                case '2':
                    $key = "invoice_id";
                    $header = "INVOICE";
                    $model = Invoice::model()->find(
                        'invoice_id = :someVarName',
                        array(
                            ':someVarName' => $filename,
                        )
                    );
                    $filepath = '/files/invoices/' . $filename . '.pdf';
                    break;
            }
        }

        $this->render('index', array('model' => $model, 'filepath' => $filepath, 'key' => $key, 'header' => $header));
        //  $this->render('home',array());

    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionXContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                    "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" .
                    "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->renderPartial('contact', array('model' => $model));
    }

    public function actionSuccess()
    {

        $this->render('success');
    }

    /**
     * Ajax Sample
     */
    public function actionQtnModl()
    {
        /* $message = $_POST['message'];
          echo BsHtml::alert(BsHtml::ALERT_COLOR_INFO, "<strong>Message:</strong>{$message}");
          Yii::app()->end(); */
        $model = new Quotation();
        if (isset($_POST['Quotation'])) {
            $model->st_type = 1;

            $model->quotation_id = $_POST['Quotation']['quotation_id'];
        }
        $stmt = new statement();
        if (isset($_POST['statement'])) {
            $stmt->st_type = 1;
            $stmt->closed = 0;
            //print_r($stmt->getErrors());Yii::app()->end();
            $stmt->attributes = $_POST['statement'];
        }


        if ($stmt->validate() && $stmt->save()) {

            $model->st_id = $stmt->id;
            if ($model->save())
                $this->redirect(array('angularHelper/default/qtnApp', 'id' => $model->quotation_id));
        }
        $this->renderPartial('_qtn', array('model' => $model, 'stmt' => $stmt), false, true);
    }

    /**
     * Ajax Sample
     */
    public function actionInvModl()
    {
        $model = new Invoice();
        if (isset($_POST['Invoice'])) {
            $model->st_type = 1;

            $model->invoice_id = $_POST['Invoice']['invoice_id'];
        }
        $stmt = new statement();
        if (isset($_POST['statement'])) {
            $stmt->st_type = 1;
            $stmt->closed = 0;
            //print_r($stmt->getErrors());Yii::app()->end();
            $stmt->attributes = $_POST['statement'];
        }


        if ($stmt->validate() && $stmt->save()) {

            $model->st_id = $stmt->id;
            if ($model->save())
                $this->redirect(array('angularHelper/default/invApp', 'id' => $model->invoice_id));
        }
        $this->renderPartial('_inv', array('model' => $model, 'stmt' => $stmt), false, true);
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

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionCopyrightJson()
    {
        /* $json = json_encode(
          $this->renderInternal(
          'themes/fusion/views/site/pages/copyright.php',
          null,
          TRUE
          )
          ); */
        if (isset($_GET['q']) && ($keyword = trim($_GET['q'])) !== '') {
            $tags = Customer::model()->suggestTags($keyword);
        } else {
            // $tag = Customer::model()->findByPk($id);
            // $tags[] = array('id' =>(int)$tag->customer_no,'text' => $tag->first_name." ".$tag->last_name     );
        }
        //  header('Content-type: application/json');
        echo CJSON::encode($tags, true);
        // echo $tags;
        Yii::app()->end();
        // return;
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

}