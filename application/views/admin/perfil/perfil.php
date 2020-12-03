<div class="title text-center">
    <h3><?=$this->session->userdata('nombre') . " ". $this->session->userdata('apellidos')?></h3>
</div>
<!-- <?php var_dump($usuario)?> -->

<div class="row justify-content-center my-5">
    <div class="col-md-5">
    <form action="<?=base_url("perfil/guargarDatosEditados")?>" id="EfrmPerfil" method="post">
        <?php foreach($usuario as $user):?>
        <div class="form-group">
            <label for="">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?=$user["nombre"]?>">
        </div>

        <div class="form-group">
            <label for="">Apellidos</label>
            <input type="text" name="apellidos" id="apellidos" class="form-control" value="<?=$user["apellidos"]?>">
        </div>

        <div class="form-group">
            <label for="">Correo</label>
            <input type="email" name="correo" id="correo" class="form-control" value="<?=$user['correo']?>">
        </div>

        <div class="form-group">
            <label for="">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" class="form-control" value="<?=$user["contrasena"]?>">
        </div>

        <div class="form-group">
            <label for="">Puesto</label>
            <input type="text" name="puesto" id="puesto" class="form-control" value="<?=$user["puesto"]?>">
        </div>

        <div class="form-group">
            <label for="">Sexo</label>
            <select name="sexo" id="sexo" class="form-control" value="<?=$user["sexo"]?>">
            
                <option value="M"> Masculino</option>
                <option value="F"> Femenino</option>
            </select>
        </div>

        <div class="form-group">
            <label for="">teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="<?=$user["telefono"]?>">
        </div>
        <div class="text-center mt-4">
            <button class = "btn btn-success" type="submit">Guardar</button>
        </div>

        <?php endforeach?>
        </form>
    </div>
</div>
<script src="<?=base_url("assets/js/perfil.js")?>"></script>