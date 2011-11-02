<?php
$config =  parse_ini_file("EasyFaqConfig.ini",TRUE);
//evitar que se usa la configuracion por defecto
if($config['UserData']['user']== "root" && $config['UserData']['pass'] == 'toor' )
	die("porfavor modifique los datos de login predeterminados antes de usar el servicio");

if(!$_SESSION['logged'])
	header("location: /login.php");
?>