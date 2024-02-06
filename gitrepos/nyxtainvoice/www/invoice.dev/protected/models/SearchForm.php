<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SearchForm extends CFormModel
{

    public $from_date;
    public $to_date;
    public $ship_date;
    public $st_type;
    public $is_paid;
    public $customer_name;
    public $venue_id;
    public $customer_no;
    public $invoice_id;
    public $quotation_id;
    public $created;
    public $updated;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // username and password are required
            array('from_date, to_date, ship_date, st_type, is_paid, customer_name, venue_id,customer_no invoice_id, quotation_id, created, updated', 'safe', 'on' => 'search'),
            // rememberMe needs to be a boolean
            // password needs to be authenticated
            // array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'is_paid' => 'Pay Status',
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $this->_identity = new UserIdentity($this->username, $this->password);
            if (!$this->_identity->authenticate())
                $this->addError('password', 'Incorrect username or password.');
        }
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful  1452240000  1452274715
     */
    public function search()
    {
        $this->st_type = statement::TYPE_INVOICE;
        $this->from_date = (empty($this->from_date)) ? date('Y-m-d', strtotime('yesterday')) : $this->from_date;
        $this->to_date = (empty($this->to_date)) ? date('Y-m-t', strtotime('next month')) : $this->to_date;

        $criteria = new CDbCriteria;
        $criteria->with = array('statement', 'statement.customer', 'statement.venue');
        // $criteria->compare('statement.st_type', $this->st_type);        
        $criteria->compare('is_paid', $this->is_paid);

        //  $criteria->compare('CONCAT(customer.first_name, \' \', customer.last_name)', $this->customer_name, true);
        //  $criteria->compare('venue.ship_name', $this->ship_name, true);

        if (!empty($this->invoice_id)) {
            $condition = "invoice_id LIKE :i";
            $criteria->params[':i'] = "%" . $this->invoice_id . "%";
            $criteria->addCondition($condition);
        } else if (!empty($this->created)) {
            $criteria->compare("DATE_FORMAT(create_time, '%Y-%m-%d')", $this->created, true);
        } else {
            $condition = self::getShipCondition($this->from_date, $this->to_date);
            if (!empty($condition)) {
                $criteria->addCondition($condition);
            }

            if (!empty($this->customer_name)) {
                $condition = "CONCAT(customer.first_name,' ',customer.last_name ) LIKE :c";
                $criteria->params[':c'] = "%" . $this->customer_name . "%";
                $criteria->addCondition($condition);
            }
            if ($this->venue_id !== "0") {
                $condition = "venue.venue_id = :v";
                $criteria->params[':v'] = $this->venue_id;
                $criteria->addCondition($condition);
            }
            // SEARCH BY CREATE DATE
            /*   if (strpos($this->created, ".")) {
                       list($day,$month,$year) = explode(".",$this->created);
                       //list($day,$month,$year) = explode("/",$this->start);
                       $daystart= mktime(0,0,0,(int)$month,(int)$day,(int)$year);
                       $dayend= mktime(23,59,59,(int)$month,(int)$day,(int)$year);
                 //  $this->created = mktime(0,0,0,(int)$month,(int)$day,(int)$year);
                   $this->created = CDateTimeParser::parse($this->created, 'dd.MM.yyyy');
                  //  echo $this->created; die;
                   $criteria->addCondition(':s<= UNIX_TIMESTAMP(create_time) AND UNIX_TIMESTAMP(create_time)<=:e');
                   $criteria->params[':s']=$daystart;
                   $criteria->params[':e'] =$dayend;
                 //  echo $daystart; echo ' '; echo $dayend;
                 //  print_r($criteria->condition); die;

               }*/

            //  
        }

        return new CActiveDataProvider(new Invoice(), array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'ship_date ASC',
                // 'multisort'=>true, //maybe your solution!
// 'attributes'=>array(
//    'field_1','field_2', 'field_3','field_4','field_5'
            ),
            'pagination' => array(
                'pageSize' => 50,
            )
        )
        );
    }

    public static function getShipCondition($from, $to)
    {
        $cond = "";
        if (!empty($to) && !empty($from)) {
            // $from = CDateTimeParser::parse($from, 'yy-MM-dd');
            //  $to = CDateTimeParser::parse($to, 'yy-MM-dd');
            $cond = "ship_date  >= '$from' and ship_date <= '$to'";
        } elseif (!empty($from)) {
            //  $from = CDateTimeParser::parse($from, 'yy-MM-dd');
            $cond = "ship_date >= '$from'";
            // date is database date column field
        } elseif (!empty($to)) {
            //$to = CDateTimeParser::parse($to, 'yy-MM-dd');
            $cond = "ship_date <= '$to'";
            // date is database date column field
        } else { //(!empty($to))
            //  $from = date('Y-m-d',strtotime('yesterday'));
            //   $to = date('Y-m-d',strtotime('next month'));
            $cond = "ship_date  >= '$from' and ship_date <= '$to'";
        }

        return $cond;
    }

}