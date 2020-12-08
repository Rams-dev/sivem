ventasit.classList.add("selected");

const horainicio = document.querySelector("#horainicio")
const horatermino = document.querySelector("#horatermino")
const choferdiv = document.querySelector("#choferdiv")

window.factura.addEventListener("change", function(e){
         if(this.value == "si"){
                 window.iva.classList.remove("d-none")
         }else{
                 window.iva.classList.add("d-none")
         }
         calcularTotal()
})

window.descuentoCantidad.addEventListener("change", function(e){
        if(parseFloat(this.value).toFixed(2) >= 100){
                this.value ="";
        }
})

$("#descuento").change(function(){
        if(this.value == "si"){
                $("#descuentoinput").removeClass("d-none")
        }else{
                $("#descuentoinput").addClass("d-none")
                $("#descuentoinput").val("")
        }

})


let fechaInicio = {};
let fechaTermino = {};
let FI;
let FT;
$('#fechaInicio').blur(function(){
        $('#fechaInicio').removeClass("is-invalid")
})

$('#fechaTermino').blur(function(){
        $('#fechaTermino').removeClass("is-invalid")
})

$('#fechaInicio').change(function(){
        $("#tipoMedio").val("");

        console.log(this.value);
         FI = this.value.split("-",3);
         fechaInicio = new Date(FI);
        console.log(fechaInicio);
        obtenerDias()
})

$('#fechaTermino').change(function(){
        $("#tipoMedio").val("");

        console.log(this.value);
        FT = this.value.split("-",3);
        fechaTermino = new Date(FT);
        console.log(fechaTermino);
        obtenerDias()


})
let dias;
function obtenerDias(){
        if(fechaInicio != '' && fechaTermino != ''){
                console.log(fechaInicio)
                let meses = fechaTermino - fechaInicio;
                dias = meses / (1000 * 60 * 60 * 24 * 1) + 1 ;
                if(dias<0){
                        alertify.error("las fecha de termino no puede ser menor a la de inicio");
                        validarFechas();
                        return 0;
                }
                $("#fechaInicio").removeClass("is-invalid");
                $("#fechaTermino").removeClass("is-invalid");
                console.log(dias);
                return dias; 
        }else{
                return 0;
        }
}


function obtenerHora(h1,h2){
        if(h1 != "" && h2 != ""){
                if(h1>h2){
                        alertify.error("la fecha de termino no puede ser menor a la fecha de inicio")
                }
                $("#hinicio").addClass("is-invalid");
                $("#htermino").addClass("is-invalid");
        }

}


let datos = [];


$('#tipoMedio').change(function(e){
        e.preventDefault();
        $('#hinicio').val("");
        $('#htermino').val("");
        $("#medio option[value!='']").remove();
        datos= [];

})

$("#tipoMedio").change(function(e){
        e.preventDefault();
        medio = this.value
        console.log(this.value)

        let fInicio = $("#fechaInicio").val();
        let fTermino = $("#fechaTermino").val();

        
        if($("#fechaInicio").val() != "" && $("#fechaTermino").val() != ""){
                if($("#fechaInicio").val() > $("#fechaTermino").val()){
                alertify.error('Selecciona una fecha valida')
                this.value = ""
                validarFechas()
                return 0;
                }
        
                if(medio ==  "1" || medio ==  "2" ){
                        obtenerMedios(medio)
                        // return 0;
                }
        

        
                if(medio == "3"){
                        medio = "3";
                        horainicio.classList.remove("d-none")
                        horatermino.classList.remove("d-none")
                        choferdiv.classList.remove("d-none")
                        let hI ="";
                        let hT = "";
                        $("#hinicio").change(function(){
                                // $("#medio option[value!='']").remove();
                                //         datos="";
                                hI = this.value
                                if(this.value != "" && $("#htermino").val() != ""){
                                        // obtenerChoferesDisponibles(hI,hT,fInicio,fTermino);      
                                        obtenerVallasMovilesDisponibles(hI,hT,fInicio,fTermino,medio);      
                                }
                        })
                        $("#htermino").change(function(){
                                // $("#medio option[value!='']").remove();
                                //         datos="";
                                // $("#medio option[value!='']").remove();
                                if($("#hinicio").val() != "" && this.value != ""){
                                hT = this.value 
                                //  obtenerChoferesDisponibles(hI,hT,fInicio,fTermino);    
                                        obtenerVallasMovilesDisponibles(hI,hT,fInicio,fTermino,medio);      
                                }
                        })        
                }else{
                        horainicio.classList.add("d-none")
                        horatermino.classList.add("d-none")
                        choferdiv.classList.add("d-none")

                }
        }else{
                alertify.error('Primero selecciona una fecha')
                this.value = ""
                validarFechas();
        }

})


$("#chofer").change(function(e){
        e.preventDefault();

})

function obtenerVallasMovilesDisponibles(h1,h2,fInicio,fTermino,medio){
        $.ajax({
                url: "obtenerVallasMovilesDisponibles",
                type: "post",
                //  dataType: "json",
                data: {
                        h1: h1,
                        h2: h2,
                        f1: fInicio,
                        f2: fTermino,
                        id: medio
                }
                
        })
        .done(function(response){
                let res = JSON.parse(response);
                console.log(res);
                rellenarMedios(res)
                res = "";
        })
        .fail(function(err){
                alertify.error("ha ocurrido un error");
        })


}


function obtenerChoferesDisponibles(h1,h2,fInicio,fTermino){
     
        $.ajax({
                url: "obtenerChoferesDisponibles",
                type: "post",
                //  dataType: "json",
                data: {
                        h1: h1,
                        h2: h2,
                        fi: fInicio,
                        f2: fTermino
                }
                
        })
        .done(function(response){
                let res = JSON.parse(response);
                console.log(response);
                rellenarChoferes(res);
        })
        .fail(function(err){
                alertify.error("ha ocurrido un error");
        })
}

function rellenarChoferes(data){
        const selectChoferes = document.querySelector("#chofer")
        let option;
        if(data.length > 0){
                data.map(m =>{
                        option =  document.createElement('option')
                        option.text = m.nombre+ " "+ m.apellidos;
                        option.value = m.id;
                        selectChoferes.appendChild(option)
                })
                data = "";

        }
}


function obtenerMedios(val){
        valores = {};
        valores.medio = val; 
        valores.fechaInicio = $("#fechaInicio").val(); 
        valores.fechaTermino = $("#fechaTermino").val();
        $.ajax({
                url:"obtenerMedios",
                type:'post',
                data: valores 
        })
        .done(function(response){
                if(response != ''){
                        let res = JSON.parse(response)
                        console.log(res)
                        rellenarMedios(res)

                }else{
                        return 0;
                }

        })
        .fail(function(err){
                console.log(err)
        })

}

function rellenarMedios(data){
        if(data != ''){
                const medio =  document.querySelector('#medio')
                let option;
                data.map(m =>{
                        option =  document.createElement('option')
                        if(m.tipo_medio == "Vallas movil"){
                                 option.text = m.nocontrol+ " - "+ m.marca + " " + m.modelo +" "+m.anio;
                         }else{
                                option.text = m.nocontrol+ " - "+ m.calle + " " + m.colonia +" "+m.municipio;
                         }
                        option.value = m.id_medio;
                        medio.appendChild(option)
                })
                data = "";
        }else{
                return 0;
        }
  }


$('#medio').change(function(e){
        e.preventDefault();
        console.log(this.value)
        datos = {};
         datos.medio = this.value; 
         datos.fechaInicio = $("#fechaInicio").val(); 
         datos.fechaTermino = $("#fechaTermino").val();
         console.log(datos) 
          $.ajax({
                  url:"verificarDisponibilidad",
                  type:'post',
                  data: datos 
         })
          .done(function(response){
                if(response ==""){
                        $("#error").html("");
                        $("#medio").removeClass("is-invalid")
                }else{
                
                        let res = JSON.parse(response)
                        console.log(res)
                        if(res.error){
                                $("#error").html(res.error);
                                $("#medio").addClass("is-invalid")
                                // rellenarMedios(datos)
                                return 0;
                        }
                }

          })
          .fail(function(err){
                 console.log(err)
          })

        $.get('obtenerMedioPorId/'+ this.value, function(response){
          if(response != ''){
                datosMedio = JSON.parse(response)
                // datosMedio.push(res);
                console.log(datosMedio)
                 return datosMedio;
          }else{
                  return 0;
          }
        })
})
//  let datosMedio = [];
let datosDeMedios = [];
let idMedios = [];

function validarFechas(){
        $("#fechaInicio").addClass("is-invalid");
        $("#fechaTermino").addClass("is-invalid");
}

window.add.addEventListener('click', function(e){
        e.preventDefault();
        if(datosMedio == ''){
                return 0;
        }
        if(dias == undefined || dias =="" || isNaN(dias) ){
                alertify.error("Primero debes seleccionar la fecha");
        validarFechas()
                return 0;
        }
        if(dias<0){
                alertify.error("las fecha de termino no puede ser menor a la de inicio");
                return 0;
        }
        let Table = document.querySelector("#bodyTable");
        let tipoVenta = document.querySelector("#tipoVenta");
        //console.log(datosMedio)

        // console.log(datosDeMedios)
        console.log(idMedios)
        // Table.innerHTML =""


        if(tipoVenta.value == "renta"){

                //   for(let i=0;i<datosMedio.length;i++){

                datosMedio.map(medio =>{
                        console.log(medio.precio)
                        let costototal = ((parseFloat(medio.costo_renta) + parseFloat(medio.costo_instalacion)) / 30) * dias;
                        Table.innerHTML += `<tr>
                        <td>#</td>
                        <td>${medio.nocontrol}</td>
                        <td>${medio.localidad}</td>
                        <td>$ ${medio.costo_renta} </td>
                        <td>-</td>
                        <td>$ ${medio.costo_instalacion}</td>
                        <td>$ ${parseFloat(costototal).toFixed(2)}</td>

                        </tr>`;
                        idMedios.push(medio.id)
                        datosDeMedios.push(parseFloat(costototal));
                        // console.log(datosDeMedios)
                
                        calcularTotal()
                })
                // }


        }else{
                datosMedio.map(medio =>{
                        let ctotal = ((parseFloat(medio.costo_renta) + parseFloat(medio.costo_instalacion) + parseFloat(medio.costo_instalacion)) / 30) * dias;
                        console.log(medio.precio)
                        Table.innerHTML += `<tr>
                        <td>${datosDeMedios.length + 1}</td>
                        <td>${medio.nocontrol}</td>
                        <td>${medio.localidad}</td>
                        <td>$ ${medio.costo_renta}</td>
                        <td>$ ${medio.costo_impresion}</td>
                        <td>$ ${medio.costo_instalacion}</td>
                        <td>$ ${ctotal}</td>
                        </tr>`;
                        //   return medio.precio;
                        idMedios.push(medio.id)
                        datosDeMedios.push(parseFloat(ctotal));
                        console.log(datosDeMedios)
                        
                        calcularTotal()
                })
        }
 })

 $("#descuentoCantidad").change(function(e){
         descuento = isNaN(parseFloat(this.value)) ? 0 : parseFloat(this.value);
         console.log(descuento);
         obtenerDesc()
         
})

let preciofinal = 0;
let precioIva = 0;
let descuento = 0;

        function calcularTotal(){
        const preciototal = document.querySelector("#preciototal");
        console.log( datosMedio)
//        const total = document.querySelector("#total");
         preciofinal = datosDeMedios.reduce((arr,el) => arr + el)
        // preciofinal = preciofinal ;
        // preciofinal = parseFloat(preciofinal + parseFloat(medio));
        
        if($('#factura').val() == "si"){
                let iva = parseFloat(preciofinal * .16);
                preciofinal += iva;
        }
        preciototal.innerHTML = '$ '+ parseFloat(preciofinal).toFixed(2);
        $("#monto").val(preciofinal);
        console.log(preciofinal)
        obtenerDesc()
        

}

function obtenerDesc(){
        const desc = document.querySelector("#desc");
        console.log("ahh" + preciofinal)
        descuentot = parseFloat(preciofinal *(descuento/100)).toFixed(2);
        desc.innerHTML = '$ '+ descuentot;
        console.log(descuentot)
        obtenerPrecioTotal()
        return descuentot;
}

function obtenerPrecioTotal(){
        const precioConDesc = document.querySelector('#precioConDescuento')
        precio_total = parseFloat(preciofinal - descuentot).toFixed(2);
        precioConDesc.innerHTML = '$ ' + precio_total;
        return precio_total;

}

$("#guardarventa").submit(function(e){
    e.preventDefault();

    let formData = new FormData($("#guardarventa")[0]);
    formData.set('idmedios',idMedios);
    formData.set("descuento",descuentot);
    formData.set("precio_final",precio_total);
    $.ajax({
            url:'guardarVenta',
            type:'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
    })
    .done(function(response){
            let res = JSON.parse(response);
            console.log(res)
            if(res.success){
                alertify.success(res.success)
                $("#guardarventa")[0].reset();
                $("#precioConDescuento").html("");
                $("#desc").html("$ 0");
                $("#preciototal").html("$ 0");
                $("#bodyTable").html("$ 0");
                preciofinal = 0;
                precioIva = 0;
                descuento = 0;
                datosDeMedios = [];
                idMedios = [];
                dias =0;
            }else{
                alertify.error(res.error)

            }
    })
    .fail(function(err){
            console.log("algo salio mal");
    })
})



/* ---------------------------------------- M A S K--------------------------------- */

// $("#descuentoCantidad").mask("SS%")