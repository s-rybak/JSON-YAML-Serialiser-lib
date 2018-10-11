<?php

use PhpCsFixer\Finder;

$finder = Finder::create()
            ->in( __DIR__ . "/lib" )
            ->in( __DIR__ . "/bin" );

return \PhpCsFixer\Config::create()
                         ->setFinder($finder)
                         ->setRules([
	                         '@PSR2'=>true
                         ]);

