<div class="my-5">
<h3 class="text-center text-danger" >Agregar valla movil</h3>
<hr>
</div>
<form action="<?=base_url("admin/vallas_moviles/guardarValla_movil")?>" id="guardarValla_movil" method="post">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="noControl">No control</label>
                <input type="text" name="nocontrol" id="nocontrol" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="Modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="anio">Año</label>
                <input type="text" name="anio" id="anio" class="form-control">
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" value="" >
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

        <div class="col-lg-4 col-md-4 d-none" id="hastaDiv">
            <div class="form-group">
                <label for="hasta" > Fecha termino de ocupación: </label>
                <input type="date" class="form-control" id="terminoOcupacion" name="terminoOcupacion">
            </div>
        </div>

    </div>


    <div class="col-md-12 my-4">
        <h5 class="text-center">Medidas</h5>
        <hr>
    </div>
    



    <div class="row justify-content-between">
        <div class="col-md-5">
            <h4 class="text-center ">Lateral</h4>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="anchoLateral">Ancho(m)</label>
                        <input type="number" name="anchoLateral" id="anchoLateral" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="altoLateral">Alto(m)</label>
                        <input type="number" name="altoLateral" id="altoLateral" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="materialLateral">Material</label>
                        <select name="materialLateral" id="materialLateral" class="form-control form-control-sm">
                        <option value="">Sel. Material</option>
                                <?php foreach($materiales as $material):?>
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio'] . " ". $material['unidad']?></option>
                                 <?php endforeach ?> 
                        </select>
                    </div>
                </div>
            </div>

            <h5 class="text-center my-4">Faldon</h5>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="anchoFaldon">Ancho(m)</label>
                        <input type="number" name="anchoFaldon" id="anchoFaldon" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="altoFaldon">Alto(m)</label>
                        <input type="number" name="altoFaldon" id="altoFaldon" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="materialFaldon">Material</label>
                        <select name="materialFaldon" id="materialFaldon" class="form-control form-control-sm">
                        <option value="">Sel. Material</option>
                                <?php foreach($materiales as $material):?>
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']. " ". $material['unidad']?></option>
                                 <?php endforeach ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!------------------------------------------------------ leftSide -------------------------------------->
  
        <div class="col-md-5">
            <h5 class="text-center ">Puerta</h5>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="anchoPuerta">Ancho(m)</label>
                        <input type="number" name="anchoPuerta" id="anchoPuerta" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="altoPuerta">Alto(m)</label>
                        <input type="number" name="altoPuerta" id="altoPuerta" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="materialPuerta">Material</label>
                        <select name="materialPuerta" id="materialPuerta" class="form-control form-control-sm">
                        <option value="">Sel. Material</option>
                                <?php foreach($materiales as $material):?>
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']. " ". $material['unidad']?></option>
                                 <?php endforeach ?> 
                        </select>
                    </div>
                </div>
            </div>

            <h5 class="text-center my-4">Frente</h5>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="anchoFrente">Ancho(m)</label>
                        <input type="number" name="anchoFrente" id="anchoFrente" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="altoFrente">Alto(m)</label>
                        <input type="number" name="altoFrente" id="altoFrente" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="materialFrente">Material</label>
                        <select name="materialFrente" id="materialFrente" class="form-control form-control-sm">
                        <option value="">Sel. Material</option>
                                <?php foreach($materiales as $material):?>
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']. " ". $material['unidad']?></option>
                                 <?php endforeach ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="costo">Costo renta/m</label>
                <input type="text" name="renta" id="renta" value="$25000" class="form-control" readonly>
            </div>
        </div>    

        <div class="col-md-4">
            <div class="form-group">
                <label for="costoImpresion">Costo impresión</label>
                <input type="text" name="costoImpresion" id="costoImpresion" value="" class="form-control" readonly>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="costoImpresion">Costo total</label>
                <input type="text" name="costoTotal" id="costoTotal" value="" class="form-control" readonly>
            </div>
        </div>
        

    </div>


    <div class="form-group mt-3">
        <label for="observaciones">Observaciones</label>
        <textarea name="observaciones"class="form-control form-control-sm" id="observaciones" rows="2"></textarea>
    </div>

    <div class="form-group">
        <label for="acabados">Acabados</label>
        <textarea name="acabados"class="form-control form-control-sm" id="acabados" rows="2"></textarea>
    </div>

    <div class="my-4">
        <h5 class="text-center">Fotos</h5>
        <hr>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="imagen1"> Vista Corta </label>
                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg" id="imagen1" name="imagen1" />
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="imagen2"> Vista Media </label>
                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg" id="imagen2" name="imagen2" />
            </div>
        </div>
            
        <div class="col-md-4">
            <div class="form-group">
                <label for="imagen3"> Vista Larga </label>
                <input type="file" class="dropify" data-allowed-file-extensions="jpg jpeg" id="imagen3" name="imagen3" />
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-end my-4">
        <button class="btn btn-success " type="submit">Guardar</button>
    </div>

    </form>

    <script>vallasmovilesit.classList.add("selected");</script>
<script src="<?=base_url('assets/js/vallas_moviles.js')?>"></script>