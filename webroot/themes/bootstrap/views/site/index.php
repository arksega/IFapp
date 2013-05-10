<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Welcome to '.CHtml::encode(Yii::app()->name),
)); ?>

<?php $this->endWidget(); ?>

<?php $this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>true,
	'fade'=>true,
)); ?>

<?php
    if (Yii::app()->user->isGuest)
        echo $this->renderPartial('_loginParticipant', array('model'=>$model)); 
?>
