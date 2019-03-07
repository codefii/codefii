<?php 
namespace Codefii\Cli\Commands;

/**
 * 
 */
class Help
{
	
	public static function about ()
	{
		echo  readfile(__DIR__.'/../Fii.txt').'\n';
	}
}