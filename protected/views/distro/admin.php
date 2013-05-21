<?php
$this->breadcrumbs=array(
	'Distros'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Distro','url'=>array('create')),
);
?>

<h1>Manage Distros</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'distro-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
