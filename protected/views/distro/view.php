<?php
$this->breadcrumbs=array(
	'Distros'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Create Distro','url'=>array('create')),
	array('label'=>'Update Distro','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Distro','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Distro','url'=>array('admin')),
);
?>

<h1>View Distro #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'name',
		array(
			'name'=>'Logo',
			'value'=>CHtml::image(
				Yii::app()->request->baseUrl . '/distro_logos/' . $model->img,
				"Logo",
				array("class"=>"img-rounded", "style"=>"width: 100px; height: 100px")
			),
			'type'=>'html',
		)
	),
)); ?>
