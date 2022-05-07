<?php
ob_start();
session_start();
include('common/functions.php');
spl_autoload_register(function($classname){
  $pathcontroller = 'controller/'.$classname.'.php';
  $pathsystemconf = 'system/config/'.$classname.'.php';
  $pathsystemlib = 'system/library/'.$classname.'.php';
  $pathsystemdb = 'system/db/'.$classname.'.php';
  $pathsystem = 'system/'.$classname.'.php';
  $pathmodel = 'model/'.$classname.'.php';
  if(file_exists($pathcontroller))
    include($pathcontroller);
  if(file_exists($pathsystemconf))
    include($pathsystemconf);
  if(file_exists($pathsystemlib))
    include($pathsystemlib);
  if(file_exists($pathsystemdb))
    include($pathsystemdb);
  if(file_exists($pathsystem))
    include($pathsystem);
  if(file_exists($pathmodel))
    include($pathmodel);
});
