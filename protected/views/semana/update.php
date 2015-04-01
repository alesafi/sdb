<?php
/* @var $this SemanaController */
/* @var $model Semana */

$this->menu=array(
	array('label'=>'Ver todos los eventos', 'url'=>array('index')),
	array('label'=>'Crear un evento', 'url'=>array('create')),
	array('label'=>'Ver a detalle este evento', 'url'=>array('view', 'id'=>$model->id)),
	//array('label'=>'Manage Semana', 'url'=>array('admin')),
);
?>

<h1>Actualizando evento de <?php echo $model->institucion; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'model_materiales'=>$model_materiales, 'usuario'=>$usuario)); ?>