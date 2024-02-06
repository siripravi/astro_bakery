<?php

class CustomerController extends Controller
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
                'actions' => array('create', 'update', 'admin', 'batchUpdate', 'cards'),
                'expression' => '$user->isAuthor',
            ),
            array(
                'allow',
                // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                // 'users' => array('admin'),
                'expression' => '$user->isAdmin',
            ),
            /*array('deny', // deny all users
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
        //$this->layout = 'bs-main';
        $model = new Customer;
        $flag = false;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    $lst = array('posted' => 'success', 'id' => $model->primaryKey);
                    echo json_encode($lst);
                    Yii::app()->end();
                }
            } //$this->redirect(array('view','id'=>$model->customer_no));
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
            $this->renderPartial('create', array(
                'model' => $model,
            ), false, true);
    }

    public function actionBatchUpdate($id)
    {
        // $this->layout = "bs-main";
        // retrieve items to be updated in a batch mode
        // assuming each item is of model class 'Item'
        $items = $this->getItemsToUpdate();
        if (isset($_POST['CustomerCards'])) {
            $valid = true;
            foreach ($items as $i => $item) {
                if (isset($_POST['CustomerCards'][$i]))
                    $item->attributes = $_POST['CustomerCards'][$i];
                $valid = $item->validate() && $valid;
            }
            if ($valid) {
                foreach ($items as $i => $item) {
                    $item->customer_no = $id;
                    $item->save(false);
                }
                $lst = array('posted' => 'success', 'id' => $model->primaryKey);
                echo json_encode($lst);
                Yii::app()->end();
            } else {
                $ary = $item->getErrors();
                $lst = array();
                foreach (array_keys($ary) as $k) {
                    $v = $ary[$k];
                    $lst = array_merge($lst, array_values($v));
                }
                echo json_encode($lst);
                Yii::app()->end();
            }
        }
    }

    public function getItemsToUpdate()
    {
        // Create an empty list of records
        $items = array();

        // Iterate over each item from the submitted form
        if (isset($_POST['CustomerCards']) && is_array($_POST['CustomerCards'])) {
            foreach ($_POST['CustomerCards'] as $item) {
                // If item id is available, read the record from database 
                // if ( array_key_exists('id', $item) ){
                if ($item['id'] > 0) {
                    $items[] = CustomerCards::model()->findByPk($item['id']);
                }
                // Otherwise create a new record
                else {
                    $items[] = new CustomerCards();
                }
            }
        }
        return $items;
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);
        $cards = $model->cards;
        if (empty($cards))
            $cards[0] = new CustomerCards();
        //Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        if (isset($_POST['Customer'])) {
            $model->attributes = $_POST['Customer'];
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    $lst = array('posted' => 'success', 'id' => $model->primaryKey);
                    echo json_encode($lst);
                    Yii::app()->end();
                } //$this->redirect(array('view','id'=>$model->customer_no));
            }
        }
        /* $this->renderPartial('update',array(
          'model'=>$model,
          ),false,true); */
        $this->render('update', array(
            'model' => $model,
            'cards' => $cards
        )
        );
    }

    public function actionCards($id)
    {
        $this->layout = false;
        $this->render('cview');
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
        $dataProvider = new CActiveDataProvider('Customer');
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
        $model = new Customer('search');
        $model->unsetAttributes(); // clear any default values
        if (isset($_GET['Customer']))
            $model->attributes = $_GET['Customer'];

        $this->render('admin', array(
            'model' => $model,
        )
        );
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Customer the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Customer::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Customer $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'customer-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}