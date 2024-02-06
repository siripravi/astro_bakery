<?php

class m160202_052951_initial extends CDbMigration
{
    public function up()
    {

        $this->createTable('customer_cards', array(
            'id' => 'pk',
            'customer_no' => 'int(11) NOT NULL',
            'card_type' => 'int(11) NOT NULL',
            'card_number' => 'varchar(30) NOT NULL',
            'card_name' => 'varchar(100) NOT NULL',
            'card_expiry_mn' => 'varchar(2) NOT NULL',
            'card_expiry_yr' => 'varchar(2) NOT NULL',
            'card_csc' => 'varchar(6) NOT NULL',
            'street_number' => 'varchar(225) NOT NULL',
            'route' => 'varchar(100) NOT NULL',
            'locality' => 'varchar(100) NOT NULL',
            'postal_code' => 'varchar(15) NOT NULL',
            'country' => 'varchar(50) NOT NULL',
            'administrative_area_level_1' => 'varchar(50) NOT NULL',
            'status' => 'char(1) NOT NULL',
        ), '');

        $this->createIndex('idx_customer_no', 'customer_cards', 'customer_no', FALSE);

        $this->createTable('designation', array(
            'emp_type_id' => 'pk',
            'designation' => 'varchar(32) NOT NULL',
            'design_abbr' => 'varchar(8) DEFAULT NULL',
        ), '');

        $this->createTable('employee', array(
            'id' => 'pk',
            'emp_type_id' => 'smallint(5) unsigned DEFAULT NULL',
            'title' => 'varchar(8) DEFAULT NULL',
            'first_name' => 'varchar(32) DEFAULT NULL',
            'last_name' => 'varchar(32) DEFAULT NULL',
            'address1' => 'varchar(64) DEFAULT NULL',
            'address2' => 'varchar(32) DEFAULT NULL',
            'city' => 'varchar(32) DEFAULT NULL',
            'state' => 'varchar(32) DEFAULT NULL',
            'postal_code' => 'varchar(16) DEFAULT NULL',
            'country' => 'varchar(32) DEFAULT NULL',
            'phone1' => 'varchar(32) DEFAULT NULL',
            'phone2' => 'varchar(32) DEFAULT NULL',
            'email' => 'varchar(64) DEFAULT NULL',
            'date_created' => 'timestamp NOT NULL',
            'notes' => 'text DEFAULT NULL',
        ), '');

        $this->createIndex('idx_emp_type_id', 'employee', 'emp_type_id', FALSE);

    }

    public function down()
    {
        $this->dropTable('card_type');
        $this->dropTable('customer_cards');
        $this->dropTable('designation');
        $this->dropTable('employee');

    }
    /*
       // Use safeUp/safeDown to do migration with transaction
       public function safeUp()
       {
       }

       public function safeDown()
       {
       }
       */
    // UPDATE table SET date = FROM_UNIXTIME(ship_date)
    // UPDATE `payments` SET `PAY_DATE`=STR_TO_DATE( PAY_DATE, '%m-%d-%Y')
    //  1442243305
    //  UPDATE `statement` SET `ship_date`=FROM_UNIXTIME(ship_date)
    // UPDATE `statement` SET `ship_date`=FROM_UNIXTIMESTAMP()

    //UPDATE `statement` SET `ship_date`=UNIX_TIMESTAMP()
    //UNIX_TIMESTAMP()
}