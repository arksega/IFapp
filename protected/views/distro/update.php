<?php
$this->breadcrumbs=array(
	'Distros'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Distro','url'=>array('index')),
	array('label'=>'Create Distro','url'=>array('create')),
	array('label'=>'View Distro','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Distro','url'=>array('admin')),
);
?>

<h1>Update Distro <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>