<?php
$config =  parse_ini_file("EasyFaqConfig.ini.php",TRUE);
//evitar que se usa la configuracion por defecto
if($config['UserData']['user'] == "root" && $config['UserData']['pass'] == 'toor' )
	die("porfavor modifique los datos de login predeterminados antes de usar el servicio");

session_start();

if($_SESSION['logged'])
	header("location: EasyFaqAdmin.php");

$_SESSION['logged'] = false;

if(isset($_POST['user']) && $_POST['psw'])
	{
		if($_POST['user'] == $config['UserData']['user'] && $_POST['psw'] == $config['UserData']['pass'] )
		{
			$_SESSION['logged'] = true;
			header("location: EasyFaqAdmin.php");
		}
		else
			$error = "Nombre de usuario o contrase–a invalidos";
	}



	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>EasyFaq Admin Login</title>
	</head>
	
	<body>
		<div class="LogInContainer">
			<?php	
				if(isset($error))
					echo "<div class\"Error\">$error</div>";
			?>
			<div class="LogInForm">
				<form method="post" action="<?php echo basename($_SERVER['PHP_SELF']);?>" method="post">
					Usuario: <input name="user" type="text" /><br />
					Pasword: <input name="psw" type="password" /><br />
					<input type="submit" value="Entrar">
				</form>
			</div>
		</div>
		<!-- porfavor no remuevas esto -->
		<div id="footer">EasyFaq por juan "<a href="ka-plum.co.cc">Cetus</a>" orozco</div>
	</body>
</html>