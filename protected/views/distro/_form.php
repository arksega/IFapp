<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'distro-form',
	'enableAjaxValidation'=>false,
	'htmlOptions' => array(
		'enctype' => 'multipart/form-data',
	),
)); ?>

	<p class="help-block">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>20)); ?>

	<?php if($model->isNewRecord!='1'){ ?>
		<div>
			<?php echo CHtml::image(
				Yii::app()->request->baseUrl . '/distro_logos/' . $model->img,
				"Logo",
				array("class"=>"img-rounded", "style"=>"width: 100px; height: 100px")
			); ?>
		</div>
	<?php } ?>

	<?php echo $form->fileFieldRow($model, 'img'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
