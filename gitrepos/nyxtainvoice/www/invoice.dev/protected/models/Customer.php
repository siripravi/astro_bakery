<?php

/**
 * This is the model class for table "customer".
 *
 * The followings are the available columns in table 'customer':
 * @property integer $customer_no
 * @property string $first_name
 * @property string $last_name
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $state
 * @property string $zip
 * @property string $phone1
 * @property string $phone2
 * @property string $email1
 * @property string $email2
 * @property string $notes
 */
class Customer extends CActiveRecord
{
	public $address;
	public $contact;
	public $customer_name;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'customer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name,address1,phone1,email1', 'required'),
			array('first_name, last_name, address1, address2, city', 'length', 'max' => 30),
			array('state', 'length', 'max' => 2),
			array('zip', 'length', 'max' => 6),
			array('phone1, phone2', 'length', 'max' => 15),
			array('email1, email2', 'length', 'max' => 45),
			array('notes', 'length', 'max' => 255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('customer_no, customer_name, first_name, last_name, address1, address2, city, state, zip, phone1, phone2, email1, email2, notes', 'safe', 'on' => 'search'),
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
			'invoices' => array(self::HAS_MANY, 'Invoice', 'customer_no'),
			'cards' => array(self::HAS_MANY, 'CustomerCards', 'customer_no')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'customer_no' => 'Customer No',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'address1' => 'address1',
			'address2' => 'address2',
			'city' => 'city',
			'state' => 'state',
			'zip' => 'zip',
			'phone1' => 'phone1',
			'phone2' => 'phone2',
			'email1' => 'email1',
			'email2' => 'email2',
			'notes' => 'Notes',
		);
	}

	public function getFullName()
	{
		return $this->first_name . ' ' . $this->last_name;
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

		$criteria->compare('customer_no', $this->customer_no);
		$criteria->compare('CONCAT(first_name, \' \', last_name)', $this->customer_name, true);
		$criteria->compare('first_name', $this->first_name, true);
		$criteria->compare('last_name', $this->last_name, true);
		$criteria->compare('address1', $this->address1, true);
		$criteria->compare('address2', $this->address2, true);
		$criteria->compare('city', $this->city, true);
		$criteria->compare('state', $this->state, true);
		$criteria->compare('zip', $this->zip, true);
		$criteria->compare('phone1', $this->phone1, true);
		$criteria->compare('phone2', $this->phone2, true);
		$criteria->compare('email1', $this->email1, true);
		$criteria->compare('email2', $this->email2, true);
		$criteria->compare('notes', $this->notes, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		)
		);
	}
	/**
	 * Suggests a list of existing tags matching the specified keyword.
	 * @param string the keyword to be matched
	 * @param integer maximum number of tags to be returned
	 * @return array list of matching tag names
	 */
	public function suggestTags($keyword, $limit = 20)
	{
		//$criteria=New CDbCriteria ; 
		//$criteria->addSearchCondition('CONCAT_WS(" ",first_name,last_name)',$keyword,true);
		//$criteria->params = 
		//$list = User::model()->findAll($criteria);
		$tags = $this->findAll(
			array(
				'condition' => 'first_name || last_name LIKE :keyword',
				//'order'=>'frequency DESC, Name',
				'limit' => $limit,
				'params' => array(
					':keyword' => '%' . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
				),
			)
		);
		$names = array();
		foreach ($tags as $tag) {
			$names[] = array(
				'id' => (int) $tag->customer_no,
				'text' => $tag->first_name . " " . $tag->last_name
			);
		}
		return $names;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Customer the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	protected function renderAddress($data, $row)
	{
		$address = '  
            <address>
            <strong>' . $data->address1 . '</strong><br>' . $data->address1 . ',' . $data->address2 . ' <br>' .
			$data->city . ',' . $data->state . ' ' . $data->zip . '<br>
            <abbr title="Phone">P:</abbr>' . $data->phone1
			. '<abbr title="Phone">P:</abbr>' . $data->phone2 .
			'</address>';

		return $address;
	}
	protected function renderContact($data, $row)
	{

		$contact =
			'<address>
          <strong>' . ucfirst($data->first_name) . ' ' . ucfirst($data->last_name) . '</strong><br>
          <a href="mailto:#">' . $data->email1 . '</a><br>
          <a href="mailto:#">' . $data->email2 . '</a>
        </address>';
		return $contact;
	}

	public function getUserName($id)
	{
		$user = User::model()->findByPk($id);
		if (!empty($user))
			return $user->username;
	}

	public function showAddress()
	{
		$address = '  
            <address>
            <strong>' . $this->address1 . '</strong><br>' . $this->address1 . ',' . $this->address2 . ' <br>' .
			$this->city . ',' . $this->state . ' ' . $this->zip . '<br>
            <abbr title="Phone">P:</abbr>' . $this->phone1
			. '<abbr title="Phone">P:</abbr>' . $this->phone2 .
			'</address>';

		echo $address;
	}
}