<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/bs-main';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */

    public $document; //quote
    public $invoice;

    public $breadcrumbs = array();

    public function beforeRender($view)
    {
        $statement = null;
        if (!empty($this->document)) { // && !Yii::app()->user->isGuest)
            $statement = $this->document;
            $url = array('/quotation/chgQuote');
            $key = 'quotation_id';
            $header = 'QUOTE ';
        } else if (!empty($this->invoice)) {
            $statement = $this->invoice;
            $url = array('/invoice/chgInv');
            $key = 'invoice_id';
            $header = 'INVOICE ';
            //$this->renderPartial('//layouts/clips/_hdr_level2_inv_clip');
        }
        if ($statement)
            $this->renderPartial('//layouts/clips/_hdr_level2_clip', array('statement' => $statement, 'url' => $url, 'key' => $key, 'header' => $header));
        return parent::beforeRender($view);
    }

    public static function getPayMode($data, $row = "")
    {

        switch ($data->MODE_ID) {
            case '1':
                return 'Check';
                //all fields with `switch` = 1
                break;
            case '2':
                return 'Cash';
                //all fields with `switch` = 1
                break;
            case '3':
                return '<i class="pe-7s-credit"></i> card';
                //all fields with `switch` = 1
                break;
            case '4':
                return 'Deposit';
                //all fields with `switch` = 1
                break;
        }
    }


}