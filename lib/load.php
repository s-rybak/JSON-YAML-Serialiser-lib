<?php
/**
 * Loads lib classes and interfaces
 *
 * @author  Sergey R <qwe@qwe.com>
 */
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../bin/Person.php";
require_once "interfaces/SerialiserInterface.php";
require_once "classes/types/JSONSerialiserClass.php";
require_once "classes/types/YAMLSerialiserClass.php";
require_once "classes/types/XMLSerialiserClass.php";
require_once "classes/SerialiserClass.php";
