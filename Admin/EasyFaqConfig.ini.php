;<?php die("Acceso denegado")?> 
;con la linea anterior evitamos que lean el archivo desde el navegador
;el punto y coma antes del las instrucciones php es para que al procesar
;el archivo fuera del navegador (en el servidor) no lo interprete para nada

;config file for Easyfaq
[UserData]
	;cambialo por tus datos
	user = "root"
	pass = "toor"
	
;datos de configuracion de la bd
[DbData]
	;cambialo por tus datos
	user = "root"
	pass = "toor";
	host = "exampla.com:42"
	DB = "DatabaseName"

;end
	