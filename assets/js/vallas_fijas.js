

    const selectUbicacion = document.getElementById("ubicacion");
    const selectUbicaciones = document.querySelector("#ubicaciones");
    const calle = document.querySelector("#calle");
    const numero = document.querySelector("#numero");
    const colonia = document.querySelector("#colonia");
    const localidad = document.querySelector("#localidad");
    const estado = document.querySelector("#estado");
    const municipio = document.querySelector("#municipio");
    const nombre = document.querySelector("#nombre");
    const telefono = document.querySelector("#telefonoDiv");
    const celular = document.querySelector("#celularDiv");

    // selectUbicacion.addEventListener("change",function(e){
    //     e.preventDefault()
    //     if(selectUbicacion.value == "guardada"){
    //         selectUbicaciones.classList.add("d-block")
    //         calle.classList.add("d-none")
    //         numero.classList.add("d-none")
    //         colonia.classList.add("d-none")
    //         localidad.classList.add("d-none")
    //         estado.classList.add("d-none")
    //         municipio.classList.add("d-none")
       
            
    //     }else{
    //         selectUbicaciones.value = "";
    //         selectUbicaciones.classList.remove("d-block")
    //         calle.classList.remove("d-none")
    //         numero.classList.remove("d-none")
    //         colonia.classList.remove("d-none")
    //         localidad.classList.remove("d-none")
    //         estado.classList.remove("d-none")
    //         municipio.classList.remove("d-none")
    //     }
    // })
    // const propietario = document.querySelector("#propietario");

    window.propietario.addEventListener("change", function(e){
        e.preventDefault()
        if(this.value == "registrado"){
            window.propietariosReg.classList.add("d-block");
            nombre.classList.add("d-none");
            celular.classList.add("d-none");
            telefono.classList.add("d-none");
        }else{
            window.propietariosReg.classList.remove("d-block")
            nombre.classList.remove("d-none")
            celular.classList.remove("d-none")
            telefono.classList.remove("d-none")

        }
    })


    
    window.estadoselect.addEventListener('change', function(e){
    e .preventDefault()
     let estado = this.value.split(',');
     estado = estado[1].replace(/[\u0300-\u036f]/g, "")
     console.log(estado)
     obtenerMunicipios(estado)
})

async function obtenerMunicipios(estado){
    try{
        const res = await fetch(`https://api-sepomex.hckdrk.mx/query/get_municipio_por_estado/${estado}`)
        const data = await res.json()
        console.log(data.response.municipios)
        agregarMunicipiosSelect(data.response.municipios)
    }catch(err){
    console.log(err)
    }
}

function agregarMunicipiosSelect(municipios){
    let municipioselect = document.querySelector('#municipioselect')
    let option;
    for(let i=0; i<municipios.length; i++){
        option =  document.createElement('option')
        option.text =municipios[i]
        option.value = municipios[i]
        municipioselect.appendChild(option)
    }
}


$('#estadoselect').change(function(e){
    $("#municipioselect option[value!='']").remove();

    e.preventDefault();
    datos="";

})


const material = 65;
let instalacionM2= 35;
let ancho = 0;
let alto = 0;
let area= 0;
let CInstalacion = 0;
let CImpresion = 0;
let precioTotal = 0;

$("#ancho").change(function(e){
    e.preventDefault()
    ancho = this.value;
    calcularArea();

})

$("#alto").change(function(e){
    e.preventDefault()
    alto = this.value;
    calcularArea()

})


function calcularArea(){
    if(alto > 0 && alto > 0){
        area = parseFloat(alto * ancho).toFixed(2);
        console.log(area);
        calcularCostoInstalacion()
    }
}

function calcularCostoInstalacion(){
    CInstalacion = parseFloat(area * instalacionM2).toFixed(2);
    window.costodeinstalacion.value = '$ '+ CInstalacion;
    calcularCostoImpresion();
}

function calcularCostoImpresion(){
    CImpresion = parseFloat(area * material).toFixed(2);
    window.costodeimpresion.value = '$ '+ CImpresion;
    calcularPrecio();   

}

function calcularPrecio(){
    // CInstalacion = parseFloat(CInstalacion).toFixed(2);
    // console.log(typeof(CInstalacion))
    precioTotal = parseFloat(parseFloat(CImpresion) + parseFloat(CInstalacion)).toFixed(2);
    console.log(precioTotal)
    window.precio.value = '$ ' + precioTotal;

    
}




/* G U A R D A R   V A L L A */


$("#guardarVallaFija").submit(function(e){
    e. preventDefault();
    var formdata = new FormData($("#guardarVallaFija")[0]);

    $.ajax({
        url: 'guardarVallaFija',
        type: 'post',
        data: formdata,
        cache: false,
        contentType: false,
        processData: false
    })
    .done(function(response){
        console.log(response)
        let res = JSON.parse(response);
        if(res.success){
            alertify.success(res.success);
            $("#guardarVallaFija")[0].reset();
            
        }
        
        if(res.error){
            alertify.error(res.error);
        }
    })
    .fail(function(err){
        console.log(err)
    })
    .always(function(alwais){

    })
})

/*----------------------------------> E L I M I N A R   V A  L L A S   F I J A S <----------------------------------- */


function eliminarValla_fija(id){
    console.log(id)
    $.ajax({
        url: 'vallas_fijas/eliminarVallaFija',
        type: 'post',
        data: {id:id},
    })
    .done(function(response){
        let res = JSON.parse(response);
        console.log(res)
        if(res.success){
            alertify.success(res.success);
        }
        if(res.error){
            alertify.error(res.error);
        }
    })
    .fail(function(err){
        console.log(err)
        alertify.error("error intenta mas tarde");
    })
    .always(function(ok){
        window.location.reload();

    })
}



/*-----------   M A S K     ----------------------------------------- */

$(document).ready(function(){
    $('#numero').mask('00000');

    $('#celular').mask('000-000-00-00');
   $("#telefono").mask('000-000-00-00');

 })

/*----------------------------------> E D I T A R   V A  L L A    F I J A  <----------------------------------- */


$("#editarVallaFija").submit(function(e){
    e.preventDefault();
    let formData = new FormData($("#editarVallaFija")[0])
    $.ajax({
        url:"../guardarVallaFijaEditada",
        type:"post",
        data: formData,
         contentType:false,
        cache:false,
        processData:false,
    })
    .done(function(response){
        let res= JSON.parse(response);
        if(res.success){
            alertify.success(res.success)
        }
        if(res.error){
            alertify.error(res.error)
        }
        console.log(res)

    })
    .fail(function(err){
        console.log("error");
        alertify.error("Error al enviar los datos");
    })
})

