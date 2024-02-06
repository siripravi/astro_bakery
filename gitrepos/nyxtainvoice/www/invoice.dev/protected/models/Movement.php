<?php

/**
 * This is the model class for table "movement".
 *
 * The followings are the available columns in table 'movement':
 * @property integer $id
 * @property integer $st_id
 * @property integer $mov_type
 * @property string $mov_time_start
 * @property string $mov_time_end
 * @property string $truck_number
 * @property string $description
 *
 * The followings are the available model relations:
 * @property MovEmployee[] $movEmployees
 * @property statement $st
 */
class Movement extends ManyManyActiveRecord
{
	public $employees = array();

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'movement';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('st_id, mov_type, mov_time_start', 'required'),
			array('mov_date, instructions', 'safe'),
			array('st_id, mov_type', 'numerical', 'integerOnly' => true),
			array('truck_number', 'length', 'max' => 100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, st_id, mov_type, mov_time_start, mov_time_end, truck_number', 'safe', 'on' => 'search'),
		);
	}

	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				//'createAttribute' => 'starttime',
				//'updateAttribute' => 'update_time_attribute',
			),

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
			'movemp' => array(self::MANY_MANY, 'Employee', 'mov_employee(mov_id, emp_id)'),
			'employees' => array(self::HAS_MANY, 'MovEmployee', 'id'),
			'st' => array(self::BELONGS_TO, 'statement', 'st_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'st_id' => 'St',
			'mov_type' => 'Mov Type',
			'mov_time_start' => 'Mov Time Start',
			'mov_time_end' => 'Mov Time End',
			'truck_number' => 'Truck Number',
			'description' => 'Description',
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
		$criteria->compare('mov_type', $this->mov_type);
		$criteria->compare('mov_time_start', $this->mov_time_start, true);
		$criteria->compare('mov_time_end', $this->mov_time_end, true);
		$criteria->compare('truck_number', $this->truck_number, true);
		$criteria->compare('description', $this->description, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		)
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Movement the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}

	protected function beforeSave()
	{

		if (parent::beforeSave()) {

			//$this->ship_date =CDateTimeParser::parse($this->event_date,'MM-dd-yyyy');

			if ($this->isNewRecord) {
				// $this->created=$this->modified=time();
				$this->cuser_id = $this->uuser_id = Yii::app()->user->id;
			} else {
				//$this->modified=time();
				$this->uuser_id = Yii::app()->user->id;
			}
			$this->mov_date = date("Y-m-d");
			return true;
		} else
			return false;

	}
}