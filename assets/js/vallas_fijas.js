

    const selectUbicacion = document.getElementById("ubicacion");
    const selectUbicaciones = document.querySelector("#ubicaciones");
    const calle = document.querySelector("#calle");
    const numero = document.querySelector("#numero");
    const colonia = document.querySelector("#colonia");
    const localidad = document.querySelector("#localidad");
    const estado = document.querySelector("#estado");
    const municipio = document.querySelector("#municipio");
    const nombre = document.querySelector("#nombre");
    const telefono = document.querySelector("#telefono");
    const celular = document.querySelector("#celular");

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
    const propietario = document.querySelector("#propietario");

    propietario.addEventListener("change", function(e){
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
     estado = estado[1]
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
    })
    .fail(function(err){
        console.log(err)
    })
    .always(function(alwais){

    })
})


/*-----------   M A S K     ----------------------------------------- */

