<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header('Location: ../index.php');
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        // Check if file was uploaded without errors
        if(isset($_FILES["the_file"]) && $_FILES["the_file"]["error"] == 0){

            $uploadDirectory = "../uploads/";

            $errors = []; // Store errors here

            $fileExtensionsAllowed = ['xlsx','xls','csv']; // These will be the only file extensions allowed 

            $fileName = $_FILES['the_file']['name'];
            $fileSize = $_FILES['the_file']['size'];
            $fileTmpName  = $_FILES['the_file']['tmp_name'];
            $fileType = $_FILES['the_file']['type'];
            $tmp = explode('.', $fileName);
            $fileExtension = strtolower(end($tmp));

            if (! in_array($fileExtension, $fileExtensionsAllowed)) {
                $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
            }
            if ($fileSize > 4000000) {
                $errors[] = "File exceeds maximum size (4MB)";
            }
            if (empty($errors)) {
                $nuevo_nombre = generarNombreUnico($fileName);
                $uploadPath = $uploadDirectory . $nuevo_nombre;
                
                $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

                if($didUpload) {
                    echo "The file " . basename($fileName) . " has been uploaded";
                    require_once('../conexion/conexion.php');

                    date_default_timezone_set("America/Lima"); //para establecer la hora (importante para evitar fechas incorrectas)
                    $fecha_subida = date("Y-m-d H:i:s");
                    $id_usuario = $_SESSION['id'];
                    
                    // Insertando los datos del archivo  excel cargado a la base se dedatos
                    $consulta = "INSERT INTO archivo_excel VALUES ('null', '$nuevo_nombre', '$fecha_subida', '$id_usuario')";
                    $resultado = mysqli_query($conexion, $consulta);

                    if($resultado)
                    {
                        // Consultadno el id del archivo excel que se acaba de cargar
                        $consulta = "SELECT id_archivo_excel FROM archivo_excel WHERE nombre_archivo_excel = '$nuevo_nombre' AND fecha_subida = '$fecha_subida' AND id_usuario = '$id_usuario'";
                        $resultado = mysqli_query($conexion, $consulta);
                        
                        $fila = mysqli_fetch_array($resultado);
                        $_SESSION['id_archivo_excel'] = $fila['id_archivo_excel'];

                        header('Location: 3_procesarVerificarExcel.php'); die();
                    }
                    else
                    {
                        echo "Los datos del archivo no se subieron a la base de datos correctamente";
                    }
                    
                } else {
                    echo "An error occurred. Please contact the administrator.";
                }
            } 
            else {
                foreach ($errors as $error) {
                    echo $error . "These are the errors" . "\n";
                }
            }
        }
        else{
            echo "Error: " . $_FILES["photo"]["error"];
        }

    }

    function generarNombreUnico($nombre_archivo_excel){
        //CONSTRUIMOS UN CODIGO UNICO PARA RENOMBRAR
        $codigo_fecha = date("YmdHis");         
        $no_aleatorio = rand(100, 999); //GENERAMOS TRES DIGITOS PARA INCORPORARLO AL FINAL DEL CODIGO
        $codigo = $codigo_fecha.$no_aleatorio; //CODIGO DE 17 DIGITOS

        $tmp = explode('.',$nombre_archivo_excel);
        $extension = strtolower(end($tmp));
        $nuevo_nombre = "$codigo"."."."$extension";

        return $nuevo_nombre;
    }

?>




