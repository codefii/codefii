<?php
namespace Codefii\Cli\Commands;

/**
  * 
  */

 class Model
 {
 	//Private write file fn
 	private static function wfile($model_name)
 	{
 		return "<?php \nnamespace App\Models;
 				\nuse App\Codefii\Entity\Orm\Fiirm;\n
 				\nclass {$model_name} extends Fiirm {\n\n\n\n\n}";
 	}

 	public static function model_maker($model_name)
 	{
 		//Check for Existing model(true) kill execution
 		if (file_exists("app/models/{$model_name}.php")) {
 			echo "Existing [{$model_name}] Model found, try again \n";
 			exit;
 		}

 		//Create and write File to model Dir
 		$model = fopen("app/models/{$model_name}.php","w");
 		fwrite($model, self::wfile($model_name));

 		//Throw response
 		echo "Model [{$model_name}] created successfully \n";
 	}

 } 