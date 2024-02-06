<?php

class getPdf extends CAction
{

    //	protected $controller; 
    protected $actId;
    public $docId;
    public $docType;
    public $title;
    public $showAmount = true;
    public $filename;
    public $pdfBaseDir;
    public $layout;
    public $customer;

    public function run()
    {
        $this->docId = !empty($_GET['id']) ? $_GET['id'] : null;
        $model = $this->controller->loadModel($this->docId);
        // echo $model->getFileName();
        $filename = $_SERVER['DOCUMENT_ROOT'] . $model->getFileName();

        $this->customer = $model->statement->customer;
        $itemCount = count($model->items);
        $items = array();
        $tmp = 15;
        $gtot = false;
        $start = 1;
        $grandtotal = 0.0;
        $subtotal = 0.0;
        $page = 1;

        // $mpdf = Yii::app()->ePdf->mpdf();
        require_once dirname(__FILE__) . '/../../../vendor/autoload.php';
        $mpdf = new \Mpdf\Mpdf();

        $stylesheet = file_get_contents(dirname(__FILE__) . '/../widgets/invoice/assets/css/invlay.css');

        $mpdf->WriteHTML($stylesheet, 1);
        $gtot = true;
        Yii::app()->controller->layout = 'application.themes.prime.views.layouts.invoice';
        $items = $model->items;
        $subtotal = $this->calc_subtotal($items);
        $grandtotal += $subtotal;

        // false is default
        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle($model->getHeader1());
        $mpdf->SetAuthor("Prime Party Rentals");
        $mpdf->setHeader('Prime Party Rentals- {DATE m-j-Y}');
        $mpdf->setFooter('Page {PAGENO} of {nb}');

        $mpdf->SetDisplayMode('fullpage');
        $mpdf->shrink_tables_to_fit = 1;

        // $createDate = DateTime::createFromFormat('Y-m-d H:i:s', $model->statement->create_time);
        // $dueDate = $this->calcDueDate($createDate->format("Y-m-d"), $model->statement->ship_date); //$this->stmt->created;
        $createDate = Yii::app()->dateFormatter->formatDateTime($model->create_time, "long", null);
        $dueDate = $this->calcDueDate($model->create_time, $model->statement->ship_date);

        $mpdf->WriteHTML(Yii::app()->controller->render('pdf', array(
            'slip' => "", //$slip,
            'id' => $this->id,
            'type' => $model->st_type,
            'relmod' => $model->statement,
            'grandtotal' => $grandtotal,
            'subtotal' => $subtotal,
            'items' => $items,
            'created' => $createDate,
            'dueDate' => $dueDate,
            'start' => $start,
            'customer' => $this->customer,
            'gtot' => $gtot,
            'page' => $page
        ), true));

        $mpdf->Output($filename, 'F');
        Yii::app()->user->setFlash('pdf', 'Document converted pdf successfully!');
        //echo $filename;

        Yii::app()->end();
    }

    public function getTitle()
    {

    }

    public function calc_subtotal($items)
    {
        $price = 0.0;
        foreach ($items as $i => $item)
            $price += $item->quantity * $item->price;
        return $price;
    }

    public function calcDueDate($d1, $d2)
    {
        $d1 = strtotime($d1);
        $d2 = strtotime($d2);
        $diff = abs($d1 - $d2);
        $days = floor($diff / 60 / 60 / 24);
        $pd = strtotime(str_replace('-', '/', date('m-d-Y', $d2)));
        $dueDt = ($days <= 14) ? date('F j, Y', $d1) : date('F j, Y', strtotime('-14 days', $pd));

        echo $days;
        return $dueDt;
    }
}