<!DOCTYPE HTML>
<!--
	Strata by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html><head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="<?php echo Yii::app()->request->baseUrl; ?>/css/ie/html5shiv.js"></script><![endif]-->
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/jquery.poptrox.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/skel.min.js"></script>
		<script src="<?php echo Yii::app()->request->baseUrl; ?>/assets/js/init.js"></script>
    <script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
        </script>
		
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie/v8.css" /><![endif]-->

<!-- blueprint CSS framework -->


<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script src="http://bdi.conabio.gob.mx/fotoweb/googleAnalytics.js"></script>
<title>9a. Semana de la Diversidad Biol&oacute;gica  | Biodiversidad Mexicana | CONABIO</title>
<meta property="og:image" content="https://www.biodiversidad.gob.mx/SDB/imagenes/pagina/9SDB.jpg"/>


<noscript>
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/skel.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/style-xlarge.css" />
</noscript>

</head>

<body>

		<!-- Header -->
			<header id="header">
				<!--<a href="<?php echo Yii::app()->request->baseUrl; ?>" class="image avatar"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/imgCirculo.png" alt="" /></a>-->
				<a href="<?php echo Yii::app()->request->baseUrl; ?>" class="image avatar"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn_transparente.png" alt="" /></a>
			</header>

		<!-- Main -->
			<div id="main">

				<!-- One -->
					<section id="one">
					  <header class="major">
						  <h6 align="right">
							  <a href="http://www.biodiversidad.gob.mx/index.html">Biodiversidad Mexicana</a>&nbsp;-&nbsp;Semana de la Diversidad Biol&oacute;gica <b>| <a href="http://www.biodiversidad.gob.mx/menusup/difusion.html">Semanas anteriores</a></b>
						  </h6>
						  <a href="<?php echo Yii::app()->request->baseUrl; ?>" class="image avatar"><h4 class="verde">Inicio</h4></a>
							<!--<h2>&nbsp;</h2>
							<a href="<?php echo Yii::app()->request->baseUrl; ?>" class="image avatar"><h2 class="verde">9a. Semana de la Diversidad Biol&oacute;gica</h2></a><br>
                            <span class="slogan">Nuestra biodiversidad, nuestra alimentaci&oacute;n, nuestra salud</span>
                            <h3 style="font-variant: small-caps"> </h3>-->
					  </header>
						<p style="text-align:center"><br>
						<?php if (Yii::app()->user->isGuest) { ?>
					    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=usuarios/create"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn_sumate.png" name="registro" width="90" height="127" id="registro" onMouseOver="MM_swapImage('registro','','<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn2_sumate.png',1)" onMouseOut="MM_swapImgRestore()"></a>
					    <?php } ?>
					    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=semana/create"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn_publica.png" name="publica" width="90" height="127" id="publica" onMouseOver="MM_swapImage('publica','','<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn2_publica.png',1)" onMouseOut="MM_swapImgRestore()"></a> 
                        
					    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=semana/admin"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn_consulta.png" name="eventos" width="90" height="127" id="eventos" onMouseOver="MM_swapImage('eventos','','<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn2_consulta.png',1)" onMouseOut="MM_swapImgRestore()"></a> 
                        
					    <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=semana/materiales"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn_materiales.png" name="materiales" width="90" height="127" id="materiales" onMouseOver="MM_swapImage('materiales','','<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn2_materiales.png',1)" onMouseOut="MM_swapImgRestore()"></a>
                        
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=semana/mat_ninos"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn_mninos.png" name="ninos" width="90" height="127" id="ninos" onMouseOver="MM_swapImage('ninos','','<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn2_mninos.png',1)" onMouseOut="MM_swapImgRestore()"></a> 
                        
						<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=semana/estadisticas"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn_estadisticas.png" name="estadisticas" width="90" height="127" id="estadisticas" onMouseOver="MM_swapImage('estadisticas &lt;img&gt;','','/Imagenes/titEstadisticas_03.png','estadisticas','','<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn2_estadisticas.png',1)" onMouseOut="MM_swapImgRestore()"></a>
                        
                        <!--<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=semana/aliados"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn_aliados.png" name="aliados" width="90" height="127" id="aliados" onMouseOver="MM_swapImage('aliados &lt;img&gt;','','/Imagenes/titEstadisticas_03.png','aliados','','<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn2_aliados.png',1)" onMouseOut="MM_swapImgRestore()"></a>-->
                        
                        <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=semana/ponentes"><img src="<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn_ponentes.png" name="ponentes" width="90" height="127" id="ponentes" onMouseOver="MM_swapImage('ponentes &lt;img&gt;','','/Imagenes/titEstadisticas_03.png','ponentes','','<?php echo Yii::app()->request->baseUrl; ?>/imagenes/pagina/btn2_ponentes.png',1)" onMouseOut="MM_swapImgRestore()"></a>
                        
                        </p>
						<?php if (!Yii::app()->user->isGuest) { ?>
							<a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=semana/index">Ver tus eventos</a>
					    	| <a href="<?php echo Yii::app()->request->baseUrl; ?>/index.php?r=site/logout">Cerrar sesión</a>
					    <?php } ?>
				<?php echo $content; ?>			

			</div>

		<!-- Footer -->
		
		        <!-- C\357\277\275digo para estad\357\277\275sticas en Google Analytics -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-8226401-1");
pageTracker._trackPageview();
} catch(err) {}</script>
<!-- Fin del c\357\277\275digo para estad\357\277\275sticas en Google Analytics -->
		
		
	</body>
</html>                         
                     