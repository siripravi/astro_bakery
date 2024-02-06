<?php

class statementController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    //  public $layout = '//layouts/search';

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
                'actions' => array('view'),
                'users' => array('*'),
            ),
            array(
                'allow',
                // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('chgStmt', 'slip', 'chgHdr', 'admin', 'create', 'delItem', 'update', 'setPaid', 'doc.items', 'doc.pdf', 'header', 'lineItems', 'payHist', 'pay', 'payments', 'makeInv', 'viewPdf', 'chgDelivery', 'batchUpdate'),
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
        //  $this->layout = 'column2';
        $model = $this->loadModel($id);
        $tabarr = array(
            //'INVOICE-#'.$_GET['id'] => array('content' => $this->renderPartial('update',array('id'=>$_GET["id"]),true)),
            'Doc#' => array('ajax' => '/statement/lineItems/id/' . $_GET["id"]),
            //array('ajax' => '/invoice/header/id/'.$_GET["id"]),
            //  'items' => array('ajax' => '/invoice/lineItems/id/'.$_GET["id"]),
            //$this->widget('application.modules.nginvoice.components.MenuWidget') => array('ajax' => '/invoice/preview/id/'.$_GET["id"]),
            // 'tab2' => array('title'=>'Second', 'content' => $this->renderPartial('_payments',array('dp'=>$dp),true)),
            //   '<i class="fa fa-"></i>&nbsp; pdf' => array('id' => 'view-pdf', 'content' => $this->renderPartial('preview', array('fileName' => $model->getFileName()), true)),
            //'pdf' => array(  //'ajax'=> "/nginvoice/invoice/doc.pdf/id/".$_GET["id"],	 'content' => $this->renderPartial('pdf',array('id'=>$_GET["id"]),true)),
            '<i class="fa fa-envelope"></i>&nbsp; Message' => array('id' => 'send-email', 'ajax' => "/statement/sendEmail/id/" . $_GET["id"]),
        );

        if ($model->st_type == Statement::TYPE_INVOICE)
            $tabarr['<i class="fa fa-money"></i>&nbsp;Payments'] = array('id' => 'view-payments', 'ajax' => '/statement/payHist/id/' . $_GET["id"]);

        $this->render('view', array(
            'paid' => $model->paid,
            'model' => $model,
            'tabarr' => $tabarr,
            //	'items' => $model -> items,
            //	'dp' => new CArrayDataProvider($model -> payments, array('keyField' => 'ID'))
        )
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($type)
    {
        $this->layout = false;
        $model = new statement();
        //$model->scenario = 'quote';
        $model->st_type = $type;
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);
        $flag = false;
        if (isset($_POST['statement'])) {
            $model->attributes = $_POST['statement'];
            $model->ship_date = $model->event_date; //CDateTimeParser::parse($model->event_date, 'MM-dd-yyyy');

            if ($model->validate() && $model->save()) {
                $rmodel = ($model->st_type == Statement::TYPE_QUOTATION) ? new Quotation() : new Invoice();
                if ($model->st_type == Statement::TYPE_QUOTATION)
                    $rmodel->{$model->getKeyField()} = $model->quotation_id;
                else
                    $rmodel->{$model->getKeyField()} = $model->invoice_id;
                $rmodel->st_id = $model->id;
                $rmodel->st_type = $model->st_type;
                if ($rmodel->validate())
                    $rmodel->save(false);
                else
                    Yii::log('Creation: ' . var_export(CJSON::encode(
                        $rmodel->errors
                    ), true), CLogger::LEVEL_WARNING, __METHOD__);
                if (Yii::app()->request->isAjaxRequest) {
                    $lst = array('posted' => 'success', 'id' => $model->primaryKey);
                    echo json_encode($lst);
                    Yii::app()->end();
                }
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

        if (!$flag)
            $this->renderPartial('create', array(
                'model' => $model,
                'type' => $type
            ), false, true);
    }

    public function actionChgShip($id)
    {
        $flag = false;
        $model = $this->loadModel($id);

        if (isset($_POST['venId'])) {
            // $model = $stmt->relModel;
            $flag = true;
            $model->venue_id = (isset($_POST['venId'])) ? $_POST['venId'] : $model->venue_id;
            if ($model->save(false)) { //echo 'Saved';
                // Yii::log('Saved: '.var_export(CJSON::encode($model->venue->attributes), true),CLogger::LEVEL_WARNING,__METHOD__);
                echo CJSON::encode($model->venue->attributes, true);

                Yii::app()->user->setFlash('chgShip', "data saved successfully");
                Yii::app()->end();
            }
        }
        $this->renderPartial('_chgShip', array(
            'stmt' => $model,
            //'dp' => new CArrayDataProvider($model->payments, array('keyField' => 'ID'))
        ), false, true);
    }

    public function actionChgShipDt($id)
    {
        $flag = false;
        $model = $this->loadModel($id);
        if (isset($_POST['evtDt'])) {
            //$model->ship_date = $_POST['evtDt'];
            if (Statement::model()->updateByPk($id, array('ship_date' => $_POST['evtDt']))) {
                echo CJSON::encode($model->attributes);
            } else {
                echo CJSON::encode($model->errors);
            }
            Yii::app()->end();
        }
    }

    public function actionChgStmt()
    {
        $es = new EditableSaver('statement'); //'User' is name of model to be updated
        $es->onBeforeUpdate = function ($event) {
            $pk = $event->sender->primaryKey;
            $model = Statement::model()->findByPk($pk);
            $model->relModel->update_time = date('Y-m-d H:i:s');
            Yii::log('Editable: ' . var_export(CJSON::encode($model->relModel->attributes), true), CLogger::LEVEL_WARNING, __METHOD__);
            $model->relModel->uuser_id = Yii::app()->user->id;
            $model->relModel->update();
        };
        $es->update();
    }

    public function actionChgCust()
    {
        //  $this->layout = "dialog";
        $model = $this->loadModel($id);
        if (isset($_POST['custId'])) {
            // $model = $stmt->relModel;
            $model->customer_no = $_POST['custId'];
            //  $model->ship_date = CTimestamp::formatDate('m-d-Y',$model->ship_date);
            //  $model->ship_date = CDateTimeParser::parse($model->ship_date, 'MM-dd-yyyy');
            if ($model->save(false)) { //echo 'Saved';
                Yii::log('Saved: ' . var_export(CJSON::encode($model->customer->attributes), true), CLogger::LEVEL_WARNING, __METHOD__);
                echo CJSON::encode($model->customer->attributes, true);
                Yii::app()->user->setFlash('chgCust', "data saved successfully");
            } else {
                Yii::log('Not: ' . var_export($model->attributes, true), CLogger::LEVEL_WARNING, __METHOD__);
                echo CJSON::encode($model->errors);
            }
            Yii::app()->end();
        }
        $this->renderPartial('_chgCust', array(
            'stmt' => $model,
            //'dp' => new CArrayDataProvider($model->payments, array('keyField' => 'ID'))
        ), false, true);

        // $this->render('_customers',array('stmt' => $model));
    }

    public function actionChgHdr($id)
    {
        $model = $this->loadModel($id);
        if (isset($_POST[''])) {
            // $model = $stmt->relModel;
            $model->customer_no = $_POST['custId'];
            //  $model->ship_date = CTimestamp::formatDate('m-d-Y',$model->ship_date);
            //  $model->ship_date = CDateTimeParser::parse($model->ship_date, 'MM-dd-yyyy');
            if ($model->save(false)) { //echo 'Saved';
                Yii::log('Saved: ' . var_export(CJSON::encode($model->customer->attributes), true), CLogger::LEVEL_WARNING, __METHOD__);
                echo CJSON::encode($model->customer->attributes, true);
                Yii::app()->user->setFlash('chgCust', "data saved successfully");
            } else {
                Yii::log('Not: ' . var_export($model->attributes, true), CLogger::LEVEL_WARNING, __METHOD__);
                echo CJSON::encode($model->errors);
            }
            Yii::app()->end();
        }

        $this->renderPartial('_hdr', array('stmt' => $model), false, true);
    }

    public function actionNewItems()
    {
        $this->renderPartial('_newItems', array(), false, true);
    }

    public function actionUpdateItems($id)
    {
        $model = $this->loadModel($id);
        //  print_r($model->items);Yii::app()->end();
        $items = $this->getItemsToUpdate();
        if ((isset($_POST['InvoiceItems']))) { //Yii::app()->getRequest()->getIsAjaxRequest() &&
            $valid = true;
            foreach ($items as $i => $item) {
                $item->st_id = $model->getRelModel()->primaryKey;
                $item->st_type = $model->st_type;
                if ($item->validate()) {

                    if ($item->status == StatementItems::ITEM_STATUS_NEW) {
                        $item->status = 1;
                        $item->save();
                    } else {
                        $item->status = 1;
                        $item->update();
                    }
                    $this->redirect(array('/statement/update', 'id' => $id));
                } else {
                    //  print_r($item->errors);
                    //  Yii::app()->end();
                }
                //$valid=$item->validate() && $valid;
            }
            if ($valid) {

            }
        }
        /* $this->renderPartial('_lineItems', array('pkey'=>$model->primaryKey,'items' => $model->items, 'newitem' => new InvoiceItems,'stmt'=>$model,
          'dp'=> new CActiveDataProvider('InvoiceItems', array('data'=>$model->items))),false, true);
         */
    }


    public function actionLineItems($id)
    {
        $model = $this->loadModel($id);
        $this->renderPartial('items', array(
            'model' => $model,
            'dp' => new CArrayDataProvider($model->items, array(
                'keyField' => 'ID',
                'sort' => array(
                    'attributes' => array(
                        'sequence',
                    ),
                ),
            )
            )
        ), false, true);
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

    public function actionDelItem()
    {
        $id = (!empty($_POST['id'])) ? $_POST['id'] : null;
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $item = StatementItems::model()->findByPk($id);
            $item->delete();
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
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



    public function actionPayHist($id)
    {
        $stmt = $this->loadModel($id);
        $pmt = new Payments;
        //$this -> performAjaxValidation2($pmt);

        if (isset($_POST['Payments'])) {
            $pmt->attributes = $_POST['Payments'];
            $pmt->INVOICE_ID = $stmt->id;
            if ($pmt->save()) {
                $this->redirect(array('view', 'id' => $stmt->id));
            }
        }
        $this->renderPartial('payments', array(
            'pmt' => $pmt,
            'stmt' => $stmt,
            'dp' => new CArrayDataProvider($stmt->payments, array('keyField' => 'ID'))
        ), false, true);
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
        $model = Statement::model()->findByPk($id);
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

    public static function getDateString($date)
    {
        if (strstr($date, "-") || strstr($date, "/")) {
            $tdate = preg_split("/[\/]|[-]+/", $date);
            $msqld = $tdate[2] . "-" . $tdate[0] . "-" . $tdate[1];
            return date_format(date_create($msqld), "j F Y");
        }
        return false;
    }

}