#!/usr/bin/env php
<?php

require_once "Person.php";
require_once "../lib/load.php";

$person = new Person("Anton","Hamaz", 29);

$serializerYAML = new SerialiserClass(new YAMLSerialiserClass());
$serializerJSON = new SerialiserClass(new JSONSerialiserClass());

echo $serializerYAML->serialize($person) ."\n";
echo $serializerJSON->serialize($person) ."\n";
