<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
				// captcha action renders the CAPTCHA image displayed on the contact page
				'captcha'=>array(
						'class'=>'CCaptchaAction',
						'backColor'=>0xFFFFFF,
				),
				// page action renders "static" pages stored under 'protected/views/site/pages'
				// They can be accessed via: index.php?r=site/page&view=FileName
				'page'=>array(
						'class'=>'CViewAction',
				),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		//Yii::import('ext.tcpdf.*');
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
						"Reply-To: {$model->email}\r\n".
						"MIME-Version: 1.0\r\n".
						"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$this->setIdUsuario(Yii::app()->user->id);
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}

		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	/**
	 * Pone la ventana de mantenimiento
	 */
	public function actionMaintenance()
	{
		$this->render('maintenance');
	}
	
	/**
	 * Para recuperar la contrasenia
	 */
	public function actionRecupera()
	{
		$this->vigencia();
		$this->render('recupera');
	}
	
	/**
	 * Para mandar el correo a la direccion que anoto
	 */
	public function actionEnvia_correo()
	{
		$this->vigencia();
		
		if(isset($_GET['correo']) &&$_GET['correo'] != "")
		{
			$usuario = Usuarios::model()->findByAttributes(array('email'=>$_GET['correo'], 'cual_semana'=>Yii::app()->params->cual_semana));
			if (isset($usuario->id))
			{
				//$usuario->send_mail();
				$this->redirect(Yii::app()->request->baseUrl."/index.php?r=site/login&situacion=El correo esta en proces de enviarse.");
			}
			else
				$this->redirect(Yii::app()->request->baseUrl."/index.php?r=site/login&situacion=El correo proporcionado no se encuentra registrado.");	
		} else
			$this->redirect(Yii::app()->request->baseUrl."/index.php?r=site/login&situacion=El correo no puede ser vacio.");
	}
	
	/**
	 * Cuando le da click al enlace del correo
	 */
	public function actionReset()
	{
		$this->vigencia();
		
		if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['fec_alta']) && !empty($_GET['fec_alta']))
		{
			$usuario = Usuarios::model()->findByPk($_GET['id']);
			if ($usuario == NULL)
				throw new CHttpException(404,'Hubo un error en la petición.');
			elseif ($usuario->fec_alta == urldecode($_GET['fec_alta']) && $usuario->cual_semana == Yii::app()->params->cual_semana)
				$this->render('reset', array('usuario'=>$usuario));
			else
				throw new CHttpException(404,'Hubo un error en la petición.');
		} else
			throw new CHttpException(404,'Hubo un error en la petición.');
	}
	
	/**
	 * Cuando envio la nueva contrasenia
	 */
	public function actionNueva_contrasenia()
	{
		$this->vigencia();
		
		if (isset($_GET['id']) && !empty($_GET['id']) && isset($_GET['fec_alta']) && !empty($_GET['fec_alta']) && isset($_GET['passwd']) && !empty($_GET['passwd']))
		{
			$usuario = Usuarios::model()->findByPk($_GET['id']);
			if ($usuario == NULL)
				throw new CHttpException(404,'Hubo un error en la petición.');
			elseif ($usuario->fec_alta == $_GET['fec_alta'] && $usuario->cual_semana == Yii::app()->params->cual_semana)
			{
				$usuario->passwd = $_GET['passwd'];
				$usuario->solo_passwd = true;
				
				if ($usuario->save())
					$this->redirect(Yii::app()->request->baseUrl."/index.php?r=site/login&situacion=Tu contraseña ha sido cambiada con exito. Ahora puedes ingresar");
				else
					throw new CHttpException(404,'Hubo un error en la petición.');
			} else
				throw new CHttpException(404,'Hubo un error en la petición.');
		} else
			throw new CHttpException(404,'Hubo un error en la petición.');
	}
}