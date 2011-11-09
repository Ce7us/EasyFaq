<?php

if(isset($_POST['enviar']))
{
	
	//checar que el usuario halla llenado todos los campos
	 if($_POST['user'] == '' || $_POST['psw'] == '' || $_POST['DbUser'] == '' || $_POST['DbHost'] == '' || $_POST['DbPort'] == '' || $_POST['DbName'] == '' || $_POST['DbPass'] == '')
	 	$error = "debes llenar todos los campos";
	//checar que el usuario no hay usado root/toor como password
	if($_POST['user']=="root" && $_POST['psw']=="root")
		$error = "no use root/toor como pasword";
	
	if(!isset($error))
	{
		$chekvar = 1;
		include_once 'install.php';
		saveData($_POST['user'],  $_POST['psw'], $_POST['DbName'],  $_POST['DbUser'], $_POST['DbPass'],$_POST['DbHost'], $_POST['DbPort']);
		makeDb(true);
	}
}

?>
<!doctype html>
<html>
	<head>
		<Title>Instalacion EasyFaq</Title>
	</head>
	<body>
		<form action="<?php echo basename($_SERVER['PHP_SELF']);?>" method="post">
		<?php if(isset($error)) echo "<div id=\"error\">$error</div>";?>
		<h1>Datos de usuario</h1>
			Usuario: <input type="text" name="user" /><br />
			Password: <input type="password" name="psw" /><br />
		<h1> Datos De conexion </h1>
			Usuario Mysql: <input type="text" name="DbUser" /><br />
			Host Mysql:<input type="text" name="DbHost" /><br />
			Puerto Mysql:<input type="text" name="DbPort" /><br />
			Base de Datos Mysql:<input type="text" name="DbName" /><br />
			Password Mysql: <input type="password" name="DbPass" /><br />
		
		<input type="submit" value="instalar" name="enviar" />
		</form>
	</body>
</html>