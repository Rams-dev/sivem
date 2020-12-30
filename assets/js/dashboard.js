const p = location.href
p2  = p.lastIndexOf("admin")
let path = p.slice(0, p2)
console.log(path);
const divMensaje = document.querySelector("#mensajesDemediosPorTerminarContrato");

(function obtenerMediosPorTerminarContrato(){
    $.get(path+"admin/dashboard/obtenerMediosQueVanATerminarContrato", function(response){
        let res = JSON.parse(response);
        enviarNotificacion(res.total);
        mostrarMediosPorTerminarContrato(res.medios)
    })

    
})()


function enviarNotificacion(numero){
    divMensaje.innerHTML = ` <div class="alert alert-warning alert-dismissible fade show text-center text-dark" role="alert">
        Este mes vencerá el contrato de ${numero} Medios, echa un vistazo para saber cuales son.
        <button class="btn btn-info btn-sm" data-toggle="modal" data-target="#MediosPorVencerContrato">Echar un vistazo</button>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    ` ;

}

function mostrarMediosPorTerminarContrato(medios){
    const contenedorModal = document.querySelector(".modal-body");
    medios.map(medio =>{
        // console.log(medio)
        contenedorModal.innerHTML += `
        <div class="card my-2">
           <div class="card-header">
                <div class="d-flex justify-content-between p-2">
                    <div class="title">
                        Clave master: <span class="text-danger"> ${medio.nocontrol}</span>
                    </div>
                    <div class="title">
                        Fecha de termino: <span class="text-danger"> ${medio.fecha_termino}</span>
                    </div>
                </div>
            </div>
            <div class="card-body modalBody">
            <div class="row justify-content-between">
                <div class="col-md-3 col-sm-3">
                <img src="${path}assets/images/medios/${medio.vista_media}" class="imagen-modal" alt="">
                </div>
                <div class="col-md-9">
                    <div class="d-flex ">
                        <div class="col-md-6 col-sm-6 modalp">
                            <p><b>Propietario: </b><span>${medio.nombre} <span></p>
                            <p><b>Telefono: </b><span>${medio.telefono} <span></p>
                            <p><b>Celular: </b><span>${medio.celular} <span></p>
                            <p><b>Municipio: </b><span>${medio.municipio} <span></p>
                        </div>
                        <div class="col-md-6 modalp">
                            <p><b>Tipo de medio: </b><span>${medio.tipo_medio} <span></p>
                            <p><b>Medidas: </b><span>${medio.ancho}m x ${medio.alto}m <span></p>
                            <p><b>Costo: </b><span>${medio.monto} <span></p>
                            <p><b>Status: </b><span>${medio.status} <span></p>
                        </div>
                    </div>

                </div>
                
                
            </div>
            </div>
        </div>
        `
    })
  

}