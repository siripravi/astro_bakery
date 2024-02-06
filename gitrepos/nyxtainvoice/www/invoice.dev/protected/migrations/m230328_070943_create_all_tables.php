<?php

class m230328_070943_create_all_tables extends CDbMigration
{
	public function up()
	{
		$this->createTable('card_type', array(
			'id' => 'pk',
			'card_type' => 'varchar(255) NOT NULL',
		), '');
		$this->insertMultiple('card_type', array(
			array('id' => 1, 'card_type' => 'American Express'),
			array('id' => 2, 'card_type' => 'Discover'),
			array('id' => 3, 'card_type' => 'MasterCard'),
			array('id' => 4, 'card_type' => 'Visa'),
			array('id' => 5, 'card_type' => 'Diners Club'),
			array('id' => 6, 'card_type' => 'JCB'),
			array('id' => 7, 'card_type' => 'Laser'),
			array('id' => 8, 'card_type' => 'Maestro'),
			array('id' => 9, 'card_type' => 'UnionPay'),
			array('id' => 10, 'card_type' => 'Visa Electron'),
			array('id' => 11, 'card_type' => 'Dankort')
		)
		);



		$this->createTable('customer', array(
			'customer_no' => 'pk',
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
			'notes' => 'varchar(255) DEFAULT NULL',
		), '');

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
			'emp_type_id' => 'int(11) DEFAULT NULL',
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

		$this->createTable('invoice', array(
			'st_id' => 'int(11) NOT NULL',
			'ref_id' => 'int(11) DEFAULT NULL',
			'st_type' => 'int(11) DEFAULT NULL',
			'invoice_id' => 'varchar(20) NOT NULL',
			'create_time' => 'datetime NOT NULL',
			'update_time' => 'datetime NOT NULL',
			'delv_from' => 'datetime NOT NULL',
			'delv_to' => 'datetime NOT NULL',
			'pick_from' => 'datetime NOT NULL',
			'pick_to' => 'datetime NOT NULL',
			'pack_instr' => 'text NOT NULL',
			'is_paid' => 'char(1) NOT NULL',
			'cuser_id' => 'tinyint(4) NOT NULL',
			'uuser_id' => 'tinyint(4) NOT NULL',
		), '');

		$this->addPrimaryKey('pk_invoice', 'invoice', 'st_id');

		$this->createTable('mode', array(
			'mode_id' => 'pk',
			'mode_description' => 'varchar(15) NOT NULL',
		), '');

		$this->insertMultiple(
			'mode',
			array(
				array('mode_id' => 1, 'mode_description' => 'Check'),
				array('mode_id' => 2, 'mode_description' => 'Cash'),
				array('mode_id' => 3, 'mode_description' => 'Credit Card'),
				array('mode_id' => 4, 'mode_description' => 'Direct Deposit'),
			)
		);
		$this->createTable('mov_employee', array(
			'mov_id' => 'int(11) NOT NULL',
			'emp_id' => 'int(11) NOT NULL',
		), '');

		$this->createIndex('idx_emp_id', 'mov_employee', 'emp_id', FALSE);

		$this->createIndex('idx_mov_id', 'mov_employee', 'mov_id', FALSE);

		$this->createTable('movement', array(
			'id' => 'pk',
			'st_id' => 'int(11) NOT NULL',
			'mov_date' => 'date NOT NULL',
			'mov_type' => 'tinyint(1) NOT NULL',
			'mov_time_start' => 'varchar(20) NOT NULL',
			'mov_time_end' => 'varchar(20) NOT NULL',
			'truck_number' => 'varchar(100) NOT NULL',
			'instructions' => 'text NOT NULL',
			'create_time' => 'timestamp NOT NULL',
			'update_time' => 'datetime NOT NULL',
			'uuser_id' => 'smallint(5) NOT NULL',
			'cuser_id' => 'smallint(5) NOT NULL',
		), '');

		$this->createIndex('idx_st_id', 'movement', 'st_id', FALSE);

		$this->createTable('payments', array(
			'id' => 'pk',
			'invoice_id' => 'int(11) NOT NULL',
			'mode_id' => 'int(11) NOT NULL',
			'amount' => 'decimal(10,2) DEFAULT NULL',
			'balance' => 'float(10,2) NOT NULL',
			'pay_date' => 'date NOT NULL',
			'details' => 'varchar(100) DEFAULT NULL',
			'deposited_by' => 'varchar(25) DEFAULT NULL',
			'created' => 'datetime NOT NULL',
			'modified' => 'timestamp NOT NULL',
			'cuser_id' => 'int(11) NOT NULL',
			'uuser_id' => 'int(11) NOT NULL',
		), '');


		$this->createTable('quotation', array(
			'st_id' => 'int(11) NOT NULL',
			'st_type' => 'int(11) NOT NULL',
			'quotation_id' => 'varchar(20) NOT NULL',
			'create_time' => 'datetime NOT NULL',
			'cuser_id' => 'tinyint(4) NOT NULL',
			'uuser_id' => 'tinyint(4) NOT NULL',
		), '');

		$this->addPrimaryKey('pk_quotation', 'quotation', 'st_id');

		$this->createTable('statement', array(
			'id' => 'pk',
			'st_type' => 'tinyint(4) NOT NULL',
			'customer_no' => 'int(11) NOT NULL',
			'venue_id' => 'int(11) NOT NULL',
			'ship_date' => 'date NOT NULL',
			'paid' => 'varchar(1) NOT NULL DEFAULT \'0\'',
			'closed' => 'char(1) NOT NULL',
			'notes' => 'varchar(255) DEFAULT NULL',
		), '');

		$this->createTable('statement_items', array(
			'id' => 'pk',
			'st_id' => 'int(11) NOT NULL',
			'st_type' => 'tinyint(4) NOT NULL',
			'description' => 'varchar(255) NOT NULL',
			'quantity' => 'decimal(8,2) DEFAULT NULL',
			'PRICE' => 'decimal(10,2) DEFAULT NULL',
			'status' => 'int(11) NOT NULL',
			'sequence' => 'int(11) NOT NULL',
		), '');

		$this->createTable('tbl_user', array(
			'id' => 'pk',
			'username' => 'varchar(30) NOT NULL',
			'password' => 'varchar(100) NOT NULL',
			'email' => 'varchar(100) NOT NULL',
			'status' => 'tinyint(4) NOT NULL',
			'level' => 'tinyint(4) NOT NULL',
			'homeUrl' => 'varchar(100) NOT NULL',
			'profile' => 'text DEFAULT NULL',
		), '');
		$this->insert('tbl_user', array(
			'id' => 1,
			'username' => 'admin',
			'password' => 'cc03e747a6afbbcbf8be7668acfebee5',
			'email' => 'admin@invoice.dev',
			'status' => 1,
			'level' => 10,
			'homeUrl' => '',
			'profile' => 'admin user',
		)
		);


		$this->createTable('venue', array(
			'venue_id' => 'pk',
			'ship_name' => 'varchar(30) DEFAULT NULL',
			'ship_add1' => 'varchar(30) DEFAULT NULL',
			'ship_add2' => 'varchar(30) DEFAULT NULL',
			'ship_city' => 'varchar(30) DEFAULT NULL',
			'ship_state' => 'char(2) DEFAULT NULL',
			'ship_zip' => 'varchar(6) DEFAULT NULL',
			'ship_phone1' => 'varchar(15) DEFAULT NULL',
			'ship_phone2' => 'varchar(15) DEFAULT NULL',
			'ship_email1' => 'varchar(45) DEFAULT NULL',
			'ship_details' => 'varchar(255) DEFAULT NULL',
		), '');

		$this->addForeignKey('fk_customer_cards_customer_customer_no', 'customer_cards', 'customer_no', 'customer', 'customer_no', 'NO ACTION', 'NO ACTION');

		$this->addForeignKey('fk_employee_designation_emp_type_id', 'employee', 'emp_type_id', 'designation', 'emp_type_id', 'NO ACTION', 'NO ACTION');

		$this->addForeignKey('fk_mov_employee_employee_emp_id', 'mov_employee', 'emp_id', 'employee', 'id', 'NO ACTION', 'NO ACTION');

		$this->addForeignKey('fk_mov_employee_movement_mov_id', 'mov_employee', 'mov_id', 'movement', 'id', 'NO ACTION', 'NO ACTION');

		$this->addForeignKey('fk_movement_statement_st_id', 'movement', 'st_id', 'statement', 'id', 'NO ACTION', 'NO ACTION');

	}

	public function down()
	{
		//echo "m230328_070943_create_all_tables does not support migration down.\n";

		//return false;
		$this->dropForeignKey('fk_customer_cards_customer_customer_no', 'customer_cards');

		$this->dropForeignKey('fk_employee_designation_emp_type_id', 'employee');

		$this->dropForeignKey('fk_mov_employee_employee_emp_id', 'mov_employee');

		$this->dropForeignKey('fk_mov_employee_movement_mov_id', 'mov_employee');

		$this->dropForeignKey('fk_movement_statement_st_id', 'movement');

		$this->dropTable('card_type');
		$this->dropTable('customer');
		$this->dropTable('customer_cards');
		$this->dropTable('designation');
		$this->dropTable('employee');
		$this->dropTable('invoice');
		$this->dropTable('mode');
		$this->dropTable('mov_employee');
		$this->dropTable('movement');
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