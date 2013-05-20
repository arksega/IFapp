<?php
$this->breadcrumbs=array(
	'Install Fests'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List InstallFest','url'=>array('index')),
	array('label'=>'Create InstallFest','url'=>array('create')),
	array('label'=>'Update InstallFest','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete InstallFest','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InstallFest','url'=>array('admin')),
);
?>

<h1>View InstallFest <?php echo $model->edition; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'edition',
		array(
			'name'=>'Current',
			'value'=>$model->status ? 'True' : 'False',
		),
		'comment',
	),
)); ?>
