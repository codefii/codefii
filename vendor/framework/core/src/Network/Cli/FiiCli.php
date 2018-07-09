<?php
namespace Codefii\Cli;
use Codefii\Cli\AdminCreator;
final class FiiCli {
  public function __construct(){
    $opts = getopt(null,['serve','help','port:','create']);
    if(isset($opts['serve']) && isset($opts['port'])){
      if(strlen($opts['port'])==2 || strlen($opts['port'])==1 || strlen($opts['port'])==3
    || strlen($opts['port'])==0){
         die("invalid port length");
        exit();
      }else if(strlen($opts['port'])==4){
        echo "Codefii development server started at ".date("c")."
        Listening on http://localhost:".$opts['port']." ";
        passthru("php -S localhost:".$opts['port'])." -t ../web/index.php";
      }
    }else if(isset($opts['serve']) && !isset($opts['port'])){
      echo "Codefii development server started at ".date("c")."
      Listening on http://localhost:8000";
      passthru("php -S localhost:8000")."-t ../web/index.php";
    }else if(isset($opts['create'])){
      $admin  = new AdminCreator();
      $admin->createUser();
    }else{
      // var_dump($argc);
    }
    if(isset($opts['help'])){
      echo "Usage  php fii [command] \n\n
      ";
      echo "--serve \tDisplay your project on the browser using the defualt port\n\n";
      echo "     --serve --port<number> \tDisplay your project on the browser using any port of your choice\n";
    }
  }
}
