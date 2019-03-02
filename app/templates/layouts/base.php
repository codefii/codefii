<?php
 $template = new \Codefii\Controller\Template; 

 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
</head>
<body>
	<a href="/">Home</a> |
	<a href="about">About</a>
	
	<?php  $template->getTemp(); ?>


	<footer>
		
		<h3>footer</h3>
	</footer>
</body>
</html>