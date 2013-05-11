<?php

class m130510_144512_create_question_tables extends CDbMigration
{


	/*
	public function up()
	{
	}


	public function down()
	{
	}
	*/

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$this->createTable(
			'question',
			array(
				'id'=>'pk',
				'text'=>'varchar(140) NOT NULL',
				'answer'=>'int',
				'value'=>'tinyint UNSIGNED NOT NULL',
				'type'=>'tinyint UNSIGNED NOT NULL',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable(
			'answer',
			array(
				'id'=>'pk',
				'text'=>'varchar(140) NOT NULL',
				'id_question'=>'int NOT NULL',
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8'
		);

		$this->createTable(
			'user_questions',
			array(
				'id_user'=>'int',
				'id_question'=>'int',
				'state'=>'bool',
				'PRIMARY KEY (id_user, id_question)'
			),
			'ENGINE=InnoDB DEFAULT CHARSET=utf8'
		);

		$this->addForeignKey(
			'question_answers_fk1',
			'answer',
			'id_question',
			'question',
			'id',
			'CASCADE'
		);

		$this->addForeignKey(
			'question_answer_fk1',
			'question',
			'answer',
			'answer',
			'id',
			'SET NULL'
		);

		$this->addForeignKey(
			'user_questions_fk1',
			'user_questions',
			'id_user',
			'users',
			'id',
			'CASCADE'
		);

		$this->addForeignKey(
			'user_questions_fk2',
			'user_questions',
			'id_question',
			'question',
			'id',
			'CASCADE'
		);
	}

	public function safeDown()
	{
		$this->dropForeignKey('question_answers_fk1', 'answer');
		$this->dropForeignKey('question_answer_fk1', 'question');
		$this->dropForeignKey('user_questions_fk1', 'user_questions');
		$this->dropForeignKey('user_questions_fk2', 'user_questions');
		$this->dropTable('question');
		$this->dropTable('answer');
		$this->dropTable('user_questions');
	}
}
