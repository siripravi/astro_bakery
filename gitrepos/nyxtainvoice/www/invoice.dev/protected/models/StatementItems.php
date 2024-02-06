<?php

/**
 * This is the model class for table "statement_items".
 *
 * The followings are the available columns in table 'statement_items':
 * @property integer $id
 * @property integer $st_id
 * @property integer $st_type
 * @property string $description
 * @property string $quantity
 * @property string $price
 * @property integer $status
 */
class StatementItems extends CActiveRecord
{
	const ITEM_STATUS_OLD = 0;
	const ITEM_STATUS_NEW = 1;
	const ITEM_STATUS_DELETE = 3;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'statement_items';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('st_id, st_type, description, status', 'required'),
			array('st_id, st_type, sequence, status', 'numerical', 'integerOnly' => true),
			array('description', 'length', 'max' => 255),
			array('quantity', 'length', 'max' => 8),
			array('price', 'length', 'max' => 10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, st_id, st_type, description, quantity, price, status', 'safe', 'on' => 'search'),
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
			'id' => 'id',
			'st_id' => 'St',
			'st_type' => 'St Type',
			'description' => 'description',
			'quantity' => 'quantity',
			'price' => 'price',
			'status' => 'Status',
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
		$criteria->compare('st_id', $this->st_id);
		$criteria->compare('st_type', $this->st_type);
		$criteria->compare('description', $this->description, true);
		$criteria->compare('quantity', $this->quantity, true);
		$criteria->compare('price', $this->price, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		)
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StatementItems the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}