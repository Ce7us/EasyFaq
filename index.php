<!doctype html>
<html>
	<head>
		<title>Ejemplo easyfaq</title>
	</head>
	<body>
		<?php
			include_once 'Faq.php';
			$config = parse_ini_file("Admin/EasyFaqConfig.php",TRUE,INI_SCANNER_RAW);
			$faq = new Faq($config['DbData']['user'], $config['DbData']['pass'],$config['DbData']['host'],$config['DbData']['DB']);
			$faq->load();
			$faq->PrintFaqs("No Hay Faqs!"); 
		?>
	</body>
</html>