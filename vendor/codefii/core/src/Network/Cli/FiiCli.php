<?php
namespace Codefii\Cli;

use Codefii\Cli\Commands\Quotes;
use Codefii\Cli\Commands\Server;
use Codefii\Cli\Commands\Help;
use Codefii\Cli\Commands\Controller;
use Codefii\Cli\Commands\Model;


final class FiiCli
{
  
  function __construct()
  {
    $opts = getopt(null,['about','serve','help','port:','create:','quotes','n:']);

    if (isset($opts['quotes'])) {
      Quotes::quotemaker()."\n";
    }
    
    if (isset($opts['create']) && isset($opts['n'])) {
        switch($opts['create']){
          case 'controller':
          Controller::ctrl_maker($opts['n'])."\n";
          break;
          case 'model':
          Model::model_maker($opts['n'])."\n";
          break;
          default:
          echo "No command found";
          break;
        }
      }
      
      
    

    if (isset($opts['serve']) && isset($opts['port']) || isset($opts['serve']) && !isset($opts['port'])) {
      @Server::start($opts['port']);
    }

    if (empty($opts)) {
      Help::about();
    }
  }
}