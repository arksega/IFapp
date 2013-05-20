<?php

/**
 * This is the model class for table "install_fest".
 *
 * The followings are the available columns in table 'install_fest':
 * @property integer $id
 * @property string $edition
 * @property integer $status
 * @property string $comment
 *
 * The followings are the available model relations:
 * @property Distro[] $distros
 */
class InstallFest extends CActiveRecord
{
	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InstallFest the static model class
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
		return 'install_fest';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('edition', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('edition', 'length', 'max'=>5),
			array('comment', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, edition, status, comment', 'safe', 'on'=>'search'),
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
			'distros' => array(self::MANY_MANY, 'Distro', 'available_distros(id_if, id_distro)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'Edition',
			'edition' => 'Edition',
			'status' => 'Status',
			'comment' => 'Comment',
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
		$criteria->compare('edition',$this->edition,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('comment',$this->comment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function getStatusOptions()
	{
		return array(
			self::STATUS_ACTIVE => 'active',
			self::STATUS_INACTIVE => 'inactive',
		);
	}

	public function getStatusText()
	{
		$options = $this->getStatusOptions();
		return isset($options[$this->status]) ? $options[$this->status] : null; 
	}
}
