<?php
 $template = new \Codefii\Controller\Template; 

 ?>
<!DOCTYPE html>
<html>
<head>
	<title><?= $title; ?></title>
</head>
<body>
	<a href="/">Home from base 1</a> |
	<a href="about">About from base 1</a>
	
	<?php  $template->getTemp(); ?>


	<footer>
		
		<h3>base 1 footer</h3>
	</footer>
</body>
</html>