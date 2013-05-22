<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'participants-form',
	'htmlOptions'=>array('class'=>'well'),
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->textFieldRow($model,'nickname',array('class'=>'span5','maxlength'=>10)); ?>

	<br/>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
		'buttonType'=>'submit',
		'type'=>'primary',
		'label'=>'Login',
	)); ?>

<?php $this->endWidget(); ?>
