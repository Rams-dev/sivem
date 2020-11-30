<!DOCTYPE html>
<html lang="es">

<head>
<meta name="robots" content="noindex"/>
     <meta name="robots" content="nofollow"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="<?= base_url("assets/images/logosis.png")?>">
	<title> LOGIN | SIVEM</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css')?>">
<link rel="stylesheet" href="<?php echo base_url('assets/css/login.css')?>">
    	
	
</head>

<body>

<div class="container mt-2">
    <div class="mx-auto mt-5 align-items-center">
        <div class="d-flex justify-content-center">
            <img src="<?= base_url('assets/images/logosis.svg')?>" alt="Logo sivem" class="responsive">
        </div>
        <div class="col-md-6 col-lg-4 col-sm-8 mx-auto my-4">
            <form action="<?= base_url("login/validate")?>" id="loginForm" method="POST" class="p-4">
                <h3 class="text-center mb-4" >Iniciar sesion</h3>
                    <div class="col-md-12 mx-auto">
                            <div class="form-group" id="correo">
                                <label for="correo">Correo electrónico</label>
                                <input type="email" name="correo" class="form-control" id="correo" autofocus aria-describedby="emailHelp">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-12 mx-auto">
                        <div class="form-group" id="contrasena">
                            <label for="exampleInputPassword1">Contraseña</label>
                            <input type="password" name="contrasena" id="contrasena" class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    
                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary btn-block ">Iniciar sesion</button><br>
                        <div id="alert"></div>
                    </div>
                    <div class="foot">
                            <p>© 2019. TODOS LOS DERECHOS RESERVADOS.</p>
                    </div>                 
            </form> 
        </div>            
	</div>
</div>

</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/login.js')?>"></script>

</html>