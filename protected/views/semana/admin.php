<?php
/* @var $this SemanaController */
/* @var $model Semana */

$this->menu=array(
		array('label'=>'Tus eventos', 'url'=>array('index')),
		array('label'=>'Registra un evento', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
});
		$('.search-form form').submit(function(){
		$('#semana-grid').yiiGridView('update', {
		data: $(this).serialize()
});
		return false;
});
		");
?>

<!--<a href="https://www.biodiversidad.gob.mx/Difusion/news/images/calendario_7SDB.jpg" target="_blank">Programa de la 7a. Semana de la Diversidad Biológica - Biblioteca Vasconcelos</a><br><br>-->

<h1>Filtra y encuentra los eventos en tu estado</h1>

<br>

<?php $actividades = Semana::actividades(); ?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'semana-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
				array(
						'name'=>'estado_id',
						'value'=>'Estado::model()->findByPk($data->estado_id)->nombre',
						'filter'=>CHtml::listData(Estado::model()->findAll(array('order'=>'nombre ASC')), 'id', 'nombre'),
						'sortable'=>false,
				),
				array(
						'type'=>'raw',
						'name'=>'actividad',
						'value'=>'$data->actividad == "0" ? "<b>".$data->otra_actividad."</b><br>".(strlen($data->descripcion) <= 90 ? $data->descripcion: (substr($data->descripcion,0,90))." ...") : "<b>".Semana::actividades($data->actividad)."</b><br>".(strlen($data->descripcion) <= 90 ? $data->descripcion : (substr($data->descripcion,0,90))." ...")',
						'filter'=>Semana::actividades(),
						//'htmlOptions'=>array('style'=>'width:40px'),
						'sortable'=>false,
				),
				array(
						'header'=>'Fecha de inicio'.CHtml::image(Yii::app()->request->baseUrl."/imagenes/aplicacion/up-down.png", 'arriba-abajo', array('width'=>20)),
						'name'=>'fecha_ini',
						'filter'=>"<input type='date' name='Semana[fecha_ini]' min='".$this->formatoFecha('aaaa-mm-dd', Yii::app()->params->fecha_inicio)."' max='".$this->formatoFecha('aaaa-mm-dd', Yii::app()->params->fecha_termino)."' value='".$model->fecha_ini."'>",
						'value'=>'SemanaController::fechaEvento($data->fecha_ini)',
						'htmlOptions'=>array('style'=>'width:20px'),
				),
				array(
						'header'=>'Fecha de término'.CHtml::image(Yii::app()->request->baseUrl."/imagenes/aplicacion/up-down.png", 'arriba-abajo', array('width'=>20)),
						'name'=>'fecha_fin',
						'filter'=>"<input type='date' name='Semana[fecha_fin]' min='".$this->formatoFecha('aaaa-mm-dd', Yii::app()->params->fecha_inicio)."' max='".$this->formatoFecha('aaaa-mm-dd', Yii::app()->params->fecha_termino)."' value='".$model->fecha_fin."'>",
						'value'=>'SemanaController::fechaEvento($data->fecha_fin)',
						'htmlOptions'=>array('style'=>'width:20px'),
				),
				array(
						'header'=>'Institución'.CHtml::image(Yii::app()->request->baseUrl."/imagenes/aplicacion/up-down.png", 'arriba-abajo', array('width'=>20)),
						'name'=>'institucion',
						'filter'=>CHtml::textField('Semana[institucion]', $model->institucion, array('maxlength'=>255, 'size'=>10)),
						'htmlOptions'=>array('style'=>'width:10px'),
				),
				array(
						'type'=>'raw',
						'value'=>'SemanaController::validaLogo($data)',
						'header'=>'Logo',
				),
		),
)); ?>
