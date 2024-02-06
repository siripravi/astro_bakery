<?php

/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile
 */
class User extends CActiveRecord
{

    const LEVEL_REGISTERED = 0, LEVEL_SUPPORT = 4, LEVEL_AUTHOR = 6, LEVEL_ADMIN = 10, LEVEL_SUPERADMIN = 99;
    const ERROR_NONE = 0;

    //ERROR_USERNAME_INVALID = 1;
//ERROR_PASSWORD_INVALID = 2;
//ERROR_UNKNOWN_IDENTITY = 100; 
    public $rememberMe;
    private $_identity;
    public $verifyPassword;
    public $level;
    public $homeUrl;
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'tbl_user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('username,  email', 'required', 'on' => 'registration'),
            array('username', 'unique'),
            array('email', 'email'),
            //CEmailValidator
            array('username, password, email', 'length', 'max' => 128),
            array('username, password', 'required', 'on' => 'login'),
            array('password', 'authenticate', 'on' => 'login'),
            array('password', 'required'),
            //array('verifyPassword','compare','compareAttribute'=>'password','on'=>'change'),
            //	array('verifyPassword','safe'),
            array('profile,rememberMe, level, homeUrl', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, username, password, email, profile', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {

        return array(
            'employee' => array(self::BELONGS_TO, 'Employees', 'id')
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'profile' => 'Profile',
        );
    }

    /** $user = new User('search'); $user->scenario = 'search';
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
        $criteria->compare('username', $this->username, true);
        $criteria->compare('password', $this->password, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('profile', $this->profile, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        )
        );
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        $this->_identity = new UserIdentity($this->username, $this->password);
        if (!$this->_identity->authenticate())
            $this->addError('password', 'Incorrect username or password.');
    }

    public function login()
    {

        /* if($this->scenario === "change"){
          $this->password = $this->verifyPassword = md5($this->password);
          $this->status = 1;
          $this->save();
          Yii::log("Model pattribs: " . var_export($this->password, true), CLogger::LEVEL_WARNING, __METHOD__);
          } */
        $this->_identity = new UserIdentity($this->username, $this->password);
        $this->_identity->authenticate();

        if ($this->_identity->errorCode == User::ERROR_NONE) {


            Yii::app()->user->login($this->_identity, 0);
            return true;
        } else
            return false;
    }

    /**
     * parameters additional preparations before saving the user
     */
    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            // set the new user creation_date
            //	if ($this->isNewRecord){
            $this->password = md5($this->password);
            if (($this->level >= User::LEVEL_SUPPORT) && ($this->level < User::LEVEL_AUTHOR)) {
                $this->homeUrl = "/support/index";

            } else {
                $this->homeUrl = "/site/index";
            }
            return true;
        }
        return false;
    }

    /**
     * define the label for each level
     * @param int $level the level to get the label or null to return a list of labels
     * @return array|string
     */
    static function getlevelList($level = null)
    {
        $levelList = array(
            self::LEVEL_REGISTERED => 'User',
            self::LEVEL_SUPPORT => 'Support',
            self::LEVEL_AUTHOR => 'Author',
            self::LEVEL_ADMIN => 'Administrator'
        );
        if ($level === null)
            return $levelList;
        return $levelList[$level];
    }

    public static function getUserName($id)
    {
        $user = User::model()->findByPk($id);
        if (!empty($user))
            return $user->username;
    }

}