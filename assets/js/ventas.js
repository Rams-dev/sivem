ventasit.classList.add("selected");

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
$('#fechaInicio').blur(function(){
        $('#fechaInicio').removeClass("is-invalid")
})

$('#fechaTermino').blur(function(){
        $('#fechaTermino').removeClass("is-invalid")
})

$('#fechaInicio').change(function(){
        $("#tipoMedio").val("");

        console.log(this.value);
        let FI = this.value.split("-",3);
         fechaInicio = new Date(FI);
        console.log(fechaInicio);
        obtenerDias()
})

$('#fechaTermino').change(function(){
        $("#tipoMedio").val("");

        console.log(this.value);
        let FT = this.value.split("-",3);
        fechaTermino = new Date(FT);
        console.log(fechaTermino);
        obtenerDias()


})
let dias;
function obtenerDias(){
        if(fechaInicio != '' && fechaTermino != ''){
                console.log('hola')
                let meses = fechaTermino - fechaInicio;
                dias = meses / (1000 * 60 * 60 * 24 * 1) +1;
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


let datos;


$('#tipoMedio').change(function(e){
        $("#medio option[value!='']").remove();

        e.preventDefault();
        datos="";

})
  $("#tipoMedio").change(function(e){
     e.preventDefault();
     // console.log(this.value)
      if(this.value < 0 || this.value > 3 ){
          return 0;
      }
       if($("#fechaInicio").val() != "" && $("#fechaTermino").val() != ""){
               if($("#fechaInicio").val() > $("#fechaTermino").val()){
                 alertify.error('Selecciona una fecha valida')
                 this.value = ""
                 validarFechas()
                 return 0;
               }
        $.get('obtenerMedios/'+ this.value, function(response){
        if(response != ''){
                datos = JSON.parse(response)
                console.log(datos)
                rellenarMedios(datos);
        }else{
                return 0;
        }
        })
        //  datos = {};
        //  datos.medio = this.value; 
        //  datos.fechaInicio = $("#fechaInicio").val(); 
        //  datos.fechaTermino = $("#fechaTermino").val();
        //  console.log(datos) 
        //   $.ajax({
        //           url:"obtenerMediosDisponibles",
        //           type:'post',
        //           data: datos 
        //  })
        //   .done(function(response){
        //         let res = JSON.parse(response)
        //         if(response != ''){
        //                 datos = JSON.parse(response)
        //                 console.log(datos)
        //                 rellenarMedios(datos)

        //         }else{
        //                 return 0;
        //         }

        //   })
        //   .fail(function(err){
        //          console.log(err)
        //   })

       
          }else{
              alertify.error('Primero selecciona una fecha')
              this.value = ""
               validarFechas();
      }
  })


function rellenarMedios(data){
        if(data != ''){
                const medio =  document.querySelector('#medio')
                let option;
                data.map(m =>{
                        option =  document.createElement('option')
                        option.text = m.nocontrol
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
                console.log(datosMedio)
                return datosMedio;
          }else{
                  return 0;
          }
        })
})

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
        //console.log(datosMedio)

        // console.log(datosDeMedios)
        console.log(idMedios)

                datosMedio.map(medio =>{
                  console.log(medio.precio)
                  Table.innerHTML+= `<tr>
                  <td>#</td>
                  <td>${medio.nocontrol}</td>
                  <td>${medio.localidad}</td>
                  <td>$ ${medio.precio}</td>
                  </tr>`;
                //   return medio.precio;
                idMedios.push(medio.id)
                datosDeMedios.push(parseFloat(medio.precio / 31));
        console.log(datosDeMedios)
                
                calcularTotal()
          })
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
         //        const total = document.querySelector("#total");
                 preciofinal = datosDeMedios.reduce((arr,el) => arr + el)
                 preciofinal = preciofinal * dias;
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
        // descuento = Math.floor(preciof*descuento)/100;
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