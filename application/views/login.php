<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
    	
	
</head>

<body>

<div class="container">
    <div class="mx-auto mt-5 align-items-center">
            <div class="text-center">
                <img src="<?= base_url('assets/images/logosis.svg')?>" alt="Logo" width="400" class="responsive image">
            </div>            
                <form action="<?= base_url("login/validate")?>" id="loginForm" method="POST" class="my-5">
                  <h3 class="text-center" >Iniciar sesion</h3>
                        <div class="col-md-4 mx-auto">
                                <div class="form-group" id="correo">
                                    <label for="correo">Correo electrónico</label>
                                    <input type="email" name="correo" class="form-control" id="correo" aria-describedby="emailHelp">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-4 mx-auto">
                            <div class="form-group" id="contrasena">
                                <label for="exampleInputPassword1">Contraseña</label>
                                <input type="password" name="contrasena" id="contrasena" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary btn-block ">Login</button><br>
                            <div id="alert"></div>
                       </div>                 
                </form> 

                <a href="<?php echo base_url('admin/dashboard')?>">link</a>
	</div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/login.js')?>"></script>

</html>