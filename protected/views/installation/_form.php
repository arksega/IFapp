<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'installation-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($user,'username',array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'id_distro', CHtml::listData($distros, 'id', 'name'), array('class'=>'span5')); ?>

	<?php echo $form->dropDownListRow($model,'architecture', $model->architectureOptions); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
