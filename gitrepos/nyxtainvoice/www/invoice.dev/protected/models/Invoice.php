<?php

/**
 * This is the model class for table "invoice".
 *
 * The followings are the available columns in table 'invoice':
 * @property integer $st_id
 * @property integer $ref_id
 * @property integer $st_type
 * @property string $invoice_id
 */
class Invoice extends CActiveRecord
{

    public $from_date;
    public $to_date;
    public $is_paid;
    //public $customer;

    public $ship_date;
    public $venue_id;
    public $customer_no;
    public $delv_from;
    public $delv_to;
    public $pick_from;
    public $pick_to;
    public $delv_act;
    public $pick_act;
    public $pack_instr;
    public $created;
    public $updated;
    public $customer_name;
    public $ship_name;

    public $create_time;
    public $update_time;
    public $cuser_id;
    public $uuser_id;

    public $uKey = "invoice_id";
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'invoice';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('invoice_id', 'required'),
            array('invoice_id', 'required', "on" => "convert"),
            //array('st_id, ref_id, st_type', 'numerical', 'integerOnly'=>true),
            array('invoice_id', 'length', 'max' => 20),
            array('delv_act', 'default', 'value' => date('Y-m-d')),
            array('pick_act', 'default', 'value' => date('Y-m-d')),
            array('delv_from', 'default', 'value' => date('Y-m-d')),
            array('delv_to', 'default', 'value' => date('Y-m-d')),
            array('pick_from', 'default', 'value' => date('Y-m-d')),
            array('pick_to', 'default', 'value' => date('Y-m-d')),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('invoice_id', 'required', 'on' => 'header'),
            //array('invoice_id', 'unique', 'on' => array('header','insert')), 
            array('invoice_id', 'unique'),
            //'className' => 'Invoice'), 
            array('delv_from, delv_to', 'checkDelTimes', 'on' => 'update'),
            array('pick_from, pick_to', 'checkPicTimes', 'on' => 'update'),
            array('update_time', 'safe', 'on' => 'update'),
            array('delv_from, delv_from_date, delv_to, delv_to_date,pick_from, pick_to, delv_act, pick_act,pack_instr,created, customer_name, ship_name, create_time,update_time', 'safe'),
            array('st_id, ref_id, st_type, invoice_id, from_date,to_date, customer, create_time, update_time, is_paid', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.

        return array(
            'statement' => array(self::HAS_ONE, 'statement', array('id' => 'st_id')),
            'reference' => array(self::BELONGS_TO, 'Quotation', array('ref_id' => 'st_id')),
            'payments' => array(self::HAS_MANY, 'Payments', array('invoice_id' => 'st_id')),
            'items' => array(self::HAS_MANY, 'InvoiceItems', array('st_id' => 'st_id', 'st_type' => 'st_type'), 'order' => 'sequence', 'condition' => 'status = 1'),
            //'itemsTotal'=>array(self::STAT,  'InvoiceItems', 'invoice_id'=>'st_id', 'select' => 'SUM(AMOUNT)','condition'=>''),
            'paymentsTotal' => array(self::STAT, 'Payments', 'invoice_id', 'select' => 'SUM(AMOUNT)', 'condition' => ''),
            //	'itemsTotal' => array(self::STAT,  'InvoiceItems', 'st_id,st_type', 'select' => 'SUM(price * quantity)','condition'=>'status = 1'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'st_id' => 'St',
            'ref_id' => 'Ref Qtn',
            'st_type' => 'St Type',
            'invoice_id' => 'Invoice#',
            'ship_date' => 'ship date',
            'venue_id' => 'venue',
            'customer_no' => 'customer',
            'is_paid' => 'Pay Status'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;
        //  $criteria->compare('paid', $this->is_paid);
        //  $criteria->compare('st_id', $this->st_id);
        //   $criteria->compare('ref_id', $this->ref_id);
        $criteria->compare('is_paid', $this->is_paid);
        $criteria->compare('invoice_id', $this->invoice_id);
        //$criteria->compare('t.customer',$this->customer,true);
        //$criteria->with = array('statement');

        /* if(!empty($this->from_date) && empty($this->to_date))
          {
          $criteria->condition = "statement.ship_date >= '$this->from_date'";  // date is database date column field
          }
          elseif(!empty($this->to_date) && empty($this->from_date))
          {
          $criteria->condition = "statement.ship_date <= '$this->to_date'";

          }elseif(!empty($this->to_date) && !empty($this->from_date))
          {
          $criteria->condition = "statement.ship_date  >= '$this->from_date' and statement.ship_date <= '$this->to_date'";
          }
         */
        echo $criteria->condition;
        //$criteria->with = array('statement');
        return new CActiveDataProvider($this, array('criteria' => $criteria));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Invoice the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function getBalance()
    {
        return ($this->itemsTotal - $this->paymentsTotal);
    }

    public function getItemsTotal()
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->price * $item->quantity;
        }
        return $total;
    }

    public function getHeader1()
    {
        $hdr = ' from Prime Party Rentals';
        return ($this->st_type == Statement::TYPE_QUOTATION) ? 'Quote' . $hdr : 'Invoice' . $hdr;
    }

    public function getHeader2()
    {
        return ($this->st_type == Statement::TYPE_QUOTATION) ? 'QUOTE' : 'INVOICE';
    }

    public function getFileName()
    {
        $file = 'invoices/' . $this->invoice_id;
        return '/files/' . $file . '.pdf';
    }

    protected function beforeSave()
    {

        if (parent::beforeSave()) {
            //$this -> CREATE_DATE = CTimestamp::formatDate('m-d-Y');
            //$this -> ship_date = date('m-d-Y');
            //$this->CREATE_DATE = CTimestamp::formatDate('m-d-Y');
            //echo $this->event_date; Yii::app()->end();
            //$this->ship_date =CDateTimeParser::parse($this->event_date,'yy-MM-dd');

            if ($this->isNewRecord) {
                $this->cuser_id = Yii::app()->user->id;
                $this->create_time = $this->update_time = date('Y-m-d H:i:s');

                //   $this->cuser_id = $this->uuser_id = Yii::app()->user->id;
                if ($this->scenario == "convert") {
                    $statement = Statement::model()->findByPk($this->st_id);
                    $quote = Quotation::model()->findByPk($this->st_id);
                    if (!empty($statement)) {
                        $statement->st_type = Statement::TYPE_INVOICE;
                        $statement->approved = 1;
                        $statement->update(false);
                    }
                    if (!empty($quote)) {
                        $quote->st_type = Statement::TYPE_INVOICE;
                        $quote->update(false);
                    }
                }


                $this->is_paid = 0;
                $this->st_type = Statement::TYPE_INVOICE;
                //  $this->created = $this->modified = time();
                //  $this->cuser_id = $this->uuser_id = Yii::app()->user->id;
            } else {
                //    $this->update_time = date('Y-m-d H:i:s');
                //       $this->uuser_id = Yii::app()->user->id;
                //  $this->modified = time();
                //  $this->uuser_id = Yii::app()->user->id;
            }
            // $this->closed = 0;
            return true;
        } else
            return false;
    }

    protected function afterSave()
    {

        parent::afterSave();
    }

    public function checkDelTimes($attribute, $params)
    {
        $minDelDate = str_replace('-', '/', date('Y-m-d', strtotime('-7 days', strtotime($this->statement->ship_date))));
        $delDate = $this->statement->ship_date;
        $maxDelDate = $this->statement->ship_date . ' 23:59:59';
        //--$maxDelDate = str_replace('-', '/', date('Y-m-d', strtotime('1 days', strtotime($this->statement->ship_date))));

        list($delvFrom, $b) = explode(" ", $this->delv_from);
        list($delvTo, $b) = explode(" ", $this->delv_to);

        $delTime = strtotime($delDate);
        $minDelTime = strtotime($minDelDate);
        $maxDelTime = strtotime($maxDelDate);
        $delvFromTime = strtotime($this->delv_from);
        $delvToTime = strtotime($this->delv_to);

        if (($attribute == "delv_from") && (!empty($delvFrom))) {
            if (($delvFromTime < $minDelTime) || ($delvFromTime > $maxDelTime))
                $this->addError($attribute, "Error in Delivery Start time");

        } else if (($attribute == "delv_to") && (!empty($delvTo))) {
            if (($delvToTime < $delvFromTime) || ($delvToTime < $minDelTime) || ($delvToTime > $maxDelTime))
                $this->addError($attribute, "Error in Delivery End time");

        }

    }

    public function checkPicTimes($attribute, $params)
    {
        $minPicDate = $this->statement->ship_date . ' 00:00:00';
        //--str_replace('-', '/', date('Y-m-d', strtotime('1 days', strtotime($this->statement->ship_date))));
        $picDate = $this->statement->ship_date;
        $maxPicDate = str_replace('-', '/', date('Y-m-d', strtotime('+7 days', strtotime($this->statement->ship_date))));

        // $starttime = strtotime($minDelDate);
        // $endtime = strtotime($maxDelDate);
        list($picFrom, $b) = explode(" ", $this->pick_from);
        list($picTo, $b) = explode(" ", $this->pick_to);

        $picTime = strtotime($picDate);
        $minPicTime = strtotime($minPicDate);
        $maxPicTime = strtotime($maxPicDate);
        $picFromTime = strtotime($this->pick_from);
        $picToTime = strtotime($this->pick_to);

        if (($attribute == "pick_from") && (!empty($picFrom))) {
            if (($picFromTime < $minPicTime) || ($picFromTime > $maxPicTime))
                $this->addError($attribute, "Error in Pickup Start time");
        } else if (($attribute == "pick_to") && (!empty($picTo))) {
            if (($picToTime < $picFromTime) || ($picToTime < $minPicTime) || ($picToTime > $maxPicTime))
                $this->addError($attribute, "Error in Pickup End time");

        }

    }
}