<?php

/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $nickname
 * @property string $email
 * @property string $mobile
 * @property string $phone
 * @property string $password
 * @property string $salt
 * @property integer $status
 * @property integer $role
 */
class Users extends CActiveRecord
{
	public $password2;

	/**
	 * Returns the permission of delete the user.
	 * @return Boolean indicate success if the user is not the last admin.
	 */
	protected function beforeDelete()
	{
		if ($this->role == 999) {
			$admins = $this->findAll('role=:role', array(':role' => '999'));
			if (count($admins) < 2) {
				$mess = 'Usuario no eliminado: debe existir al menos un usuario administrador';
				Yii::app()->user->setFlash('error', $mess);
				return false;
			}
		}
		return true;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
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
		return 'users';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, nickname, email', 'required', 'except'=>'search'),
			array('password, password2', 'required', 'on'=>'create'),
			array('name', 'length', 'max'=>64),
			array('nickname', 'length', 'max'=>16),
			array('email', 'length', 'max'=>512),
			array('email', 'email', 'checkMX'=>true),
			array('email, nickname', 'unique'),
			array('mobile, phone', 'length', 'max'=>12),
			array('password', 'length', 'max'=>80),
			array('password2', 'length', 'max'=>80),
			array('password', 'compare', 'compareAttribute'=>'password2'),
			array('status', 'length', 'max'=>14),
			array('role', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, nickname, email, mobile, phone, status, role', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'nickname' => 'Nickname',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'phone' => 'Phone',
			'password' => 'Password',
			'salt' => 'Salt',
			'status' => 'Status',
			'role' => 'Role',
			'roleText' => 'Role',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * apply a hash in the password before we store it in the database
	 */
	public function generateHashes()
	{
		parent::afterValidate();
		if(!$this->hasErrors())
		{
			$this->salt = $this->newSalt();
			$this->password = $this->hashPassword($this->password . $this->salt);
		}
	}

	/**
	 * Generate the password hash
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return sha1($password);
	}

	/**
	 * Generate the salt hash
	 * @return string hash
	 */
	public function newSalt()
	{
		return sha1(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM));
	}

	public function validatePassword($password)
	{
		return $this->password === $this->hashPassword($password . $this->salt);
	}

	public function getRoleOptions()
	{
		return array(
			0 => 'gest',
			1 => 'user',
			999 => 'admin',
		);
	}

	public function getStatusOptions()
	{
		return array(
			0 => 'inactive',
			1 => 'active',
		);
	}

	public function getRoleText()
	{
		$roleOptions = $this->roleOptions;
		return isset($roleOptions[$this->role]) ? $roleOptions[$this->role] : null;
	}

	public function getStatusText()
	{
		$statusOptions = $this->statusOptions;
		return isset($statusOptions[$this->status]) ? $statusOptions[$this->status] : "estado desconosido ({$this->status})";
	}
}
