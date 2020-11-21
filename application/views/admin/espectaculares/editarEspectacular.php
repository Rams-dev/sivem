
<?php
 foreach($espectaculares as $espectacular){
    }?>

<h1 class="text-center" style="color:#ba0d0d;">Editar Espectacular</h1>
<hr>
<div class="col-md-12">
    <form method="POST" enctype="multipart/form-data" action="<?= base_url('admin/espectaculares/guardarCambiosEspectacular')?>" name="editarespectacular"
        id="editarespectacular">

        <div class="col-md-12">
            <h6> Datos del espectacular: </h6>
            <hr>
            <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="numcontrol"> #Control: </label>
                            <input type="text" class="form-control" value="<?= $espectacular['nocontrol']?>" id="numcontrol" name="numcontrol" value="" >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="costoimpreso"> Costo Impresión:</label>
                        <input type="number" class="form-control" value="<?= $espectacular['costo_impresion']?>" id="costoimpreso" name="costoimpreso" value="0"  step="any" value="1" readonly>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="instalacion"> Costo de Instalación: </label>
                        <input type="number" class="form-control" value="<?= $espectacular['costo_instalacion']?>" id="instalacion" name="instalacion" value="0"  step="any" value="0" readonly>
                    </div>
                </div>

                <div class="col-md-12">
                    <h6> Domicilio y Ubicación</h6>
                    <hr>
                </div>

                <div class="col-md-3">
                    <div class="form-froup">
                        <label for="calle"> Calle: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['calle']?>" id="calle" name="calle" >
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="numero"> Número: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['numero']?>" id="numero" name="numero" value="" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="colonia"> Colonia: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['colonia']?>" id="colonia" name="colonia" value="" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="localidad"> Localidad: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['localidad']?>" id="localidad" name="localidad" value="" >
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="estado"> Estado: </label>
                        <select name="estado" id="estadoselect" class="form-control" value="" >
                          <option value="<?=$espectacular['id_estado']." ". $espectacular['nombre_estado']?>'" selected><?=$espectacular['nombre_estado']?></option>
                            <?php foreach($estados as $estado):?>
                            <option value="<?= $estado['id'].','. $estado['nombre']?>"> <?= $estado['nombre'] ?></option>
                            <?php endforeach?>
                        </select>

                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="municipio"> Municipio: </label>
                        <select name="municipio" id="municipioselect" class="form-control" value="">
                            <option value="<?= $espectacular['municipio']?>"><?= $espectacular['municipio']?></option>
                        </select>
                        <!-- <input type="text" class="form-control" value="" id="municipio" name="municipio" value="" > -->
                    </div>
                </div>
                

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="latitud"> Latitud: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['latitud']?>" id="latitud" name="latitud" >
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="longitud"> Longitud: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['longitud']?>" id="longitud" name="longitud" >
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group ">
                        <label for="referencias"> Referencias </label>
                        <input type="text" class="form-control" value="<?= $espectacular['referencias']?>" id="referencias" name="referencias">
                    </div>
                </div>

                <div class="col-md-12 my-4">
                    <h6> Medidas, Materiales, Imagenes: </h6>
                    <hr>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="ancho"> Ancho(m): </label>
                        <input type="text" class="form-control" value="<?= $espectacular['ancho']?>" id="ancho" name="ancho" onblur="CalculaPrecio();">
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="alto"> Alto(m): </label>
                        <input type="text" class="form-control" value="<?= $espectacular['alto']?>" id="alto" name="alto" onblur="CalculaPrecio();">
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="material"> Material: </label>
                            <select class="form-control" id="material" name="material" value="<?= $espectacular['id_material']?>" onchange="CalculaPrecio();">
                                <option value="<?=$espectacular['id_material'] .','. $espectacular['precio_material']?>"><?= $espectacular['material'] ." $". $espectacular['precio_material']?></option>
                                <?php foreach($materiales as $material):?>
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']?></option>
                                 <?php endforeach ?>       
                            </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio"> Precio: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['precio']?>" id="precio" name="precio" readonly>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status"> Status: </label>
                        <select class="form-control" id="status" name="status" value="" >
                        <option value="<?= $espectacular['status']?>"><?= $espectacular['status']?> </option>
                            <option value="Disponible">Disponible</option>
                            <option value="Ocupado">Ocupado</option>
                            <option value="Apartado">Apartado</option>
                            <option value="Reparacion">Reparacion</option>
                            <option value="Bloqueado">Bloqueado</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <label for="observaciones"> Observaciones </label>
                    <input type="text" class="form-control" value="<?= $espectacular['observaciones']?>" id="observaciones" name="observaciones" value="" >
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="acabados"> Acabados: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['acabados']?>" id="acabados" name="acabados" value="" >
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="imagen1"> Vista Corta : </label>
                        <input type="file" class="dropify" value="<?= $espectacular['vista_corta']?>" data-allowed-file-extensions="jpg png jpeg" id="imagen1" name="imagen1" data-default-file="<?=base_url('assets/images/espectaculares/'.$espectacular['vista_corta'])?>" />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="imagen2"> Vista Media : </label>
                        <input type="file" class="dropify" value="<?= $espectacular['vista_media']?>" data-allowed-file-extensions="jpg png jpeg" id="imagen2" name="imagen2"  data-default-file="<?=base_url('assets/images/espectaculares/'.$espectacular['vista_media'])?>"  />
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="imagen3"> Vista Larga : </label>
                        <input type="file" class="dropify" value="<?= $espectacular['vista_larga']?>" data-allowed-file-extensions="jpg png jpeg" id="imagen3" name="imagen3" data-default-file="<?=base_url('assets/images/espectaculares/'.$espectacular['vista_larga'])?>" />
                    </div>
                </div>

                <div class="col-md-12 my-4">
                    <h6 > Datos del propietario (Casa, Terreno o Azotea): </h6>
                    <hr>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="nombreprop"> Propietario</label>
                            <input type="text" class="form-control" value="<?= $espectacular['nombre']?>" id="nombreprop" name="nombreprop" value="">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="celular"> Celular: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['celular']?>" id="celular" name="celular" value="">
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="form-group">
                        <label for="telefono"> Teléfono: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['telefono']?>" id="telefono" name="telefono" value="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="iniciocontrato"> Inicio </label>
                        <input type="date" class="form-control" value="<?= $espectacular['fecha_inicio']?>" id="iniciocontrato" name="iniciocontrato" value="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="fincontrato"> Fin: </label>
                            <input type="date" class="form-control" value="<?= $espectacular['fecha_termino']?>" id="fincontrato" name="fincontrato" value="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="monto"> Monto: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['monto']?>" id="monto" name="monto" value="" step="any">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="folio"> Folio: </label>
                        <input type="text" class="form-control" value="<?= $espectacular['folio']?>" id="folio" name="folio" value="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tipopago"> Tipo pago: </label>
                        <select class="form-control" value="" id="tipopago" name="tipopago" value="">
                            <option value="<?= $espectacular['id_tipo_pago']?>"><?= $espectacular['tipo_de_pago']?></option>
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
                            <option value="<?= $espectacular['id_periodo_pago']?>"><?= $espectacular['periodo']?></option>
                            <?php foreach($periodos_pago as $periodo_pago):?>
                            <option value="<?= $periodo_pago['id']?>"><?= $periodo_pago['periodo']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                </div>
                <input type="text" name="id_medio" class="d-none" value="<?=$espectacular['id']?>">
                <input type="text" name="id_prop" class="d-none" value="<?=$espectacular['id_prop']?>">
                <input type="text" name="espectacular_id" class="d-none" value="<?=$espectacular['espectacular_id']?> ">


                <div class="col-md-12 d-flex justify-content-end my-4">
                        <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </div>
        </form>
    <div id="answer"></div>
</div>

<script>espectacularesit.classList.add("selected");</script>
<script src="<?=base_url('assets/js/espectaculares.js') ?>"></script>