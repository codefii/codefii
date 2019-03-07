<?php 
namespace Codefii\Cli\Commands;

/**
 * 
 */
class Quotes
{

	public static function quotemaker ()
	{
		$quotes = [
		"Don't let other people get in the way of what you really want.",
		"Life is a collection of moments. The ideal is to have as many good once as you can.",
		"In any given moment we have two options: to step forward into growth or to step backward to safety.",
		"Only one thing can make a soul complete, and that thing is love.",
		"We don't have to bend till you break. You just have to get up",
		"Codefii Framework will keep evolving"
		];

		echo $quotes[rand(0,count($quotes)-1)]."\n";
	}
}