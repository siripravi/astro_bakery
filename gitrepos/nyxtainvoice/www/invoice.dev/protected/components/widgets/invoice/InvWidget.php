<?php

class InvWidget extends CWidget
{

    public $loginViewFile = 'application.components.widgets.invoice.views.view';
    public $visible = true;
    public $pk;
    public $model;
    public $stmt;

    public function init()
    {
        $this->stmt = $this->loadModel($this->pk);
        //  $this->stmt = ($this->stmt->st_type == statement::TYPE_QUOTATION) ? $this->stmt->quotation : $this->stmt->invoice;

        $this->publishAssets();
    }

    public function run()
    {
        $this->visible = true;
        if ($this->visible) {
            $this->renderContent();
        }
    }

    protected function renderContent()
    {
        if (!Yii::app()->user->isGuest) {
            $this->render('view', array('pk' => $this->pk));
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

    /*  public function calcDueDate($d1, $d2) {
          //	$d1 = date('m-d-Y',trim($d1));
          //		$d2 = date('m-d-Y',$d2);
          $ld = ($d1 > $d2) ? $d1 : $d2;
          //return (date('m-d-Y', strtotime('+14 days',$ld)));
          $pd = strtotime(str_replace('-', '/', $ld));
          return (date('F j, Y', strtotime('-14 days', $pd)));
          // Yii::app()->dateFormatter->formatDateTime(strtotime('+14 days',$ld), 'long',null);
      }*/

    public function calcDueDate($d1, $d2)
    {
        $diff = abs($d1 - $d2);
        $days = floor($diff / 60 / 60 / 24);
        $pd = strtotime(str_replace('-', '/', date('m-d-Y', $d2)));
        $dueDt = ($days <= 14) ? date('F j, Y', $d1) : date('F j, Y', strtotime('-14 days', $pd));

        //	echo $days;
        return $dueDt;

    }
    // function to publish and register assets on page 
    public function publishAssets()
    {

        // $sel2Dir =  Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets/select2');
        // Yii::app()->clientScript->registerCssFile( $sel2Dir. '/select2.css');
        //  Yii::app()->clientScript->registerScriptFile($sel2Dir. '/select2.min.js');

        $assDir = Yii::app()->assetManager->publish(dirname(__FILE__) . '/assets');
        // Yii::app()->clientScript->registerScriptFile($assDir. '/js/jquery-1.7.2.min.js');
        //Yii::app()->clientScript->registerCssFile( $assDir. '/css/invlay.css');
        Yii::app()->clientScript->registerCssFile($assDir . '/css/invoice.css');

        Yii::app()->clientScript->registerScript('clrFld', '$("textarea").focus(
    function(){
       // if ($(this).value() == "0"){
        $(this).value("");
        alert("click");  //}
        });', CClientScript::POS_READY);

        //Yii::app()->clientScript->registerScriptFile(Yii::app()->assetManager->publish(dirname(__FILE__).'/js/userGroups.js'));
    }

}

?>