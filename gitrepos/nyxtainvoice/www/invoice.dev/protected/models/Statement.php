<?php

/**
 * This is the model class for table "statement".
 *
 * The followings are the available columns in table 'statement':
 * @property integer $id
 * @property integer $st_type
 * @property integer $customer_no
 * @property integer $venue_id
 * @property string $ship_date
 * @property string $CREATE_DATE
 * @property string $closed
 * @property string $notes
 */
class Statement extends CActiveRecord
{

    public $from_date;
    public $to_date;

    //for search
    public $invoice_id;
    public $quotation_id;


    public $customer_name;
    public $ship_name;
    public $is_same;

    public $delv_from;
    public $delv_to;
    public $pick_from;
    public $pick_to;

    public $delv_from_date;
    public $delv_to_date;
    public $pick_from_date;
    public $pick_to_date;

    //public $pack_instr;

    public $approved;

    public $created_at;
    public $updated_at;
    const STATUS_UNPAID = '0';
    const STATUS_PAID = '1';
    const TYPE_QUOTATION = 1;
    const TYPE_INVOICE = 2;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'statement';
    }

    /* public function behaviors(){
     return array(
         'CTimestampBehavior' => array(
             'class' => 'zii.behaviors.CTimestampBehavior',
             'createAttribute' => 'create_time_attribute',
             'updateAttribute' => 'update_time_attribute',
         )
     );
     }*/
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        $rules = array(
            array('customer_no, venue_id,ship_date', 'required'),
            array('st_type, customer_no, venue_id', 'numerical', 'integerOnly' => true),
            array('closed', 'length', 'max' => 1),
            array('notes', 'length', 'max' => 255),
            array('ship_date, paid, is_same, invoice_id, quotation_id, delv_from, delv_from_date,delv_to, pick_from, pick_from_date,pick_to, pick_to_date,padelv_to_date,ck_instr', 'safe'),
            //array('invoice_id', 'required', 'on' => 'invoice'),		

            array('ship_date', 'dateValid'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('created_at, updated_at, invoice_id, quotation_id, customer_name, ship_name, id, st_type, customer_no, venue_id, ship_date, CREATE_DATE, closed, notes, from_date,to_date,paid, approved', 'safe', 'on' => 'search'),
        );

        //  $rules[] = array('invoice_id', 'invUnique');
        // $rules[] = array('quotation_id', 'qtnUnique');

        return $rules;
    }

    /*  public function aunique($attribute, $params) {
          if (!$this->hasErrors()) {

              switch ($this->st_type) {
                  case statement::TYPE_INVOICE:
                       if(empty($this->invoice_id))
                           $this->addError('invoice_id', 'Invoice Number is required!');
                       else {
                      $model = Invoice::model()->findByAttributes(array('invoice_id' => $this->invoice_id));
                      if (!empty($model))
                          $this->addError('invoice_id', 'Invoice Number already exists!');
                       }
                      break;
                  case statement::TYPE_QUOTATION:
                      if(empty($this->invoice_id))
                           $this->addError('quotation_id', 'Quote Number is required!');
                      else {
                      $model = Quotation::model()->findByAttributes(array('quotation_id' => $this->quotation_id));
                      if (!empty($model))
                          $this->addError('quotation_id', 'Quote Number already exists!');
                      }
                      break;
              }
             
          }
      }*/

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return
            array(
                'customer' => array(self::BELONGS_TO, 'Customer', 'customer_no'),
                'venue' => array(self::BELONGS_TO, 'Venue', 'venue_id'),
                'invoice' => array(self::HAS_ONE, 'Invoice', 'st_id'),
                'quotation' => array(self::HAS_ONE, 'Quotation', 'st_id'),
                'items' => array(self::HAS_MANY, 'InvoiceItems', array('st_id' => 'id', 'st_type' => 'st_type'), 'condition' => 'status = 1', 'order' => 'sequence ASC'),

                'payments' => array(self::HAS_MANY, 'Payments', array('invoice_id' => 'id')),
                'paymentsTotal' => array(self::STAT, 'Payments', 'invoice_id', 'select' => 'SUM(AMOUNT)', 'condition' => ''),
                // 'relModel'  =>  array(self::HAS_ONE, ($this->type == statement::TYPE_QUOTATION)? 'Quotation' : 'Invoice', 'id'),
                //'payments' => array(self::HAS_MANY, 'Payments', 'invoice_id'),
                // 'payedAmt' => array(self::STAT,  'Payments', 'id', 'select' => 'SUM(AMOUNT)'),
                // 'totAmt'=>array(self::STAT,  'InvoiceItems', 'invoice_id', 'select' => 'SUM(AMOUNT)'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'invoice_id' => 'Invoice Number',
            'quotation_id' => 'Quote Number',
            'id' => 'ID',
            'st_type' => ' Type',
            'customer_no' => 'Customer',
            'venue_id' => 'Venue',
            'ship_date' => 'Event Date',
            'CREATE_DATE' => 'Create Date',
            'closed' => 'Closed',
            'notes' => 'Notes',
            'is_same' => ' Ship to customer?',
        );
    }

    public function getKeyField()
    {
        $kf = ($this->st_type == statement::TYPE_QUOTATION) ? 'quotation_id' : 'invoice_id';
        return $kf;
    }

    public function getRelModel()
    {
        $rm = ($this->st_type == statement::TYPE_QUOTATION) ? $this->quotation : $this->invoice;
        return $rm;
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



    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return statement the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /* public static function makeMoney($money) {
         return Yii::app()->numberFormatter->formatCurrency($money, "USD");
     }

     protected function getShipCondition($from, $to){
         $cond = "";
          if (!empty($to) && !empty($from)) {
            // $from = CDateTimeParser::parse($from, 'yy-MM-dd');
           //  $to = CDateTimeParser::parse($to, 'yy-MM-dd');
             $cond = "ship_date  >= '$from' and ship_date <= '$to'";
         } elseif (!empty($from)) {
           //  $from = CDateTimeParser::parse($from, 'yy-MM-dd');
             $cond = "ship_date >= '$from'";
             // date is database date column field
         } 
          elseif (!empty($to)) {
             //$to = CDateTimeParser::parse($to, 'yy-MM-dd');
             $cond = "ship_date <= '$to'";
             // date is database date column field
         } 
         else {//(!empty($to))
           //  $from = date('Y-m-d',strtotime('yesterday'));
          //   $to = date('Y-m-d',strtotime('next month'));
            $cond = "ship_date  >= '$from' and ship_date <= '$to'";
             
         }
         
         return $cond;
         
     }
     */
    protected function beforeDelete()
    {
        foreach ($this->items as $item)
            $item->delete();
        return parent::beforeDelete();
    }
    protected function beforeSave()
    {

        if (parent::beforeSave()) {
            //$this -> CREATE_DATE = CTimestamp::formatDate('m-d-Y');
            //$this -> ship_date = date('m-d-Y');
            //  $this->CREATE_DATE = CTimestamp::formatDate('m-d-Y');
            //echo $this->event_date; Yii::app()->end();
            //$this->ship_date =CDateTimeParser::parse($this->event_date,'yy-MM-dd');

            if ($this->isNewRecord) {
                $this->paid = '0';
            } else {
                // $this->relModel->update_time = time();
                // $this->relModel->save();
            }
            // $this->closed = 0;
            return true;
        } else
            return false;
    }


    public function getFileName()
    {
        if (!empty($this->invoice->invoice_id))
            $file = 'invoices/' . $this->invoice->invoice_id;
        else if (!empty($this->quotation->quotation_id))
            $file = 'quotations/' . $this->quotation->quotation_id;
        return '/files/' . $file . '.pdf';
    }
    /*
        public function getHeader1() {
            $hdr = ' from Prime Party Rentals';
            return ($this->st_type == statement::TYPE_QUOTATION) ? 'Quote' . $hdr : 'Invoice' . $hdr;
        }
    */
    public function getHeader2()
    {

        return ($this->st_type == statement::TYPE_QUOTATION) ? 'QUOTE' : 'INVOICE';
    }

    /*   public function getBalance() {
           return ($this->itemsTotal - $this->paymentsTotal);
       }

       public function getItemsTotal() {
           $total = 0.0;
           foreach ($this->items as $item) {
               $total += $item->price * $item->quantity;
           }
           return $total;
       }
   */
    protected function afterSave()
    {
        parent::afterSave();
    }

    public function getUserName($id)
    {
        $user = User::model()->findByPk($id);
        if (!empty($user))
            return $user->username;
    }

    /*  public function invUnique($attribute, $params) {
          if(empty($this->invoice_id) && $this->st_type == statement::TYPE_INVOICE)
              $this->addError($attribute, "Invoice Number is required!");
          else if (($this->getIsNewRecord()) && (Invoice::model()->count('invoice_id=:name', array(':name' => $this->invoice_id)) > 0)) {
              $this->addError($attribute, "Invoice Number already exists!");
          }
      }

      public function qtnUnique($attribute, $params) {
          if(empty($this->quotation_id)&& $this->st_type == statement::TYPE_QUOTATION)
              $this->addError($attribute, "Quote Number is required!");
          else if (($this->getIsNewRecord()) && (Quotation::model()->count('quotation_id=:name', array(':name' => $this->quotation_id)) > 0)) {
              $this->addError($attribute, "Quote Number already exists!");
              
          }
      }*/
    public static function getQtnNumberRange()
    {
        $id2 = Yii::app()->db->createCommand()
            ->select('MAX(quotation_id)')
            ->from('quotation')
            ->where("quotation_id LIKE '1%'")
            ->queryScalar();
        return $id2;
    }
    public static function getInvNumberRange()
    {
        $id1 = Yii::app()->db->createCommand()
            ->select('MAX(invoice_id)')
            ->from('invoice')
            ->where("invoice_id LIKE '2%'")
            ->queryScalar();

        return $id1;

        // return "<span>Quote: </span><span><label class='label-success'>" . $id2 . "</label></span><br><span>Invoice: </span><span><label class='label-success'>" . $id1 . "</label></span>";
    }

    public function freeSearch($keyword)
    {

        /*Creating a new criteria for search*/
        $criteria = new CDbCriteria;
        $criteria->with = array('quotation', 'invoice');

        if (!empty($keyword)) {
            Yii::app()->session['ship_date'] = date("m/d/Y", strtotime($keyword));
            $criteria->compare("DATE_FORMAT(ship_date, '%m/%d/%Y')", $keyword, true);
        }
        // $criteria->with = array('quotation', 'invoice');
        // $criteria->compare('quotation.quotation_id', $keyword, true, 'OR');
        //  $criteria->compare('invoice.invoice_id', $keyword, true, 'OR');

        //    print_r($criteria); die;
        /*result limit*/
        $criteria->limit = 100;
        /*When we want to return model*/
        //    return  statement::model()->findAll($criteria);

        /*To return active dataprovider uncomment the following code*/

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        )
        );


    }

    public function dateValid($attribute, $params)
    {
        $valid = null;
        $today = date('Y-m-d', time());
        /* if(isset($params['minDate']))
             $valid = date('Y-m-d', strtotime($params['minDate'])); //+7 day

         if( !is_null($valid) )
         {  //for increamental date
             if($this->dt_ini >  $valid || $this->dt_ini < $today )
                 $this->addError($attribute, 'enter error message');     
         }  */
        if ($this->$attribute < $today)
            $this->addError($attribute, 'Wrong Entry. Try again!');
    }

}