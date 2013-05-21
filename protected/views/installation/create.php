<?php
$this->breadcrumbs=array(
	'Installations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Installation','url'=>array('index')),
	array('label'=>'Manage Installation','url'=>array('admin')),
);
?>

<h1>Create Installation</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'user'=>$user, 'distros'=>$distros)); ?>
