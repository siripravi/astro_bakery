<?php

class InvoiceController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/bs-main';
    public $invoice;
    public $customers;
    public $invoice_id;
    public $quotation_id;

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

    public function actions()
    {
        return array(
            'doc.' => array(
                'class' => 'application.components.MenuWidget',
                //   'modelName'=>'Profiles'  //$_GET['modelName']
            ),
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
                'actions' => array('chgInv', 'index', 'view', 'update', 'items', 'header', 'lineItems', 'chgDelivery', 'chgPackInstructions'),
                'users' => array('*'),
            ),
            array(
                'allow',
                // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'doc.items', 'viewPdf', 'search', 'payments', 'update', 'slip', 'setPaid', 'pay', 'pdf', 'noPdf', 'pay', 'payHist', 'sendEmail', 'preview', 'doc.pdf'),
                'expression' => '$user->isAuthor',
            ),
            array(
                'allow',
                'actions' => array('admin', 'delete'),
                'expression' => '$user->isSupport'
            ),
            /* array('deny', // deny all users
                 'users' => array('*'),
             ), */
        );
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $search = new SearchForm('search');
        $search->unsetAttributes(); // clear any default values
        if (isset($_GET['SearchForm']))
            $search->attributes = $_GET['SearchForm'];
        $model = new Invoice;
        $this->render('/search/admin', array(
            'model' => $model,
            'dp' => $search->search(),
        )
        );
    }

    public function actionViewPdf($id)
    {
        $this->layout = false;
        $stmt = $this->loadModel($id);
        $filename = $stmt->getFileName() . '?q=' . microtime(true);
        $this->renderPartial('vpdf', array('stmt' => $stmt, 'filename' => $filename), false, true);
    }
    /**
     * Default action
     */
    public function actionIndex()
    {
        $this->adminMenu = array(
            //  array('label' => 'Messages'),	
            array('label' => 'Crate', 'url' => array('/statement/create', 'type' => 2), 'active' => true),
            array('label' => 'List', 'url' => array('/search/invoices')),
            //  array('label' => 'Sent', 'url' => array('/demo1/message/sent')),
            // array('label' => 'Account', 'icon' => 'phone', 'url' => array('/demo1/message/account'))
        );
        $this->render('default');
    }

    public function actionChgInv()
    {
        $es = new EditableSaver('Invoice');
        /*$es->onBeforeUpdate = function($event) {
            if(!$event->sender->validate()){
                $event->sender->error('Error in value');
            }    
        };*/
        $es->onBeforeUpdate = function ($event) {
            $event->sender->setAttribute('update_time', date('Y-m-d H:i:s'));
            $event->sender->setAttribute('uuser_id', Yii::app()->user->id);
        };
        $es->update();
    }

    public function actionCreate($id = null)
    {
        $this->layout = false;
        $flag = false;
        $invoice = $this->loadInv($id); //new Invoice();
        $statement = $this->loadStmt($id); //new Statement();

        //  $this->performAjaxValidation(array($invoice,$statement));
        if (isset($_POST['Invoice'], $_POST['Statement'])) {
            // populate input data to $a and $b
            $invoice->attributes = $_POST['Invoice'];
            $statement->attributes = $_POST['Statement'];

            // validate BOTH $a and $b
            $valid = $invoice->validate();
            $valid = $statement->validate() && $valid;

            if ($valid) {
                $flag = true;
                // use false parameter to disable validation
                $statement->closed = '0';
                $statement->st_type = Statement::TYPE_INVOICE;

                if ($statement->save(false)) {
                    $invoice->st_id = $statement->primaryKey;
                    $invoice->st_type = Statement::TYPE_INVOICE;
                    $invoice->cuser_id = Yii::app()->user->id;
                    $invoice->pack_instr = "";
                    $invoice->uuser_id = Yii::app()->user->id;
                    if ($invoice->save(false)) {
                        if (Yii::app()->request->isAjaxRequest) {
                            $lst = array('posted' => 'success', 'id' => $invoice->invoice_id);
                            echo json_encode($lst);
                            Yii::app()->end();
                        }
                    }
                }
                // $this->redirect('document/update',array('id'=>$invoice->invoice_id));
            } else {
                $flag = false;
                // $ary = array_merge( $model->getErrors(),$stmt->getErrors());
                $ary = array_merge($statement->getErrors(), $invoice->getErrors());
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
            $this->renderPartial('create', array('statement' => $statement, 'invoice' => $invoice), false, true);
    }

    public function actionPayments($id)
    {
        $this->layout = false;
        $invoice = $this->loadModel($id);
        $this->render('payments', array(
            'pmt' => new Payments,
            'stmt' => $invoice,
            'dp' => new CArrayDataProvider($invoice->payments, array('keyField' => 'id'))
        )
        );

    }

    public function actionSlip($id)
    {
        $this->layout = "pslip";
        $mode = !(empty($_GET['mode'])) ? $_GET['mode'] : "full";
        $model = $this->loadDoc($id);
        $this->render('slip', array('model' => $model, 'print' => $mode));
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

    public function actionPay($id)
    {
        $this->layout = false;
        $model = new Payments;
        $invoice = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
        //  $this->performAjaxValidation2($model);

        if (isset($_POST['Payments'])) {
            $flag = false;
            $model->attributes = $_POST['Payments'];
            $model->invoice_id = $invoice->st_id;
            $valid = $model->validate();
            if ($valid) { //echo 'valid';die;
                $flag = true;
                // use false parameter to disable validation

                if ($model->save()) {
                    $flag = true;
                    if (Yii::app()->request->isAjaxRequest) {
                        $lst = array('posted' => 'success', 'id' => $invoice->invoice_id);
                        echo json_encode($lst);
                        Yii::app()->end();
                    }
                }
                $this->redirect('/invoice/update', array('id' => $invoice->invoice_id));
            } else {
                $flag = false;
                // $ary = array_merge( $model->getErrors(),$stmt->getErrors());
                $ary = $model->getErrors(); //print_r($ary);die;
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
            $this->renderPartial('_pay', array(
                'pmt' => $model,
                'stmt' => $invoice,
                //'dp' => new CArrayDataProvider($model->payments, array('keyField' => 'ID'))
            ), false, true);
    }

    public function actionUpdate($id)
    {
        // $this->layout = "column2";
        $this->invoice = $this->loadDoc($id);
        // $model = $this->loadModel($id);

        $this->render('update', array(
            'stmt' => $this->invoice,
            'dp' => new CArrayDataProvider($this->invoice, array('keyField' => 'st_id', 'id' => 'stmt-dp'))
        )
        );
    }

    public function actionSearch()
    {
        $search = new SearchForm('search');
        $model = new Invoice("search");
        $dataProvider = $search->search();

        if (isset($_POST['Invoice'])) {
            $model->attributes = $_POST['Invoice'];
            $dataProvider = $model->search();
        }
        if (isset($_GET['Invoice']['is_paid'])) {
            $model->is_paid = $_GET['Invoice']['is_paid'];
            $dataProvider = $model->search();
            // print_r($_GET['Invoice']); die;
        }

        // uncomment the following code to enable ajax-based validation
        /*
          if(isset($_POST['ajax']) && $_POST['ajax']==='search-form-search-form')
          {
          echo CActiveForm::validate($model);
          Yii::app()->end();
          }
         */

        if (isset($_POST['SearchForm'])) {
            $search->attributes = $_POST['SearchForm'];
            $search->st_type = statement::TYPE_INVOICE;
            if ($search->validate()) {
                // form inputs are valid, do something here
                //  print_r($_POST['SearchForm']);
                //   Yii::app()->end();
            }
            $dataProvider = $search->search();
        }
        $this->render('search', array('model' => $model, 'search' => $search, 'dp' => $dataProvider));
    }

    public function actionNoPdf()
    {
        $this->renderPartial('nopdf', array(), false, true);
    }

    public function calc_subtotal($items)
    {
        $price = 0.0;
        foreach ($items as $i => $item)
            $price += $item->QUANTITY * $item->PRICE;
        return $price;
    }

    public static function getPaid($data, $row)
    {
        //if(is_null($paid)) return $paid; //null shows all records
        //if(is_numeric($switch)) return $paid; //here we save an ability to search with `0` or `1` value
        if ($data->is_paid == "1") {
            return 'P';
            //all fields with `switch` = 1
        } else if ($data->is_paid == "0") {
            return 'U';
            //all fields
        }

    }

    public function actionSetPaid($id)
    {
        //$stmt = $this->loadModel($id);
        $paid = $_POST['paid'];

        if (Invoice::model()->updateByPk($id, array('is_paid' => $paid)))
            return;
        //$this->redirect(array('/statement/view', 'id' => $id));
    }

    protected function performAjaxValidation($models)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'invoice_form') {
            echo CActiveForm::validate($models);
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

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Invoice the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Invoice::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    //Delivery and Pickup ajax updationge

    public function actionChgDelivery($id)
    {

        $flag = false;
        $model = $this->loadModel($id);
        if (isset($_POST['statement'])) {
            // $model->attributes = $_POST['statement'];
            $model->delv_from = (!empty($_POST['statement']['delv_from'])) ? $_POST['statement']['delv_from'] : $model->delv_from;
            $model->delv_to = (!empty($_POST['statement']['delv_to'])) ? $_POST['statement']['delv_to'] : $model->delv_to;
            $model->pick_from = (!empty($_POST['statement']['pick_from'])) ? $_POST['statement']['pick_from'] : $model->pick_from;
            $model->pick_to = (!empty($_POST['statement']['pick_to'])) ? $_POST['statement']['pick_to'] : $model->pick_to;
            if ($model->save())
                echo CJSON::encode($model->attributes);
            else
                echo CJSON::encode(array('error' => 'data not saved'));
            Yii::app()->end();
        }

        //   $this->renderPartial('_chgDelivery', array('stmt' => $model), false, true);        
    }

    public function actionChgPackInstructions($id)
    {

        $flag = false;
        $model = $this->loadModel($id);

        /* if( $model->save(false)){  //echo 'Saved'; 
          Yii::app()->user->setFlash('chgShip',"data saved successfully");
          echo CJSON::encode(date("F d, Y", $model->ship_date));
          Yii::app()->end();
          } */
        if (isset($_POST['statement'])) {
            $model->attributes = $_POST['statement'];
            $model->save();
            // echo CJSON::encode($model->getErrors());
        }
        Yii::app()->end();
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return statement the loaded model
     * @throws CHttpException
     */
    public function loadDoc($id)
    {
        $models = Invoice::model()->findAllByAttributes(
            array(), $condition = 'invoice_id = :someVarName', $params = array(
                ':someVarName' => $id,
            )
        );
        if (!empty($models))
            return $models[0];
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Payments the loaded model
     * @throws CHttpException
     */
    public function loadInv($id)
    {
        $model = Invoice::model()->findByPk($id);
        if ($model == null)
            //throw new CHttpException(404,'Why The requested page does not exist.');
            // else
            $model = new Invoice();
        return $model;
    }
    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Payments the loaded model
     * @throws CHttpException
     */
    public function loadStmt($id)
    {
        $model = Statement::model()->findByPk($id);
        if ($model === null)
            //throw new CHttpException(404,'Why The requested page does not exist.');
            //else
            $model = new Statement();
        return $model;
    }



}