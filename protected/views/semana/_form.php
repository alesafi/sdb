<?php
/* @var $this SemanaController */
/* @var $model Semana */
/* @var $form CActiveForm */
?>

<style>
.errorSummary, .errorMessage
{
	color: red;	
}
</style>

<script type="text/javascript">
	$(document).ready(function (){
		$('#actividad').change(function (){
			if ($(this).val() == '0') 
			{
				$('#Semana_otra_actividad').prop('disabled', false);
			} else {
				$('#Semana_otra_actividad').prop('disabled', true);
			}
		});		
	});
</script>

<div class="form">

	<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'semana-form',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">
		Campos con <span class="required">*</span> son requeridos.
	</p>

	<?php echo $form->errorSummary($model); ?>

	<table>
		<tr>
			<td>
				<div>
					<?php echo $form->labelEx($model,'institucion'); ?>
					<?php echo $form->textField($model,'institucion',array('size'=>60,'maxlength'=>255)); ?>
					<?php echo $form->error($model,'institucion'); ?>
				</div>
			</td>
			<td><?php $this->renderPartial('_logo',array(
					'model'=>$model, 'form'=>$form
			)); ?></td>
		</tr>
	</table>

	<div>
		<?php echo $form->labelEx($model,'estado_id'); ?>
		<?php echo $form->dropDownList($model, 'estado_id',  CHtml::listData(Estado::model()->findAll(), 'id', 'nombre'), 
				array('empty'=>'---Selecciona un estado---', 'id'=>'estado')); ?>
		<?php echo $form->error($model,'estado_id'); ?>
	</div>
	<br>
	<div>
		<?php echo $form->labelEx($model,'direccion'); ?><br>
		<?php echo $form->textArea($model,'direccion',array('rows'=>4, 'cols'=>50)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>
	<br>
	<div>
		<?php echo $form->labelEx($model,'actividad'); ?>
		<?php echo $form->dropDownList($model, 'actividad', Semana::actividades(), 
				array('empty'=>'---Selecciona una actividad---', 'id'=>'actividad')); ?>
		<?php echo $form->error($model,'actividad'); ?>
	</div>
	<div>
		<?php echo $form->labelEx($model,'otra_actividad'); ?>
		<span><em>Solo si tu actividad no se encuentra en la lista</em> </span><br>
		<?php echo $form->textField($model,'otra_actividad',array('size'=>60,'maxlength'=>255, 'disabled'=>$model->actividad == '0' ? false : true)); ?>
		<?php echo $form->error($model,'otra_actividad'); ?>
	</div>
	<br>
	<div>
		<?php echo $form->labelEx($model,'descripcion'); ?><br>
		<?php echo $form->textArea($model,'descripcion',array('rows'=>4, 'cols'=>50)); ?>
		<?php echo $form->error($model,'descripcion'); ?>
	</div>
	<br>
	<table cellpadding="20">
		<tr>
			<td>
				<div>
					<?php echo $form->labelEx($model,'fecha_ini'); ?>
					<?php 
					$this->widget(
		'ext.jui.EJuiDateTimePicker',
		array(
				'model'     => $model,
				'attribute' => 'fecha_ini',
				//'flat'=>true,
				//'value' => '2014-03-14 14:00:00',
				//'language'=> 'ru',//default Yii::app()->language
				//'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
				'options'   => array(
						'dateFormat' => 'yy-mm-dd',
						//'timeFormat' => 'hh:mm',
						'hourMin'=>6,
						'hourMax'=>22,
						'minDate'=>'2016-05-17',
						'maxDate'=>'2016-05-22',
				),
				'htmlOptions'=>array(
					//'style'=>'height:20px;',
					//'disabled'=>true
				),
		)
);
?>
					<?php echo $form->error($model,'fecha_ini'); ?>
				</div>
			</td>
			<td>
				<div>
					<?php echo $form->labelEx($model,'fecha_fin'); ?>
					<?php 
					$this->widget(
		'ext.jui.EJuiDateTimePicker',
		array(
				'model'     => $model,
				'attribute' => 'fecha_fin',
				//'flat'=>true,
				//'value' => '2014-03-14 14:00:00',
				//'language'=> 'ru',//default Yii::app()->language
				//'mode'    => 'datetime',//'datetime' or 'time' ('datetime' default)
				'options'   => array(
						'dateFormat' => 'yy-mm-dd',
						//'timeFormat' => 'hh:mm',
						'hourMin'=>6,
						'hourMax'=>22,
						'minDate'=>'2016-05-17',
						'maxDate'=>'2016-05-22',
				),
				'htmlOptions'=>array(
					//'style'=>'height:20px',
				),
		)
);
?>
					<?php echo $form->error($model,'fecha_fin'); ?>
				</div>
			</td>
		</tr>
	</table>

	<div>
		<?php echo $form->labelEx($model,'informes'); ?>
		<span><em>, Referencia en caso de dudas o sugerencias</em> </span><br>
		<?php echo $form->textArea($model,'informes',array('rows'=>4, 'cols'=>50)); ?>
		<?php echo $form->error($model,'informes'); ?>
	</div>
	<br>
	<div>
		<?php echo $form->labelEx($model,'url'); ?>
		<span><em>Se vinculará el evento con la URL de su página web (ej. http://www.biodiversidad.gob.mx)</em> </span><br>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>
	<br>
	<?php $this->renderPartial('_materiales',array(
					'model'=>$model, 'form'=>$form, 'model_materiales' => isset($model_materiales) ? $model_materiales : array(),
			)); ?>

	<?php echo $form->hiddenField($model,'usuarios_id', array('value' => $usuario)); ?>

	<div align="right">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear evento' : 'Actualizar evento'); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>
<!-- form -->
