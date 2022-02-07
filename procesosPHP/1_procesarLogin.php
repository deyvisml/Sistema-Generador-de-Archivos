<?php
    session_start();
    require_once('../conexion/conexion.php');

    if(isset($_POST['btnLogin'])){
        $usuario = $_POST['user'];
        $contraseña = $_POST['pass'];

        $sentencia = "SELECT * FROM usuario WHERE usuario = '$usuario' AND contrasenia = '$contraseña'";
        $resultados = mysqli_query($conexion, $sentencia);

        $filasAfectadas = mysqli_num_rows($resultados); //muy importante, para saber cuantas filas fueron afectadas al ejecutar la sentencia y asi saber si existe el usuario o no

        if($filasAfectadas == 1){
            $fila = mysqli_fetch_array($resultados);
            $_SESSION['id'] = $fila['id_usuario'];
            header('Location: ../index.php');
        }
        else{
            header('Location: ../login.php');
        }
    }
    
?>