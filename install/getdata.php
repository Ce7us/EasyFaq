<?php

if(isset($_POST))
{
	
	//checar que el usuario halla llenado todos los campos
	 if(!isset($_POST['user']) || !isset($_POST['psw']) || !isset($_POST['DbUser']) || !isset($_POST['DbHost']) || !isset($_POST['DbPort']) || !isset($_POST['DbName']) || !isset($_POST['DbPass']))
	 	$error = "debes llenar todos los campos";
	//checar que el usuario no hay usado root/toor como password
	if($_POST['user']=="root" && $_POST['psw']=="root")
		$error = "no use root/toor como pasword";
	
	if(!isset($error))
	{
		$chekvar = 1;
		include_once 'install.php';
	}
}

?>

<!doctype html>
<html>
	<head>
		<Title>Instalacion EasyFaq</Title>
	</head>
	<body>
		<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		<?php if(isset($error)) echo "<div id=\"error\">$error</div>";?>
		<h1>Datos de usuario</h1>
			<input type="text" name="user" />
			<input type="password" name="psw" />
		<h1> Datos De conexion </h1>
			<input type="text" name="DbUser" />
			<input type="text" name="DbHost" />
			<input type="text" name="DbPort" />
			<input type="text" name="DbName" />
			<input type="text" name="DbPass" />
		
		<input type="submit" value="instalar" />
		</form>
	</body>
</html>