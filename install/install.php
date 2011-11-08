<?php
 if(!isset($chekvar))
 	die("este archivo no deve ser ejecutado");
 
 
 /**
  * guarda la configuracion en EasyFaqConfig.ini.php
  * 
  * @param string $user
  * @param string $psw
  * @param string $dbName
  * @param string $dbUser
  * @param string $dbPass
  * @param string $dbHost
  * @param int $dbPort
  */
 function saveData( string $user, string $psw, string $dbName, string $dbUser, string $dbPass, string $dbHost, int $dbPort)
 {
 	
 }
 
 
 /**
  * 
  * genera las tablas necesarias para el funcionamiento de EasyFaq
  * 
  * si $loadFromFile esta definido en true procesara el archivo EasyFaqConfig.ini.php para sacar los datos,
  * en este caso no es necesario aportar los demas argumentos
  *  
  * @param string $dbName
  * @param string $dbUser
  * @param string $dbPass
  * @param string $dbHost
  * @param int $dbPort
  * @param bool $loadFromFile[opcional]
  */
 function makeDb( bool $loadFromFile = FALSE, string $dbName, string $dbUser, string $dbPass, string $dbHost, int $dbPort)
 {
 	if($loadFromFile)
 	{
 		$config = parse_ini_file("EasyFaqConfig.ini.php",TRUE,INI_SCANNER_RAW);
 		$conexion = mysql_connect($config['DbData']['host'],$config['DbData']['user'],$config['DbData']['pass']);
 		mysql_select_db($config['DbData']['DB'],$conexion);	
 	}
 	
 }
 
 ?>