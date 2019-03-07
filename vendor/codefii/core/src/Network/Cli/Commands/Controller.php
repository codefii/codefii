<?php
namespace Codefii\Cli\Commands;

/**
  * 
  */

 class Controller
 {
 	//Private write file fn
 	private static function wfile($ctrl_name)
 	{
 		return "<?php \nnamespace App\Controllers;
 				\nuse App\Controllers\Controller;\n
 				\nclass {$ctrl_name} extends Controller {\n\n\n\n\n}";
 	}

 	public static function ctrl_maker($ctrl_name)
 	{
 		//Check for Existing Controller(true) kill execution
 		if (file_exists("app/controllers/{$ctrl_name}.php")) {
 			echo "Existing [{$ctrl_name}] Controller found, try again \n";
 			exit;
 		}

 		//Create and write File to controller Dir
 		$controller = fopen("app/controllers/{$ctrl_name}.php","w");
 		fwrite($controller, self::wfile($ctrl_name));

 		//Throw response
 		echo "Controller [{$ctrl_name}] created successfully \n";
 	}

 } 