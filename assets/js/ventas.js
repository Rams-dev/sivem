window.factura.addEventListener("change", function(e){
         if(this.value == "si"){
                 window.iva.classList.add("d-block")
         }else{
                 window.iva.classList.remove("d-block")
         }
         calcularTotal()
})



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
      $.get('obtenerMediosDisponibles/'+ this.value, function(response){
          if(response != ''){
                datos = JSON.parse(response)
                console.log(datos)
                rellenarMedios(datos)

          }else{
                  return 0;
          }
        })
  })


function rellenarMedios(data){
        if(data != ''){
                const medio =  document.querySelector('#medio')
                let option;
                data.map(m =>{
                        option =  document.createElement('option')
                        option.text = m.nocontrol
                        option.value = m.id;
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

window.add.addEventListener('click', function(e){
        e.preventDefault();
        if(datosMedio == ''){
                return 0;
        }
        let Table = document.querySelector("#bodyTable");
        //console.log(datosMedio)

        console.log(datosDeMedios)
        console.log(idMedios)

                datosMedio.map(medio =>{
                  console.log(medio.precio)
                  Table.innerHTML+= `<tr>
                  <td>#</td>
                  <td>${medio.nocontrol}</td>
                  <td>${medio.localidad}</td>
                  <td>$ ${medio.monto}</td>
                  </tr>`;
                //   return medio.precio;
                idMedios.push(medio.id)
                datosDeMedios.push(parseFloat(medio.monto));

                  calcularTotal()
          })
 })

        let preciofinal = 0;
        let precioIva = 0;
function calcularTotal(){
       const preciototal = document.querySelector("#preciototal");
        preciofinal = datosDeMedios.reduce((arr,el) => arr + el)
        // preciofinal = parseFloat(preciofinal + parseFloat(medio));
        if($('#factura').val() == "si"){
                let iva = preciofinal * .16;
                preciofinal += iva;
        }
        preciototal.innerHTML = '$ '+ preciofinal;
        $("#monto").val(preciofinal);
        console.log(preciofinal)

}

$("#guardarventa").submit(function(e){
    e.preventDefault();

    let formData = new FormData($("#guardarventa")[0]);
    formData.set('idmedios',idMedios)
    $.ajax({
            url:'guardarVenta',
            type:'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
    })
    .done(function(resonse){
            let res = JSON.parse(resonse);
            if(res.success){
                    alertify.success(res.success)
                    $("#guardarventa")[0].reset();
            }else{
                alertify.error(res.error)

            }
            
    })
    .fail(function(err){
            console.log(err);
    })
})