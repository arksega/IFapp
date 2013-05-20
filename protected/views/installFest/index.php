<?php
$this->breadcrumbs=array(
	'Install Fests',
);

$this->menu=array(
	array('label'=>'Create InstallFest','url'=>array('create')),
	array('label'=>'Manage InstallFest','url'=>array('admin')),
);
?>

<h1>Install Fests</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
