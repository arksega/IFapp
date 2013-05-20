<?php
$this->breadcrumbs=array(
	'Install Fests'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Create InstallFest','url'=>array('create')),
	array('label'=>'Set current InstallFest','url'=>array('current')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('install-fest-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Install Fests</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'install-fest-grid',
	'dataProvider'=>$model->search(),
	'rowCssClassExpression'=>'$data->status ? "success" : ""',
	'template' => '{items}',
	'columns'=>array(
		//'id',
		'edition',
		'comment',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
