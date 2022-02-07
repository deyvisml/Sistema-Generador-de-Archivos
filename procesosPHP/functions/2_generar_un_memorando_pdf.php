<?php

require_once('../fpdf/fpdf.php');

function BasicTable($conexion, $id_tutor, $witdh, $header, $pdf)
{
    $pdf->SetFillColor(215, 215, 215);
    $witdh_column1 = 17;
    $witdh_column2 = 115;
    $witdh_column3 = $witdh - ($witdh_column1 + $witdh_column2);

    // Cabecera
    $pdf->Cell($witdh_column1, 7, utf8_decode($header[0]), 1, 0, 'L', true);
    $pdf->Cell($witdh_column2, 7, utf8_decode($header[1]), 1, 0, 'L', true);
    $pdf->Cell($witdh_column3, 7, utf8_decode($header[2]), 1, 1, 'L', true);

    
    // Mostrando la informacion de los tutorados (alumnos)
    $sentencia1 = "SELECT apellidos_nombres, tutorado.id_situacion_tutorado as 'id_situacion_tutorado', nombre_situacion
    FROM tutorado
    LEFT JOIN situacion_tutorado
    ON (tutorado.id_situacion_tutorado = situacion_tutorado.id_situacion_tutorado)
    WHERE tutorado.id_tutor = '$id_tutor' ORDER BY tutorado.id_situacion_tutorado, tutorado.apellidos_nombres ASC";

    $resultados_tutorados_situacion = mysqli_query($conexion, $sentencia1);

    $numeracion = 1;
    while($fila_tutorado_situacion = mysqli_fetch_array($resultados_tutorados_situacion)){
        // Numeracion
        
        $apellidos_nombres_tutorado = $fila_tutorado_situacion['apellidos_nombres'];
        $nombre_situacion = ucfirst($fila_tutorado_situacion['nombre_situacion']);
        
        $pdf->Cell($witdh_column1, 7, $numeracion, 1, 0, 'R');
        $pdf->Cell($witdh_column2, 7, utf8_decode($apellidos_nombres_tutorado), 1, 0, 'L');
        $pdf->Cell($witdh_column3, 7, utf8_decode($nombre_situacion), 1, 0, 'L');

        $numeracion++;
        $pdf->Ln();
    }
}

function getIniciales($nombre){
    $name = '';
    $explode = explode(' ', $nombre);
    foreach($explode as $x){
        $name .=  $x[0];
    }
    return $name;    
}

function generarMemorandoPDF($id_archivo_excel, $conexion, $facultad, $programa_estudios, $nombre_memorando, $asunto, $anio_ciclo, $fecha, $responsable, $cargo_responsable, $tutor, $cargo_tutor, $id_tutor, $nombre_archivo, $ruta_almacenar)
{
    /*====================================== DEFINIENDO TODS LA INFORMACION A PLASMAR EN EL PDF ====================================== */

        $texto_principal_memorando = "";

        // Determinado el texto correspondiente segun la situacion de sus tutorados
        $sentencia1 = "SELECT * FROM tutorado WHERE id_tutor = '$id_tutor' ORDER BY id_situacion_tutorado, apellidos_nombres ASC";
        $resultados_tutorados = mysqli_query($conexion, $sentencia1);

        $id_texto_memorando = [];
        for($i = 0; $fila_tutorado_situacion = mysqli_fetch_array($resultados_tutorados); ){
            $id_situacion = $fila_tutorado_situacion['id_situacion_tutorado'];

            if($id_situacion != 5 AND !in_array($id_situacion, $id_texto_memorando))
            {
                $id_texto_memorando[$i] = $id_situacion;
                $i++; // para que no se incremente cuando sea su situacion Unknow
            }
        }
        $id_texto_memorando = implode("-", $id_texto_memorando);

        $sentencia2 = "SELECT * FROM texto_memorando WHERE id_texto_memorando = '$id_texto_memorando'";
        $resultado_texto_memorando = mysqli_query($conexion, $sentencia2);
        $filasAfectadas = mysqli_num_rows($resultado_texto_memorando);

        if($filasAfectadas == 1)
        {
            $fila_texto_memorando = mysqli_fetch_array($resultado_texto_memorando);
            $texto_principal_memorando = $fila_texto_memorando['texto'];

            // cambiar la parte de PERIODO ACADEMICO del texto capturado
            $texto_principal_memorando = str_replace("PERIODO_ACADEMICO", $anio_ciclo, $texto_principal_memorando);
        }
        else
        {
            //echo "no se encontro el texto f";
        }


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

        $pdf->SetFont('Arial', 'B', 14);
        $text1 = utf8_decode("UNIVERSIDAD NACIONAL DEL ALTIPLANO");
        $pdf->Cell(0, 5, $text1, $borde, 1, 'C');

        $pdf->SetFont('Times', '', 12);
        $text2 = utf8_decode($facultad);
        $pdf->Multicell(0, 7, $text2, $borde, 'C');

        $pdf->SetFont('Arial', 'B', 12);
        $text2 = utf8_decode($programa_estudios);
        $pdf->Multicell(0, 8, $text2, $borde, 'C');

        $pdf->Ln(1);

        $mid_x = $pdf->GetPageWidth()/2; 
        $pdf->Line($mid_x - 75, $pdf->GetY(), $mid_x + 75, $pdf->GetY());

        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'BU', 12);
        $text1 = utf8_decode($nombre_memorando);
        $pdf->Cell(0, 5, $text1, $borde, 1, 'L');

        $pdf->Ln(5);

        $borde = 0;

        // Parte 1

        $pdf->SetFont('Arial', 'B', 12);
        $text1 = utf8_decode("PARA        :");
        $pdf->Cell(26, 6, $text1, $borde, 0, 'J');
        $text1 = utf8_decode($tutor);
        $pdf->MultiCell(0, 6, $text1, $borde, 'L');
        $pdf->Cell(26);
        $text1 = utf8_decode($cargo_tutor);
        $pdf->Cell(0, 5, $text1, $borde, 1);

        $pdf->Ln(5);

        // Parte 2

        $pdf->SetFont('Arial', 'B', 12);
        $text1 = utf8_decode("ASUNTO   :");
        $pdf->Cell(26, 6, $text1, $borde, 0, 'J');
        $text1 = utf8_decode($asunto);
        $pdf->MultiCell(0, 6, $text1, $borde, 'L');

        $pdf->Ln(5);

        // Parte 3

        $pdf->SetFont('Arial', 'B', 12);
        $text1 = utf8_decode("FECHA      :");
        $pdf->Cell(26, 6, $text1, $borde, 0, 'J');
        $text1 = utf8_decode($fecha);
        $pdf->MultiCell(0, 6, $text1, $borde, 'L');

        // LInea
        $pdf->SetLineWidth(0.7);
        $mid_x = $pdf->GetPageWidth()/2; 
        $pdf->Line($pdf->GetX(), $pdf->GetY(), $pdf->GetPageWidth() - $margen_horizontal, $pdf->GetY());


        $pdf->Ln(5);

        $borde =0;
        /* Texto principal */
        $pdf->SetFont('Arial', '', 12);
        $text1 = utf8_decode($texto_principal_memorando);
        $pdf->MultiCell(0, 5, $text1, $borde, 'J');

        $pdf->Ln(5);

        /* Tabla de tutorados */
        $pdf->SetFont('Arial', '', 12);
        $text1 = utf8_decode("TUTORADOS");
        $pdf->Cell(0, 6, $text1, $borde, 1, 'C');

        // Títulos de las columnas
        $pdf->SetLineWidth(0.2);
        $header = array('NRO.', 'APELLIDOS Y NOMBRES', 'SITUACIÓN');

        BasicTable($conexion, $id_tutor, $witdh, $header, $pdf);

        $pdf->Ln(13);

        /* Para final Atentamente */
        $texto1 = utf8_decode("Atentamente, ");
        $pdf->Cell(0, 7, utf8_decode($texto1), $borde, 1, 'L');

        // Espacio para el area de firma
        $pdf->Ln(28);

        // Datos del responsable del documento

        $espacio = 45;
        $witdh_line_firma = $witdh - 2*$espacio;

        $pdf->Cell($espacio);
        $pdf->SetFont('Arial', 'B', 14);
        $text1 = utf8_decode($responsable);
        $pdf->Cell($witdh_line_firma, 8, $text1, 'T', 1, 'C');

        $pdf->Cell($espacio);
        $pdf->SetFont('Arial', '', 12);
        $text1 = utf8_decode($cargo_responsable);
        $pdf->Cell($witdh_line_firma, 5, $text1, 0, 1, 'C');


        // Datos del coautor
        $just_nombre = substr($responsable, 4);

        $just_iniciales =  getIniciales($just_nombre);

        $height = $pdf->GetPageHeight() - 2*$margen_vertical;
        $pdf->SetY($height - 1);

        $pdf->SetTextColor(80, 80, 80);
        $pdf->SetFont('Arial', '', 11);
        $texto1 = utf8_decode("C.c. Archivo ");
        $pdf->Cell(0, 5, utf8_decode($texto1), $borde, 1, 'L');
        $texto1 = utf8_decode($just_iniciales.".");
        $pdf->Cell(0, 5, utf8_decode($texto1), $borde, 1, 'L');

        $pdf->Output('F', $ruta_almacenar.$nombre_archivo);
        //$pdf->Output();

    /*============================================================================================================================== */

    /*======================================= REGISTRAR EN LA BASE DE DATOS EL PDF GENERADO ======================================= */
        //echo "<br>".$id_texto_memorando."<br>";

        $sentencia_f = "INSERT INTO memorando VALUES ('null', '$nombre_archivo', '$id_texto_memorando', '$id_tutor', '$id_archivo_excel')";
        $resultado_f = mysqli_query($conexion, $sentencia_f);
    /*============================================================================================================================== */
}



?>