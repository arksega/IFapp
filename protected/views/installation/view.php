<?php
$this->breadcrumbs=array(
	'Installations'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Installation','url'=>array('index')),
	array('label'=>'Create Installation','url'=>array('create')),
	array('label'=>'Update Installation','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Installation','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Installation','url'=>array('admin')),
);
?>

<h1>View Installation #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_user',
		'id_distro',
		'architecture',
	),
)); ?>
