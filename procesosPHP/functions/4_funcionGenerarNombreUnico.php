<?php

function generarNombreUnico($nombre_inicial){
    //CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
    date_default_timezone_set("America/Lima");
    $codigo_fecha = date("YmdHis");      
    $no_aleatorio = rand(100, 999); //GENERAMOS TRES DIGITOS PARA INCORPORARLO AL FINAL DEL CODIGO
    $codigo = $nombre_inicial." ".$codigo_fecha.$no_aleatorio; //CODIGO DE 17 DIGITOS
    $unique_file_name = str_replace(" ", "_", $codigo);
    $extension = "pdf";
    $nuevo_nombre = "$unique_file_name"."."."$extension";

    return $nuevo_nombre;
}

?>