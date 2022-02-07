<?php
	$host_db = "localhost";
	$nombre_db = "sgd";
	$usuario_db = "root";
	$contra_db = "";

	$conexion = mysqli_connect($host_db, $usuario_db, $contra_db, $nombre_db);
	mysqli_set_charset($conexion,"utf8");

	if(!$conexion){
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	   	echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}
    mysqli_select_db($conexion, $nombre_db);
?>