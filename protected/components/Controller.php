<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	/**
	 * The filter method for 'accessControl' filter.
	 * This filter is a wrapper of {@link CAccessControlFilter}.
	 * To use this filter, you must override {@link accessRules} method.
	 * @param CFilterChain $filterChain the filter chain that the filter is on.
	 */
	public function filterAccessControl($filterChain)
	{
		$user = Yii::app()->user;
		if (!$user->isGuest) {
            if ($user->role == 'admin') {
                $filterChain->run();
                return true;
            }
			$operation = $this->getAction()->id . substr(get_class($this), 0, -10);
			$auth = Yii::app()->authManager;
			if ($auth->getAuthItem($user->role))
				$auth->assign($user->role, $user->id);
			else
				Yii::log('The "' . $user->role . '" role is not defined', 'warning', 'application');
			if ($auth->CheckAccess($operation, $user->id))
				$filterChain->run();
			else
				throw new CHttpException(403, 'You are not authorized to perform this action.');
		} else {
			$user->returnUrl = '/' . $this->getId() . '/' . $this->getAction()->id;
			Yii::app()->user->setFlash('error', '<strong>Error!</strong> Just logged users can have fun.');
			$this->redirect('/site/index');
		}
	}

}
