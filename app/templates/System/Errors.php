<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>404 Not Found</title>
  </head>
  <style media="screen">
    *{
      padding:0px;
      margin:0px;
    }
    body{
      font-family:"roboto",sans-serif;
      background:#FAF6FF;
    }
    .cf{
      width: 50%;

      text-align: center;
      margin:0 auto;
    }
  body h1,h2,h3,h4{
    font-family:"roboto",sans-serif;
      padding-top: 270px;
      color:#504E53;
    }
    .cf a{
      text-decoration: none;
      font-size: 25px;
      color:#2980B9;
    }
  </style>
    <body>
    <div class="cf">
          <h1><?php echo $error; ?></h1>
          <br />
          <a href="..">Go Back</a>
    </div>
  </body>
</html>
