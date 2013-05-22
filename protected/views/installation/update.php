<?php
$this->breadcrumbs=array(
	'Installations'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Installation','url'=>array('index')),
	array('label'=>'Create Installation','url'=>array('create')),
	array('label'=>'View Installation','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Installation','url'=>array('admin')),
);
?>

<h1>Update Installation <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model, 'user'=>$user, 'distros'=>$distros)); ?>
