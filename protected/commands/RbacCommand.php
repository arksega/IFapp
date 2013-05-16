<?php
class RbacCommand extends CConsoleCommand
{

	private $_authManager;

	public function getHelp()
	{
		
		$description = "DESCRIPTION\n";
		$description .= '    '."This command generates an initial RBAC authorization hierarchy.\n";
		return parent::getHelp() . $description;
	}

	/**
	 * The default action - create the RBAC structure.
	 */
	public function actionIndex()
	{

		$this->ensureAuthManagerDefined();
		
		$message = "This command will create three roles: Owner, Member, and Reader\n";

		//check the input from the user and continue if 
		//they indicated yes to the above question
		if($this->confirm($message)) 
		{
			 //first we need to remove all operations, 
			 //roles, child relationship and assignments
			 $this->_authManager->clearAll();

			 //create the lowest level operations for users
			 $this->_authManager->createOperation('createUsers'); 
			 $this->_authManager->createOperation('indexUsers'); 
			 $this->_authManager->createOperation('adminUsers'); 
			 $this->_authManager->createOperation('viewUsers'); 
			 $this->_authManager->createOperation('updateUsers'); 
			 $this->_authManager->createOperation('deleteUsers'); 
			 $this->_authManager->createOperation('participantUsers');

			 //create the admin role and add the appropriate permissions
			 $role=$this->_authManager->createRole("admin"); 
			 $role->addChild("createUsers");
			 $role->addChild("indexUsers"); 
			 $role->addChild("adminUsers"); 
			 $role->addChild("viewUsers"); 
			 $role->addChild("updateUsers"); 
			 $role->addChild("deleteUsers"); 

			 //create the participant role and permissions
			 $role=$this->_authManager->createRole("participant");
			 $role->addChild('participantUsers');

			 //create roles
			 $role=$this->_authManager->createRole("user"); 

			 $this->_authManager->save();
			//provide a message indicating success
			echo "Authorization hierarchy successfully generated.\n";
		} else
			echo "Operation cancelled.\n";
	}

	public function actionDelete()
	{
		$this->ensureAuthManagerDefined();
		$message = "This command will clear all RBAC definitions.\n";
		$message .= "Would you like to continue?";
		//check the input from the user and continue if they indicated 
		//yes to the above question
		if($this->confirm($message)) 
		{
			$this->_authManager->clearAll();
			echo "Authorization hierarchy removed.\n";
		}
		else
			echo "Delete operation cancelled.\n";
			
	}

	protected function ensureAuthManagerDefined()
	{
		//ensure that an authManager is defined as this is mandatory for creating an auth heirarchy
		if(($this->_authManager=Yii::app()->authManager)===null)
		{
			$message = "Error: an authorization manager, named 'authManager' must be con-figured to use this command.";
			$this->usageError($message);
		}
	}
}
