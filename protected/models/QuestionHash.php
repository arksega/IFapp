<?php

class QuestionHash extends CFormModel
{
	public $hash;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('hash', 'required'),
			array('hash', 'length', 'is'=>5),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'hash' => 'Question',
		);
	}
}
