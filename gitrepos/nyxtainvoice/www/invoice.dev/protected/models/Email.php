<?php
class Email extends CActiveRecord
{
    public function tableName()
    {
        return 'emails';
    }

    public function rules()
    {
        return array(
            array('email, name, subject, body', 'required'),
            array('email, name, subject', 'length', 'max' => 255),
            array('email', 'email'),
            array('email, name, subject', 'safe', 'on' => 'search'),
        );
    }

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}