<div class="row" align="justify">
	<?php echo $form->labelEx($model,'logo'); ?>
	<span style="font-size:11;"><em>Se recomienda una imagen de 150px por 150px con un peso máximo de 5MB, solo para jpg, jpeg, png, gif</em> </span><br>
	<?php echo $form->fileField($model, 'logo'); ?>

	<?php //if (!$model->isNewRecord && !empty($model->logo)) { 
	//echo CHtml::button("Quitar", array('id'=>'quita_foto')); } ?>

	<?php echo $form->error($model,'logo'); ?>
</div>

<div id="foto_de_carga">
	<?php
	if (!$model->isNewRecord && !empty($model->logo)) {
	echo CHtml::image("../".$model->ruta,
				$model->institucion, array('width'=>'150px', 'align'=>'left')); ?>

	<?php } else if (!$model->isNewRecord) { ?>
	<?php echo CHtml::image(Yii::app()->request->baseUrl.'/imagenes/aplicacion/blank-logo.png', 'sin logo de institución', array('width'=>'150px', 'align'=>'left'));
		} ?>
</div>