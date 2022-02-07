
<?php
    session_start();

    if(!isset($_SESSION['id']) OR !isset($_SESSION['id_archivo_excel'])){
        header('Location: ../login.php'); die();
    }

    require_once('../conexion/conexion.php');
?>

<?php
    $ruta_excel = "../uploads/";
    $id_usuario = $_SESSION['id'];
    $id_archivo_excel = $_SESSION['id_archivo_excel'];

    $consulta = "SELECT nombre_archivo_excel FROM archivo_excel WHERE id_archivo_excel = '$id_archivo_excel' AND id_usuario = '$id_usuario'";
    $resultado = mysqli_query($conexion, $consulta);

    $filasAfectadas = mysqli_num_rows($resultado); //muy importante, para saber cuantas filas fueron afectadas al ejecutar la sentencia y asi saber si existe el usuario o no

    if($filasAfectadas == 1){
        $fila = mysqli_fetch_array($resultado);
        $ruta_excel .= $fila['nombre_archivo_excel'];
    }
    else{
        header('Location: ../login.php'); die();
    }
?>

<?php

    function separar_nombre_apellido($nombre_completo, &$nombre, &$apellidos)
    {
        $str_arr = explode (",", $nombre_completo);
        
        if(count($str_arr) == 2)
        {
            $apellidos = mb_strtoupper(trim($str_arr[0]),'utf-8');
            $nombre =  ucfirst(strtolower(trim($str_arr[1])) ); 
        }
        else
        {
            //header('Location: index.php');
        }
    }

    // INSETANDO LOS DATOS DE LOS Tutores (docentes)

    function search_tutor($nombre_completo, $grado_academico, $id_archivo_excel, $conexion)
    {
        $nombre = "";
        $apellidos = "";
        $fila = "";
        separar_nombre_apellido($nombre_completo, $nombre, $apellidos);

        $sentencia = "SELECT * FROM tutor WHERE nombre = '$nombre' AND apellidos = '$apellidos' AND grado_academico = '$grado_academico' AND id_archivo_excel = '$id_archivo_excel'";
        $resultado = mysqli_query($conexion, $sentencia);
        $filasAfectadas = mysqli_num_rows($resultado);

        if($filasAfectadas == 0)
        {
            $consulta = "INSERT INTO tutor VALUES ('null', '$nombre', '$apellidos', '$grado_academico', '$id_archivo_excel')";
            $resultado = mysqli_query($conexion, $consulta);
        }

        $sentencia = "SELECT id_tutor FROM tutor WHERE nombre = '$nombre' AND apellidos = '$apellidos' AND grado_academico = '$grado_academico' AND id_archivo_excel = '$id_archivo_excel'";
        $resultado = mysqli_query($conexion, $sentencia);
        $filasAfectadas = mysqli_num_rows($resultado);

        if($filasAfectadas == 1){
            $fila = mysqli_fetch_array($resultado);
        }

        return $fila['id_tutor'];
    }

    function getSituacionTutorado($nombre_situacion, $conexion)
    {
        $nombre_situacion = strtolower($nombre_situacion);
        $sentencia = "SELECT * FROM situacion_tutorado WHERE nombre_situacion = '$nombre_situacion'";
        $resultado = mysqli_query($conexion, $sentencia);
        $filasAfectadas = mysqli_num_rows($resultado);

        $id_situacion_tutorado = 5; // Unknow

        if($filasAfectadas == 1)
        {
            $fila = mysqli_fetch_array($resultado);
            $id_situacion_tutorado =  $fila['id_situacion_tutorado'];
        }

        return $id_situacion_tutorado;
    }

?>

<?php

    // (A) PHPSPREADSHEET TO LOAD EXCEL FILE
    require "../vendor/autoload.php";
    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    $spreadsheet = $reader->load($ruta_excel);
    $worksheet = $spreadsheet->getActiveSheet();

    foreach ($worksheet->getRowIterator(2) as $row) {
        $cellIterator = $row->getCellIterator("A", "D");
        $cellIterator->setIterateOnlyExistingCells(true);

        $nombres_completos_tutor = "";
        $grado_academico_tutor = "";
        $apellidos_nombres_tutorado = "";
        $id_situacion_tutorado = 0;

        echo "<tr>";
        $i = 0;
        foreach ($cellIterator as $cell) 
        {
            if($i == 0){
                $apellidos_nombres_tutorado = mb_strtoupper($cell->getValue(),'utf-8'); // a mayuscula
            }
            else if($i == 1){
                $nombre_situacion = strtolower($cell->getValue()); // a minuscula
                $id_situacion_tutorado = getSituacionTutorado($nombre_situacion, $conexion);

                if($id_situacion_tutorado == 5)
                {
                    // error, se ingreso mal la situacion del tutorado
                    //header('Location: ../login.php'); die();
                }
            }
            else if($i == 2){
                $grado_academico_tutor = ucfirst((strtolower($cell->getValue()))); 
            }
            else if($i == 3){
                $nombres_completos_tutor = strtolower($cell->getValue());
            }

            //echo "<td>". $cell->getValue() ."</td>";
            $i++;
        }

        $id_tutor = search_tutor($nombres_completos_tutor, $grado_academico_tutor, $id_archivo_excel, $conexion);

        // Verificar si ya existe este tutorado entonces ya no se lo agregara nuevamente
        $sentencia = "SELECT * FROM tutorado WHERE apellidos_nombres = '$apellidos_nombres_tutorado' AND id_situacion_tutorado = '$id_situacion_tutorado' AND id_tutor = '$id_tutor' AND id_archivo_excel = '$id_archivo_excel'";
        $resultado = mysqli_query($conexion, $sentencia);
        $filasAfectadas = mysqli_num_rows($resultado);

        if($filasAfectadas == 0)
        {
            $consulta = "INSERT INTO tutorado VALUES ('null', '$apellidos_nombres_tutorado', '$id_situacion_tutorado', '$id_tutor', '$id_archivo_excel')";
            $resultado = mysqli_query($conexion, $consulta);
        }
        
        echo "</tr>";
    }

    header('Location: ../mostrarDatosAsignacion.php'); die();

?>