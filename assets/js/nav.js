$("#menu").click(function(e){
    e.preventDefault();
    $(".sidenav").toggle("800")
    // $("#menu").html(" <li class='navbar-horizontal_li' id='menuUp> <a >MENU <i class='fas fa-times'></i> </a></li>  ")
})



// function capitalize(str){
//     return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
// }

// let text = document.getElementsByTagName('input');
// text.addEventListener('keypress', e => {
// setTimeout(() => {input.value = capitalize(input.value)}, 1)
// })



// function verificarNoControlExiste(value){
//     $.ajax({
//         url:"catalogos/noControlExiste",
//         type:"post",
//         data:{nc:value},
//     })
//     .done(function(response){
//         let res = JSON.parse(response);
//         if(res.error){
//            alertify.error(res.error)
//         }
//     })

// }