<?php

// Includes
foreach (glob("config/*.php") as $filename)
{
    include $filename;
}

foreach ($lib as $filename)
{
    include $filename['path'] . $filename['file'];
}

foreach (glob("helper/*.php") as $filename)
{
    include $filename;
    $filename = str_replace('.php', '', $filename);
    $filename = str_replace('helper/', '', $filename);
    $filename = ucfirst(strtolower($filename));
    $class = strtolower($filename);
    $$class = new $filename;
    // if(is_object($$class)){
    // 	echo $class . '- Esta correcto <br>';
    // }else{
    // 	echo $class . '- No se creo <br>';
    // }
}


foreach (glob("controller/*.php") as $filename)
{
    include $filename;
}

$q = $_SERVER['REQUEST_URI'];

$params = explode('/', $q);

if(count($params) > 1){

	if(isset($params[1])){
		$controller = ucfirst(strtolower($params[1]));
	}else{
		$controller = 'Post';
	}
	
	if(isset($params[2])){
		$method = strtolower($params[2]);
	}else{
		$method = 'index';
	}
}

$obj = new $controller;

$obj->$method();
