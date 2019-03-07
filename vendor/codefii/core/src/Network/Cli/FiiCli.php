<?php
namespace Codefii\Cli;

use Codefii\Cli\Commands\Quotes;
use Codefii\Cli\Commands\Server;
use Codefii\Cli\Commands\Help;
use Codefii\Cli\Commands\Controller;


final class FiiCli
{
  
  function __construct()
  {
    $opts = getopt(null,['about','serve','help','port:','create:','quotes']);

    if (isset($opts['quotes'])) {
      Quotes::quotemaker()."\n";
    }
    
    if (isset($opts['create'])) {
      Controller::ctrl_maker($opts['create'])."\n";
    }

    if (isset($opts['serve']) && isset($opts['port']) || isset($opts['serve']) && !isset($opts['port'])) {
      @Server::start($opts['port']);
    }

    if (empty($opts)) {
      Help::about();
    }
  }
}