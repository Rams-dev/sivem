<?php var_dump($vallas_moviles);

var_dump($vallas_moviles);

foreach($vallas_moviles as $vallas):
?>

<div class="my-5">
<h3 class="text-center text-danger" >Editar valla movil <?= $vallas['nocontrol']?></h3>
<hr>
</div>
<form action="<?=base_url("admin/vallas_moviles/guardarValla_movilEditado")?>" id="editarValla_movil" method="post">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="noControl">No control</label>
                <input type="text" name="nocontrol" id="nocontrol" value="<?=$vallas['nocontrol']?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" name="marca" id="marca" value="<?=$vallas["marca"]?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="Modelo">Modelo</label>
                <input type="text" name="modelo" id="modelo" value="<?=$vallas["modelo"]?>" class="form-control">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="anio">Año</label>
                <input type="text" name="anio" id="anio" value="<?=$vallas["anio"]?>" class="form-control">
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="costo">Costo</label>
                <input type="text" name="costo" id="costo" value="25000" class="form-control" readonly>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" >
                     <option value="<?=$vallas['status']?>"><?=$vallas['status']?></option>
                    <option value="DISPONIBLE">DISPONIBLE</option>
                    <option value="OCUPADO">OCUPADO</option>
                    <option value="APARTADO">APARTADO</option>
                    <option value="REPARACIÓN">REPARACIÓN</option>
                    <option value="BLOQUEADO">BLOQUEADO</option>
                </select>
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
                        <input type="number" name="anchoLateral" id="anchoLateral" value="<?=$vallas['lateral_ancho']?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="altoLateral">Alto(m)</label>
                        <input type="number" name="altoLateral" id="altoLateral" value="<?=$vallas['lateral_alto']?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="materialLateral">Material</label>
                        <select name="materialLateral" id="materialLateral" class="form-control form-control-sm" >
                        <!-- <option value="">Sel. Material</option> -->
                                <?php foreach($materiales as $material){
                                if($material["id"] == $vallas["lateral_id_material"]){?>
                                <option selected value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']?></option>
                                <?php }else{ ?>
                                
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']?></option>
                                <?php } }?> 
                        </select>
                    </div>
                </div>
            </div>

            <h5 class="text-center my-4">Faldon</h5>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="anchoFaldon">Ancho(m)</label>
                        <input type="number" name="anchoFaldon" id="anchoFaldon" value="<?= $vallas['faldon_ancho']?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="altoFaldon">Alto(m)</label>
                        <input type="number" name="altoFaldon" id="altoFaldon" value="<?= $vallas['faldon_alto']?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="materialFaldon">Material</label>
                        <select name="materialFaldon" id="materialFaldon" class="form-control form-control-sm">
                        <!-- <option value="">Sel. Material</option> -->
                                <?php foreach($materiales as $material){
                                if($material["id"] == $vallas["faldon_id_material"]){?>
                                <option selected value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']?></option>
                                <?php }else{ ?>
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']?></option>
                                <?php }} ?> 
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
                        <input type="number" name="anchoPuerta" id="anchoPuerta"  value="<?= $vallas['puerta_ancho']?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="altoPuerta">Alto(m)</label>
                        <input type="number" name="altoPuerta" id="altoPuerta" value="<?= $vallas['puerta_alto']?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="materialPuerta">Material</label>
                        <select name="materialPuerta" id="materialPuerta" class="form-control form-control-sm">
                        <!-- <option value="">Sel. Material</option> -->
                                <?php foreach($materiales as $material){
                                if($material["id"] === $vallas["faldon_id_material"]){?>
                                <option selected value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']?></option>
                                
                                <?php }else{ ?>
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']?></option>
                                <?php }} ?> 
                        </select>
                    </div>
                </div>
            </div>

            <h5 class="text-center my-4">Frente</h5>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="anchoFrente">Ancho(m)</label>
                        <input type="number" name="anchoFrente" id="anchoFrente" value="<?= $vallas['frente_ancho']?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="altoFrente">Alto(m)</label>
                        <input type="number" name="altoFrente" id="altoFrente" value="<?= $vallas['frente_alto']?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="materialFrente">Material</label>
                        <select name="materialFrente" id="materialFrente" class="form-control form-control-sm">
                        <option value="">Sel. Material</option>
                                <?php foreach($materiales as $material){
                                if($material["id"] == $vallas["frente_id_material"]){?>
                                <option selected value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']?></option>
                                <?php }else{ ?>
                                <option value="<?=$material['id'] .','. $material['precio']?>"><?= $material['material'] ." $". $material['precio']?></option>
                                <?php }} ?> 
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group mt-3">
        <label for="observaciones">Observaciones</label>
        <textarea name="observaciones"class="form-control form-control-sm" id="observaciones"  rows="2"><?= $vallas['observaciones']?></textarea>
    </div>

    <div class="form-group">
        <label for="acabados">Acabados</label>
        <textarea name="acabados"class="form-control form-control-sm" id="acabados" rows="2"><?= $vallas['acabados']?></textarea>
    </div>

    <div class="my-4">
        <h5 class="text-center">Fotos</h5>
        <hr>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="imagen1"> Vista Corta </label>
                <input type="file" class="dropify" data-allowed-file-extensions="jpg png jpeg" id="imagen1" name="imagen1" data-default-file="<?=base_url('assets/images/medios/'.$vallas['vista_corta'])?>"/>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="imagen2"> Vista Media </label>
                <input type="file" class="dropify" data-allowed-file-extensions="jpg png jpeg" id="imagen2" name="imagen2" data-default-file="<?=base_url('assets/images/medios/'.$vallas['vista_media'])?>"/>
            </div>
        </div>
            
        <div class="col-md-4">
            <div class="form-group">
                <label for="imagen3"> Vista Larga </label>
                <input type="file" class="dropify" data-allowed-file-extensions="jpg png jpeg" id="imagen3" name="imagen3" data-default-file="<?=base_url('assets/images/medios/'.$vallas['vista_larga'])?>"/>
            </div>
        </div>
        <input type="hidden" value="<?=$vallas['id_medio']?>" name="id_medio">
    </div>
    <div class="d-flex justify-content-end my-4">
        <button class="btn btn-success " type="submit">Guardar</button>
    </div>

    </form>

    <?php endforeach?>

    <script>vallasmovilesit.classList.add("selected");</script>
<script src="<?=base_url('assets/js/vallas_moviles.js')?>"></script>