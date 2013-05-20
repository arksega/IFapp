<?php

class m130517_231621_create_distro_if_entities extends CDbMigration
{
	public function up()
	{
		$this->createTable(
			'distro',
			array(
				'id' => 'pk',
				'name' => 'varchar(20) NOT NULL UNIQUE',
				'img' => 'varchar(50)'
			)
		);

		$this->createTable(
			'install_fest',
			array(
				'id' => 'pk',
				'edition' => 'varchar(5) NOT NULL UNIQUE',
				'status' => 'bool NOT NULL DEFAULT FALSE',
				'comment' => 'varchar(50)'
			)
		);

		$this->createTable(
			'available_distros',
			array(
				'id_if' => 'int NOT NULL',
				'id_distro' => 'int NOT NULL',
				'UNIQUE (id_if, id_distro)'
			)
		);

		$this->createTable(
			'installation',
			array(
				'id' => 'pk',
				'id_user' => 'int NOT NULL',
				'id_distro' => 'int NOT NULL',
				'architecture' => 'tinyint'
			)
		);

		$this->addForeignKey(
			'available_distros_fk1',
			'available_distros',
			'id_if',
			'install_fest',
			'id'
		);

		$this->addForeignKey(
			'available_distros_fk2',
			'available_distros',
			'id_distro',
			'distro',
			'id'
		);

		$this->addForeignKey(
			'installation_fk1',
			'installation',
			'id_distro',
			'distro',
			'id'
		);

		$this->addForeignKey(
			'installation_fk2',
			'installation',
			'id_user',
			'users',
			'id'
		);

	}

	public function down()
	{
		$this->dropForeignKey('installation_fk1', 'installation');
		$this->dropForeignKey('installation_fk2', 'installation');
		$this->dropForeignKey('available_distros_fk1', 'available_distros');
		$this->dropForeignKey('available_distros_fk2', 'available_distros');
		$this->dropTable('distro');
		$this->dropTable('install_fest');
		$this->dropTable('available_distros');
		$this->dropTable('installation');
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
