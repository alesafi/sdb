<?php

class SemanaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	//public $layout='//layouts/column2';
	//public $layout=false;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('view', 'admin', 'inicio', 'materiales', 'mat_ninos', 'aliados', 'estadisticas', 'ponentes'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('index', 'create','update', 'delete'),
						'users'=>array('@'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
				 'actions'=>array('index', 'create','update', 'delete'),
						'users'=>array('calonso'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$model=$this->loadModel($id);
		$model_materiales=Materiales::model()->findAllByAttributes(array('semana_id'=>$model->id));

		$this->render('view',array(
				'model'=>$model,
				'model_materiales'=>$model_materiales,
				'puede_modificar' => $this->puedeModificar($model->usuarios_id, false),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$this->vigencia();
		$this->verificaLogin();
		$model=new Semana;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Semana']))
		{
			//print_r($_POST);
			$model->attributes=$_POST['Semana'];
			if($model->save()) {
				$this->enviaMail($model);
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
				'model'=>$model,
				'usuario' => Yii::app()->user->id_usuario
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$this->vigencia();
		$this->verificaLogin();
		$model=$this->loadModel($id);
		$this->puedeModificar($model->usuarios_id);
		$model_materiales=Materiales::model()->findAllByAttributes(array('semana_id'=>$model->id));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Semana']))
		{
			if (empty($_POST['Semana']['logo']))
				unset($_POST['Semana']['logo']);
			$model->attributes=$_POST['Semana'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
				'model'=>$model,
				'model_materiales'=>$model_materiales,
				'usuario' => Yii::app()->user->id_usuario
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->vigencia();
		$this->verificaLogin();
		$model = $this->loadModel($id);
		$this->puedeModificar($model->usuarios_id);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->verificaLogin();
		$dataProvider=new CActiveDataProvider('Semana', array('criteria' => array ('condition'=>'usuarios_id='.Yii::app()->user->id_usuario." AND cual_semana='".Yii::app()->params->cual_semana."'")));
		$this->render('index',array(
				'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$this->verificaLogin();
		$model=new Semana('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Semana']))
			$model->attributes=$_GET['Semana'];

		$this->render('admin',array(
				'model'=>$model,
		));
	}

	/**
	 * El index de la semana
	 */
	public function actionInicio()
	{
		$this->render('inicio');
	}
	
	
	/**
	 * Pagina de Aliados
	 */
	public function actionAliados()
	{
		$this->render('aliados');
	}
	
	/**
	 * Pagina de Ponentes
	 */
	public function actionPonentes()
	{
		$this->render('ponentes');
	}
	
	
	/**
	 * Pagian de Materiales
	 */
	public function actionMateriales()
	{
		$this->render('materiales');
	}
	
	/**
	 * Pagian de Materiales para ninios
	 */
	public function actionMat_ninos()
	{
		$this->render('mat_ninos');
	}
	
	/**
	 * Estadisticas de los eventos
	 */
	public function actionEstadisticas()
	{
		$this->render('estadisticas', array('estadisticas'=>Controller::valoresGraficaEventos()));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Semana the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Semana::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Semana $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='semana-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public static function fechaEvento($fecha)
	{
		switch ((int) substr($fecha, 8, 2))
		{
			case 9:
				return 'Lunes 9 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 10:
				return 'Martes 10 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 11:
				return 'Miércoles 11 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 12:
				return 'Jueves 12 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 13:
				return 'Viernes 13 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 14:
				return 'Sábado 14 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 15:
				return 'Domingo 15 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 16:
				return 'Lunes 16 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 17:
				return 'Martes 17 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 18:
				return 'Miércoles 18 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 19:
				return 'Jueves 19 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 20:
				return 'Viernes 20 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 21:
				return 'Sábado 21 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			case 22:
				return 'Domingo 22 de Mayo de 2016 a las '.substr($fecha, 11, 5).' horas.';
				break;
			default:
				return 'Fecha incorrecta, favor de verificar';
				break;
		}
	}

	/**
	 *
	 * @param integer $foto el idebtificador del logo
	 * @return string la foto a desplegar
	 */
	public static function validaLogo ($model)
	{
		if (!empty($model->logo))
		{
			return CHtml::link(CHtml::image($model->ruta, 'Ver detalles', array('width'=>'70px')), array('view', 'id'=>$model->id)).'<br>'.CHtml::link('Ver a detalle', array('view', 'id'=>$model->id), array('style'=>'color:#BD5D28;font-size:10;'));

		} else {
			return CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/imagenes/aplicacion/blank-logo.png', 'Ver detalles', array('width'=>'70px')), array('view', 'id'=>$model->id)).'<br>'.CHtml::link('Ver a detalle', array('view', 'id'=>$model->id), array('style'=>'color:#BD5D28;font-size:10;'));
		}
	}

	private function enviaMail ($model)
	{
		$institucion = '<b>Institucion:</b> '.$model->institucion.'<br>';
		$actividad = '<b>Actividad: </b>';
		$model->actividad == '0' ? $actividad.=$model->otra_actividad.'<br>' : $actividad.=Semana::actividades($model->actividad).'<br>';
		$descripcion = '<b>Descripcion:</b> '.$model->descripcion.'<br>';
		$estado = '<b>Estado: </b>'.Estado::model()->findByPk($model->estado_id)->nombre.'<br>';
		$ubicacion = '<b>Ubicacion: </b>'.$model->direccion.'<br>';
		$fecha_inicio = '<b>Fecha de inicio: </b>'.SemanaController::fechaEvento($model->fecha_ini).'<br>';
		$fecha_termino = '<b>Fecha de termino: </b>'.SemanaController::fechaEvento($model->fecha_fin).'<br><br>';
		$liga = "Para más información consulta el ".CHtml::link('registro del evento', "http://biodiversidad.gob.mx/Difusion/SDB/index.php/semana/".$model->id);
		$msj = $institucion.$actividad.$descripcion.$estado.$ubicacion.$fecha_inicio.$fecha_termino.$liga;
		$subject = 'Nuevo registro de evento';
		$to = 'sdb@conabio.gob.mx';
		$header  = "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html; charset: utf8\r\n";
		mail($to, $subject, $msj, $header);
	}

	private function puedeModificar($usuario_semana, $con_redirect = true)
	{
		if (!Yii::app()->user->isGuest)
		{
			// Solo pueden modificar el usuario root, cgalindo o medios, o el dueño del contenido
			$rol = $this->dameInfoUsuario();
			if ($rol['id'] == "3" || $rol['id'] == "6" || $rol['id'] == "7" || ($usuario_semana == Yii::app()->user->id_usuario))
				return true;
			else {
				if ($con_redirect)
					throw new CHttpException(NULL,"Lo sentimos, no tienes permiso para realizar esta acción.");
				else
					return false;
			}
		
		} else {
			if ($con_redirect)
				throw new CHttpException(NULL,"Lo sentimos, no tienes permiso para realizar esta acción.");
			else
				return false;
		}
	}
}
