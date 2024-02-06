<?php

class VenueController extends Controller
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
                'actions' => array('create', 'update', 'admin'),
                'expression' => '$user->isAuthor',
            ),
            array(
                'allow',
                // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'expression' => '$user->isAdmin',
            ),
            /* array('deny', // deny all users
                 'users' => array('*'),
             ),*/
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $this->layout = 'false';
        $model = new Venue;
        $flag = false;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Venue'])) {
            $model->attributes = $_POST['Venue'];
            if ($model->validate() && $model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    $lst = array('posted' => 'success', 'id' => $model->primaryKey);
                    echo json_encode($lst);
                    Yii::app()->end();
                }
            }
            //$this->redirect(array('view','id'=>$model->venue_id));
            else {
                $flag = true;
                // $ary = array_merge( $model->getErrors(),$stmt->getErrors());
                $ary = $model->getErrors();
                $lst = array();
                foreach (array_keys($ary) as $k) {
                    $v = $ary[$k];
                    $lst = array_merge($lst, array_values($v));
                }
                echo json_encode($lst);
                Yii::app()->end();
            }
        }
        if (!$flag)
            $this->renderPartial('create', array('model' => $model), false, true);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        //  $this->layout = false;
        $model = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Venue'])) {
            $model->attributes = $_POST['Venue'];
            Yii::log('Venue Update: ' . var_export($model->attributes, true), CLogger::LEVEL_WARNING, __METHOD__);
            $flag = false;
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    $lst = array('posted' => 'success', 'id' => $model->primaryKey);
                    echo json_encode($lst);
                    Yii::app()->end();
                } //$this->redirect(array('view','id'=>$model->venue_id));
            } else {
                $flag = true;
                // $ary = array_merge( $model->getErrors(),$stmt->getErrors());
                $ary = $model->getErrors();
                $lst = array();
                foreach (array_keys($ary) as $k) {
                    $v = $ary[$k];
                    $lst = array_merge($lst, array_values($v));
                }
                echo json_encode($lst);
                Yii::app()->end();
            }
        }
        $this->render('update', array('model' => $model));
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
        $dataProvider = new CActiveDataProvider('Venue');
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
        $model = new Venue('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Venue']))
            $model->attributes = $_GET['Venue'];

        $this->render('admin', array(
            'model' => $model,
        )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Venue the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Venue::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Venue $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'venue-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}