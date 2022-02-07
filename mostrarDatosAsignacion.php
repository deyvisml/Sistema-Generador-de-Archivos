<?php
    session_start();

    if(!isset($_SESSION['id']) AND !isset($_SESSION['id_archivo_excel'])){
        header('Location: login.php');
    }

    require_once('conexion/conexion.php');
    $id_archivo_excel = $_SESSION['id_archivo_excel'];
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="styles/estilos2.css">
    <title>Visualizar tablas de asignacion</title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />

	<style>
		.niveles{
			background: ;
			display: flex;
			justify-content: center;
			align-items: center;
			height: 10vh;
			margin: 0;
			padding: 0;
		}
		.rectangule{
			position: absolute;
			width: 408px;
			height: 0px;
			left: 334px;
			top: 115px;
			border: 2px solid #c4c4c4;
			background-color: #c4c4c4;
			margin: 10px;
		}
		.rectangule2{
			position: absolute;
			width: 407px;
			height: 0px;
			left: 760px;
			top: 115px;
			border: 2px solid #c4c4c4;
			background-color: #c4c4c4;
			margin: 10px;
		}
		.status{
			display: inline-block;
			justify-content: center;
			width: 30px;
			height: 30px;
			/*background: #016E9F; */
			border-radius: 50%;
			-webkit-border-radius: 50%;
			-moz-border-radius: 50%;
			-ms-border-radius: 50%;
			-o-border-radius: 50%;
			margin: 200px;

		}
		.status::before{
			content: '';
			position: absolute;
			left: -5px;
			top: -5px;
			width: 35px;
			height: 35px;
			border-radius: 50px;
			-webkit-border-radius: 50px;
			-moz-border-radius: 50px;
			-ms-border-radius: 50px;
			-o-border-radius: 50px;
		}

		.status.online{
			background: #016E9F;
		}
		.status.wait{
			background: #016E9F;
		}
		.status.offline{
			background: #C4C4C4;
		}

		.numero{
			color: white;
			text-align: center;
		}

	</style>
	
  </head>
  <body>
	
	<!--Header-->
	<?php
		include "header.php";
	?>
	<!--End Header-->
	
	<!-- nivel de progreso 1 2 3-->
    <div class="niveles">
        <span class="rectangule"></span>
        <span class="rectangule2"></span>
        <span class="status online"><p class="numero">01</p></span>
        <span class="status offline"><p class="numero">02</p></span>
        <span class="status offline"><p class="numero">03</p></span>
    </div>
	
	<div class="col-md-6 offset-md-3 text-center  text-muted" style="padding-bottom:1%; padding-top:3%">
		<p class="fw-light fs-3">Visualización de las tablas de asignación de Tutores,tutorados y el tipo de formato a generar</p>
	</div> 
	
	<div class="container">
	  <div class="row">
		<div class="col-12 text-white" style="background-color:#2596be; padding:15px">TABLAS DE ASIGNACIÓN, TIPOS DE FORMATOS Y DOCUMENTOS A GENERAR</div>
		
		<div class="col-9 bg-white" style="padding-top:10px; padding:30px">
		
		<div class="table-wrapper-scroll-y my-custom-scrollbar bg-white">

            <?php
                $sentencia = "SELECT * FROM tutor WHERE id_archivo_excel = $id_archivo_excel ORDER BY apellidos ASC";
                $resultados_tutores = mysqli_query($conexion, $sentencia);

                $numeracion_tutores = 1;
                while($fila_tutor = mysqli_fetch_array($resultados_tutores)){
                    echo '<table class="table table-bordered mb-0">
                    <thead>
                        <tr style="background:#e8e4e4">
                        <th scope="col">Tutor</th><th scope="col">Apellidos y nombres(tutor)</th><th scope="col">Grado A.</th>
                        </tr>
                    </thead>';

                    // Datos tutor
                    echo '<tbody>
                            <tr>
                            <th scope="row">'.$numeracion_tutores.'</th><td>'.$fila_tutor['apellidos'].", ".$fila_tutor['nombre'].'</td><td>'.$fila_tutor['grado_academico'].'</td>
                            </tr>
                        </tbody>';

                    $id_tutor = $fila_tutor['id_tutor'];

                    $sentencia = "SELECT * FROM tutorado WHERE id_tutor = $id_tutor ORDER BY apellidos_nombres ASC";
                    $resultados_tutorados = mysqli_query($conexion, $sentencia);
                    
                    echo '<thead>
                            <tr style="background:#e8e4e4">
                            <th scope="col">Tutorado</th><th scope="col">Apellidos y nombres(tutorado)</th><th scope="col">Situación</th>
                            </tr>
                        </thead>';
                    
                    $numeracion_tutorados = 1;
                    while($fila_tutorado = mysqli_fetch_array($resultados_tutorados)){
                        $id_situacion = $fila_tutorado['id_situacion_tutorado'];
                        $sentencia = "SELECT * FROM situacion_tutorado WHERE id_situacion_tutorado = '$id_situacion'";
                        $resultado = mysqli_query($conexion, $sentencia);
                        $fila_situacion_tutorado = mysqli_fetch_array($resultado);
                        $nombre_situacion = $fila_situacion_tutorado['nombre_situacion'];

                        echo '<tbody>
                                <tr>
                                <th scope="row">'.$numeracion_tutorados.'</th><td>'.$fila_tutorado['apellidos_nombres'].'</td><td>'.strtoupper($nombre_situacion).'</td>
                                </tr>
                            </tbody>';

                        $numeracion_tutorados++;
                    }
                    echo "</table>";
                    echo "<br><br>";

                    $numeracion_tutores++;
                }
            ?>

		</div>
		
		<div data-bs-spy="scroll" data-bs-target="#navbar-example2" data-bs-offset="3" class="scrollspy-example" tabindex="0">
			
		</div>
		
		</div>

        <form action="procesosPHP/5_procesarSeleccionArchivosGenerar.php" method="POST" name="formulario" class="col-3" style="padding-top:5%; background-color:#f1f6f9">
            <p class="h4" style="padding-bottom:5%">Seleccione el documento y/o tipos de formatos que desea generar</p>
            
            <p class="h6" style="padding-bottom:5%"><u>Archivo de tablas de Asignación</u></p>
			<div class="form-check s-4">
                <input class="form-check-input" type="checkbox" onclick="javacript:EnableDisableButton(this, 1);" id="3" name="word1" value="word1">
                <label class="form-check-label" for="word1">Word</label>
			</div>
			<div class="form-check">
                <input class="form-check-input" type="checkbox" onclick="javacript:EnableDisableButton(this, 2);" id="4" name="pdf1" value="pdf1">
                <label class="form-check-label" for="pdf1">PDF</label>
			</div>

            
            <p class="h6" style="padding-bottom:5%; padding-top:5%"><u>Memorando</u></p>
			<div class="form-check s-4">
                <input class="form-check-input" type="checkbox" onclick="javacript:EnableDisableButton(this, 3);" id="1" name="word2" value="word2">
                <label class="form-check-label" for="word2">Word</label>
			</div>
			<div class="form-check">
            <input class="form-check-input" type="checkbox" onclick="javacript:EnableDisableButton(this, 4);" id="2" name="pdf2" value="pdf2">
            <label class="form-check-label" for="pdf2"> PDF</label>
			</div>
            
            <div style="padding-top:20px; padding-left:25%;">
            <input type="submit" value="Continuar" name = "enviar" id="btn_enviar" style="background-color: #046c9c; color:white; padding:10px; border-radius: 10px; padding-left:30px; padding-right:30px;"/>
			</div>

        </form>
		


	  </div>
	</div>
	
	<div>
	<br><br><br>
	</div>
	
	
	
	











<!--Footer-->
<?php
		include "footer.php";
	?>
	<!--End Footer-->

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>