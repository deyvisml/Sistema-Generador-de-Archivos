<?php
    session_start();

    if(!isset($_SESSION['id']) OR !isset($_SESSION['id_archivo_excel'])){
        header('Location: login.php');
    }

    $id_archivo_excel = $_SESSION['id_archivo_excel'];

    require_once('conexion/conexion.php');
?>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/estilos.css">
    <title>Hello, world!</title>


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
			width: 400px;
			height: 0px;
			left: 527px;
			top: 120px;
			border: 3px solid #016E9F;
			margin: 10px;
		}
		.rectangule2{
			position: absolute;
			width: 400px;
			height: 0px;
			left: 957px;
			top: 120px;
			border: 3px solid #C4C4C4;
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


		.boton{
			text-align: center;
		
		}

		.button {
			background:white;
			background-color:#016E9F;
   			border-color: #016E9F;
			border-width: 1px;
			display:inline-block;
			font-size:1;
			margin:20px;
			padding:10px;
			border-radius:10px;
			width:170px;
			text-decoration:none;
			-webkit-border-radius:10px;
			-moz-border-radius:10px;
			-ms-border-radius:10px;
			-o-border-radius:10px;
		}
		.btn {
			background:white;
			border-color: #016E9F;
			border-width: 1px;
			display:inline-block;
			font-size:1;
			margin:20px;
			padding:10px;
			border-radius:10px;
			width:170px;
			text-decoration:none;
			-webkit-border-radius:10px;
			-moz-border-radius:10px;
			-ms-border-radius:10px;
			-o-border-radius:10px;
		}

		
	</style>

  </head>
  <body>
	
	<!-- HEADER -->
	<nav class="navbar navbar-expand-lg navbar-dark text-white" style="background-color:#2C2E49">
	  <div class="container-fluid">
		<div class="col-2">
			<a class="navbar-brand" href="#" >
			  <img src="https://aulavirtual2.unap.edu.pe/images/logos/unap/logo.png" alt="" width="240"  class="d-inline-block align-text-top" style="padding-left: 1em">
			</a>
		</div>
	  
		<div class="collapse navbar-collapse d-flex col-8" id="navbarNav">
		  <ul class="navbar-nav">
			<li class="nav-item col-3">
			  <a class="nav-link active" aria-current="page" href="index.html">Inicio</a>
			</li>
			<li class="nav-item col-7">
			<a class="nav-link" href="index.php">Generar documentos</a>
			</li>
			<li class="nav-item col-6">
			  <a class="nav-link" href="#">Descargar Plantilla</a>
			</li>
			
			
			
		  </ul>
		</div>
		
		<div class="collapse navbar-collapse d-flex">
			<ul class="navbar-nav">
				<li class="nav-item d-flex justify-content-end">
					<a class="navbar-brand" href="#" >
					  <img src="https://cdn-icons-png.flaticon.com/512/1177/1177568.png" alt="" width="45" height="45" class="d-inline-block align-text-top">
					</a>
				</li>
				
				<li class="nav-item dropdown d-flex justify-content-end">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Nombre usuario
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
					<li><a class="dropdown-item" href="#">Ver perfil</a></li>
					<li><a class="dropdown-item"  href="procesosPHP/procesarCerrarSesion.php">Salir</a></li>
				  </ul>
				</li>
			</ul>
		</div>
		
	  </div>
	</nav>
	
    <!-- nivel de progreso 1 2 3-->
    <div class="niveles">
        <span class="rectangule"></span>
        <span class="rectangule2"></span>
        <span class="status online"><p class="numero">01</p></span>
        <span class="status wait"><p class="numero">02</p></span>
        <span class="status offline"><p class="numero">03</p></span>
    </div>

    
    <div class="col-md-5 offset-md-3 text-center text-black" 	>
		<p class="fs-5">Rellenar todos  campos para la generacion de su memorando</p>
	</div> 
    
    <main class="container-fluid mt-1">
        <div class="row">
            <div class="col-lg-5 col-md-6 mx-auto" style="width: 740px; height:400px;">

                <div class="card" style="background-color: #F1F6F9;"> 
                    <div class="p-1  bg-gradient fw-bold text-white" style="background-color: rgba(1, 110, 159, .6);">
                        <p class="col-md-5 fs-5 text-center">DATOS  DEL  MEMORANDUM</p>
                    </div>
					



                    <form class="row  card-body validar-form" action="procesosPHP/7_procesarDatosGeneracionMemorandos.php" method="POST" name="formulario">
						<div class="g-1" style="background-color:#F1F6F9;"></div>
                                <div class="col-12"> 
                                    <label for="nombre-txt" class="form-label"><p class="fw-bold m-0"><span class="text-danger"> * </span>Nombres y Apellidos del autor del documento</p></label>
                                    <input type="text" name="responsable"  placeholder="Ingrese Nombres y Apellidos" class="form-control" id="nombre-txt" value="" required>
									<!-- Mensajes para validación   -->
									<div class="valid-feedback">¡Campo válido!</div>
									<div class="invalid-feedback">Debe completar los datos.</div>
                                </div>

                                <div class="col-12"> 
                                    <label for="cargo-text" class="form-label"><p class="fw-bold m-0"><span class="text-danger"> * </span>Cargo del autor del documento</p></label>
                                    <input type="text" name="cargo_responsable"  placeholder="Ingrese cargo del tutor del documento" class="form-control" id="cargo-text" value="" required>
									<!-- Mensajes para validación   -->
									<div class="valid-feedback">¡Campo válido!</div>
									<div class="invalid-feedback">Debe completar los datos.</div>
                                </div>
                            
                                <div class="col-6 mb-1">
                                    <label for="periodo" class="form-label"><p class="fw-bold m-0"><span class="text-danger"> * </span>Periodo académico</p></label>
                                    
                                    <select class="form-select" id="periodo" name="select_periodo_academico" required>
										<option selected disabled value="">Seleccione...</option>
                                        <?php
                                            $sentencia = "SELECT * FROM periodo_academico";
                                            $resultado = mysqli_query($conexion, $sentencia);

                                            while($fila = mysqli_fetch_array($resultado)){
                                                echo '<option value="'.$fila['id_periodo_academico'].'">'.$fila['anio']."-".$fila['ciclo'].'</option>';
                                            }
                                        ?>
                                    </select>
									<!-- Mensajes para validación   -->
									<div class="valid-feedback">¡Campo válido!</div>
									<div class="invalid-feedback">Debe completar los datos.</div>
                                </div>

                                <div class="col-6">
                                    <label for="fecha" class="form-label"><p class="fw-bold m-0"><span class="text-danger"> * </span>Fecha del documento generado</p></label>
                                    <input type="date" name="fecha" class="form-control" id="fecha" value="" required>
									<!-- Mensajes para validación   -->
									<div class="valid-feedback">¡Campo válido!</div>
									<div class="invalid-feedback">Debe completar los datos.</div>
                                  </div>

                                <div class="col-6">
                                    <label for="numeroI" class="form-label"><p class="fw-bold m-0"><span class="text-danger"> * </span>Número de Inicio del memorando</p></label>
                                    <input type="number" name="num_inicio_memorando" placeholder="El número del memorando iniciará en:" class="form-control" id="numeroI" value="" required>
									<!-- Mensajes para validación   -->
									<div class="valid-feedback">¡Campo válido!</div>
									<div class="invalid-feedback">Debe completar los datos.</div>
                                </div>  
							
						</div>		

						<div class="row text-center" style="background-color: white;">
							<div class="col text-end">
							<a href="mostrarDatosAsignacion.php" class="btn 1" style="color:#016E9F">Cancelar</a>
							</div>
							<div class="col text-start">
							<input class="button 2" style="color: white;" type="submit" name="btn_enviar" value="Continuar" id="btn_enviar">
							</div>	
						</div> 

                    </form>



	
                </div>
				
            </div>  
        </div>
    </main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script>      
    (function () {
      'use strict'
      // estilos
      var forms = document.querySelectorAll('.validar-form')
      //validar envio
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {            
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }//else{
              //alert('FORM VALIDADO')
            //}
            form.classList.add('was-validated')
          }, false)
        })
    })()
    </script> 




	<div>
	<br><br><br>	<br><br><br>	<br><br><br>
	</div>
	
	
	<footer class="text-center text-lg-start text-white" style="background-color:#2C2E49">
	  <!-- Section: Social media -->

	  <!-- Section: Social media -->

	  <!-- Section: Links  -->
	  <section class="">
		<div class="container text-center text-md-start mt-5" style="padding-top:5px">
		  <!-- Grid row -->
		  <div class="row mt-3">
			<!-- Grid column -->
			<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
			  <!-- Content -->
			  <h6 class="text-uppercase fw-bold mb-4">
				Sobre nosotros
			  </h6>
			  <p>
				<a href="#" class="text-reset">About</a>
			  </p>
			  <p>
				<a href="#" class="text-reset">Contactanos</a>
			  </p>
			  <p>
				<a href="#" class="text-reset">Últimas búsquedas</a>
			  </p>
			  <p>
				<a href="#" class="text-reset">Lo mas buscado</a>
			  </p>
			</div>
			<!-- Grid column -->

			<!-- Grid column -->
			<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
			  <!-- Links -->
			  <h6 class="text-uppercase fw-bold mb-4">
				Información
			  </h6>
			  <p>
				<a href="#!" class="text-reset">Centro de ayuda</a>
			  </p>
			  <p>
				<a href="#!" class="text-reset">Aviso destacado</a>
			  </p>
			  <p>
				<a href="#!" class="text-reset">Políticas de privacidad</a>
			  </p>
			  <p>
				<a href="#!" class="text-reset">Términos y condiciones</a>
			  </p>
			</div>
			<!-- Grid column -->

			<!-- Grid column -->
			<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
			  <!-- Links -->
			  <h6 class="text-uppercase fw-bold mb-4">
				Redes sociales
			  </h6>
				<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/brands.js" integrity="sha384-sCI3dTBIJuqT6AwL++zH7qL8ZdKaHpxU43dDt9SyOzimtQ9eyRhkG3B7KMl6AO19" crossorigin="anonymous"></script>
				<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>
				<div>
				  <a href="" class="me-4 text-reset text-dark">
					<i class="fab fa-facebook-f"></i>
				  </a>
				  <a href="" class="me-4 text-reset">
					<i class="fab fa-twitter"></i>
				  </a>
				  <a href="" class="me-4 text-reset">
					<i class="fab fa-instagram"></i>
				  </a>
				  <a href="" class="me-4 text-reset">
					<i class="fab fa-linkedin"></i>
				  </a>
				  
				</div>
			</div>
			<!-- Grid column -->

			<!-- Grid column -->
			<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
			  <!-- Links -->
			  <h6 class="text-uppercase fw-bold mb-4">
				Descarga nuestros aplicativos
			  </h6>
			  <p>
				<a href="#" class="text-reset">IOS app</a>
			  </p>
			  <p>
				<a href="#" class="text-reset">Android app</a>
			  </p>
			</div>
			<!-- Grid column -->
		  </div>
		  <!-- Grid row -->
		</div>
	  </section>
	  <!-- Section: Links  -->

	  <!-- Copyright -->
	  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
		© 2021 Copyright:
		<a class="text-reset fw-bold" href="#">DreamSof4u</a>
	  </div>
	  <!-- Copyright -->
	</footer>

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

