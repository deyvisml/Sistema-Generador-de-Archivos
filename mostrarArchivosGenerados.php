<?php
    session_start();

    if(!isset($_SESSION['id']) OR !isset($_SESSION['id_archivo_excel'])){
        header('Location: ../login.php');
    }

    $id_archivo_excel = $_SESSION['id_archivo_excel'];
    $id_usuario = $_SESSION['id'];

    require_once('conexion/conexion.php');
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Archivos generados</title>
  </head>
  <body>

    









<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/estilos-descarga.css">
    <title>Hello, world!</title>

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
			width: 407px;
			height: 0px;
			left: 760px;
			top: 115px;
			border: 2px solid #016E9F;
			background-color: #016E9F;
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




      .row{
          margin: 0px 20px 0px 20px;
      }

      .input-group {

          margin: 10px 0px 30px 0px;
          width: 400px;
          height: 25px;
          border-width: 1px;
      }


      .tabla-descarga {
        background-color: white;
        border-width: 2px;
        padding: 100px;
        margin: 10px;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -ms-border-radius: 10px;
        -o-border-radius: 10px;
      }


      .boton {
        text-align: center;
      }

      .button {
        background: #2c2e49;
        border-color: #016e9f;
        border-width: 1px;
        display: inline-block;
        font-size: 1;
        margin: 20px;
        padding: 10px;
        border-radius: 10px;
        width: 170px;
        text-decoration: none;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -ms-border-radius: 10px;
        -o-border-radius: 10px;
      }
      .btn {
        background: white;
        border-color: #016e9f;
        border-width: 1px;
        display: inline-block;
        font-size: 1;
        margin: 20px;
        padding: 10px;
        border-radius: 10px;
        width: 170px;
        text-decoration: none;
        -webkit-border-radius: 10px;
        -moz-border-radius: 10px;
        -ms-border-radius: 10px;
        -o-border-radius: 10px;
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
        <span class="status wait"><p class="numero">03</p></span>
    </div>




    <main class="container-fluid mt-2 pt-5" >
        <div class="row">
            <div class="col-lg-1 col-12 mx-auto" style="width: 890px; height:300px;">
                <div class="card" style="background-color: #F1F6F9;"> 
                    <div class="bg-gradient text-white" style="background-color: rgba(1, 110, 159, .6);">
                        <p class="col-12 fs-5 pt-2 ps-3 ">ARCHIVO DE TABLAS DE ASIGNACIÓN</p>
                    </div> 

					           <div class="row  card-body">


                          <?php
                            $sentencia1 = "SELECT escuela.acronimo AS 'acronimo_escuela', archivo_tablas_asignacion.nombre_archivo AS 'nombre_archivo'
                            FROM archivo_tablas_asignacion
                            LEFT JOIN archivo_excel
                            ON (archivo_tablas_asignacion.id_archivo_excel = archivo_excel.id_archivo_excel)
                            LEFT JOIN usuario
                            ON (archivo_excel.id_usuario = usuario.id_usuario)
                            LEFT JOIN escuela
                            ON (usuario.id_escuela = escuela.id_escuela)
                            WHERE archivo_excel.id_archivo_excel = '$id_archivo_excel'";


                            //$sentencia1 = "SELECT * FROM archivo_tablas_asignacion WHERE id_archivo_excel = '$id_archivo_excel'";
                            $resultados_archivo_tablas_asignacion = mysqli_query($conexion, $sentencia1);
                            $filas_afectadas1 = mysqli_num_rows($resultados_archivo_tablas_asignacion);

                            if($filas_afectadas1 == 1)
                            {
                              $fila_archivo_tablas_asignacion = mysqli_fetch_array($resultados_archivo_tablas_asignacion);

                              $dir = "generated/archivo_tablas_asingacion/pdf/";
                              $nombre_archivo = $fila_archivo_tablas_asignacion['nombre_archivo'];
                              $dir_visualizar = $dir.$nombre_archivo;

                              $just_name = "Archivo tablas de asignación - ".$fila_archivo_tablas_asignacion['acronimo_escuela'];

                              // Mostrando el elemento en HTML
                              echo '<table class="table table-borderless">
                                    <thead >
                                      <tr>
                                        <th scope="col">Nombre del Archivo</th>
                                        <th scope="col" class="text-center">Formato</th>
                                      </tr>
                                    </thead>
        
                                    <tbody class="tabla-descarga">
                                      <tr>
                                        <td scope="row">'.$just_name.'</td>
                                        <td scope="row" class="text-center"> 
                                            <div class="col" style="width: 50%; display:inline-flex" >
                                              <div class="col">
                                                <a class="icono-pdf col-2" href="'.$dir_visualizar.'" target=“_blank”>
                                                  <i style="color: red;" class="fas fa-file-pdf"></i>
                                                </a>
                                              </div>
                                              <div class="col">
                                                <a class="icono-word col-2" href="">
                                                  <i style="color: rgb(42, 89, 192);" class="fas fa-file-word"></i>
                                                </a>
                                              </div>
                                            </div>
                                        </td>
        
                                      </tr>
                                    </tbody>
                                  </table>';



                              echo "<br><br><br>";
                            }

                          ?>

                      </div>

                      
                      <div class="" style="background-color: #F1F6F9;">
                          <div class="boton">
                              <!-- Boton para descargar-->
                          <!--  <a download="archivo" href="sistemas.pdf" class="btn 1" style="color:#016E9F"><span class="icon-house"></span>Descargar </a>-->
                          <a download="archivo" href="sistemas.pdf" href="#">  <button class="button 2" style="color: white;" type="submit">Descargar</button>  </a>
                          </div>
                      </div> 

	
                    </div>
                </div>

            </div>  
        </div>
    </main>

    <main class="container-fluid mt-2"></div>
        <div class="row">
            <div class="col-lg-1 col-12 mx-auto" style="width: 890px;"> 

                


                          <?php
                            $sentencia2 = "SELECT escuela.acronimo, tutor.apellidos, tutor.nombre AS 'nombre_tutor', memorando.nombre_archivo
                            FROM memorando
                            LEFT JOIN tutor
                            ON (memorando.id_tutor = tutor.id_tutor)
                            LEFT JOIN archivo_excel
                            ON (memorando.id_archivo_excel = archivo_excel.id_archivo_excel)
                            LEFT JOIN usuario
                            ON (archivo_excel.id_usuario = usuario.id_usuario)
                            LEFT JOIN escuela
                            ON (usuario.id_escuela = escuela.id_escuela)
                            WHERE memorando.id_archivo_excel = '$id_archivo_excel' ORDER BY nombre_archivo ASC";

                            //$sentencia2 = "SELECT * FROM memorando WHERE id_archivo_excel = '$id_archivo_excel' ORDER BY nombre_archivo ASC";
                            $resultados_memorando = mysqli_query($conexion, $sentencia2);
                            $num_filas_afectadas2 = mysqli_num_rows($resultados_memorando);

                            if($num_filas_afectadas2 >= 1)
                            {
                              echo '<div class="card" style="background-color: #F1F6F9;"> 
                              <div class="bg-gradient text-white" style="background-color: rgba(1, 110, 159, .6);">
                                  <p class="col-12 fs-5 pt-2 ps-3 ">MEMORANDOS</p>
                              </div> 
                    
                              <div class="row  card-body" >
          
                                  <div class="input-group justify-content-between "> 
                                      <input type="text" class="form-control form-control-lg" placeholder="Escribe el nombre a buscar" style="font-size: 85%;">
                                      <button type="submit" class="input-group-text btn-primary" style="background-color:#016E9F ;"><i class="bi bi-search me-2"></i> Buscar</button>
                                  </div>';



                              echo '<table class="table table-borderless">
                              <thead>
                                <tr>

                                  <th scope="col">Nombre del Archivo</th>
                                  <th scope="col" class="text-center">Formato</th>
                                  <th scope="col" class="text-end">
                                    <div class="">
                                      <input class="form-check-input" type="checkbox" id="check1" name="option1" value="something" checked>
                                      <label class="form-check-label">Seleccionar todo</label>
                                    </div>
                                  </th>
  
                                </tr>
                              </thead>
                              <tbody class="tabla-descarga">';

                              $dir = "generated/memorandos/pdf/";

                              for($i = 1; $fila_memorando = mysqli_fetch_array($resultados_memorando); $i++)
                              {
                                $acronimo_escuela = $fila_memorando['acronimo'];
                                $just_name = "Memorando - ".$acronimo_escuela." - ".$fila_memorando['apellidos'].", ".$fila_memorando['nombre_tutor'];

                                $nombre_archivo = $fila_memorando['nombre_archivo'];
                                $dir_visualizar = $dir.$nombre_archivo;
                        
                        
                                // Mostrando el elemento en HTML
  
                                echo '<tr>
                                      <td scope="row">'.$just_name.'</td>
                                      <td scope="row" class="text-center"> 
                                          <div class="col" style="width: 70%; display:inline-flex" >
                                            <div class="col">
                                              <a class="icono-pdf col-2" href="'.$dir_visualizar.'" target=“_blank”>
                                                <i style="color: red;" class="fas fa-file-pdf"></i>
                                              </a>
                                            </div>
                                            <div class="col">
                                              <a class="icono-word col-2" href="">
                                                <i style="color: rgb(42, 89, 192);" class="fas fa-file-word"></i>
                                              </a>
                                            </div>
                                          </div>
                                      </td>
                                      <td class="">
                                        <div class="text-center">
                                          <input class="form-check-input" type="checkbox" id="check1" name="option1" value="" checked>
                                        </div>
                                      </td>
                                      
                                    </tr>';


                              }
                              echo "</tbody></table>";




                              echo '</div>

                              <div class="" style="background-color: white;">
                                  <div class="boton">
                                      <!-- Boton descargar-->
                                 <!--  <a download="archivo" href="sistemas.pdf" class="btn 1" style="color:#016E9F"><span class="icon-house"></span>Descargar </a> -->
                                  <a download="archivo" href="sistemas.pdf" href="#">  <button class="button 2" style="color: white;" type="submit">Descargar</button>  </a>
                                  </div>
                              </div> 
                              
            
                            </div>';

                            }
                          ?>








      



                </div>

            </div>  
        </div>
    </main>






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