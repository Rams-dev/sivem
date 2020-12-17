<?php foreach($vallas_fijas as $valla):?>
<h1 class="text-center" style="color:#ba0d0d;">Editar <?=$valla['nocontrol']?> </h1>
    <hr>
<div class="loader"></div>


    <div class="col-lg-12">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url("admin/vallas_fijas/guardarVallaFijaEditada")?>" name="editarVallaFija" id="editarVallaFija">
                <h6 class="text-center"> Datos de la valla </h6>
                <hr>
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="form-group">
                            <label for="numcontrol"> No Control: </label>
                            <input type="text" required class="form-control" id="numcontrol" name="numcontrol" value="<?=$valla['nocontrol']?>"  onchange="VerificarEspectacularDuplicado(this.value);">
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-4" id="calle">
                        <div class="form-group">
                            <label for="calle" > Calle:</label>
                            <input type="text" required class="form-control" id="calle" name="calle" value="<?=$valla['calle']?>"  step="any">
                        </div>
                    </div>
                    
                    <div class="col-lg-2 col-md-4" id="numeroDiv">
                        <div class="form-group">
                            <label for="numero" > Numero:</label>
                            <input type="number" required class="form-control" id="numero" name="numero" value="<?=$valla['numero']?>"  step="any">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="colonia">
                        <div class="from-group">
                            <label for="colonia" > Colonia:</label>
                            <input type="text" required class="form-control" id="colonia" name="colonia" value="<?=$valla['colonia']?>"  step="any">
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4" id="localidad">
                        <div class="form-group">
                            <label for="localidad" >Localidad:</label>
                            <input type="text" required class="form-control" id="localidad" name="localidad" value="<?=$valla['localidad']?>"  step="any">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="estado">
                        <div class="form-group">
                            <label for="estado" > Estado: </label>
                                <select name="estado" id="estadoselect" class="form-control">
                                    <!-- <option value="<?=$valla['id_estado']?>"><?=$valla['nombre']?></option> -->
                                    <?php foreach($estados as $estado){
                                    if($valla['id_estado'] == $estado['id']){?>
                                        <option selected value="<?= $estado['id'] .",". $estado['nombre']?>"><?= $estado['nombre']?></option>
                                    <?php }else{   ?>
                                        <option value="<?= $estado['id'] .",". $estado['nombre']?>"><?= $estado['nombre']?></option>
                                    <?php }}?>
                                </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="municipio">
                        <div class="form-group">
                            <label for="municipio" > Municipio: </label>
                            <select name="municipio" id="municipioselect" class="form-control">
                                <option value="<?=$valla['municipio']?>"><?=$valla['municipio']?></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="latitud">
                        <div class="form-group">
                            <label for="latitud" >Latitud:</label>
                            <input type="text" required class="form-control" id="latitud" name="latitud" value="<?=$valla['latitud']?>"  step="any">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4" id="longitud">
                        <div class="form-group">
                            <label for="longitud" >Longitud:</label>
                            <input type="text" required class="form-control" id="longitud" name="longitud" value="<?=$valla['longitud']?>"  step="any">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12" id="referencias">
                        <div class="form-group">
                            <label for="referencias" >Referencias:</label>
                            <input type="text" required class="form-control" id="referencias" name="referencias" value="<?=$valla['referencias']?>"  step="any">
                        </div>
                    </div>

                    <div class="col-lg-12 col-md-12 my-4">
                        <h6 class="text-center">Medidas</h6>
                        <hr>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label for="ancho" > Ancho(m): </label>
                                <input type="number" required class="form-control" id="ancho" name="ancho" value="<?=$valla['ancho']?>"  step="any">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label for="alto" > Alto(m): </label>
                                <input type="number" required class="form-control" id="alto" name="alto" value="<?=$valla['alto']?>"  step="any">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3"> 
                        <div class="form-group">
                            <label for="costoderenta"> Costo de renta: </label>
                                <input type="number" class="form-control" id="costoderenta" name="costoderenta" value="<?=$valla['costo_renta']?>"  step="any" required>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="form group">
                            <label for="material" > Material: </label>
                                    <input type="text" required id="material" name="material" class="form-control" value="<?=$valla['material']?>" placeholder = "vinil - 65$"  readonly>
                                </select>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-3"> 
                        <div class="form-group">
                            <label for="costodeimpresion" > Costo de impresion: </label>
                                <input type="text" required class="form-control" id="costodeimpresion" name="costodeimpresion" value="$ <?=$valla['costo_impresion']?>"  readonly>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="form-group">
                            <label for="costodeinstalacion" > Costo de instalacion: </label>
                                <input type="text" required class="form-control" id="costodeinstalacion" name="costodeinstalacion" value="$ <?=$valla['costo_instalacion']?>"   readonly>
                                
                        </div>
                    </div>
                    
                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label for="precio" > Precio: </label>
                            <input type="text" required class="form-control" id="precio" name="precio" value="$ <?=$valla['precio']?>"  readonly>
                        </div>
                    </div>

                    <div class="col-sm-3 col-md-3">
                        <div class="form-group">
                            <label for="status"> Status: </label>
                                <select class="form-control" id="status" name="status">
                                    <option value="<?=$valla['status']?>"><?=$valla['status']?></option>
                                    <option value="DISPONIBLE">DISPONIBLE</option>
                                    <option value="OCUPADO">OCUPADO</option>
                                    <option value="APARTADO">APARTADO</option>
                                    <option value="REPARACION">Reparacion</option>
                                    <option value="BLOQUEADO">BLOQUEADO</option>
                                </select>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="observaciones" > Obaservaciones: </label>
                            <textarea class="form-control" required id="observaciones" name="observaciones" step="any"><?=$valla['observaciones']?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="form-group">
                            <label for="acabados" > Acabados </label>
                            <textarea class="form-control" required id="acabados" name="acabados"  step="any"><?=$valla['acabados']?></textarea>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="imagen1" > Vista Corta : </label>
                                <input type="file"  class="dropify" data-allowed-file-extensions="jpg jpeg"
                                    id="imagen1" name="imagen1"  data-default-file="<?=base_url('assets/images/medios/'.$valla['vista_corta'])?>" />
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="imagen1" > Vista Media : </label>
                                <input type="file"  class="dropify" data-allowed-file-extensions="jpg jpeg"
                                    id="imagen2" name="imagen2"  data-default-file="<?=base_url('assets/images/medios/'.$valla['vista_media'])?>" />
                        </div>
                    </div>
                            
                    <div class="col-lg-4 col-md-4">
                        <div class="form-group">
                            <label for="imagen1" > Vista Larga : </label>
                                <input type="file"  class="dropify" data-allowed-file-extensions="jpg jpeg"
                                    id="imagen3" name="imagen3" data-default-file="<?=base_url('assets/images/medios/'.$valla['vista_media'])?>" />
                        </div>
                    </div>
                    <div class="col-lg-12 my-5">
                        <h6 class="text-center"> Datos del propietario: </h6>
                        <hr>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group ">
                            <label for="propietario" > Propietario:</label>
                            <select class="form-control" id="propietario" name="propietario"  >
                                <option value="nuevo">Nuevo</option>
                                <option value="registrado">Registrado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 d-none" id="propietariosReg">
                        <div class="form-group ">
                            <label for="propietarioReg" > Propietarios registrados:</label>
                            <select class="form-control" id="propietarioReg" name="propietarioReg" >
                                <option value="">--selecciona--</option>
                                <?php foreach($propietarios as $propietario):?>
                                <option value="<?= $propietario['id']?>"><?= $propietario["nombre"]?></option>
                                <?php endforeach?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4" id="nombre">
                        <div class="form-group ">
                            <label for="nombreprop" > Nombre:</label>
                            <input type="text" required class="form-control" id="nombreprop" name="nombreprop" value="<?=$valla['nombre_propietario']?>" >
                        </div>
                    </div>

                    <div class="col-md-4" id="celularDiv">
                        <div class="form-group">
                            <label for="celular" > Celular: </label>
                            <input type="text" required class="form-control" id="celular" name="celular" value="<?=$valla['celular']?>" >
                        </div>
                    </div>

                    <div class="col-md-4" id="telefonoDiv">
                        <div class="form-group">
                            <label for="telefono" > Teléfono: </label>
                            <input type="text" required class="form-control" id="telefono" name="telefono" value="<?=$valla['telefono']?>" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="monto" > Monto: </label>
                            <input type="text" required class="form-control" id="monto" name="monto" value="<?=$valla['monto']?>" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="iniciocontrato" > Fecha de inicio:</label>
                            <input type="date" required class="form-control" id="iniciocontrato" name="iniciocontrato" value="<?=$valla['fecha_inicio']?>" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="fincontrato" > Fecha de termino: </label>
                                <input type="date" required class="form-control" id="fincontrato" name="fincontrato" value="<?=$valla['fecha_termino']?>" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tipopago" > Tipo pago: </label>
                                <select class="form-control" id="tipopago" name="tipopago" value="" >
                                    <?php foreach($tipos_pago as $tipo){
                                    if($valla['id_tipo_pago'] == $tipo['id']){?>
                                        <option selected value="<?= $tipo['id']?>"><?= $tipo['nombre']?></option>
                                    <?php }else{
                                    ?>
                                        <option value="<?= $tipo['id']?>"><?= $tipo['nombre']?></option>
                                    <?php }} ?>
                                </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pago" > Periodo de Pago: </label>
                                <select class="form-control" id="periodopago" name="periodopago" value=""
                                    >
                                    <?php foreach($periodos_pago as $periodo){
                                    if($valla['id_periodo_pago'] == $periodo['id']){?>
                                        <option selected value="<?= $periodo['id']?>"><?= $periodo['periodo']?></option>
                                    <?php }else{
                                    ?>
                                        <option value="<?= $periodo['id']?>"><?= $periodo['periodo']?></option>
                                    <?php }} ?>
                                </select>
                        </div>
                    </div>

                    <input type="hidden" required name="id_medio" id="id_medio" value="<?=$valla['id_medio']?>">

                    <!--<div class="col-lg-2">
                        <div class="form-group">
                            <label for="folio" > Folio: </label>
                            <input type="text" class="form-control" id="folio" name="folio" value="" >
                        </div>
                    </div>-->
<!-- 
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="monto" c>Contrato: </label>
                            <input type="file" id="monto" name="monto" value=""  step="any">
                        </div>
                    </div>  -->
                    
                </div>
                <div class="d-flex justify-content-end my-5">
                    <button type="submit" id="submitVallas_fijas" class="btn btn-success">Guardar</button>
                </div>
        </form>
    </div>

<div id="answer">

</div>

<?php endforeach?>
<script>vallasit.classList.add("selected");</script>
<script src="<?= base_url("assets/js/vallas_fijas.js")?>"></script>	