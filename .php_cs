<?php

use PhpCsFixer\Finder;

$finder = Finder::create()->in( __DIR__ . "/lib" );

return \PhpCsFixer\Config::create()
                         ->setFinder($finder)
                         ->setRules([
	                         '@PSR2'=>true
                         ]);

