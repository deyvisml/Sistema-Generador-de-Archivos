<?php
    session_start();

    if(!isset($_SESSION['id']) OR !isset($_SESSION['id_archivo_excel'])){
        header('Location: ../login.php');
    }

    $id_archivo_excel = $_SESSION['id_archivo_excel'];

    require_once('../conexion/conexion.php');
?>

<?php

    if(isset($_POST['enviar']))
    {
        $consulta = "DELETE FROM archivos_generar WHERE id_archivo_excel = $id_archivo_excel";
        $resultado = mysqli_query($conexion, $consulta);

        // Tablas de asginacion
        if(isset($_POST["word1"]))
        {
            $consulta = "INSERT INTO archivos_generar VALUES ('$id_archivo_excel', 1, 1)";
            $resultado = mysqli_query($conexion, $consulta);
        }
        if(isset($_POST["pdf1"]))
        {
            $consulta = "INSERT INTO archivos_generar VALUES ('$id_archivo_excel', 1, 2)";
            $resultado = mysqli_query($conexion, $consulta);
        }

        // Memorando
        if(isset($_POST["word2"]))
        {
            $consulta = "INSERT INTO archivos_generar VALUES ('$id_archivo_excel', 2, 1)";
            $resultado = mysqli_query($conexion, $consulta);
        }
        if(isset($_POST["pdf2"]))
        {
            $consulta = "INSERT INTO archivos_generar VALUES ('$id_archivo_excel', 2, 2)";
            $resultado = mysqli_query($conexion, $consulta);
        }

        header('Location: 6_generarDocumentosFase1.php'); die();
    }
    else
    {
        header('Location: ../index.php'); die();
    }

?>