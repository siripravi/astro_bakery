<?php

/**
 * This is the model class for table "payments".
 *
 * The followings are the available columns in table 'payments':
 * @property integer $ID
 * @property integer $invoice_id
 * @property integer $mode_id
 * @property string $amount
 * @property string $pay_date
 * @property string $details
 * @property string $deposited_by
 */
class Payments extends CActiveRecord
{

    public $invoice_id;
    public $from_date;
    public $to_date;

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'payments';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('invoice_id, mode_id, pay_date,amount', 'required'),
            array('invoice_id, mode_id', 'numerical', 'integerOnly' => true, 'min' => 1),
            array('amount', 'length', 'max' => 10),
            array('details', 'length', 'max' => 100),
            array('deposited_by', 'length', 'max' => 25),
            array('pay_date', 'chkDate'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, invoice_id, mode_id, amount, pay_date, details, deposited_by,from_date,to_date', 'safe', 'on' => 'search'),
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
            'statement' => array(self::HAS_ONE, 'statement', array('id' => 'invoice_id')),
            'invoice' => array(self::HAS_ONE, 'Invoice', array('st_id' => 'invoice_id')),
            'mode' => array(self::HAS_ONE, 'Mode', array('mode_id' => 'mode_id')),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'invoice_id' => 'Invoice',
            'mode_id' => 'Mode',
            'amount' => 'amount',
            'pay_date' => 'Pay Date',
            'details' => 'details',
            'deposited_by' => 'Paid By',
            'cuser_id' => 'Created By',
            'uuser_id' => 'Updated By'
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
        $criteria->with = array('invoice');
        //$criteria->compare('ID',$this->ID);
        if ($this->from_date != null) {
            $criteria->addCondition("pay_date>=:from");
            $criteria->params += array('from' => date('Y-m-d', strtotime(str_replace('-', '/', $this->from_date))));
        }
        if ($this->to_date != null) {
            $criteria->addCondition("pay_date<=:to");
            $criteria->params += array('to' => date('Y-m-d', strtotime(str_replace('-', '/', $this->to_date))));
        }
        $criteria->compare('invoice.invoice_id', $this->invoice_id, true);
        $criteria->compare('mode_id', $this->mode_id);
        $criteria->compare('amount', $this->amount, true);
        $criteria->compare('pay_date', $this->pay_date, true);
        $criteria->compare('details', $this->details, true);
        $criteria->compare('deposited_by', $this->deposited_by, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 50
            ),
            'sort' => array(
                'defaultOrder' => 'pay_date DESC',
                // 'multisort'=>true, //maybe your solution!
                'attributes' => array(
                ),
            )
        )
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Payments the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function fetchTotal($records)
    {
        $total = 0.0;
        foreach ($records as $record)
            $total += $record->amount;
        return $total;
    }

    public function getUserName($id)
    {
        $user = User::model()->findByPk($id);
        if (!empty($user))
            return $user->username;
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            //$this->pay_date =CDateTimeParser::parse($this->event_date,'MM-dd-yyyy');			
            if ($this->isNewRecord) {
                $this->created = $this->modified = date('Y-m-d H:i:s');
                $this->cuser_id = $this->uuser_id = Yii::app()->user->id;
            } else {
                $this->modified = date('Y-m-d H:i:s');
                $this->uuser_id = Yii::app()->user->id;
            }

            return true;
        } else
            return false;
    }

    public static function makeMoney($money)
    {
        return Yii::app()->numberFormatter->formatCurrency($money, "USD");
    }

    public function chkDate($attribute, $params)
    {
        $today = date("Y-m-d");
        $payDate = str_replace('-', '/', date('Y-m-d', strtotime($this->$attribute)));
        $minDate = str_replace('-', '/', date('Y-m-d', strtotime($today)));
        $maxDate = str_replace('-', '/', date('Y-m-d', strtotime('+7 days', strtotime($today))));

        if (($attribute == "pay_date") && (!empty($maxDate))) {
            if (($payDate < $minDate) || ($payDate > $maxDate))
                $this->addError($attribute, "Error in Payment Date");
        }
    }

}