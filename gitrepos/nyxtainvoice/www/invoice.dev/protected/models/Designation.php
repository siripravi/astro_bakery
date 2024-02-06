<?php

/**
 * This is the model class for table "designation".
 *
 * The followings are the available columns in table 'designation':
 * @property integer $emp_type_id
 * @property string $designation
 * @property string $design_abbr
 */
class Designation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'designation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('designation', 'required'),
			array('designation', 'length', 'max' => 32),
			array('design_abbr', 'length', 'max' => 8),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('emp_type_id, designation, design_abbr', 'safe', 'on' => 'search'),
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
			'emp_type_id' => 'Emp Type',
			'designation' => 'Designation',
			'design_abbr' => 'Design Abbr',
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

		$criteria->compare('emp_type_id', $this->emp_type_id);
		$criteria->compare('designation', $this->designation, true);
		$criteria->compare('design_abbr', $this->design_abbr, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		)
		);
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Designation the static model class
	 */
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
}