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
    <title>Ingresar datos para la generacion de memorandos</title>


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
			width: 410px;
			height: 0px;
			left: 330px;
			top: 115px;
			border: 2px solid #016E9F;
			background-color: #016E9F;
			margin: 10px;
		}
		.rectangule2{
			position: absolute;
			width: 405px;
			height: 0px;
			left: 765px;
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
                                    <input type="text" name="cargo_responsable"  placeholder="Ingrese cargo del autor del documento" class="form-control" id="cargo-text" value="" required>
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

