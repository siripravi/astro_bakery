<?php
class getItems extends CAction
{
    public $docId;
    public function run()
    {
        $this->docId = !empty($_GET['id']) ? $_GET['id'] : null;
        $stmt = $this->controller->loadModel($this->docId);

        /* if(!empty($_GET['event_date']) && ($_GET['event_date'] !== "null")) {
             $stmt->event_date = $_GET['event_date'];
             $stmt->ship_date = CDateTimeParser::parse($stmt->event_date, 'MM-dd-yyyy');
         }
         if(!empty($_GET['venue_id']) && ($_GET['venue_id'] !== "null"))
             $stmt->venue_id = $_GET['venue_id'];
         if(!empty($_GET['customer_id']) && ( $_GET['customer_id'] !== "null"))
             $stmt->customer_no = $_GET['customer_id'];
        */
        if (!empty($stmt)) {

            $stmt->relModel->update_time = date('Y-m-d H:i:s');
            Yii::log('Editable Items: ' . var_export(CJSON::encode($stmt->relModel->attributes), true), CLogger::LEVEL_WARNING, __METHOD__);
            $stmt->relModel->uuser_id = Yii::app()->user->id;
            $stmt->relModel->update();

        }


        $items = json_decode(file_get_contents("php://input"));
        //  print_r($items);
        //  Yii::app()->end();

        $response = array();
        $inv = ($stmt->st_type == Statement::TYPE_QUOTATION) ? $stmt->quotation : $stmt->invoice;

        if (!empty($items)) {
            foreach ($items as $k => $item) {
                $invItem = new InvoiceItems;
                $invItem->st_type = $inv->st_type;
                if ($item->id > 0) {
                    $invItem->id = (int) $item->id;
                    $invItem = InvoiceItems::model()->findByPk($invItem->id);
                    $invItem->sequence = $k + 1;
                    if (!empty($invItem)) {
                        $invItem->st_type = $inv->st_type;
                        $invItem->description = $item->description;
                        $invItem->quantity = $item->quantity;
                        $invItem->price = $item->price;
                        if ($item->status == StatementItems::ITEM_STATUS_DELETE)
                            $invItem->delete();
                        else
                            $invItem->update();
                    }
                } else {
                    $invItem->sequence = $k + 1;
                    $invItem->st_id = $inv->st_id;
                    $invItem->st_type = $inv->st_type;
                    $invItem->description = $item->description;
                    $invItem->quantity = $item->quantity;
                    $invItem->price = $item->price;
                    $invItem->status = StatementItems::ITEM_STATUS_NEW;
                    if ($item->status == StatementItems::ITEM_STATUS_DELETE)
                        $invItem->delete();
                    else
                        $invItem->save();
                }
            }
        }

        if (isset($inv->ref_id) && ($inv->ref_id > 0))
            $ref = $this->loadRef($inv->ref_id);
        // $response["filename"] = $filename;
        if (!empty($inv->items)) {
            echo CJSON::encode($inv->items);
            Yii::app()->end();
        } elseif (!empty($ref)) {
            foreach ($ref->items as $item)
                $item->id = null;
            echo CJSON::encode($ref->items);
        }

        /** *********End of only with invoice ********* */
    }

    public function loadRef($id)
    {
        $model = Quotation::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not bexist.');
        return $model;
    }

}