<div class="imagenes">
	<h1>
		<table style="display: table-row;">
			<tr>
				<td style="background-color: #E8E4D0;"><?php 
				if (!empty($model->logo)) {
				echo CHtml::image($model->ruta,
				$model->institucion, array('align'=>'right', 'width'=>150)); ?> <?php } else {
					echo CHtml::image(Yii::app()->request->baseUrl.'/imagenes/aplicacion/blank-logo.png', 'sin foto de institución', array('width'=>'100px', 'align'=>'right'));
				}?></td>
				<td width="80%" style="background-color: #E8E4D0;"><?php 
				echo "<span style='font-size:20px;'>".$model->institucion."</span>";
				?>
				</td>
			</tr>
		</table>
	</h1>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
		array(
						'name'=>'actividad',
						'value'=>$model->actividad == "0" ? $model->otra_actividad : Semana::actividades($model->actividad),
				),
		array(
						'name'=>'descripcion',
						'type'=>'raw',
						'value'=>$model->descripcion,
				),
		'direccion',
		array(
						'name'=>'estado_id',
						'value'=>Estado::model()->findByPk($model->estado_id)->nombre,
				),
		array(
						'name'=>'fecha_ini',
						'value'=>SemanaController::fechaEvento($model->fecha_ini),
				),
		array(
						'name'=>'fecha_fin',
						'value'=>SemanaController::fechaEvento($model->fecha_fin),
				),
		'informes',
		array(
						'type'=>'raw',
						'name'=>'url',
						'value'=>!empty($model->url) ? "<span style='font-size:12px;'>".CHtml::link($model->url, $model->url, array('target'=>'_blank', 'style'=>'color:#009BB7'))."</span>" : '',
				),
	),
)); ?>

<?php if ($puede_modificar) 
{
	echo CHtml::link('Editar', array('update', 'id'=>$model->id), array('style'=>'color:#009BB7;font-size:11px;'));
	echo "&nbsp;&nbsp;&nbsp;";
	echo CHtml::link('Eliminar', '#', array('style'=>'color:#009BB7;font-size:11px;', 'submit'=>array('delete','id'=>$model->id), 'confirm'=>'¿Estás seguro que deseas eliminar este contacto?'));
}	
?>

<br>
<br>
<h3>Materiales disponibles:</h3>
<?php 
foreach ($model_materiales as $k => $material)
{
		if ($material->formato == "image/jpeg")
			echo CHtml::image($material->ruta, $material->nombre, array('width'=>150)).'<br>'.CHtml::link('Ver imagen', $material->ruta, array('style'=>'color:#009BB7', 'target'=>'_blank'));
		if ($material->formato == "application/pdf")
			echo CHtml::link($material->nombre, $material->ruta, array('target'=>'_blank', 'style'=>'color:#009BB7'));
		echo "<br><br>";
}
?>