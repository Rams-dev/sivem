
<h1 class="text-center" style="color:#ba0d0d;">Nuevo Espectacular</h1>
<hr>
<div class="loader"></div>
<div class="col-md-12">
    <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/espectaculares/guardarEspectacular')?>" name="guardarespectacular"
        id="guardarespectacular">

        <div class="col-md-12">
            <h6> Datos del espectacular: </h6>
            <hr>
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numcontrol"> #Control: </label>
                            <input type="text" class="form-control" id="numcontrol" name="numcontrol" value="" >
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-froup">
                        <label for="calle"> Calle: </label>
                        <input type="text" class="form-control" id="calle" name="calle" value="" >
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numero"> Número: </label>
                        <input type="text" class="form-control" id="numero" name="numero" value="" >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="colonia"> Colonia: </label>
                        <input type="text" class="form-control" id="colonia" name="colonia" value="" >
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label for="localidad"> Localidad: </label>
                        <input type="text" class="form-control" id="localidad" name="localidad" value="" >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="estado"> Estado: </label>
                        <select name="estado" id="estadoselect" class="form-control" >
                          <option value="" selected>Selecciona un estado</option>
                            <?php foreach($estados as $estado):?>
                            <option value="<?= $estado['id'].','. $estado['nombre']?>"> <?= $estado['nombre'] ?></option>
                            <?php endforeach?>
                        </select>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="municipio"> Municipio: </label>
                        <select name="municipio" class="js-example-basic-single js-states form-control" id="municipioselect">
                            <option value="">selecciona un municipio</option>
                        </select>
                        <!-- <input type="text" class="form-control" id="municipio" name="municipio" value="" > -->
                    </div>
                </div>
                

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="latitud"> Latitud: </label>
                        <input type="text" class="form-control" id="latitud" name="latitud" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="longitud"> Longitud: </label>
                        <input type="text" class="form-control" id="longitud" name="longitud" >
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group ">
                        <label for="referencias"> Referencias </label>
                        <input type="text" class="form-control" id="referencias" name="referencias">
                    </div>
                </div>

                <div class="col-md-12 my-4">
                    <h6> Medidas, Materiales, Imagenes: </h6>
                    <hr>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ancho"> Base(m): </label>
                        <input type="text" class="form-control" id="ancho" name="ancho"  step="any" onblur="CalculaPrecio();">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="alto"> Altura(m): </label>
                        <input type="text" class="form-control" id="alto" name="alto"  step="any" onblur="CalculaPrecio();">
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="material"> Material: </label>
                            <select class="form-control" id="material" name="material"  onchange="CalculaPrecio();">
                                <option value="">Sel. Material</option>
                                <?php foreach($materiales as $material):?>
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio'] ." " . $material['unidad']?></option>
                                 <?php endforeach ?>       
                            </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="costorenta"> Costo renta:</label>
                        <input type="number" class="form-control" id="costorenta" name="costorenta" onchange="CalculaPrecio();" required >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="costoimpreso"> Costo Impresión:</label>
                        <input type="number" class="form-control" id="costoimpreso" name="costoimpreso" value="0"  step="any" value="1" readonly>
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="instalacion"> Costo de Instalación: </label>
                        <input type="number" class="form-control" id="instalacion" name="instalacion" value="0"  step="any" value="0" readonly>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="precio"> Precio: </label>
                        <input type="text" class="form-control" id="precio" name="precio"  step="any" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="stats"> Status: </label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Sel. Status</option>
                            <option value="DISPONIBLE">DISPONIBLE</option>
                            <option value="OCUPADO">OCUPADO</option>
                            <option value="APARTADO">APARTADO</option>
                            <option value="REPARACIÓN">REPARACIÓN</option>
                            <option value="BLOQUEADO">BLOQUEADO</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 d-none" id="desdeDiv">
                        <div class="form-group">
                            <label for="hasta" >Fecha inicio de ocupación </label>
                            <input type="date" class="form-control" id="inicioOcupacion" name="inicioOcupacion">
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 d-none" id="hastaDiv">
                        <div class="form-group">
                            <label for="hasta" > Fecha termino de ocupación: </label>
                            <input type="date" class="form-control" id="terminoOcupacion" name="terminoOcupacion">
                        </div>
                    </div>

                <div class="col-md-12">
                    <label for="observaciones"> Observaciones </label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones" value="" >
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="acabados"> Acabados: </label>
                        <input type="text" class="form-control" id="acabados" name="acabados" value="" >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="imagen1"> Vista Corta : </label>
                        <input type="file" class="dropify" data-allowed-file-extensions="jpg png jpeg JPG PNG JPEG" id="imagen1" name="imagen1"/>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="imagen2"> Vista Media : </label>
                        <input type="file" class="dropify" data-allowed-file-extensions="jpg png jpeg JPG PNG JPEG" id="imagen2" name="imagen2"  />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="imagen3"> Vista Larga : </label>
                        <input type="file" class="dropify" data-allowed-file-extensions="jpg png jpeg JPG PNG JPEG" id="imagen3" name="imagen3"  />
                    </div>
                </div>

                <div class="col-md-12 my-4">
                    <h6 > Datos del propietario (Casa, Terreno o Azotea): </h6>
                    <hr>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nombreprop"> Propietario</label>
                            <input type="text" class="form-control" id="nombreprop" name="nombreprop" value="">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="celular"> Celular: </label>
                        <input type="text" class="form-control" id="celular" name="celular" value="">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefono"> Teléfono: </label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" value="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="iniciocontrato"> Inicio </label>
                        <input type="date" class="form-control" id="iniciocontrato" name="iniciocontrato" value="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fincontrato"> Fin: </label>
                            <input type="date" class="form-control" id="fincontrato" name="fincontrato" value="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="monto"> Monto: </label>
                        <input type="text" class="form-control" id="monto" name="monto" value="" step="any">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="folio"> Folio: </label>
                        <input type="text" class="form-control" id="folio" name="folio" value="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tipopago"> Tipo pago: </label>
                        <select class="form-control" id="tipopago" name="tipopago" value="">
                            <option value="">Sel. Tipo de pago</option>
                            <?php foreach($tipos_pago as $pagos):?>
                            <option value="<?=$pagos['id']?>"><?=$pagos['nombre']?></option>
                            <?php endforeach?>
                            
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="pago"> Pago: </label>
                        <select class="form-control" id="periodopago" name="periodopago" value="">
                            <option value="">Periodo</option>
                            <?php foreach($periodos_pago as $periodo_pago):?>
                            <option value="<?= $periodo_pago['id']?>"><?= $periodo_pago['periodo']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-end my-4">
                        <button type="submit" id="submitespectacular" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    <div id="answer"></div>
</div>

<script>espectacularesit.classList.add("selected");</script>
<script src="<?=base_url('assets/js/espectaculares.js') ?>"></script>
<script>
const w = document.querySelector("#status");
    w.addEventListener("change", (e)=> console.log(e.currentTarget.value))
</script>