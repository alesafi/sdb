<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */
/*
$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Registro',
);

$this->menu=array(
	array('label'=>'Lista de usuarios', 'url'=>array('index')),
	array('label'=>'Administra usuarios', 'url'=>array('admin')),
);*/
?>

<h1>Registro</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>