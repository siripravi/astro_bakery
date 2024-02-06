<?php

/**
 * This is the model class for table "employee".
 *
 * The followings are the available columns in table 'employee':
 * @property integer $id
 * @property integer $emp_type_id
 * @property string $title1
 * @property string $first_name
 * @property string $mid_name1
 * @property string $last_name1
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state_id
 * @property string $postal_code
 * @property string $country
 * @property string $phone1
 * @property string $phone2
 * @property string $email
 * @property string $date_created
 * @property string $notes
 *
 * The followings are the available model relations:
 * @property Employee $empType
 * @property Employee[] $employees
 * @property MovEmployee $movEmployee
 */
class Employee extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'employee';
	}

	public function getFullName()
	{
		return $this->first_nme . ' ' . $this->last_name;
	}


	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		//NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name,', 'required'),
			array('emp_type_id', 'numerical', 'integerOnly' => true),
			array('title', 'length', 'max' => 8),
			array('first_name,  last_name, address1, address2, city, state, country, phone1, phone2', 'length', 'max' => 32),
			array('address1, email', 'length', 'max' => 64),
			array('postal_code', 'length', 'max' => 16),
			array('title,notes', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, emp_type_id, title1, first_name, mid_name1, last_name1, address1, address2, city, state_id, postal_code, country, phone1, phone2, email, date_created, notes', 'safe', 'on' => 'search'),
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
			'empType' => array(self::BELONGS_TO, 'Designation', 'emp_type_id'),
			//'employees' => array(self::HAS_MANY, 'Employee', 'emp_type_id'),
			'movEmployee' => array(self::HAS_ONE, 'MovEmployee', 'emp_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'emp_type_id' => 'Designation',
			'title1' => 'Title1',
			'first_name' => 'First Name',
			'mid_name1' => 'Mid Name1',
			'last_name1' => 'Last Name1',
			'address1' => 'address1',
			'address2' => 'address2',
			'city' => 'city',
			'state_id' => 'state',
			'postal_code' => 'Postal Code',
			'country' => 'Country',
			'phone1' => 'phone1',
			'phone2' => 'phone2',
			'email' => 'Email',
			'date_created' => 'Date Created',
			'notes' => 'Notes',
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
		$criteria->compare('emp_type_id', $this->emp_type_id);
		$criteria->compare('title', $this->title, true);
		$criteria->compare('first_name', $this->first_name, true);
		//$criteria->compare('mid_name',$this->mid_name,true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('address1', $this->address1, true);
		$criteria->compare('address2', $this->address2, true);
		$criteria->compare('city', $this->city, true);
		$criteria->compare('state', $this->state, true);
		$criteria->compare('postal_code', $this->postal_code, true);
		$criteria->compare('country', $this->country, true);
		$criteria->compare('phone1', $this->phone1, true);
		$criteria->compare('phone2', $this->phone2, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('date_created', $this->date_created, true);
		$criteria->compare('notes', $this->notes, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		)
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Employee the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}