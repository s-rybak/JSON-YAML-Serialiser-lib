<?php
/**
 * Loads lib classes and interfaces
 *
 * @author  Sergey R <qwe@qwe.com>
 */
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../bin/Person.php";
require_once __DIR__."/interfaces/SerialiserInterface.php";
require_once __DIR__."/exceptions/CantBeSerialisedException.php";
require_once __DIR__."/classes/types/JSONSerialiserClass.php";
require_once __DIR__."/classes/types/YAMLSerialiserClass.php";
require_once __DIR__."/classes/types/XMLSerialiserClass.php";
require_once __DIR__."/classes/SerialiserClass.php";
