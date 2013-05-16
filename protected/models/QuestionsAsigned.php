<?php

/**
 * This is the model class for table "questions_asigned".
 *
 * The followings are the available columns in table 'questions_asigned':
 * @property integer $id_user
 * @property integer $id_question
 * @property integer $state
 * @property string $text
 * @property integer $answer
 * @property integer $value
 * @property integer $type
 * @property string $hash
 */
class QuestionsAsigned extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return QuestionsAsigned the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'questions_asigned';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_question, state, answer, value, type', 'numerical', 'integerOnly'=>true),
			array('text', 'length', 'max'=>140),
			array('hash', 'length', 'max'=>5),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_user, id_question, state, text, answer, value, type, hash', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_user' => 'Id User',
			'id_question' => 'Id Question',
			'state' => 'State',
			'text' => 'Text',
			'answer' => 'Answer',
			'value' => 'Value',
			'type' => 'Type',
			'hash' => 'Hash',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_question',$this->id_question);
		$criteria->compare('state',$this->state);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('answer',$this->answer);
		$criteria->compare('value',$this->value);
		$criteria->compare('type',$this->type);
		$criteria->compare('hash',$this->hash,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}