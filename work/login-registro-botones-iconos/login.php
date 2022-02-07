<?php
  session_start();
  
  if(isset($_SESSION['id'])){
      header('Location: index.php');
  }

  if(!$_GET){
    header('Location: login.php?status=active');
  }
  else if($_GET['status']!='active'){
    header('Location: login.php?status=active');
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
    <link rel="stylesheet" href="styles/estilos-login.css">
    
    <title>Hello, world!</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous" />
    
    <style>
        body{
    margin: 0;
    padding: 0;
    }

    .izquierda{
        background: #F1F6F9;
        height: 100vh;
        width: 33.5%;
    }

    form{
      padding: 0 2em;
    }
    .form__input{
        background: #F1F6F9;
      width: 100%;
      border:0px solid transparent;
      border-radius: 0;
      border-bottom: 1px solid #aaa;
      padding: 1em .5em .5em;
      padding-left: 2em;
      outline:none;
      margin:1.5em auto;
      transition: all .5s ease;
    }
    .input-group-text{
        border:0px solid transparent;
        background: #F1F6F9;
    }


    .form__input:focus{
      border-bottom-color: #016E9F;
      box-shadow: 0 0 5px rgba(1,110,159,.1);
      border-radius: 4px;
      -webkit-border-radius: 4px;
      -moz-border-radius: 4px;
      -ms-border-radius: 4px;
      -o-border-radius: 4px;
    }

    .invalid-feedback{
        position: fixed;
        background: transparent;
        margin-top: 4%;
        padding-right: 91%;

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
    .btn:hover, .btn:focus{
      background-color: #0e5e83;
      color:white;
    }

    .link{
        color:#F1F6F9

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
        background: url(imagen/imagen-login.jpg);
        background-size: cover;
        background-position: center;
        width: 66.5%;
    }
    #pantalla-dividida{
        display: flex;
    }
    </style>

  </head>
  <body>
      <section id="pantalla-dividida">
          <div class="izquierda ">
              <div class="unap col pt-5 text-center">
                  <img src="imagen/unap.png" alt="una-p">
                  <h1 class="pt-5" style="font-family: Roboto;"><p class="fw-bold">GENERAR  DOCUMENTOS</p></h1>
              </div>
            <div class="row p-5 text-center" style="background: #F1F6F9;">

                <form control="" class="row form-group m-1 validar-form"  method="POST" action="procesosPHP/1_procesarLogin.php">
                    
                    <div class="col-9 mx-auto" style="display: flex; background: ;">
                        <input type="text" name="user" id="username" class="form__input ps-1" placeholder="USUARIO" value="" required> 
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        <!-- Mensajes para validación   -->
                        <div class="invalid-feedback">Debe completar los datos.</div>
                        
                    </div>
                    <div class="col-9 mx-auto" style="display: flex; background: ;">
                        <input type="password" name="pass" id="password" class="form__input ps-1"  placeholder="CONTRASENIA"  value="" required>
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i></span>
                        <!-- Mensajes para validación   -->
                        <div class="invalid-feedback">Debe completar los datos. </div>
                    </div>


                    <div class="col">
                      <input type="submit" value="INGRESAR" name="btnLogin" id="btnLogin" class="btn">
                    </div>
                    <div>
                        <a href="#"  class="link"><p style="color: #1E9CA9;">¿Olvidaste tu contraseña?</p></a>
                    </div>

                    <div class="col">
                        <a href="registro.php"><input type="button" value="REGISTRARTE" class="button"> </a>
                    </div>
                    
                </form>

            </div>

          </div>
          <div class="derecha" style="background-color: ">
            
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