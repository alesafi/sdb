<?php
/* @var $this SemanaController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
		array('label'=>'Conoce los eventos', 'url'=>array('admin')),
		array('label'=>'Crea un evento', 'url'=>array('create')),
);
?>

<h1>Tus eventos</h1>

<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'emptyText' => 'Aún no has creado ningún evento. ¿Quieres '.CHtml::link('crear un evento', array('semana/create'), array('style'=>'color:#BD5D28;')).'?',
)); ?>
