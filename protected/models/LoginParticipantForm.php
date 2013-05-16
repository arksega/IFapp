<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginParticipantForm extends CFormModel
{
	public $username;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username', 'required'),
			array('username', 'numerical'),
			array('username', 'length', 'is'=>9),
		);
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		$users = new Users();
		$currentUser = $users->find(
			'nickname=:nickname',
			array(':nickname'=>$this->username)
		);

		if($currentUser===null)
		{
			$currentUser = new Users('participant');
			$currentUser->nickname = $this->username;
			$currentUser->role = Users::ROLE_PARTICIPANT;
			if(!$currentUser->save()){
				var_dump($currentUser->getErrors());
				exit(0);
			}

		}
		$identity = new CUserIdentity($this->username, '');
		$identity->setState('role', $currentUser->roleText);
		$identity->setState('id', $currentUser->id);
		Yii::app()->user->login($identity);
		return true;
	}
}
