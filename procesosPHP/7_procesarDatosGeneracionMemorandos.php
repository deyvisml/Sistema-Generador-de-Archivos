<?php
    session_start();

    if(!isset($_SESSION['id']) OR !isset($_SESSION['id_archivo_excel'])){
        header('Location: ../login.php');
    }

    $id_archivo_excel = $_SESSION['id_archivo_excel'];

    require_once('../conexion/conexion.php');
?>

<?php

if(isset($_POST['btn_enviar']))
{
    $consulta = "DELETE FROM campos_memorando WHERE id_archivo_excel = $id_archivo_excel";
    $resultado = mysqli_query($conexion, $consulta);

    // Recolectando la informacion
    $num_inicio_memorando = $_POST['num_inicio_memorando'];
    $responsable = $_POST['responsable'];
    $cargo_responsable = $_POST['cargo_responsable'];
    $fecha = $_POST['fecha'];
    $id_periodo_academico = $_POST['select_periodo_academico'];

    echo $num_inicio_memorando."<br>";
    echo $responsable."<br>";
    echo $cargo_responsable."<br>";
    echo $fecha."<br>";
    echo $id_periodo_academico."<br>";

    // Insertando los datos a la base de datos
    $consulta = "INSERT INTO campos_memorando VALUES (null, '$num_inicio_memorando', '$responsable', '$cargo_responsable', '$fecha', '$id_periodo_academico', '$id_archivo_excel')";
    $resultado = mysqli_query($conexion, $consulta);

    // Continuando el procedimeinto
    header('Location: 8_generarDocumentosFase2.php');
}
else
{
    header('Location: ../login.php');
}

?>