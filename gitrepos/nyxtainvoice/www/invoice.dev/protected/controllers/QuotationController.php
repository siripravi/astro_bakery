<?php

class QuotationController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/bs-main';
    public $invoice;
    public $customers;
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
                'actions' => array('view', 'items'),
                'users' => array('*'),
            ),
            array(
                'allow',
                // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'search', 'chgQuote', 'doc.items', 'doc.pdf', 'viewPdf', 'index', 'admin', 'create', 'update', 'edit', 'pdf', 'makeInv', 'preview', 'sendEmail'),
                'expression' => '$user->isAuthor',
            ),
            array(
                'allow',
                // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'expression' => '$user->isAdmin',
            ),
            /*array('deny',  // deny all users
                         'users'=>array('*'),
                     ),*/
        );
    }

    public function actionCreate($id = null)
    {
        $this->layout = false;
        $flag = false;
        $quotation = $this->loadQtn($id); //new Quotation();
        $statement = $this->loadStmt($id); //new Statement();       
        //  $this->performAjaxValidation(array($invoice,$statement));
        if (isset($_POST['Quotation'], $_POST['Statement'])) {
            // populate input data to $a and $b
            $quotation->attributes = $_POST['Quotation'];
            $statement->attributes = $_POST['Statement'];

            // validate BOTH $a and $b
            $valid = $quotation->validate();
            $valid = $statement->validate() && $valid;

            if ($valid) {
                $flag = true;
                // use false parameter to disable validation
                // $statement->id = Yii::app()->db->getLastInsertID() + 1;
                $statement->closed = '0';
                $statement->st_type = Statement::TYPE_QUOTATION;
                if ($statement->save(false)) {
                    $quotation->st_id = $statement->primaryKey;
                    $quotation->cuser_id = Yii::app()->user->id;
                    $quotation->st_type = Statement::TYPE_QUOTATION;
                    if ($quotation->save(false)) {
                        if (Yii::app()->request->isAjaxRequest) {
                            $lst = array('posted' => 'success', 'id' => $quotation->quotation_id);
                            echo json_encode($lst);
                            Yii::app()->end();
                        }
                    }
                }

                // $this->redirect('document/update',array('id'=>$invoice->invoice_id));
            } else {
                $flag = false;
                // $ary = array_merge( $model->getErrors(),$stmt->getErrors());
                $ary = array_merge($statement->getErrors(), $quotation->getErrors());
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
            $this->renderPartial('create', array('statement' => $statement, 'quotation' => $quotation), false, true);
    }
    public function actionUpdate($id)
    {
        //$this->layout = "search";
        $this->document = $this->loadDoc($id);
        // $model = $this->loadModel($id);

        $this->render('update', array(
            'stmt' => $this->document,
            'dp' => new CArrayDataProvider($this->document, array('keyField' => 'st_id', 'id' => 'stmt-dp'))
        )
        );
    }
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel2($id);
        $this->render('view', array(
            'model' => $model,
            'items' => $model->items
        )
        );
    }

    public function actionChgQuote()
    {
        $es = new EditableSaver('Quotation'); //'User' is name of model to be updated
        $es->onBeforeUpdate = function ($event) {
            $event->sender->setAttribute('update_time', date('Y-m-d H:i:s'));
            $event->sender->setAttribute('uuser_id', Yii::app()->user->id);
        };
        $es->update();
        //  $this->redirect(array('/quotation/update','id'=>$model->quotation_id));

    }

    public function actionMakeInv($id)
    {
        // $this->layout = "//layouts/dialoglayout";
        $inv = new Invoice("convert");
        $quot = $this->loadModel($id);
        $stmt = $quot->statement;

        if (!empty($_POST['Invoice']['invoice_id'])) {
            $inId = $_POST['Invoice']['invoice_id'];

            if (Quotation::moveItems($id, $inId)) {
                DialogBox::closeDialogBox('success', '/invoice/update/id/' . $inId);
            } else {
                print_r($stmt->errors);
            }

        }
        $this->renderPartial('_make', array('model' => $inv), false, true);
    }


    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionEdit($id)
    {
        $this->render('view2', array(
            'model' => $this->loadModel2($id),
        )
        );
    }

    /*  public function actionMakeInv($id){
              $this->layout = "//layouts/dialoglayout";
                $model = new Invoice('header'); 
              $stmt = new statement();
              $qot = $this->loadModel($id);		
              $tmp = $qot->statement;		
              $stmt->st_type = stateMENT::TYPE_INVOICE;
              $stmt->customer_no = $tmp->customer_no;
              $stmt->venue_id = $tmp->venue_id;
              $stmt->ship_date = $tmp->ship_date;
              $stmt->closed = $tmp->closed;
          
          //if (!Yii::app()->request->isAjaxRequest){ 
          if(!empty($_POST['Invoice']['invoice_id'])){
              $model->ref_id = $qot->st_id;
              $model->st_type = stateMENT::TYPE_INVOICE;
              $model->invoice_id = $_POST['Invoice']['invoice_id'];
             //////////////
             $model->ship_date = $stmt->ship_date;
             $model->customer_no = $stmt->customer_no;
             $model->venue_id = $stmt->venue_id;
             //////////////
          
          $valid=$model->validate();
          $valid=$stmt->validate() && $valid;
          
          if($valid)
          {
              // use false parameter to disable validation
              $stmt->save(false);
              $model->st_id = $stmt->id;
              $model->save(false);			
              
              Yii::app()->user->setFlash('invitations_sent','Invitations sent successfully');	           
              DialogBox::closeDialogBox('success','/statement/update/id/'.$stmt->id);                                       
                  return;            // ...redirect to another page
              //$this->redirect(array('angularHelper/default/invApp','id'=>$model->invoice_id));
          }
          
          else print_r($model->errors);
          }				
          $this->render('_make',array('model'=>$model));
          
      }
          
      */

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    /*public function actionCreate()
       {
           $model = new Quotation('header');
           $stmt = new statement('header');           
           if(isset($_POST['Quotation']['ship_date']))
              $model->ship_date = $_POST['Quotation']['ship_date'];
           if(isset($_POST['Quotation']['venue_id']))
              $model->venue_id = $_POST['Quotation']['venue_id'];
           if(isset($_POST['Quotation']['customer_no']))
              $model->customer_no = $_POST['Quotation']['customer_no'];
           //$this->performAjaxValidation($model);
           
           if(isset($_POST['Quotation'], $_POST['Quotation']))
           {
           // populate input data to $a and $b
           $model->attributes=$_POST['Quotation'];
           $model->st_type = statement::TYPE_QUOTATION;
           $stmt->attributes=$_POST['Quotation'];
           $stmt->st_type = statement::TYPE_QUOTATION;
           // validate BOTH $a and $b
           $valid=$model->validate();
           $valid=$stmt->validate() && $valid;
    
           if($valid)
           {
               // use false parameter to disable validation
               $stmt->save(false);
               $model->st_id = $stmt->id;
               $model->save(false);			
               
               // ...redirect to another page
               $this->redirect(array('/quotation/update','id'=>$model->quotation_id));
           }
           //print_r($model->getErrors());
       }
           
           $this->render('create',array('model'=>$model,'stmt'=>$stmt));
           
       }
   */

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
        $this->adminMenu = array(
            //  array('label' => 'Messages'),	
            array('label' => 'Crate', 'url' => array('/statement/create', 'type' => 1), 'active' => true),
            array('label' => 'List', 'url' => array('/search/quotations')),
            //  array('label' => 'Sent', 'url' => array('/demo1/message/sent')),
            // array('label' => 'Account', 'icon' => 'phone', 'url' => array('/demo1/message/account'))
        );
        $this->render('default');
    }

    /**
     * Manages all models.
     */
    /*	public function actionAdmin()
        {
            $model=new Quotation('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['Quotation']))
                $model->attributes=$_GET['Quotation'];

            $this->render('admin',array(
                'model'=>$model,
            ));
        }
    */
    /**
     * Performs the AJAX validation.
     * @param Quotation $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'quotation-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    /* protected function moveItems($items){
         
         foreach($items as $item){
             $item->primaryKey = null;
             $item->st_type = statement::TYPE_INVOICE;
             $item->save();
             
         }
         
     }*/

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Payments the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Quotation::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'Why The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Payments the loaded model
     * @throws CHttpException
     */
    public function loadQtn($id)
    {
        $model = Quotation::model()->findByPk($id);
        if ($model == null)
            //throw new CHttpException(404,'Why The requested page does not exist.');
            // else
            $model = new Quotation();
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

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return statement the loaded model
     * @throws CHttpException
     */
    public function loadDoc($id)
    {
        $models = Quotation::model()->findAllByAttributes(
            array(),
            $condition = 'quotation_id = :someVarName',
            $params = array(
                ':someVarName' => $id,

            )
        );

        //   $model = Quotation::model()->findByAttributes(array('quotation_id' => $id));
        if ($models === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $models[0];
    }

    public function actionViewPdf($id)
    {
        $this->layout = false;
        $stmt = $this->loadModel($id);
        $filename = $stmt->getFileName() . '?q=' . microtime(true);
        $this->renderPartial('vpdf', array('stmt' => $stmt, 'filename' => $filename), false, true);
    }
    /**
     * Manages all models.
     */
    public function actionSearch()
    {
        $model = new Quotation('search');
        $model->unsetAttributes(); // clear any default values
        $model->from_date = (empty($model->from_date)) ? date('m-d-Y', strtotime('yesterday')) : $model->from_date;
        $model->to_date = (empty($model->to_date)) ? date('m-t-Y', strtotime('next month')) : $model->to_date;
        if (isset($_GET['Quotation'])) {
            $model->attributes = $_GET['Quotation'];
        }
        /* if (isset($_GET['Quotation'])) 
            $model->attributes = $_GET['Quotation']; 
         
        if (isset($_GET['quotation_id']))
            $model->quotation_id = (empty($model->quotation_id)) ? $_GET['quotation_id']: null;
        
        if (isset($_GET['customer_no']))
            $model->customer_name = $_GET['customer_no'];
        
        if (isset($_POST['Quotation']['from_date'])) {
            Yii::app()->request->cookies['from_date'] = new CHttpCookie('from_date', $_POST['Quotation']['from_date']);
            $model->from_date = $_POST['Quotation']['from_date'];
        } else {
            if (isset(Yii::app()->request->cookies['from_date']))
                $model->from_date = Yii::app()->request->cookies['from_date'];
        }
        if (isset($_POST['to_date'])) {
            Yii::app()->request->cookies['to_date'] = new CHttpCookie('to_date', $_POST['Quotation']['to_date']);
            $model->to_date = $_POST['Quotation']['to_date'];
        } else {
            if (isset(Yii::app()->request->cookies['to_date']))
                $model->to_date = Yii::app()->request->cookies['to_date'];
        }
        */
        $st_type = 1;
        $model->st_type = $st_type;
        $this->render('admin2', array(
            'model' => $model,
            'dp' => $model->search(),
        )
        );
    }


    /*  public function actionPayments() {
          $this->layout = false;
          $this->render('payments');
          
      }
     public function actionPayHist($id) {
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
                 ),false,true);
     }
 */
    /*public function actionPay($id) {
        //$this -> layout = '//layouts/dialoglayout';
        $model = new Payments;
        $stmt = $this->loadModel($id);
        // Uncomment the following line if AJAX validation is needed
      //  $this->performAjaxValidation2($model);

        if (isset($_POST['Payments'])) {
            $model->attributes = $_POST['Payments'];
            $model->INVOICE_ID = $stmt->id;
            if ($model->validate() && $model->save()) {
               Yii::app()->user->setFlash('pay-done',"Payment saved successfully!");
               if (Yii::app()->request->isAjaxRequest) {
                        $lst = array('posted' => 'success', 'id' => $stmt->primaryKey);
                        echo json_encode($lst);
                        Yii::app()->end();
                    }
                Yii::app()->end();            }  //$this->redirect(array('view', 'id' => $stmt->id));
             else{
                 Yii::log('Pay : '.var_export($model->errors, true),CLogger::LEVEL_WARNING,__METHOD__);
                  echo CJSON::encode($model->errors) ;
             }   
            
        }

        $this->renderPartial('_pay', array('pmt' => $model, 'stmt' => $stmt,
            //'dp' => new CArrayDataProvider($model->payments, array('keyField' => 'ID'))
                ), false, true);
    }*/

}