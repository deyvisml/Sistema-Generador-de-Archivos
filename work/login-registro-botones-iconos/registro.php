<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/estilos-registro.css">
    <title>Hello, world!</title>

    <style>
        body{
        margin: 0;
        padding: 0;
    }
    .izquierda{
        background: url(imagen/imagen-registro.jpg);
        background-size: cover;
        background-position: center;
        width: 47%;
    }
    .registrarte{
        font-size: 40px;
    }
    .inicio-sesion{
        font-size: 20px;
    }

    .btn{
        transition: all .5s ease;
        width: 73%;
        color:white;
        border-radius: 6px;
        font-weight: 600;
        background-color: #016E9F;
        border: 1px solid #016E9F;
        margin-top: 1.5em;
        margin-bottom: .5em;
        margin-right: 1em;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        -ms-border-radius: 6px;
        -o-border-radius: 6px;
    }

    .button {
        transition: all .5s ease;
        width: 33%;
        height: 4.2vh;
        color:white;
        border-radius: 6px;
        font-weight: 600;
        background-color: #2c2e49;
        border: 1px solid #016e9f;
        margin-top: 1.5em;
        margin-bottom: .5em;
        margin-right: 1em;
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        -ms-border-radius: 6px;
        -o-border-radius: 6px;
    }
    .button:hover, .button:focus{
        background-color: #383957;
        color:white;
    }

    .derecha{
        background: white;
        height: 100vh;
        width: 53%;
    }
    #pantalla-dividida{
        display: flex;
        
    }
    </style>

  </head>
  <body>
  <section id="pantalla-dividida">
        <div class="izquierda">

        </div>
        <div class="derecha pt-2">

            <div class="ps-5">
                <div class="unap col pt-5 ps-5">
                    <h2 class="registrarte">Registrarte</h2>
                    <p class="inicio-sesion">Ya tienes una cuenta? <a href="login.php" style="color:#016E9F;">Iniciar Sesion</a></p> 

                </div>
            </div>
            <div class="mx-5 car ps-5 pe-5">
                <form class="row card-body validar-form" novalidate action="descargar.html">

                    <div class="bg-gradient text-white" style="background-color: rgba(1, 110, 159, .6);">
                        <p class="col-12 fs-5 pt-2 ">DATOS GENERALES</p>
                    </div> 

                    <div class="row g-1 ps-5 pe-5 pb-1" style="background-color:#F1F6F9;">
                            <div class="col-12 pt-2"> 
                                <input type="text"  placeholder="Nombres" class="form-control" id="nombre" value="" required>
                            </div>
               
                            <div class="col-6 pt-2 pe-2">   
                                <input type="text"  placeholder="Apellido Paterno" class="form-control" id="" value="" required>
                            </div>

                            <div class="col-6 pt-2 ps-2"> 
                                <input type="text"  placeholder="Apellido Materno" class="form-control" id="" value="" required>
                            </div>
                        
                            <div class="col-6 pt-2 pe-2">  
                                <select class="form-select" id="periodo" required>
                                    <option selected disabled value="">Escuela Profesional</option>
                                    <option value="1">Derecho</option>
                                    <option value="2">Administracion</option>
                                    <option value="3">Medicina</option>
                                    <option value="4">Ingenieria de Sistemas</option>
                                </select>
                            </div>
               
                            <div class="col-6 pt-2 ps-2">   
                                <select class="form-select" id="periodo" required>
                                    <option selected disabled value="">Seleccione cargo </option>
                                    <option value="1">Secretario</option>
                                    <option value="2">Director</option>
                                    <option value="3">Coordinador</option>
                                    <option value="4">Rector</option>
                                </select>
                            </div>
               
                            <div class="col-12 pt-2"> 
                                <input type="email"  placeholder="Correo electronico" class="form-control" id="" value="" required>
                            </div>
                        </div>  
                        <!-- FORMULARIO 2   -->
                        <div class="bg-gradient text-white g-3" style="background-color: rgba(1, 110, 159, .6);">
                                <p class="col-12 fs-5 pt-2"> DATOS DE INICIO DE SESION</p>
                        </div>
                        <div class="row g-1 ps-5 pe-5 pb-1" style="background-color:#F1F6F9;">

                            <div class="col-12 pt-2"> 
                                <input type="text"  placeholder="Nombre de usuario" class="form-control" id="" value="" required>
                                <label for="fecha" class="form-label"><p class="fw-light m-0"><span class="text-danger"> * </span>La longitud del nombre de usuario debe tener 15 caracteres como maximo y no puede incluir espacios</p></label>
                            </div>
               
                            <div class="col-6 pt-2 pe-2"> 
                                <label for="contrasenia-1" class="form-label"><p class="fw-normal m-0">Introduce nueva contrasenia</p></label>
                                <input type="password"  placeholder="Contrasenia nueva" class="form-control" id="contrasenia-1" value="" required>
                            </div>

                            <div class="col-6 pt-2 ps-2"> 
                                <label for="contrasenia-2" class="form-label"><p class="fw-normal m-0">Repite contrasenia</p></label>
                                <input type="password"  placeholder="Confirmar contrasenia" class="form-control" id="contrasenia-1" value="" required>
                            </div>
                        </div>
            
                    <div class="text-center pb-2" style="background-color: #F1F6F9;">
                        <div class="boton">
                            <!-- Boton para registrarse-->
                        <a href="#">  <button class="button 2" style="color: white;" type="submit">REGISTRARTE</button> </a>
                        </div>
                    </div> 
                </form>
            </div>

        </div>
    </section>

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


  </body>
</html>