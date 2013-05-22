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
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'Nickname',
			'value'=>'$data["nickname"]',
		),
		array(
			'name'=>'Distro',
			'value'=>'$data["name"]',
		),
		array(
			'name'=>'Architecture',
			'value'=>'Installation::getArchitectureOptions()[$data["architecture"]]',
		),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}{update}{delete}',
			'buttons'=>array(
				'view' => array(
					'url'=>'Yii::app()->controller->createUrl("installation/view", array("id"=>$data["id"]))',
				),
				'update' => array(
					'url'=>'Yii::app()->controller->createUrl("installation/update", array("id"=>$data["id"]))',
				),
				'delete' => array(
					'url'=>'Yii::app()->controller->createUrl("installation/delete", array("id"=>$data["id"], "command"=>"delete"))',
				),
			),
		),
	),
)); ?>
