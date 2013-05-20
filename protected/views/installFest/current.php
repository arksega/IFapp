<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'install-fest-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php
		$answers = CHtml::listData($data, 'id', 'edition');
		echo $form->radioButtonListRow($model,'id',$answers); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
