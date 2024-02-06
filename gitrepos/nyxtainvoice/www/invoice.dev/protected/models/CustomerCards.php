<?php

/**
 * This is the model class for table "customer_cards".
 *
 * The followings are the available columns in table 'customer_cards':
 * @property integer $id
 * @property integer $customer_no
 * @property integer $card_type
 * @property string $card_number
 * @property string $card_name
 * @property string $card_expiry_mn
 * @property string $card_expiry_yr
 * @property string $card_csc
 * @property string $street_number
 * @property string $route
 * @property string $locality
 * @property string $postal_code
 * @property string $country
 * @property string $administrative_area_level_1
 *
 * The followings are the available model relations:
 * @property Customer $cust
 */
class CustomerCards extends CActiveRecord
{
	public $cc1;
	public $cc2;
	public $cc3;
	public $cc4;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer_cards';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array(' card_type, cc1, cc2, cc3, cc4, card_name, card_expiry_mn, card_expiry_yr, card_csc', 'required'),
			array('customer_no,street_number, route, locality, postal_code, country, administrative_area_level_1,status', 'safe'),
			array('customer_no, card_type', 'numerical', 'integerOnly' => true),
			array('card_number', 'length', 'max' => 30),
			array('card_name, route, locality', 'length', 'max' => 100),
			array('card_expiry_mn, card_expiry_yr', 'length', 'max' => 2),
			array('card_csc', 'length', 'max' => 6),
			array('street_number', 'length', 'max' => 225),
			array('postal_code', 'length', 'max' => 15),
			array('country, administrative_area_level_1', 'length', 'max' => 50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, customer_no, card_type, card_number, card_name, card_expiry_mn, card_expiry_yr, card_csc, street_number, route, locality, postal_code, country, administrative_area_level_1', 'safe', 'on' => 'search'),
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
			//  'cust' => array(self::BELONGS_TO, 'Customer', 'customer_no'),
			'type' => array(self::BELONGS_TO, 'CardType', 'card_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'customer_no' => 'Cust',
			'card_type' => 'Card Type',
			'card_number' => 'Card Number',
			'card_name' => 'Card Name',
			'card_expiry_mn' => 'Card Expiry Mn',
			'card_expiry_yr' => 'Card Expiry Yr',
			'card_csc' => 'Card Csc',
			'street_number' => 'Street Number',
			'route' => 'Route',
			'locality' => 'Locality',
			'postal_code' => 'Postal Code',
			'country' => 'Country',
			'administrative_area_level_1' => 'Administrative Area Level 1',
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

		$criteria->compare('id', $this->id);
		$criteria->compare('customer_no', $this->customer_no);
		$criteria->compare('card_type', $this->card_type);
		$criteria->compare('card_number', $this->card_number, true);
		$criteria->compare('card_name', $this->card_name, true);
		$criteria->compare('card_expiry_mn', $this->card_expiry_mn, true);
		$criteria->compare('card_expiry_yr', $this->card_expiry_yr, true);
		$criteria->compare('card_csc', $this->card_csc, true);
		$criteria->compare('street_number', $this->street_number, true);
		$criteria->compare('route', $this->route, true);
		$criteria->compare('locality', $this->locality, true);
		$criteria->compare('postal_code', $this->postal_code, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('administrative_area_level_1', $this->administrative_area_level_1, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		)
		);
	}


	public function afterFind()
	{
		list($this->cc1, $this->cc2, $this->cc3, $this->cc4) = explode(' ', $this->card_number);
	}

	protected function beforeSave()
	{
		if (parent::beforeSave()) {
			//$this->ship_date =CDateTimeParser::parse($this->event_date,'MM-dd-yyyy');

			if ($this->isNewRecord) {
				$this->card_number = $this->cc1 . " " . $this->cc2 . " " . $this->cc3 . " " . $this->cc4;

			} else {

			}

			return true;
		} else
			return false;

	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CustomerCards the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}