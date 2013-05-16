<?php

class UsersController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users('create');

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->validate()) {
				$model->generateHashes();
				$model->save(false);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			if ($_POST['Users']['password'] == '') {
				$_POST['Users']['password'] = $model->password;
				$_POST['Users']['password2'] = $model->password;
				$newPassword = false;
			}
			else
				$newPassword = true;
			$model->attributes=$_POST['Users'];
			if($model->validate()) {
				if ($newPassword)
					$model->generateHashes();
				$model->save(false);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$model->password = '';
		$model->password2 = '';
		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
        /*
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
        */
        $this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Manage the participants index
	 */
	public function actionParticipant()
	{
		$hash = new QuestionHash();
		if (isset($_POST['QuestionHash'])) {
			$hash->attributes= $_POST['QuestionHash'];
			if($hash->validate()){
				$question = Question::model()->find(
					array(
						'condition'=>'hash=:hash',
						'params'=>array(':hash'=>$hash->hash)
					)
				);
				if($question == null)
					$hash->addError('hash', 'Question not exist!');
				else {
					$asign = new UserQuestions();
					$asign->id_user = Yii::app()->user->id;
					$asign->id_question = $question->id;
					if ($question->type == Question::TYPE_FREE)
						$asign->state = true;
					$asign->save();
					if ($asign->hasErrors())
						$hash->addError('hash', 'You already have this question assigned!');
				}
			}
		}
		$model = $this->loadModel(Yii::app()->user->id);
		$questionsAsigned = QuestionsAsigned::model()->findAll(
					array(
						'condition'=>'id_user=:id',
						'params'=>array(':id'=>$model->id)
					)
		);
		$dataProvider = new CArrayDataProvider($questionsAsigned);
		$this->render('participant', array('questionModel'=>$hash, 'dataProvider'=>$dataProvider));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
