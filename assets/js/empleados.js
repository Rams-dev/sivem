$("#frmAgregar").submit(function(e){
    e.preventDefault();

    let formData = new FormData($("#frmAgregar")[0]);
    $.ajax({
        url:'empleados/agregarEmpleado',
        type: 'post',
        data:formData,
        cache:false,
        contentType:false,
        processData:false
        
    })
    .done(function(response){
        let res = JSON.parse(response)
        doneFunction(response)
    })
    .fail(function(err){
        console.log("error")
    })

})

/*-------------------------------- E D I T A R  -------------------------------------------- */


function EditarEmpleado(id){
    $.get("empleados/getEmpleadoPoId/"+ id,function(response){
        let res = JSON.parse(response)
        console.log(res[0]);
        RellenarInputs(res)
    })

}

let id;
function RellenarInputs(data){
    data.map(d=>{
        id=d.id;
        window.Enombre.value = d.nombre;
        window.Eapellidos.value = d.apellidos;
        window.Ecorreo.value = d.correo;
        window.Etelefono.value = d.telefono;
        window.Epuesto.value = d.puesto;
        window.Elicencia.value = d.licencia;
        window.Esexo.value = d.sexo;
        window.Eacceso.value = d.acceso;
        if(d.acceso == "si"){
            EinputSistema.classList.remove("d-none")
        }else{
            EinputSistema.classList.add("d-none")

        }
        window.Econtrasenia.value = d.contrasena;
        window.Etipo.value = d.tipo;
        
    })
}

$("#frmEditar").submit(function(e){
    e.preventDefault();
    let formData = new FormData($("#frmEditar")[0]);
    formData.set("id",id);
 
    $.ajax({
        url:"empleados/editaEmpleado",
        type:'post',
        data:formData,
        cache:false,
        contentType:false,
        processData:false
    })
    .done(function(response){
       doneFunction(response);

    })
    .fail(function(err){
        console.log("error")
    })

})

/*-------------------------------- E L I M I N A R  -------------------------------------------- */


function eliminarEmpleado(id){
    
alertify.confirm("Espera","¿Esta seguro que desea eliminar este empleado?",
  function(){
      
    $.ajax({
        url:'empleados/eliminarEmpleado',
        type:'post',
        data:{id:id}
    })
    .done(function(response){
        alertify.success("Eliminado")
        location.reload();
    })
    .fail(function(err){
        console.log("ha ocurrido un error")
    })
},
function(){
//   alertify.error('Cancel');
});
}





function doneFunction(response){
    let res = JSON.parse(response)
     if(res.success){
         $("#modalEditar").modal("hide");
         alertify.success(res.success)
         setTimeout(() => {
             location.reload();
         },1500)
     }
     if(res.error){
         alertify.error(res.error);
     }
}





/*-------------------------------- M A S K -------------------------------------------- */
$("#telefono").mask("000-000-00-00");


const btnAccesso = document.getElementById("acceso");
const EbtnAccesso = document.getElementById("Eacceso");
const inputSistema = document.querySelector("#inputSistema");
const EinputSistema = document.querySelector("#EinputSistema");


btnAccesso.addEventListener("change", function(e){
    e.preventDefault()
    console.log(e.target.value)
    if(e.target.value == "si"){
        inputSistema.classList.remove("d-none")    
    }else{
        inputSistema.classList.add("d-none")    
    }
})


EbtnAccesso.addEventListener("change", function(e){
    e.preventDefault()
    console.log(e.target.value)
    if(e.target.value == "si"){
        EinputSistema.classList.remove("d-none")    
    }else{
        EinputSistema.classList.add("d-none")    
    }
})


