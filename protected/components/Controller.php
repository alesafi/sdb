<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	*/
	public $breadcrumbs=array();

	/**
	 *
	 * @return el campo fec_alta de cada tabla
	*/
	public static function fechaAlta()
	{
		date_default_timezone_set("Mexico/General");
		return date("Y-m-d H:i:s");
	}

	public function dameInfoUsuario()
	{		
		$results = Yii::app()->db->createCommand()
		->select('r.*')
		->from('usuarios u')
		->leftJoin('roles r', 'u.roles_id=r.id')
		->where('u.id='.Yii::app()->user->id_usuario)
		->queryRow();

		return $results;
	}

	/**
	 * Pone el Id de la sesion en el objeto persistente de yii (cookie)
	 * @param string $usuario el nombre
	 */
	public function setIdUsuario($usuario)
	{
		$model = Usuarios::model()->findByAttributes(array('email'=>$usuario, 'cual_semana'=>Yii::app()->params->cual_semana));
		Yii::app()->user->setState('id_usuario', $model->id);
	}

	/**
	 *
	 * @param boolean $dameId si queremos que retorne el id
	 */
	public function verificaLogin($dameId=null)
	{
		if(isset(Yii::app()->user->id_usuario))
		{
			if ($dameId)
				return Yii::app()->user->id_usuario;

		} else {
			if (isset(Yii::app()->user->id)) {

			$this->setIdUsuario(Yii::app()->user->id);

			if ($dameId)
				return $this->verificaLogin(true);
			} else {
				
			}
		}
	}

	/**
	 * Verifica si el registro tiene estado o no
	 * @param object clase Estado $data
	 * @return string el valor del estaod si es que existe o vacio
	 */
	public static function situacionEstado($data)
	{
		$estado = Estado::model()->findByPk($data);

		if ($estado != null)
			return $estado->nombre;

		else
			return '';
	}
	
	/**
	 *
	 * @param query $valores
	 * @return array para valores de la serie
	 */
	public static function valoresGraficaEventos ()
	{
		$eventos='';
		$estados='';
		$barras='';
	
		$resultados=Yii::app()->db->createCommand()
		->select('count(*) AS eventos, estado_id AS estado')
		->from('semana s')
		->where("cual_semana='".Yii::app()->params->cual_semana."'")
		->group('estado_id')
		->order('count(*) DESC')
		->queryAll();
	
		foreach ($resultados as $k => $data)
			$barras.="['".Estado::model()->findByPk($data['estado'])->nombre."', ".$data['eventos'].'], ';

		return array('barras'=>'['.substr($barras, 0, -2).']');
	}

	public function vigencia()
	{
		$fecha = date("YmdHis");
		if ($fecha > Yii::app()->params->fecha_termino_sdb)
			throw new CHttpException(NULL,"El tiempo para publicar tus actividades ha terminado, la fecha límite fue: ".$this->formatoFecha('aaaa-mm-dd', Yii::app()->params->fecha_termino_sdb));
		else if ($fecha < Yii::app()->params->fecha_inicio_sdb)
			throw new CHttpException(NULL,"El tiempo para publicar tus actividades aún no ha iniciado, comienza el: ".$this->formatoFecha('aaaa-mm-dd', Yii::app()->params->fecha_inicio_sdb));
		else
			return true;
	}
	
	public static function formatoFecha($formato, $fecha = null)
	{
		if (empty($fecha))
			$fecha = Yii::app()->params->fecha_termino;
			
		$anio = substr($fecha,0,4);
		$mes = substr($fecha,4,2);
		$dia = substr($fecha,6,2);
		
		switch ($formato)
		{
			case 'aaaa-mm-dd':		
				$fecha = $anio.'-'.$mes.'-'.$dia;
				break;
			case 'aaaa-mm':
				$fecha = $anio.'-'.$mes;
				break;
			default:
				$fecha = '0000-00-00';
				break;
		}
		
		return $fecha;
	}
}