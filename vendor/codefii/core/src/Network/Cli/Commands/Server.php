<?php

namespace Codefii\Cli\Commands;

/**
 * 
 */
class Server
{
	public static function start($port)
	{
		//When port is less than 3 or is null
		if (strlen($port) <= 3 && strlen($port) != 0 ) {
			echo "Invalid port length \n";
			exit;
		}

		//Execute when port is null

		if (is_null($port)) {
			echo "Codefii development server started at ".date("c")."
			Listening on http://localhost:8000";

			passthru("php -S localhost:8000");
		}else{

			//Execute when port is set
			echo "Codefii development server started at ".date("c")."
			Listening on http://localhost:".$port;

			passthru("php -S localhost:".$port);
		}
	}
	
}