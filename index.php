<?php

session_start();

if(!isset($_SESSION['id'])){
  header('Location: login.php');
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="estilos2.css">
    <title>Index</title>
	
  </head>
  <body>
	
	<!--Header-->
	<?php
		include "header.php";
	?>
	<!--End Header-->
	
	
	<div class="col-md-6 offset-md-3 text-center " style="padding-top:50px; padding-bottom:50px">
		<h2>Generador de memorando y archivo de tablas de asignación</h2>
	</div>
	<div class="col-md-6 offset-md-3 text-center  text-muted" style="; padding-bottom:10px">
		<p class="fw-light fs-3">Genera los memorandos y el archivo de tablas de Asigmacion de Tutores con sus respectivos Tutorados y descarga en formatos de WORD y/o PDF</p>
	</div> 
	







	<div class="row justify-content-center" STYLE= "padding-left:25%; padding-right:25%; padding-top:20px; padding-bottom:5%">
		<div class="input-group col-4 text-center" style="border:1px dashed; padding:2%; background-color:#F1F6F9">
			<div class="text-center" style="padding-bottom:2%; padding-left:18%">
				Asegúrese de que su archivo esté en el formato establecido en la plantilla
				<a href="#">(Ver plantilla)</a>
			</div>
			<div class="w-100 d-none d-md-block"></div>

      <form action="procesosPHP/2_procesarSubirExcelServidor.php" method="post" enctype="multipart/form-data" class="mb-3 col align-self-center" style="padding-left:25%; padding-right:25%">
          <input class="form-control" type="file" name="the_file" id="fileToUpload" accept=".xlsx, .xls, .csv" required>
          <br><br>
          <input class="button 2" type="submit" name="submit" value="Continuar" style="background-color:#046c9c; color:white; padding:10px; border-radius: 10px; padding-left:30px; padding-right:30px;">
      </form>
			
			<div class="w-100 d-none d-md-block"></div>
		</div>
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