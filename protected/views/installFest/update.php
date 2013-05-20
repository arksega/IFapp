<?php
$this->breadcrumbs=array(
	'Install Fests'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InstallFest','url'=>array('index')),
	array('label'=>'Create InstallFest','url'=>array('create')),
	array('label'=>'View InstallFest','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage InstallFest','url'=>array('admin')),
);
?>

<h1>Update InstallFest <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>