<?php

/**
 * This is the model class for table "venue".
 *
 * The followings are the available columns in table 'venue':
 * @property integer $venue_id
 * @property string $ship_name
 * @property string $ship_add1
 * @property string $ship_add2
 * @property string $ship_city
 * @property string $ship_state
 * @property string $ship_zip
 * @property string $ship_phone1
 * @property string $ship_phone2
 * @property string $ship_email1
 * @property string $ship_details
 */
class Venue extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'venue';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ship_name, ship_add1, ship_city, ship_phone1, ship_email1', 'required'),
			array('ship_name, ship_add1, ship_add2, ship_city', 'length', 'max' => 30),
			array('ship_state', 'length', 'max' => 2),
			array('ship_zip', 'length', 'max' => 6),
			array('ship_phone1, ship_phone2', 'length', 'max' => 15),
			array('ship_email1', 'length', 'max' => 45),
			array('ship_details', 'length', 'max' => 255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('venue_id, ship_name, ship_add1, ship_add2, ship_city, ship_state, ship_zip, ship_phone1, ship_phone2, ship_email1, ship_details', 'safe', 'on' => 'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'venue_id' => 'Venue',
			'ship_name' => 'Ship Name',
			'ship_add1' => 'Ship Add1',
			'ship_add2' => 'Ship Add2',
			'ship_city' => 'Ship city',
			'ship_state' => 'Ship state',
			'ship_zip' => 'Ship zip',
			'ship_phone1' => 'Ship phone1',
			'ship_phone2' => 'Ship phone2',
			'ship_email1' => 'Ship email1',
			'ship_details' => 'Ship Details',
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

		$criteria->compare('venue_id', $this->venue_id);
		$criteria->compare('ship_name', $this->ship_name, true);
		$criteria->compare('ship_add1', $this->ship_add1, true);
		$criteria->compare('ship_add2', $this->ship_add2, true);
		$criteria->compare('ship_city', $this->ship_city, true);
		$criteria->compare('ship_state', $this->ship_state, true);
		$criteria->compare('ship_zip', $this->ship_zip, true);
		$criteria->compare('ship_phone1', $this->ship_phone1, true);
		$criteria->compare('ship_phone2', $this->ship_phone2, true);
		$criteria->compare('ship_email1', $this->ship_email1, true);
		$criteria->compare('ship_details', $this->ship_details, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		)
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Venue the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}