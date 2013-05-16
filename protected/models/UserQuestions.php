<?php

/**
 * This is the model class for table "user_questions".
 *
 * The followings are the available columns in table 'user_questions':
 * @property integer $id
 * @property integer $id_user
 * @property integer $id_question
 * @property integer $state
 *
 * The followings are the available model relations:
 * @property Question $idQuestion
 * @property Users $idUser
 */
class UserQuestions extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserQuestions the static model class
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
		return 'user_questions';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_user, id_question, state', 'numerical', 'integerOnly'=>true),
			array('id_user', 'unique',
				'criteria'=>array(
					'condition'=>'id_question=:idquestion',
					'params'=>array(':idquestion'=>$this->id_question),
				),
			),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_user, id_question, state', 'safe', 'on'=>'search'),
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
			'idQuestion' => array(self::BELONGS_TO, 'Question', 'id_question', 'together'=>true),
			'idUser' => array(self::BELONGS_TO, 'Users', 'id_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_user' => 'Id User',
			'id_question' => 'Id Question',
			'state' => 'State',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_user',$this->id_user);
		$criteria->compare('id_question',$this->id_question);
		$criteria->compare('state',$this->state);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
