<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'question-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'text',array('class'=>'span5','maxlength'=>140)); ?>

	<?php 
		$answers = CHtml::listData($model->answers, 'id', 'text');
		$answers[null] = '';
		echo $form->dropDownListRow($model, 'answer', $answers,array('class'=>'span5')
	); ?>

	<?php echo $form->textFieldRow($model,'value',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'type',$model->typeOptions); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
