<?php

    require_once('2_generar_un_memorando_pdf.php');

    require_once('functions/4_funcionGenerarNombreUnico.php'); // tiene esta dirrecion por que este archivo sera incluido al final por otro

    function generarMemorandosPDF($conexion, $id_archivo_excel, $id_usuario)
    {
        // Antes de insertar necesitamos eliminar si este archivo excel ya genero memorandos antes 
        $sentencia_memorandos = "SELECT * FROM memorando WHERE id_archivo_excel = '$id_archivo_excel'";
        $resultado_memorandos = mysqli_query($conexion, $sentencia_memorandos);

        $base_directory = "../generated/memorandos/pdf/"; // Es igula a la variable ruta almacenar de mas abajo
        while($fila_memorando = mysqli_fetch_array($resultado_memorandos)){
            if(unlink($base_directory.$fila_memorando['nombre_archivo']))
            {
                // echo "File Deleted.";
            }
        }

        // Antes de insertar necesitamos eliminar el registro de la bas ede datos de los memorandos de algun archivo excel que ya genero memorandos antes 
        $sentencia_delete = "DELETE FROM memorando WHERE id_archivo_excel = '$id_archivo_excel'";
        $resultado_delete = mysqli_query($conexion, $sentencia_delete);

        
        $facultad = "";
        $escuela = "";
        $programa_estudios = "";
        $acronimo_escuela = ""; 
        $acronimo_facultad = "";
        $numeracion_memorando = "";
        $nombre_memorando = "";
        $tutor = "";
        $cargo_tutor = "";
        $id_tutor = "";
        $asunto = "";
        $fecha = "";
        $responsable = ""; 
        $cargo_responsable = ""; 
        

        // Estableciendo las variables requeridas para la generacion de memorandos

        $sentencia1 = "SELECT escuela.nombre AS 'nombre_escuela', escuela.acronimo AS 'acronimo_escuela', facultad.nombre AS 'nombre_facultad', facultad.acronimo AS 'acronimo_facultad'
        FROM usuario
        LEFT JOIN escuela
        ON (usuario.id_escuela = escuela.id_escuela)
        LEFT JOIN facultad
        ON (escuela.id_facultad = facultad.id_facultad)
        WHERE id_usuario = '$id_usuario'";
        $resultado_escuela_facu = mysqli_query($conexion, $sentencia1);
        $fila_escuela_facu = mysqli_fetch_array($resultado_escuela_facu);

        $facultad = $fila_escuela_facu['nombre_facultad'];
        $escuela = $fila_escuela_facu['nombre_escuela'];
        $programa_estudios = "PROGRAMA DE ESTUDIOS DE ".$escuela;
        $acronimo_escuela = $fila_escuela_facu['acronimo_escuela'];
        $acronimo_facultad = $fila_escuela_facu['acronimo_facultad'];


        $sentencia2 = "SELECT num_inicio_memorando, responsable, cargo_responsable, fecha, anio, ciclo
        FROM campos_memorando
        LEFT JOIN periodo_academico
        ON (campos_memorando.id_periodo_academico = periodo_academico.id_periodo_academico)
        WHERE campos_memorando.id_archivo_excel = '$id_archivo_excel'";
        $resultado_campos_memo_periodo = mysqli_query($conexion, $sentencia2);
        $fila_campos_memo_periodo = mysqli_fetch_array($resultado_campos_memo_periodo);
        
        $numeracion_memorando = $fila_campos_memo_periodo['num_inicio_memorando'];
        $anio_ciclo = $fila_campos_memo_periodo['anio']."-".$fila_campos_memo_periodo['ciclo'];
        $asunto = "Asignación de estudiantes para tutoria universitaria - ".$anio_ciclo;
        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
        $fecha = strftime("%d de %B de %Y", strtotime($fila_campos_memo_periodo['fecha']));
        $fecha = "Puno, ".$fecha;
        $responsable = $fila_campos_memo_periodo['responsable'];
        $cargo_responsable = $fila_campos_memo_periodo['cargo_responsable'];

        // Seleccionando los tutores que le corresponden a este archivo Excel
        $sentencia3 = "SELECT * FROM tutor WHERE id_archivo_excel = '$id_archivo_excel' ORDER BY apellidos ASC";
        $resultados_tutores = mysqli_query($conexion, $sentencia3);

        while($fila_tutor = mysqli_fetch_array($resultados_tutores)){
            $nombre_memorando = "MEMORANDUM Nº ".$numeracion_memorando." ".$fila_campos_memo_periodo['anio']."-"."D"."-".$acronimo_escuela."-".$acronimo_facultad."-UNA-PUNO";
            
            // Datos tutor
            $tutor =  $fila_tutor['grado_academico']." ".strtoupper($fila_tutor['apellidos']).", ".$fila_tutor['nombre'];
            $cargo_tutor = "Docente - ".$acronimo_escuela;
            $id_tutor = $fila_tutor['id_tutor'];

            // Estableciendo la ruta en donde se almacenara y el nombre del archivo
            $apellido_nombre_tutor = $fila_tutor['apellidos']." ".$fila_tutor['nombre']." ".$numeracion_memorando;
            $nombre_archivo = generarNombreUnico($apellido_nombre_tutor);
            $ruta_almacenar = $base_directory;

            generarMemorandoPDF($id_archivo_excel, $conexion, $facultad, $programa_estudios, $nombre_memorando, $asunto, $anio_ciclo, $fecha, $responsable, $cargo_responsable, $tutor, $cargo_tutor, $id_tutor, $nombre_archivo, $ruta_almacenar);
        
            $numeracion_memorando++;
        }
    }
    
?>