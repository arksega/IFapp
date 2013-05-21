<?php
$this->breadcrumbs=array(
	'Distros'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Distro','url'=>array('index')),
	array('label'=>'Manage Distro','url'=>array('admin')),
);
?>

<h1>Create Distro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>