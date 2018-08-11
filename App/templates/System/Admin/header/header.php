<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Codefii | Administrator</title>
    <meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="img/favicon.png">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../web/css/fiiA/master.css">
    <link rel="stylesheet" href="../../web/css/fiiA/bootstrap.css">

  </head>
  <body>
  <nav>
    <ul>
      <?php
        echo'<ul><li><a href="/admin">Home</a></li>
            <li><a><h4>logged in as:'.strtoupper($value).'</h4></a></li>
      
            <li><a href="/admin/logout">Logout</a></li>
      </ul>';
      // }else{
      //   echo '<li><a href="/admin">Home</a></li>';
      // }
       ?>
       

  </nav>
