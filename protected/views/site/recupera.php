<script type="text/javascript">
<!--
function validateEmail(email) 
{
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

	$(document).ready(function(){
		$('#boton').on('click', function(){
			if(!validateEmail($('#correo').val()))
				$('#error').html('').html('El correo no es correcto. Por favor verificalo.')
		});
	});	
//-->

</script>

<h4>Para recuperar tu cuenta por favor escribe el correo que registraste y dale enviar.
En unos minutos te ser&aacute; enviado un correo con el cual podr&aacute;s poner una nueva contrase&ntilde;a</h4>

<br>
NOTA: Asegurate de revisar tu bandeja de correo no deseado o spam
<p>
<form method="get" action="<?php echo Yii::app()->request->baseUrl.'/index.php?r=site/envia_correo'; ?>">
	Correo: <input id ="correo" name="correo" type="text"> <span style="color: red;" id="error"></span>
	<br>
	<input type="hidden" name="r" value="site/envia_correo">
	<div class="buttons" align="right">
		<input type="submit" value="Enviar" id="boton">
	</div >
</form>
</p>