<?php
$config =  parse_ini_file("EasyFaqConfig.ini",TRUE);
//evitar que se usa la configuracion por defecto
if($config['UserData']['user'] == "root" && $config['UserData']['pass'] == 'toor' )
	die("porfavor modifique los datos de login predeterminados antes de usar el servicio");

session_start();
if(!isset($_SESSION['logged']))
	$_SESSION['logged'] = false;

if(isset($_POST['user']) && $_POST['pass'])
	{
		if($_POST['user'] == $config['UserData']['user'] && $_POST['pass'] == $config['UserData']['pass'] )
			$_SESSION['logged'] = true;
		else
			$error = "Nombre de usuario o contrase–a invalidos";
	}

if($_SESSION['logged'])
	header("location: /EasyFaqAdmin.php");


	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>EasyFaq Admin Login</title>
	</head>
	
	<body>
		<div class="main container">
			<?php	
				if(isset($error))
					echo "<div class\"error\">$error</div>";
			?>
			<div class="loginform">
				<form method="post" action="login.php">
					Usuario: <input id="user" type="text" /><br />
					Pasword: <input id="user" type="password"><br />
					<input type="submit" value="Entrar">
				</form>
			</div>
		</div>
	</body>
</html>