<?php
session_start();
define('DIR',  __DIR__);


spl_autoload_register(function ($class)
{
	$parts = explode("_", $class);
	if ($parts[0] == 'C') {
		include DIR. '/application/controllers/' . $class . '.php';
	} elseif ($parts[0] == 'M')	{
		include DIR. '/application/models/' . $class . '.php';
	}
});

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	$controller = new C_GetController();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$controller = new C_PostController();
}

$controller->Request();

