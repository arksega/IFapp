<?php

/**
 * This is the model class for table "question".
 *
 * The followings are the available columns in table 'question':
 * @property integer $id
 * @property string $text
 * @property integer $answer
 * @property integer $value
 * @property integer $type
 * @property string  $hash
 *
 * The followings are the available model relations:
 * @property Answer[] $answers
 * @property Users[] $users
 */
class Question extends CActiveRecord
{

	const TYPE_FREE=0;
	const TYPE_MULTIPLE=1;
	const TYPE_TEXT=2;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Question the static model class
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
		return 'question';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('text, value, type', 'required'),
			array('answer, value, type', 'numerical', 'integerOnly'=>true),
			array('text', 'length', 'max'=>140),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, text, answer, value, type', 'safe', 'on'=>'search'),
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
			'answers' => array(self::HAS_MANY, 'Answer', 'id_question'),
			'users' => array(self::MANY_MANY, 'Users', 'user_questions(id_question, id_user)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'text' => 'Text',
			'answer' => 'Correct Answer',
			'value' => 'Value',
			'type' => 'Type',
			'hash' => 'Identifier',
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
		$criteria->compare('text',$this->text,true);
		$criteria->compare('answer',$this->answer);
		$criteria->compare('value',$this->value);
		$criteria->compare('type',$this->type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * @return boolean the save state
	 */
	public function save()
	{
		if ($this->hash == '')
			$this->hash = substr(sha1(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), 0, 5);
		return parent::save();
	}

	/**
	 * @return array the valid types
	 */
	public function getTypeOptions()
	{
		return array(
			self::TYPE_FREE => 'free',
			self::TYPE_MULTIPLE => 'multiple',
			self::TYPE_TEXT => 'text',
		);
	} 

	/**
	 * @return string the current type text
	 */
	public function getTypeText()
	{
		$types = $this->getTypeOptions();
		return isset($types[$this->type]) ? $types[$this->type] : null;
	}
}
