/* MANEJO DEL DOM Y DECALARACION DE VARIABLES */

ventasit.classList.add("selected");
const horainicio = document.querySelector("#horainicio")
const horatermino = document.querySelector("#horatermino")
const choferdiv = document.querySelector("#choferdiv")
const descuentoCantidadvendedor = document.querySelector(".descuentoCantidadvendedor")

let fechaInicio = {};
let fechaTermino = {};
let FI;
let FT;
let dias;
let datosDeMedios = [];
let idMedios = [];
let idChofer;
let preciofinal = 0;
let precioIva = 0;
let descuento = 0;
let arrayMedios = [];


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
                $("#descuentoCantidad").val("")
                descuento = 0;
                obtenerDesc()
        }
})

descuentoCantidadvendedor.addEventListener("keyup", function(e){
        e.preventDefault();
        if(esMayorA20(e.target.value)){
                this.value = 20
        }
})

function esMayorA20(number){
        if(number>20){
                return true;
        }else{
                return false;
        }
}

window.tipoVenta.addEventListener("change", function(e){
        e.preventDefault()
        if(e.target.value == "renta"){
                window.VM.classList.add("d-none");
        }else{
                window.VM.classList.remove("d-none");
        }
})

$('#fechaInicio').blur(function(){
        $('#fechaInicio').removeClass("is-invalid")
})

$('#fechaTermino').blur(function(){
        $('#fechaTermino').removeClass("is-invalid")
})

/*   FIN DEL MANEJO DEL DOM */


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
                removeErrorFechas()
                console.log(dias);
                return dias;
        }else{
                return 0;
        }
}
let medio = "";
$("#tipoMedio").change(function(e){
        e.preventDefault();
        medio = this.value
        console.log(this.value)
        datos= [];
  


        if($("#fechaInicio").val() != "" && $("#fechaTermino").val() != ""){
                if($("#fechaInicio").val() > $("#fechaTermino").val()){
                alertify.error('Selecciona una fecha valida')
                this.value = ""
                validarFechas()
                return 0;
                }

                if(medio ==  "1" || medio ==  "2" ){
                        $('#hinicio').val("");
                        $('#htermino').val("");
                        $("#medio option[value!='']").remove();
                        obtenerMedios(medio)
                }

                if(medio == "3"){
                        horainicio.classList.remove("d-none")
                        horatermino.classList.remove("d-none")
                        choferdiv.classList.remove("d-none")
             
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


let hI="";
let hT ="";

horainicio.addEventListener("change",function(e){
        hI = e.target.value
        $("#medio option[value!='']").remove();
        $("#chofer option[value!='']").remove();
        obtenerChoferesDisponibles();
        obtenerVallasMovilesDisponibles();

})

horatermino.addEventListener("change",function(e){
        hT = e.target.value
         $("#medio option[value!='']").remove();
         $("#chofer option[value!='']").remove();
        obtenerChoferesDisponibles();
        obtenerVallasMovilesDisponibles();
})


window.chofer.addEventListener("change", function(e){
        e.preventDefault();
        idChofer = e.target.value;
})


function obtenerVallasMovilesDisponibles(){
        fInicio = $("#fechaInicio").val();
        fTermino = $("#fechaTermino").val();
     if(validarHora()){
             console.log(fInicio)
        $.ajax({
                url: "obtenerVallasMovilesDisponibles",
                type: "post",
                data: {
                        h1: hI,
                        h2: hT,
                        f1: fInicio,
                        f2: fTermino,
                        id: medio
                }

        })
        .done(function(response){
                let res = JSON.parse(response);
                rellenarMedios(res)
                res = "";
        })
        .fail(function(err){
                alertify.error("ha ocurrido un error");
        })
     }


}

function validarHora(){
        console.log()
        if($("#hinicio").val() != "" && $("#htermino").val() != ""){
                return true;
        }else{
                return false;
        }
}

function obtenerChoferesDisponibles(){
        fInicio = $("#fechaInicio").val();
        fTermino = $("#fechaTermino").val();
        if(validarHora()){
                $.ajax({
                        url: "obtenerChoferesDisponibles",
                        type: "post",
                        data: {
                                h1: hI,
                                h2: hT,
                                f1: fInicio,
                                f2: fTermino
                        }
        
                })
                .done(function(response){
                        let res = JSON.parse(response);
                        // console.log(response);
                        rellenarChoferes(res);
                        res = ""
                })
                .fail(function(err){
                        alertify.error("ha ocurrido un error");
                })
        }
}

function rellenarChoferes(data){
        const selectChoferes = document.querySelector("#chofer")
        let option;
        if(data != ""){
                if(arrayMedios.length > 0){
                        for(let x = 0; x<arrayMedios.length; x++){
                                for(let y = 0; y<arrayMedios[x].length; y++){
                                       data = data.filter(me => me.id != arrayMedios[x][y].idChofer)
                                }
                        }
                }
                console.log(data)
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
        console.log(valores.fechaInicio)
        $.ajax({
                url:"obtenerMedios",
                type:'post',
                data: valores
        })
        .done(function(response){
                if(response != ''){
                        let res = JSON.parse(response)
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

                if(arrayMedios.length > 0){
                        for(let x = 0; x<arrayMedios.length; x++){
                                for(let y = 0; y<arrayMedios[x].length; y++){
                                        //  console.log(arrayMedios[x][y].id_medio)
                                      data = data.filter(me => me.id_medio != arrayMedios[x][y].id_medio)
                        }}
                }
                console.log(data)
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
        $("#medio").removeClass("is-invalid");
        console.log(this.value)
        $.get('obtenerMedioPorId/'+ this.value, function(response){
          if(response != ''){
                datosMedio = JSON.parse(response)
                // datosMedio.push(res);
                console.log(datosMedio)
                datosMedio[0]["idChofer"] = idChofer;
                datosMedio[0]["hInicio"] = hI;
                datosMedio[0]["hTermino"] = hT;
                arrayMedios.push(datosMedio);
                hI ="";
                hT="";
                idChofer ="";
          }else{
                  return 0;
          }
        })
})


function removeErrorFechas(){
        $("#fechaInicio").removeClass("is-invalid");
        $("#fechaTermino").removeClass("is-invalid");
}

function validarFechas(){
        $("#fechaInicio").addClass("is-invalid");
        $("#fechaTermino").addClass("is-invalid");
}

window.add.addEventListener('click', function(e){
        
        e.preventDefault();
        if(arrayMedios == "" || $("#medio").val() == ""){
                alertify.error("Agregar primero un medio");
                $("#medio").addClass("is-invalid");
                return 0;
        }
        horainicio.classList.add("d-none")
        horatermino.classList.add("d-none")
        $('#hinicio').val("");
        $('#htermino').val("");
        choferdiv.classList.add("d-none")
        $("#medio option[value!='']").remove();
        $("#chofer option[value!='']").remove();

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
        rellenarTabla()

 })


 function EliminarMedioDeLaTabla(medio_id){
        console.log(medio_id);
        arrayMedios.splice(medio_id,1)
        console.log(arrayMedios)
        rellenarTabla()
}

 function rellenarTabla(){
        let Table = document.querySelector("#bodyTable");
        let tipoVenta = document.querySelector("#tipoVenta");
        //console.log(datosMedio)
        console.log(idMedios)
        Table.innerHTML =""

        for(let medios=0; medios < arrayMedios.length; medios++){
                arrayMedios[medios].map(medio =>{
                        if(medio.tipo_medio == "Vallas movil"){
                                console.log(medio.precio)
                                
                                medio["costototal"] = parseFloat(parseFloat((medio.costo_renta / 30) * dias) + parseFloat(medio.costo_impresion)).toFixed(2);
                                Table.innerHTML += `<tr>
                                <td><button class="btn btn-danger btn-sm" type="button" onclick="EliminarMedioDeLaTabla(${medios})">-</button></td>
                                <td>${medios + 1}</td>
                                <td>${medio.nocontrol}</td>
                                <td>${medio.tipo_medio}</td>
                                <td>-</td>
                                <td>$ ${medio.costo_renta} </td>
                                <td>-</td>
                                <td>$ ${medio.costo_impresion}</td>
                                <td>$${medio.costototal} </td>

                                </tr>`;
                        }else{
                        if(tipoVenta.value == "renta"){
                                console.log(medio.precio)
                                medio["costototal"] = parseFloat(parseFloat((medio.costo_renta / 30) * dias) + parseFloat(medio.costo_instalacion)).toFixed(2);
                                Table.innerHTML += `<tr>
                                <td><button class="btn btn-danger btn-sm" type="button" onclick="EliminarMedioDeLaTabla(${medios})">-</button></td>
                                <td>${medios + 1}</td>
                                <td>${medio.nocontrol}</td>
                                <td>${medio.tipo_medio}</td>

                                <td>${medio.localidad}</td>
                                <td>$ ${medio.costo_renta} </td>
                                <td>$ ${medio.costo_instalacion}</td>
                                <td>-</td>
                                <td>$${medio.costototal} </td>

                                </tr>`;
                        }else{
                                medio["costototal"] = parseFloat(parseFloat((medio.costo_renta / 30) * dias) + parseFloat(medio.costo_instalacion) + parseFloat(medio.costo_impresion)).toFixed(2);
                                console.log(medio.precio)

                                Table.innerHTML += `<tr>
                                <td><button class="btn btn-danger btn-sm" type="button" onclick="EliminarMedioDeLaTabla(${medios})">-</button></td>
                                <td>${medios + 1}</td>
                                <td>${medio.nocontrol}</td>
                                <td>${medio.tipo_medio}</td>

                                <td>${medio.localidad}</td>
                                <td>$ ${medio.costo_renta}</td>

                                <td>$ ${medio.costo_instalacion}</td>
                                <td>$ ${medio.costo_impresion}</td>
                                <td>$ ${medio.costototal}</td>
                                </tr>`;

                        }
                }

                })
               
        }
        hI="";
        hT="";
        console.log(arrayMedios)
        calcularTotal()
 }


 $("#descuentoCantidad").change(function(e){
         descuento = isNaN(parseFloat(this.value)) ? 0 : parseFloat(this.value);
         console.log(descuento);
         obtenerDesc()

})



function calcularTotal(){
        const preciototal = document.querySelector("#preciototal");
        let costototal =0.0;
        for(let val of arrayMedios){
                for(let id of val){
                       costototal += parseFloat(id.costototal);
                }
        }
        preciofinal = costototal;
        console.log(preciofinal)

        //  preciofinal = preciofinal ;
        //  preciofinal = parseFloat(preciofinal + parseFloat(medio));

        if($('#factura').val() == "si"){
                let iva = parseFloat(preciofinal * .16);
                preciofinal += iva;
        }
        preciototal.innerHTML = '$ '+ parseFloat(preciofinal).toFixed(2);
        $("#monto").val(preciofinal);
        $("#medio").val("");
        $("#tipoMedio").val("");
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
        if(arrayMedios ==""){
                alertify.error("Agrega medios a la tabla");
                return 0;   
        }
        for(let x = 0; x<arrayMedios.length; x++){
                for(let y = 0; y<arrayMedios[x].length; y++){
                        // console.log(y.id)
                        idMedios.push(arrayMedios[x][y].id_medio)
        }}

    let formData = new FormData($("#guardarventa")[0]);
    formData.set('idmedios',idMedios);
    formData.set("descuento",descuentot);
    formData.set("precio_final",precio_total);
    formData.set("medios",JSON.stringify(arrayMedios));
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
                    setTimeout(() => {
                    location.reload();
                }, 1500);
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