<?php
    ob_start();

    session_start();

    if(!isset($_SESSION['id']) OR !isset($_SESSION['id_archivo_excel']))
    {
        header('Location: ../login.php'); die();
    }

    require_once('../conexion/conexion.php');

    $id_usuario = $_SESSION['id'];
    $id_archivo_excel = $_SESSION['id_archivo_excel'];

    $ruta_excel = "../uploads/";

    $consulta = "SELECT nombre_archivo_excel FROM archivo_excel WHERE id_archivo_excel = '$id_archivo_excel' AND id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexion, $consulta);

    $filasAfectadas = mysqli_num_rows($resultado);

    if($filasAfectadas == 1){
        $fila = mysqli_fetch_array($resultado);
        $ruta_excel .= $fila['nombre_archivo_excel'];
    }
    else{
        header('Location: ../login.php'); die();
    }


    function verificar_excel_correcto($ruta_excel)
    {
        // (A) PHPSPREADSHEET TO LOAD EXCEL FILE
        require "../vendor/autoload.php";
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadsheet = $reader->load($ruta_excel);
        $worksheet = $spreadsheet->getActiveSheet();
        
        // Verificando el numero de columnas para cada fila
        echo '<table border=\"2\">';
        foreach ($worksheet->getRowIterator(2) as $row) {
            // (B1) READ CELLS
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(true);
            $i = 0;
            echo "<tr>";
            foreach ($cellIterator as $cell) 
            {
                $i++;
                echo "<td>". $cell->getValue() ."</td>";
            }
            echo "</tr>";
            if($i != 4)
            {
                return false;
            }
        }
        echo "</table>";
        
        return true;
    }

    if(verificar_excel_correcto($ruta_excel))
    {
        echo "<br>La estructura del archivo es correcta<br>";

        header('Location: 4_procesarSubirDatosBD.php'); die();
    }
    else{

        // Ya que el archivo no es correcto lo eliminaremos del servidor
        $sentencia_archivo_excel = "SELECT * FROM archivo_excel WHERE id_archivo_excel = '$id_archivo_excel'";
        $resultado_archivo_excel = mysqli_query($conexion, $sentencia_archivo_excel);

        $base_directory = "../uploads/";
        while($fila_archivo_excel = mysqli_fetch_array($resultado_archivo_excel)){
            if(unlink($base_directory.$fila_archivo_excel['nombre_archivo_excel']))
            {
                // echo "File Deleted.";
            }
        }

        // Ya que el archivo no es correcto eliminaremos su registro de la base de datos
        $sentencia_delete = "DELETE FROM archivo_excel WHERE id_archivo_excel = '$id_archivo_excel'";
        $resultado_delete = mysqli_query($conexion, $sentencia_delete);


        echo "<br>Por favor asegurese de que la estructura de la tabla este correcta<br>";
    }

    ob_end_flush();
?>