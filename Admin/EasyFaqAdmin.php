<?php

$config =  parse_ini_file("EasyFaqConfig.ini",TRUE);
//evitar que se usa la configuracion por defecto
if($config['UserData']['user']== "root" && $config['UserData']['pass'] == 'toor' )
	die("porfavor modifique los datos de login predeterminados antes de usar el servicio");

if(!$_SESSION['logged'])
	header("location: /login.php");

include_once 'Faq.php';

$faqList = new Faq($config['DbData']['user'], $config['DbData']['pass'], $config['DbData']['host'], $config['DbData']['DB']);

$faqList->load();

if(isset($_GET['borrar']))
{
	return ($faqList->delFaq($_GET['id']))? "Eliminado con Exito" :"Error al eliminar ";
	
}

if(isset($_POST['add']))
{
	$faqList->AddFaq($_POST['pregunta'], $_POST[respuesta]); 
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title>EasyFaq Admin</title>
	</head>
	
	<body>
		<div class="mainContainer">
					<?php 
						$faqList->PrintFaqs("no hay faqs", basename($_SERVER['PHP_SELF']));
					?>
					
					<div id="AddNew">
						<form id="new" action="<?php echo basename($_SERVER['PHP_SELF']);?>" method="post">
							<input type="hidden" id="id" value="<?php echo $faqList->getLastId();?>" />
							<input type="hidden" id="add" />
							<input type="text" id="pregunta" />
							<textarea rows="10" cols="30" id="respuesta"></textarea>
							<input type="submit" value="A–adir" />
						</form> 
					</div>
		</div>
		<!-- porfavor no remuevas esto -->
		<div id="footer">EasyFaq por juan "<a href="ka-plum.co.cc">Cetus</a>" orozco</div>
	</body>
</html>