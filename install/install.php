<?php
 if(!isset($chekvar))
 	die("este archivo no debe ser ejecutado");
 
 
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
 	$config = fopen("../Admin/EasyFaqConfig.ini.php", "w+");
 	if($config)
 	{
 		fwrite($config,";<?php die(\"Acceso denegado\")?>\n;con la linea anterior evitamos que lean el archivo desde el navegador\n;el punto y coma antes del las instrucciones php es para que al procesar\n;el archivo fuera del navegador (en el servidor) no lo interprete para nada\n\n;config file for Easyfaq\n[UserData]\n");
 		fwrite($config,"\tuser = \"$user\"\n");
 		fwrite($config,"\tpass = \"$psw\"\n");
 		fwrite($config,"\n\n;datos de configuracion de la bd\n[DbData]\n");
 		fwrite($config,"\tuser = \"$dbUser\"\n");
 		fwrite($config,"\tpass = \"$dbPass\"\n");
 		fwrite($config,"\thost = \"$dbHost:$dbPort\"\n");
 		fwrite($config,"\tDB  = \"$dbName\"\n\n;end");
 		
 		return true;
 	}
 	else 
 	return ";<?php die(\"Acceso denegado\")?>\n;con la linea anterior evitamos que lean el archivo desde el navegador\n;el punto y coma antes del las instrucciones php es para que al procesar\n;el archivo fuera del navegador (en el servidor) no lo interprete para nada\n\n;config file for Easyfaq\n[UserData]\n\tuser = \"$user\"\n\tpass = \"$psw\"\n\n\n;datos de configuracion de la bd\n[DbData]\n\tuser = \"$dbUser\"\n\tpass = \"$dbPass\"\n\thost = \"$dbHost:$dbPort\"\n\tDB  = \"$dbName\"\n\n;end";
 	
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
 		mysql_query("Create table 'EasyFaqData' ('id' int not null auto_increment,'question' longtext not null,'answer' longtext not null) primary key('id')",$conexion);			
 	}
 	
 }
 
 ?>