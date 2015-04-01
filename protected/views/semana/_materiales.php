<b>Materiales (programas de actividades, carteles)</b>
<br>
<span><em>Solo se permiten documentos pdf e imagenes en jpg con un
		límite de 3 archivos y un peso máximo de 5MB por archivo</em> </span>
<br>

<table border="0">
	<tr>
		<td>
			<div class="row">
				<?php echo $form->labelEx($model,'material1'); ?>
				<?php echo $form->fileField($model, 'material1'); ?>
				<?php echo $form->error($model,'material1'); ?>
			</div>
		</td>
		<td>
		<?php 
		foreach ($model_materiales as $k => $material) 
		{
			if ($material->numero_material == "material1") 
			{
				if ($material->formato == "image/jpeg")
					echo CHtml::image("../".$material->ruta, $material->nombre, array('width'=>150));
				if ($material->formato == "application/pdf")
					echo CHtml::link($material->nombre, "../".$material->ruta, array('target'=>'_blank', 'style'=>'color:#BD5D28'));
			}	
		}
		?>
		</td>
	</tr>

	<tr>
		<td>
			<div class="row">
				<?php echo $form->labelEx($model,'material2'); ?>
				<?php echo $form->fileField($model, 'material2'); ?>
				<?php echo $form->error($model,'material2'); ?>
			</div>
		</td>

		<td>
		<?php 
		foreach ($model_materiales as $k => $material) 
		{
			if ($material->numero_material == "material2") 
			{
				if ($material->formato == "image/jpeg")
					echo CHtml::image("../".$material->ruta, $material->nombre, array('width'=>150));
				if ($material->formato == "application/pdf")
					echo CHtml::link($material->nombre, "http://".$_SERVER['SERVER_ADDR'].Yii::app()->request->baseUrl.substr($material->ruta, 5), array('target'=>'_blank', 'style'=>'color:#BD5D28'));
			}	
		}
		?>
		</td>
	</tr>

	<tr>
		<td>
			<div class="row">
				<?php echo $form->labelEx($model,'material3'); ?>
				<?php echo $form->fileField($model, 'material3'); ?>
				<?php echo $form->error($model,'material3'); ?>
			</div>
		</td>
		<td>
		<?php 
		foreach ($model_materiales as $k => $material) 
		{
			if ($material->numero_material == "material3") 
			{
				if ($material->formato == "image/jpeg")
					echo CHtml::image("../".$material->ruta, $material->nombre, array('width'=>150));
				if ($material->formato == "application/pdf")
					echo CHtml::link($material->nombre, "http://".$_SERVER['SERVER_ADDR'].Yii::app()->request->baseUrl.substr($material->ruta, 5), array('target'=>'_blank', 'style'=>'color:#BD5D28'));
			}	
		}
		?>
		</td>
	</tr>
</table>

<!--div class="row">
	<?php //echo $form->labelEx($model,'material4'); ?>
	<?php //echo $form->fileField($model, 'material4'); ?>
	<?php //echo $form->error($model,'material4'); ?>
</div>


<div class="row">
	<?php //echo $form->labelEx($model,'material5'); ?>
	<?php //echo $form->fileField($model, 'material5'); ?>
	<?php //echo $form->error($model,'material5'); ?>
</div-->
