<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h3>Welcome <i><?php echo CHtml::encode(Yii::app()->user->name); ?></i></h3>
<?php $this->widget('bootstrap.widgets.TbAlert');?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'question-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->textFieldRow($questionModel,'hash',array('class'=>'span2','maxlength'=>5)); ?>
	<br/>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Add',
	)); ?>

<?php $this->endWidget(); ?>
<?php 
	$getCss = array(
		null => 'warning',
		true => 'info',
		false => 'error',
	);
?>

<h3>Questions</h3>
<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'answer-grid',
	'dataProvider'=>$dataProvider,
	'ajaxUpdate'=>false,
	'summaryText'=>'',
	'hideHeader'=>true,
	'rowCssClassExpression'=>'$data->state ? "success" : "error"',
	'columns'=>array(
		'text',
		array(
			'class'=>'CLinkColumn',
			'header'=>'',
			'labelExpression'=>'$data->state == null ? "Reply" : ""',
			'urlExpression'=>'$data->state == null ? Yii::app()->controller->createUrl("question/replay", array("id"=>$data->hash)) : null',
		),
	),
)); ?>
