
  const selectStatus = document.querySelector("#status");
  const inicioOcupacion = document.querySelector("#desdeDiv");
  const terminoOcupacion = document.querySelector("#hastaDiv");
  const costoImpresion = document.querySelector("#costoImpresion");


selectStatus.addEventListener("change", function(e){
    e.preventDefault();
    console.log(this.value)
    if(this.value == "OCUPADO"){
        terminoOcupacion.classList.remove("d-none");
        inicioOcupacion.classList.add("d-none");

    }else if(this.value == "APARTADO"){
        inicioOcupacion.classList.remove("d-none");
        terminoOcupacion.classList.remove("d-none");
    }else{
        inicioOcupacion.classList.add("d-none");
        terminoOcupacion.classList.add("d-none");
    }
})

window.anchoLateral.addEventListener("change", function(e){
    e.preventDefault();
     anchoLateral = parseFloat(this.value);
    calcularPrecioLateral(); 
})

window.altoLateral.addEventListener("change", function(e){
    e.preventDefault();
    altoLateral = parseFloat(this.value) ;
    calcularPrecioLateral(); 
})


window.materialLateral.addEventListener("change", function(e){
    e.preventDefault();
    let val = this.value.split(",")
    materialLateral =parseFloat(val[1]);
    calcularPrecioLateral(); 
})



/************* FALDON *********** */


window.anchoFaldon.addEventListener("change", function(e){
    e.preventDefault();
     anchoFaldon = parseFloat(this.value);
    calcularPrecioFaldon(); 
})

window.altoFaldon.addEventListener("change", function(e){
    e.preventDefault();
    altoFaldon = parseFloat(this.value) ;
    calcularPrecioFaldon(); 
})


window.materialFaldon.addEventListener("change", function(e){
    e.preventDefault();
    let val = this.value.split(",")
    materialFaldon =parseFloat(val[1]);
    calcularPrecioFaldon(); 
})



/************* PUERTA *********** */


window.anchoPuerta.addEventListener("change", function(e){
    e.preventDefault();
     anchoPuerta = parseFloat(this.value);
    calcularPrecioPuerta(); 
})

window.altoPuerta.addEventListener("change", function(e){
    e.preventDefault();
    altoPuerta = parseFloat(this.value) ;
    calcularPrecioPuerta(); 
})


window.materialPuerta.addEventListener("change", function(e){
    e.preventDefault();
    let val = this.value.split(",")
    materialPuerta =parseFloat(val[1]);
    calcularPrecioPuerta(); 
})


/************* FRENTE *********** */


window.anchoFrente.addEventListener("change", function(e){
    e.preventDefault();
     anchoFrente = parseFloat(this.value);
    calcularPrecioFrente(); 
})

window.altoFrente.addEventListener("change", function(e){
    e.preventDefault();
    altoFrente = parseFloat(this.value) ;
    calcularPrecioFrente(); 
})


window.materialFrente.addEventListener("change", function(e){
    e.preventDefault();
    let val = this.value.split(",")
    materialFrente =parseFloat(val[1]);
    calcularPrecioFrente(); 
})



let anchoLateral=0;
let altoLateral=0;
let materialLateral = 0;

let anchoFaldon="";
let altoFaldon="";
let materialFaldon = "";

let anchoPuerta="";
let altoPuerta="";
let materialPuerta = "";

let anchoFrente="";
let altoFrente="";
let materialFrente = "";

let precioLateral =0;
let precioFaldon =0;
let precioPuerta =0;
let precioFrente =0;




function calcularPrecioLateral(){
    if(anchoLateral != "" &&  altoLateral != "" && materialLateral != ""){
        let p = anchoLateral * altoLateral;
        precioLateral = (p * materialLateral) * 2;
        console.log(precioLateral)
        calcularPrecioInstalacion()
    }else{
        return 0;
    }
}



function calcularPrecioFaldon(){
    if(anchoFaldon != "" &&  altoFaldon != "" && materialFaldon != ""){
        let p = anchoFaldon * altoFaldon;
        precioFaldon = (p * materialFaldon) * 2;
        console.log(precioFaldon)
        calcularPrecioInstalacion()
    }else{
        return 0;
    }
}

function calcularPrecioPuerta(){
    if(anchoPuerta != "" &&  altoPuerta != "" && materialPuerta != ""){
        let p = anchoPuerta * altoPuerta;
        precioPuerta = (p * materialPuerta) * 2;
        console.log(precioPuerta)
        calcularPrecioInstalacion()
    }else{
        return 0;
    }
}


function calcularPrecioFrente(){
    if(anchoFrente != "" &&  altoFrente != "" && materialFrente != ""){
        let p = anchoFrente * altoFrente;
        precioFrente = (p * materialFrente) * 2;
        console.log(precioFrente)
        calcularPrecioInstalacion()
    }else{
        return 0;
    }
}


function calcularPrecioInstalacion(){
    if(precioLateral != "" && precioFaldon != "" && precioPuerta != "" && precioFrente != ""){
        let precioImpresion
        precioImpresion = precioLateral + precioFaldon + precioFrente + precioPuerta;
        console.log(precioImpresion);
        agregarPrecioInput(precioImpresion)

    }else{
        return 0;
    }
}

function agregarPrecioInput(precioImpresion){
    if(isNaN(precioImpresion)){
        costoImpresion.value = ""
        window.costoTotal.value= "";
    }else{
        costoImpresion.value = precioImpresion;
        calcularCostoTotal(precioImpresion);

    }
}

function calcularCostoTotal(impresion){
    let renta = parseFloat(window.renta.value.replace("$","").trim())
    precioTotal = renta + impresion;
    console.log(precioTotal)
    window.costoTotal.value=precioTotal;
}






$("#guardarValla_movil").submit(function(e){
    e.preventDefault();

    let formData = new FormData($("#guardarValla_movil")[0]);
    $.ajax({
        url:"guardarValla_movil",
        type:"post",
        data: formData,
        cache:false,
        contentType:false,
        processData:false
    })
    .done(function(response){
        let res = JSON.parse(response);
        console.log(res);
        respuesta(res)        
    })
    .fail(function(err){
        alertify.error("Error, intenta mas tarde");
    })

})


function respuesta(res){
    if(res.success){
        alertify.success(res.success);
        location.reload();
    }
    if(res.error){
        alertify.error(res.error);
        console.log(res.error)
    }
}


function eliminarValla(id_medio){
    console.log(id_medio)
    $.ajax({
        url:"vallas_moviles/eliminarValla",
        type:"post",
        data:{id_medio:id_medio},
    })
    .done(function(response){
        let res = JSON.parse(response);
        console.log(res);
        respuesta(res);
    })
    .fail(function(err){
        alertify.error("ocurrio un error");
    })
}


$("#editarValla_movil").submit(function(e){
    e.preventDefault();
    let formData = new FormData($("#editarValla_movil")[0]);

    $.ajax({
        url:'../guardarValla_movilEditado',
        type:"post",
        data:formData,
        cache:false,
        contentType:false,
        processData:false
    })
    .done(function(response){
        let res = JSON.parse(response);
        console.log(res)
        respuesta(res)
    })
    .fail(function(err){
        console.log("Error, intenta más tarde");
    })

})


$("#anio").mask("0000")

