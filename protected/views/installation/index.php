<?php
$this->breadcrumbs=array(
	'Installations',
);

$this->menu=array(
	array('label'=>'Create Installation','url'=>array('create')),
	array('label'=>'Manage Installation','url'=>array('admin')),
);
?>

<h1>Installations</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
