<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginParticipantForm extends CFormModel
{
	public $nickname;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that nickname and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// nickname and password are required
			array('nickname', 'required'),
			array('nickname', 'numerical'),
			array('nickname', 'length', 'is'=>9),
		);
	}

	/**
	 * Logs in the user using the given nickname and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		$currentUser = $this->getValidInstance();
		$identity = new CUserIdentity($this->nickname, '');
		$identity->setState('role', $currentUser->roleText);
		$identity->setState('id', $currentUser->id);
		Yii::app()->user->login($identity);
		return true;
	}

	public function getValidInstance()
	{
		$users = new Users();
		$currentUser = $users->find(
			'nickname=:nickname',
			array(':nickname'=>$this->nickname)
		);

		if($currentUser===null)
		{
			$currentUser = new Users('participant');
			$currentUser->nickname = $this->nickname;
			$currentUser->role = Users::ROLE_PARTICIPANT;
			if(!$currentUser->save()){
				var_dump($currentUser->getErrors());
				exit(0);
			}
		}
		return $currentUser;
	}
}
