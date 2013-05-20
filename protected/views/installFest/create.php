<?php
$this->breadcrumbs=array(
	'Install Fests'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List InstallFest','url'=>array('index')),
	array('label'=>'Manage InstallFest','url'=>array('admin')),
);
?>

<h1>Create InstallFest</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>