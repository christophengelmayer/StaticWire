<?php
namespace StaticWire;

include(getcwd() . '/index.php');

$module = $modules->getModule('StaticWire', ['noPermissionCheck' => true]);
echo "Build path: " . $module->getBuildPath() . "\n";
$module->build('/');
