<?php
/* @var $this SemanaController */
/* @var $model Semana */

$this->menu=array(
		array('label'=>'Conoce los eventos', 'url'=>array('admin')),
		array('label'=>'Tus eventos', 'url'=>array('index')),
);
?>

<h1>Crea un evento <?php Yii::app()->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model, 'usuario'=>$usuario)); ?>