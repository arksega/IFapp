<?php
$this->breadcrumbs=array(
	'Installations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create Installation','url'=>array('create')),
);
?>

<h1>Manage Installations</h1>

<?php 
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'installation-grid',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		'id_user',
		array(
			'header'=>'Distro',
			'name'=>'id_distro',
			'value'=>'$data->idDistro->name',
		),
		'architecture',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
