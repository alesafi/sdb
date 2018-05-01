<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */
/*
$this->pageTitle=Yii::app()->name . ' - Acceso';
$this->breadcrumbs=array(
	'Login',
);*/
?>

<span style='color:#009BB7'>
<?php 
if (isset($_GET['situacion']))
	echo $_GET['situacion'];  
?>

</span>

<h1>Registro de actividades</h1>

<p>Para crear, actualizar o borrar un evento es necesario <?php 
			echo CHtml::link('registrarse.',array('/usuarios/create'), array('style'=>'color:#009BB7'));
			?></p>
			<p><strong>NOTA:</strong> Si ya te habias registrado en algúna otra Semana de la Diversidad Biológica, 
			no es necesario crear un nuevo registro. En caso de no recordar tus credenciales sigue los pasos para recuperar tu contrseña.</p>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div>
		<?php echo $form->labelEx($model,'Correo'); ?><br>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div >
		<label>Contrase&ntilde;a</label><br>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
		
	</div>

	<div rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<label for="LoginForm_rememberMe">Recordarme la próxima vez</label>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="buttons" align="right">
		<?php echo CHtml::submitButton('Entra'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div><!-- form -->

<div>
¿Haz olvidado tu contrase&ntilde;a? Sigue este <a href="<?php echo Yii::app()->request->baseUrl.'/index.php?r=site/recupera'; ?>">enlace</a>
</div>