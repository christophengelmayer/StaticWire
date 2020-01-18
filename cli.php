<?php
namespace StaticWire;

include(getcwd() . '/index.php');

$modules->getModule('StaticWire', ['noPermissionCheck' => true])
        ->cliCommand();
