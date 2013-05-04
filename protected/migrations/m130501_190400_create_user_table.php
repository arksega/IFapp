<?php

class m130501_190400_create_user_table extends CDbMigration
{
	public function up()
	{
		$this->createTable('users', array(
			'id' => 'pk',
			'name' => 'varchar(64) NOT NULL',
			'nickname' => 'varchar(16) NOT NULL',
			'email' => 'varchar(64)',
			'mobile' => 'varchar(12)',
			'phone' => 'varchar(12)',
			'password' => 'varchar(80) NOT NULL',
			'salt' => 'varchar(40) NOT NULL',
			'status' => 'int(3) NOT NULL',
			'role' => 'int(3) NOT NULL',
			),"ENGINE=InnoDB DEFAULT CHARSET=utf8"
		);
		$this->insert('users', array(
			'name' => 'admin',
			'nickname' => 'admin',
			'email' => 'admin@local.com',
			'password' => 'a6afd2c3965c3f48e8791a7d60e624f23b34621f',
			'salt' => '9a4e2672335f47333458f2cb27e8810e276474bc',
			'status' => 1,
			'role' => 999,
			)
		);
	}

	public function down()
	{
		$this->truncateTable('users');
        $this->dropTable('users');
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
