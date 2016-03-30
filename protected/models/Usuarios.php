<?php

/**
 * This is the model class for table "usuarios".
 *
 * The followings are the available columns in table 'usuarios':
 * @property integer $id
 * @property string $email
 * @property string $passwd
 * @property string $nombre
 * @property string $apellido
 * @property string $fec_alta
 * @property string $fec_act
 * @property integer $roles_id
 *
 * The followings are the available model relations:
 * @property Roles $roles
 */
class Usuarios extends CActiveRecord
{
	public $solo_passwd = false;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Usuarios the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuarios';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
				array('email, passwd, nombre, apellido', 'required'),
				array('roles_id', 'numerical', 'integerOnly'=>true),
				array('email, passwd, nombre, apellido', 'length', 'max'=>255),
				//valida el email
				//array('email','email'),
				// The following rule is used by search().
				// Please remove those attributes that should not be searched.
				array('id, email, passwd, nombre, apellido, fec_alta, fec_act, roles_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
				'roles' => array(self::BELONGS_TO, 'Roles', 'roles_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
				'id' => 'Id',
				'email' => 'Correo',
				'passwd' => 'Contraseña',
				'nombre' => 'Nombre (s)',
				'apellido' => 'Apellido (s)',
				'fec_alta' => 'Fecha registro',
				'fec_act' => 'Fecha ultima actualización',
				'roles_id' => 'Roles',
		);
	}

	/**
	 * (non-PHPdoc)
	 * @see CModel::afterValidate()
	 */
	public function afterValidate()
	{
		if (!$this->solo_passwd)
		{
			if (!empty($this->email)) 
			{
				if ($this->validaCorreo($this->email))
				{
					$emails = Usuarios::findAllByAttributes(array('email'=>$this->email, 'cual_semana' => Yii::app()->params->cual_semana));
				
					foreach ($emails as $email)
					{
						if (isset($email->id)) 
						{
							$this->addError('email', 'El correo '.$this->email." ya existe en nuestra base, si no recuerdas tu correo/contrase&ntilde;a sigue el siguiente <a href=\"".Yii::app()->request->baseUrl."/index.php?r=site/recupera\">enlace</a>");
							return false;
						}
					}
				} else {
					$this->addError('email', 'El correo que pusisite no es válido');
					return false;
				}
			}
			return parent::afterValidate();
			
		} else
			return parent::afterValidate();
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('passwd',$this->passwd,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('apellido',$this->apellido,true);
		$criteria->compare('fec_alta',$this->fec_alta,true);
		$criteria->compare('fec_act',$this->fec_act,true);
		$criteria->compare('roles_id',$this->roles_id);

		return new CActiveDataProvider($this, array(
				'criteria'=>$criteria,
		));
	}

	private function validaCorreo($correo)
	{
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
		if (preg_match($regex, $correo))
			return true;
		else
			return false;
	}
	
	public function send_mail()
	{
		$imagen = "<table width=\"990\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">";
		$imagen.= "<tbody><tr><td width=\"790\" align=\"center\" bgcolor=\"#FFFFFF\">";
		$imagen.= "<img	src=\"".Yii::app()->request->baseUrl.'/imagenes/aplicacion/SDB_2015/Imagenes/bg.jpg'."\" width=\"707\">";
		$imagen.= "</td></tr></tbody></table>";
		$para = $this->email.", sbd@conabio.gob.mx";
		$titulo = "5a. Semana de la Diversidad Biol&oacute;gica";
		$mensaje = $imagen."<br><br>".$this->nombre.' '.$this->apellido.",";
		$mensaje.= "<br><br>Para poder poner una nueva contrase&ntilde;a sigue el siguiente ";
		$mensaje.= "<a href=\"".Yii::app()->createAbsoluteUrl('site/reset')."&id=".$this->id."&fec_alta=".urlencode($this->fec_alta)."\" target=\"_blank\">enlace</a>.";
		$cabeceras = "Content-type: text/html; charset=utf-8"."\r\n";
		$cabeceras.= "From: noreply@conabio.gob.mx"."\r\n";
		mail($para, $titulo, $mensaje, $cabeceras);
	}
}