<?php
    session_start();

    if(!isset($_SESSION['id']) OR !isset($_SESSION['id_archivo_excel'])){
        header('Location: ../login.php');
    }

    $id_archivo_excel = $_SESSION['id_archivo_excel'];
    $id_usuario = $_SESSION['id'];

    require_once('../conexion/conexion.php');
?>

<?php

$generar_almenos_un_archivo = false;

// Verificar y generar archivos de tablas de asignacion
$sentencia = "SELECT id_archivo_extension FROM archivos_generar WHERE id_archivo_excel = '$id_archivo_excel' AND id_tipo_archivo = 1";
$resultado = mysqli_query($conexion, $sentencia);
$filasAfectadas = mysqli_num_rows($resultado);

if($filasAfectadas >= 1) // si se selecciono alguna opcion de tablas de asignacion
{
    $generar_almenos_un_archivo = true;

    // // Eliminando algunos registros de la base de datos
    // $sentencia_archivo_tablas_asignacion = "SELECT * FROM archivo_tablas_asignacion WHERE id_archivo_excel = '$id_archivo_excel'";
    // $resultado_archivo_tablas_asignacion = mysqli_query($conexion, $sentencia_archivo_tablas_asignacion);
    // $filas_afectadas1 = mysqli_num_rows($resultado_archivo_tablas_asignacion);
    // if($filas_afectadas1 >= 1)
    // {
    //     $fila_archivo_tablas_asignacion = mysqli_fetch_array($resultado_archivo_tablas_asignacion);
    //     $id_archivo_tablas_asignacion = $fila_archivo_tablas_asignacion['id_archivo_tablas_asignacion'];

    //     $sentencia_delete = "DELETE FROM archivo_tablas_asig_extension WHERE id_archivo_tablas_asignacion = '$id_archivo_tablas_asignacion'";
    //     $resultado_delete = mysqli_query($conexion, $sentencia_delete);

    //     $sentencia_delete = "DELETE FROM archivo_tablas_asignacion WHERE id_archivo_excel = '$id_archivo_excel'";
    //     $resultado_delete = mysqli_query($conexion, $sentencia_delete);

    //     // aqui falta eliminar los ficheros del servidor, no exactamente en esta parte talvez en algunos pasos mas atras
    // }

    // // Insertando en la base de datos
    // date_default_timezone_set("America/Lima"); //para establecer la hora (importante para evitar fechas incorrectas)
    // $fecha_subida = date("Y-m-d H:i:s");

    // // nota aqui falta definir el nombre del archivo de tablas de asignacion
    // $sentencia_f = "INSERT INTO archivo_tablas_asignacion VALUES ('null', '$nombre_archivo_tablas_asignacion', '$fecha_subida', '$id_archivo_excel')";
    // $resultado_f = mysqli_query($conexion, $sentencia_f);



    // te quedaste editando desde la linea 27 hasta esta linea ya que estan almacenando la informaicon erronea en algunas tablas de la base de datos
    // las principales son memorandos y archivo_tablas_...., estas solo deben almacenar el nombre del archivo y en las otras tablas que llevan extension
    // ah si se deben almacenar sus nombres con el formato, tanto pdf o doc (lo comentaremos por que no hay timepo xd)



    while($fila = mysqli_fetch_array($resultado))
    {
        if(in_array(1, $fila))
        {
            // Genear las tablas de asignacion en word
            echo "anexo en word <br>";
        }
        if(in_array(2, $fila))
        {
            // Genear las tabla sde asignacion en pdf
            require_once('functions/3_generar_archivo_tablas_asignacion_pdf.php');
            generarArchivoTablasAsingacionPDF($conexion, $id_archivo_excel, $id_usuario);
            echo "anexo en pdf <br>";
        }
    }
}

// Verificar y generar Memorandos
$sentencia = "SELECT id_archivo_extension FROM archivos_generar WHERE id_archivo_excel = '$id_archivo_excel' AND id_tipo_archivo = 2";
$resultado = mysqli_query($conexion, $sentencia);
$filasAfectadas = mysqli_num_rows($resultado);

if($filasAfectadas >= 1) // si se selecciono alguna opcion de memorandos
{
    $generar_almenos_un_archivo = true;

    while($fila = mysqli_fetch_array($resultado))
    {
        if(in_array(1, $fila))
        {
            // Genear los memorandos en word
            echo "memos en word <br>";
        }
        if(in_array(2, $fila))
        {
            // Generar los memorandos en pdf
            require_once('functions/1_generar_memorandos_pdf.php');
            generarMemorandosPDF($conexion, $id_archivo_excel, $id_usuario);
            echo "memos en pdf <br>";
        }
    }
}


if($generar_almenos_un_archivo)
{
    // Ir a mostrar los documentos generados
    header('Location: ../mostrarArchivosGenerados.php');
}
else
{
    header('Location: ../login.php');
}

?>