<?php
$this->breadcrumbs=array(
	'Distros',
);

$this->menu=array(
	array('label'=>'Create Distro','url'=>array('create')),
	array('label'=>'Manage Distro','url'=>array('admin')),
);
?>

<h1>Distros</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
