<?php
    session_start();

    if(!isset($_SESSION['id']) OR !isset($_SESSION['id_archivo_excel'])){
        header('Location: ../login.php');
    }

    $id_archivo_excel = $_SESSION['id_archivo_excel'];

    require_once('../conexion/conexion.php');
?>

<?php

$sentencia = "SELECT * FROM archivos_generar WHERE id_archivo_excel = '$id_archivo_excel' AND id_tipo_archivo = 2";
$resultado = mysqli_query($conexion, $sentencia);
$filasAfectadas = mysqli_num_rows($resultado);

if($filasAfectadas >= 1) // si se selecciono alguna opcion de memorando
{
    header('Location: ../ingresarDatosGenerarMemorandos.php'); die();
}
else
{
    header('Location: 8_generarDocumentosFase2.php'); die();
}

?>