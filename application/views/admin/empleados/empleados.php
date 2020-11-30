<h1 class=" text-center">Empleados</h1>
<hr>

<div class="d-flex justify-content-between my-4">
    <div class="d-flex">
        <input type="text" class="form-control mr-2 my-auto" id="buscadorcliente" name="buscadorcliente" value=""  placeholder="Busca empleado">
        <a class="btn btn-info search d-inline" role="button"><i class="fas fa-search"></i><p> Buscar</p></a>&nbsp;
    </div>
    <div class="d-inline">
        <a class="btn btn-warning add" role="button" data-toggle="modal" data-target="#modalAgregar"><i class="fas fa-plus"></i><p> + Nuevo Empleado +</p></a>
    </div>
</div>
<div class="table-responsive-md" id="espectacularesContainer">
    <table class="table" id="table">
    <thead class="thead-dark">
        <tr>
        <th>#</th>
        <th>nombre</th>
        <th>apellidos</th>
        <th>sexo</th>
        <th>correo</th>
        <th>telÉfono</th>
        <th>puesto</th>
        <th>contraseña</th>
        <th>tipo</th>
        <th>Acceso</th>
        <th>opciones</th>
        
        </tr>
    </thead>
    <tbody id="tableBody">
        
        <?php 
        $index = 1;
        foreach($empleados as $empleado):?>
        <tr>
        <th><?= $index?></th>
        <th><?= $empleado['nombre']?></th>
        <td><?= $empleado['apellidos']?></td>
        <td><?= $empleado['sexo']?></td>
        <td><?= $empleado['correo']?></td>
        <td><?= $empleado['telefono']?></td>
        <td><?= $empleado['puesto']?></td>
        <td><?= $empleado['contrasena']?></td>
        <td><?= $empleado['tipo'] == "1" ? "Administrador" : "Vendedor" ?></td>
        <td><?= $empleado['acceso']  ?></td>
        <td><button class="btn btn-warning btn-sm" role="button" data-toggle="modal" data-target="#modalEditar" onclick="EditarEmpleado(<?=$empleado['id']?>)" ><i class="fas fa-edit"></i></button>
        <button class="btn btn-danger btn-sm"  onclick="eliminarEmpleado(<?=$empleado['id']?>)" ><i class="fas fa-trash"></i></button></td>
        </tr>
        <?php
        $index++;
        endforeach?> 
    </tbody>
    </table>
</div>




<!---------------------------------------------  M O D A L   A G R E G A R ---------------------------- -->

<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agrgear Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url("admin/empleados/agregarEmpleado")?>" method="post" id="frmAgregar">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Apellidos</label>
                        <input type="text" name="apellidos" id="apellidos" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Correo</label>
                        <input type="email" name="correo" id="correo" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Teléfono</label>
                        <input type="text" name="telefono" id="telefono" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Puesto</label>
                        <input type="text" name="puesto" id="puesto" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Sexo</label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="M"> Masculino</option>
                            <option value="F"> Femenino</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Acceso al sistema</label>
                        <select name="acceso" id="acceso" class="form-control">
                            <option value="no" >No</option>
                            <option value="si" >Si</option>
                        </select>
                    </div>
                </div>
            </div>


            <div id="inputSistema" class=" row justify-content-between d-none" >
            
            <div class="my-4 col-md-12">
                <h5 class="text-center">Sistema</h5>
                <hr>
            </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="password" name="contrasenia" id="contrasenia" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Tipo</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="">Selecciona un rol</option>
                            <option value="2">Vendedor</option>
                            <option value="1">administrador</option>
                        </select>
                    </div>
                </div>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>        

    </div>
  </div>
</div>






<!------------------------------------------------------ M O D A L    E D I T A R -->



<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Empleado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url("admin/empleados/editarEmpleado")?>" method="post" id="frmEditar">
            <div class="row justify-content-between">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" name="Enombre" id="Enombre" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Apellidos</label>
                        <input type="text" name="Eapellidos" id="Eapellidos" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Correo</label>
                        <input type="email" name="Ecorreo" id="Ecorreo" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Teléfono</label>
                        <input type="text" name="Etelefono" id="Etelefono" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Puesto</label>
                        <input type="text" name="Epuesto" id="Epuesto" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Sexo</label>
                        <select name="Esexo" id="Esexo" class="form-control">
                            <option value="M"> Masculino</option>
                            <option value="F"> Femenino</option>
                        </select>
                    </div>
                </div>


                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Accesso al sistema</label>
                        <select name="Eacceso" id="Eacceso" class="form-control">
                            <option value="no">No</option>
                            <option value="si">Si</option>
                        </select>
                    </div>
                </div>
            </div>


            <div id="EinputSistema" class="row justify-content-between d-none" >
            
            <div class="my-4 col-md-12">
                <h5 class="text-center">Sistema</h5>
                <hr>
            </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Contraseña</label>
                        <input type="password" name="Econtrasenia" id="Econtrasenia" class="form-control">
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Tipo</label>
                        <select name="Etipo" id="Etipo" class="form-control">
                            <option value="">Selecciona un rol</option>
                            <option value="2">Vendedor</option>
                            <option value="1">administrador</option>
                        </select>
                    </div>
                </div>

            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
      </div>
      </form>        

    </div>
  </div>
</div>
<script>empleadosit.classList.add("selected");</script>
<script src="<?= base_url('assets/js/empleados.js')?>"></script>