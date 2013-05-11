<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Question','url'=>array('index')),
	array('label'=>'Create Question','url'=>array('create')),
	array('label'=>'View Question','url'=>array('view','id'=>$model->id)),
	array('label'=>'Manage Question','url'=>array('admin')),
	array('label'=>'Add answer', 'url'=>array('/answer/create/qid/'.$model->id)),
);
?>

<h1>Update Question <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
<br/>
<h1>Answers</h1>
<?php 
	$this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'answer-grid',
	'dataProvider'=>$answerDataProvider,
	'ajaxUpdate'=>false,
	'template' => '{items}',
	'columns'=>array(
		'id',
		'text',
		//'id_question',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'template'=>'{view}{update}{delete}',
			'buttons'=>array(
				'view' => array(
					'url'=>'Yii::app()->controller->createUrl("answer/view", array("id"=>$data->id))',
				),
				'update' => array(
					'url'=>'Yii::app()->controller->createUrl("answer/update", array("id"=>$data->id))',
				),
				'delete' => array(
					'url'=>'Yii::app()->controller->createUrl("answer/delete", array("id"=>$data->id, "command"=>"delete"))',
				),
			),
		),
	),
)); ?>
