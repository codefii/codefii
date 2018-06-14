<?php

$input = trim(fgets(STDIN));
if($input=="run:app"){
  system("php -S localhost:3039 -t ./public/");
}
