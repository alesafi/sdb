<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/* @var $form CActiveForm */
?>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'usuarios-form',
			'enableAjaxValidation'=>false,
)); ?>

	<p class="note">
		Campos con <span class="required">*</span> son requeridos.
	</p>

	<?php echo $form->errorSummary($model); ?>

	<?php 
	if($model->isNewRecord) {
		?>
		
	<div>
		<?php echo $form->labelEx($model,'usuario'); ?><br>
		<span><em>Por favor omite los espacios y caracteres extraños</em> </span><br>
		<?php echo $form->textField($model,'usuario',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'usuario'); ?>
	</div>
	<br>
	<?php 
	}
		?>
		
	<div>
		<?php echo $form->labelEx($model,'email'); ?><br>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	<br>
	<div>
		<?php echo $form->labelEx($model,'passwd'); ?><br>
		<?php echo $form->passwordField($model,'passwd',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'passwd'); ?>
	</div>
	<br>
	<div>
		<?php echo $form->labelEx($model,'nombre'); ?><br>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>
	<br>
	<div>
		<?php echo $form->labelEx($model,'apellido'); ?><br>
		<?php echo $form->textField($model,'apellido',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'apellido'); ?>
	</div>
	<br>
	<div align="right">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear registro' : 'Guardar cambios'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form -->
