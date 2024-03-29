<?php
$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Question','url'=>array('index')),
	array('label'=>'Create Question','url'=>array('create')),
	array('label'=>'Update Question','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Question','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Question','url'=>array('admin')),
);
?>

<h1>View Question #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'text',
		'answer',
		'value',
		array(
			'name'=>'type',
			'value'=>$model->typeText,
		)
	),
)); ?>
<br/>
<h1>Answers</h1>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'answer-grid',
	'dataProvider'=>$answerDataProvider,
	'ajaxUpdate'=>false,
	//'template'=>'items',
	'columns'=>array(
		'id',
		'text',
	),
)); ?>
