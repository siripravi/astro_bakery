<?php

class m160202_052951_initial extends CDbMigration
{
    public function up()
    {
        $this->createTable('customer', array(
            'CUSTOMER_NO' => 'pk',
            'first_name' => 'varchar(30) DEFAULT NULL',
            'last_name' => 'varchar(30) DEFAULT NULL',
            'address1' => 'varchar(30) DEFAULT NULL',
            'address2' => 'varchar(30) DEFAULT NULL',
            'city' => 'varchar(30) DEFAULT NULL',
            'state' => 'char(2) DEFAULT NULL',
            'zip' => 'varchar(6) DEFAULT NULL',
            'phone1' => 'varchar(15) DEFAULT NULL',
            'phone2' => 'varchar(15) DEFAULT NULL',
            'email1' => 'varchar(45) DEFAULT NULL',
            'email2' => 'varchar(45) DEFAULT NULL',
            'NOTES' => 'varchar(255) DEFAULT NULL',
        ), '');

        $this->createTable('invoice', array(
            'st_id' => 'int(11) NOT NULL',
            'ref_id' => 'int(11) DEFAULT NULL',
            'st_type' => 'int(11) DEFAULT NULL',
            'invoice_id' => 'varchar(20) NOT NULL',
            'create_time' => 'datetime',
            'update_time' => 'datetime',
            'delv_from' => 'datetime',
            'delv_to' => 'datetime',
            'pick_from' => 'datetime',
            'pick_to' => 'datetime',
            'pack_instr' => 'text',
            'is_paid' => 'varchar(1) NOT NULL DEFAULT \'0\'',
            'cuser_id' => 'int(11) NOT NULL',
            'uuser_id' => 'int(11) NOT NULL',
        ), '');

        $this->addPrimaryKey('pk_invoice', 'invoice', 'st_id');

        $this->createTable('mode', array(
            'MODE_ID' => 'pk',
            'MODE_DESCRIPTION' => 'varchar(15) NOT NULL',
        ), '');

        $this->createTable('payments', array(
            'ID' => 'pk',
            'INVOICE_ID' => 'int(11) NOT NULL',
            'MODE_ID' => 'int(11) NOT NULL',
            'AMOUNT' => 'decimal(10,2) DEFAULT NULL',
            'balance' => 'float(10,2) NOT NULL',
            'PAY_DATE' => 'varchar(20) NOT NULL',
            'DETAILS' => 'varchar(100) DEFAULT NULL',
            'DEPOSITED_BY' => 'varchar(25) DEFAULT NULL',
            'created' => 'int(10) NOT NULL',
            'modified' => 'int(10) NOT NULL',
            'cuser_id' => 'int(11) NOT NULL',
            'uuser_id' => 'int(11) NOT NULL',
        ), '');

        $this->createTable('quotation', array(
            'st_id' => 'int(11) NOT NULL',
            'st_type' => 'int(11) NOT NULL',
            'quotation_id' => 'varchar(20) NOT NULL',
            //'approval'=>'char(1) NOT NULL DEFAULT \'0\'',
            'create_time' => 'datetime',
            'update_time' => 'datetime',
            'cuser_id' => 'int(11) NOT NULL',
            'uuser_id' => 'int(11) NOT NULL',

        ), '');

        $this->addPrimaryKey('pk_quotation', 'quotation', 'st_id');

        $this->createTable('statement', array(
            'id' => 'pk',
            'st_type' => 'tinyint(4) NOT NULL',
            //'CUSTOMER_NO'=>'int(11) NOT NULL',
            'customer_no' => 'int(11) NOT NULL',
            //'VENUE_ID'=>'int(11) NOT NULL',
            'venue_id' => 'int(11) NOT NULL',
            //'SHIP_DATE'=>'int(11) NOT NULL',
            'ship_date' => 'date NOT NULL',
            //'CREATE_DATE'=>'varchar(20) NOT NULL',
            'paid' => 'varchar(1) NOT NULL DEFAULT \'0\'',
            //'CLOSED'=>'char(1) NOT NULL',
            'closed' => 'char(1) NOT NULL',
            //'NOTES'=>'varchar(255) DEFAULT NULL',
            'notes' => 'varchar(255) DEFAULT NULL',
            // 'created'=>'int(10) NOT NULL',
            // 'modified'=>'int(10) NOT NULL',
            // 'cuser_id'=>'int(11) NOT NULL',
            // 'uuser_id'=>'int(11) NOT NULL',
        ), '');

        $this->createTable('statement_items', array(
            'ID' => 'pk',
            'st_id' => 'int(11) NOT NULL',
            'st_type' => 'int(11) NOT NULL',
            'DESCRIPTION' => 'varchar(255) NOT NULL',
            'QUANTITY' => 'decimal(8,2) DEFAULT NULL',
            'PRICE' => 'decimal(10,2) DEFAULT NULL',
            'sequence' => 'int(11) NOT NULL',
            'status' => 'int(11) NOT NULL',
        ), '');

        $this->createTable('tbl_user', array(
            'id' => 'pk',
            'username' => 'varchar(30) NOT NULL',
            'password' => 'varchar(100) NOT NULL',
            'email' => 'varchar(100) NOT NULL',
            'status' => 'tinyint(4) NOT NULL',
            'accessLevel' => 'tinyint(4) NOT NULL',
            'homeUrl' => 'varchar(100',
            'profile' => 'text DEFAULT NULL',
        ), '');

        $this->createTable('venue', array(
            'VENUE_ID' => 'pk',
            'ship_name' => 'varchar(30) DEFAULT NULL',
            'ship_add1' => 'varchar(30) DEFAULT NULL',
            'ship_add2' => 'varchar(30) DEFAULT NULL',
            'SHIP_city' => 'varchar(30) DEFAULT NULL',
            'SHIP_state' => 'char(2) DEFAULT NULL',
            'SHIP_zip' => 'varchar(6) DEFAULT NULL',
            'SHIP_phone1' => 'varchar(15) DEFAULT NULL',
            'SHIP_phone2' => 'varchar(15) DEFAULT NULL',
            'SHIP_email1' => 'varchar(45) DEFAULT NULL',
            'SHIP_DETAILS' => 'varchar(255) DEFAULT NULL',
        ), '');
    }

    public function down()
    {
        //echo "m160202_052951_initial does not support migration down.\n";
        //return false;
        $this->dropTable('customer');
        $this->dropTable('invoice');
        $this->dropTable('mode');
        $this->dropTable('payments');
        $this->dropTable('quotation');
        $this->dropTable('statement');
        $this->dropTable('statement_items');
        $this->dropTable('tbl_user');
        $this->dropTable('venue');
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
}