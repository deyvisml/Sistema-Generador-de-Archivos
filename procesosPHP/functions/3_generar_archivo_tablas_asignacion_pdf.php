<?php

require_once('../fpdf/fpdf.php');

require_once('functions/4_funcionGenerarNombreUnico.php');

function tutorYTablasTutorados($conexion, $fila_tutor, $witdh, $pdf)
{
    $borde = 0; // auxiliar solo para mostrar algunos bordes
    $header = array('NRO.', 'APELLIDOS Y NOMBRES', 'SITUACIÓN');

    // Datos tutor
    $tutor =  $fila_tutor['grado_academico']." ".strtoupper($fila_tutor['apellidos']).", ".$fila_tutor['nombre'];
    $id_tutor = $fila_tutor['id_tutor'];

    $pdf->SetFillColor(215, 215, 215);
    $witdh_column1 = 17;
    $witdh_column2 = 115;
    $witdh_column3 = $witdh - ($witdh_column1 + $witdh_column2);

    // Nombre tutor
    $pdf->SetFont('Arial', '', 12);
    $texto_tutor = utf8_decode("TUTOR: ".$tutor);
    $pdf->Multicell(0, 7, $texto_tutor, $borde, 'C');

    $text_tutorados = utf8_decode("TUTORADOS");
    $pdf->Cell(0, 6, $text_tutorados, $borde, 1, 'C');

    // Cabecera
    $pdf->Cell($witdh_column1, 7, utf8_decode($header[0]), 1, 0, 'L', true);
    $pdf->Cell($witdh_column2, 7, utf8_decode($header[1]), 1, 0, 'L', true);
    $pdf->Cell($witdh_column3, 7, utf8_decode($header[2]), 1, 1, 'L', true);

    
    // Mostrando la informacion de los tutorados (alumnos)
    $sentencia = "SELECT apellidos_nombres, tutorado.id_situacion_tutorado as 'id_situacion_tutorado', nombre_situacion
    FROM tutorado
    LEFT JOIN situacion_tutorado
    ON (tutorado.id_situacion_tutorado = situacion_tutorado.id_situacion_tutorado)
    WHERE tutorado.id_tutor = '$id_tutor' ORDER BY tutorado.id_situacion_tutorado, tutorado.apellidos_nombres ASC";

    $resultados_tutorados_situacion = mysqli_query($conexion, $sentencia);

    $numeracion = 1;
    while($fila_tutorado_situacion = mysqli_fetch_array($resultados_tutorados_situacion)){

        $apellidos_nombres_tutorado = $fila_tutorado_situacion['apellidos_nombres'];
        $nombre_situacion = ucfirst($fila_tutorado_situacion['nombre_situacion']);
        
        $pdf->Cell($witdh_column1, 7, utf8_decode($numeracion), 1, 0, 'R');
        $pdf->Cell($witdh_column2, 7, utf8_decode($apellidos_nombres_tutorado), 1, 0, 'L');
        $pdf->Cell($witdh_column3, 7, utf8_decode($nombre_situacion), 1, 0, 'L');

        $numeracion++;
        $pdf->Ln();
    }
    
    $pdf->Ln(10);
}

function generarArchivoTablasAsingacionPDF($conexion, $id_archivo_excel, $id_usuario)
{
    // Eliminar el archvivo de tablas de asignacion para el archivo excel del servidor si lo tuviera
    $sentencia_archivo_tablas_asignacion = "SELECT * FROM archivo_tablas_asignacion WHERE id_archivo_excel = '$id_archivo_excel'";
    $resultado_archivo_tablas_asignacion = mysqli_query($conexion, $sentencia_archivo_tablas_asignacion);

    $base_directory = "../generated/archivo_tablas_asingacion/pdf/";
    while($fila_archivo_tablas_asignacion = mysqli_fetch_array($resultado_archivo_tablas_asignacion)){
        if(unlink($base_directory.$fila_archivo_tablas_asignacion['nombre_archivo']))
        {
            // echo "File Deleted.";
        }
    }
    
    // Eliminar el registro archivo de tablas de asignacion para este archivo excel de la base de datos si lo tuviera
    $sentencia_delete = "DELETE FROM archivo_tablas_asignacion WHERE id_archivo_excel = '$id_archivo_excel'";
    $resultado_delete = mysqli_query($conexion, $sentencia_delete);


    /*========================================== ESTABLECIENDO LA RUTA DONDE SE ALMACENARA ========================================== */
    $sentencia1 = "SELECT escuela.acronimo AS 'escuela_acronimo', facultad.acronimo AS 'facultad_acronimo'
    FROM usuario
    LEFT JOIN escuela
    ON (usuario.id_escuela = escuela.id_escuela)
    LEFT JOIN facultad
    ON (escuela.id_facultad = facultad.id_facultad)
    WHERE id_usuario = '$id_usuario'";
    $resultado_escuela_facu = mysqli_query($conexion, $sentencia1);
    $fila_escuela_facu = mysqli_fetch_array($resultado_escuela_facu);

    // Estableciendo la ruta en donde se almacenara y el nombre del archivo
    $nombre_inicial = "archivo tablas de asignacion"." ".$fila_escuela_facu['escuela_acronimo']." ".$fila_escuela_facu['facultad_acronimo'];
    $nombre_archivo_tablas_asignacion = generarNombreUnico($nombre_inicial);
    $ruta_almacenar = $base_directory;

    /*============================================================================================================================== */


    /*====================================================== GENERANDO EL PDF ====================================================== */

        $pdf = new FPDF();

        $borde = 0;

        // Estableciendo los margenes
        $margen_horizontal = 20;
        $margen_vertical = 15;
        $pdf->SetMargins($margen_horizontal, $margen_vertical, $margen_horizontal);
        $witdh = $pdf->GetPageWidth() - 2*$margen_horizontal;

        $pdf->AddPage();

        // Cabecera

        $pdf->SetFont('Arial', 'B', 13);
        $text1 = utf8_decode("TABLAS DE ASIGNACION"); // aumentar escuela y facultad
        $pdf->Cell(0, 5, $text1, $borde, 1, 'C');

        $pdf->Ln(8);

    /*============================================================================================================================== */


    /*====================================== GENERANDO LAS TABLAS PARA CADA TUTOR PERO EN UN SOLO DOCUEMENTO ====================================== */

        $sentencia = "SELECT * FROM tutor WHERE id_archivo_excel = '$id_archivo_excel' ORDER BY apellidos ASC";
        $resultados_tutores = mysqli_query($conexion, $sentencia);

        while($fila_tutor = mysqli_fetch_array($resultados_tutores)){
            // Tabla simple
            tutorYTablasTutorados($conexion, $fila_tutor, $witdh, $pdf);
        }


        $pdf->Output('F', $ruta_almacenar.$nombre_archivo_tablas_asignacion);
        //$pdf->Output();

    /*============================================================================================================================== */


    /*======================================= REGISTRAR EN LA BASE DE DATOS EL PDF GENERADO ======================================= */
        date_default_timezone_set("America/Lima"); //para establecer la hora (importante para evitar fechas incorrectas)
        $fecha_subida = date("Y-m-d H:i:s");

        $sentencia_f = "INSERT INTO archivo_tablas_asignacion VALUES ('null', '$nombre_archivo_tablas_asignacion', '$fecha_subida', '$id_archivo_excel')";
        $resultado_f = mysqli_query($conexion, $sentencia_f);


        
    /*============================================================================================================================== */
}

?>