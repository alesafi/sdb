<?php
/* @var $this SemanaController */
/* @var $data Semana */
?>

<table>
	<tr>
		<td><?php 

		if (!empty($data->logo))
			echo CHtml::image($data->ruta,
					$data->institucion, array('width'=>'150px', 'align'=>'left'));
		else
			echo CHtml::image(Yii::app()->request->baseUrl.'/imagenes/aplicacion/blank-logo.png', 'sin foto de institución', array('width'=>'150px', 'align'=>'right'));
		?>
		</td>
		<td>
			<div class="view">
				<h3>
					<?php echo CHtml::link(CHtml::encode($data->institucion), array('view', 'id'=>$data->id)); ?>
					<br>
					<?php echo CHtml::link('Editar', array('update', 'id'=>$data->id), array('style'=>'color:#009BB7;font-size:11px;'))?>
					&nbsp;
					<?php echo CHtml::link('Eliminar', '#', array('style'=>'color:#009BB7;font-size:11px;', 'submit'=>array('delete','id'=>$data->id), 'confirm'=>'¿Estás seguro que deseas eliminar este contacto?'))?>

				</h3>
				<b><?php echo CHtml::encode($data->getAttributeLabel('actividad')); ?>:</b>
				<?php echo CHtml::encode($data->actividad == "0" ? $data->otra_actividad : Semana::actividades($data->actividad)); ?>
                <br /><b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
                <?php echo CHtml::encode($data->descripcion); ?>
				<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
				<?php echo CHtml::encode($data->direccion); ?>
				<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
				<?php echo CHtml::encode(Estado::model()->findByPk($data->estado_id)->nombre); ?>
				<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('fecha_ini')); ?>:</b>
				<?php echo CHtml::encode(SemanaController::fechaEvento($data->fecha_ini)); ?>
				<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('fecha_fin')); ?>:</b>
				<?php echo CHtml::encode(SemanaController::fechaEvento($data->fecha_fin)); ?>
				<br /> <b><?php echo CHtml::encode($data->getAttributeLabel('informes')); ?>:</b>
				<?php echo CHtml::encode($data->informes); ?>
				<br />
			</div>
		</td>
	</tr>
</table>
