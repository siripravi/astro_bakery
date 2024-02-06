<?php

class PaymentsController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = 'bs-main';

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
                'actions' => array('admin', 'create', 'update', 'pay', 'updatePmt', 'createPmt'),
                'expression' => '$user->isAuthor',
            ),
            array(
                'allow',
                // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete', 'setPaid'),
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
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial('view', array(
                'model' => $this->loadModel($id),
                'asDialog' => !empty($_GET['asDialog']),
            ), false, true);
            Yii::app()->end();
        } else
            $this->render('view', array(
                'model' => $this->loadModel($id),
            )
            );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    /* public function actionCreate() {
         $model = new Payments;

         // Uncomment the following line if AJAX validation is needed
         $this->performAjaxValidation($model);

         if (isset($_POST['Payments'])) {
             $model->attributes = $_POST['Payments'];
             if ($model->save())
                 $this->redirect(array('view', 'id' => $model->ID));
         }

         $this->render('create', array(
             'model' => $model,
         ));
     }*/

    public function actionCreatePmt()
    {
        if (Yii::app()->request->isPostRequest) {
            $model = new Payments;
            $model->attributes = $_POST;
            if ($model->save()) {
                echo CJSON::encode(array('id' => $model->primaryKey));
            } else {
                $errors = array_map(function ($v) {
                    return join(', ', $v); }, $model->getErrors());
                echo CJSON::encode(array('errors' => $errors));
            }
        } else {
            throw new CHttpException(400, 'Invalid request');
        }
    }

    public function actionUpdatePmt()
    {
        $es = new EditableSaver('Payments');
        $es->onBeforeUpdate = function ($event) {
            $event->sender->setAttribute('modified', date('Y-m-d H:i:s'));
        };
        $es->update();

    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Payments'])) {
            $model->attributes = $_POST['Payments'];
            if ($model->save())
                $this->redirect(array('admin'));
        }

        $this->render('update', array(
            'model' => $model,
        )
        );
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider(
            'Payments',
            array(
                'sort' => array(
                    'defaultOrder' => 'pay_date DESC',
                    'multisort' => true,
                    //maybe your solution!
                    'attributes' => array(

                    ),
                )
            )
        );
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        )
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model = new Payments('search');
        $model->unsetAttributes(); // clear any default values
        $model->from_date = (empty($model->from_date)) ? date('m-d-Y', strtotime('yesterday')) : $model->from_date;
        $model->to_date = (empty($model->to_date)) ? date('m-t-Y', strtotime('next month')) : $model->to_date;
        if (isset($_GET['Payments']))
            $model->attributes = $_GET['Payments'];

        $this->render('admin2', array(
            'model' => $model,
        )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Payments the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Payments::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Payments $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'payments-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }




}