$("#loginForm").submit(function(e){
    e.preventDefault()

    $.ajax({
        url: 'login/validate',
        datatype: 'JSON',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
            var json = JSON.parse(response);
            window.location.replace(json.url);
        },
        statusCode: {
            400: function(xhr){
                $('#correo > input').removeClass('is-invalid');
                $('#contrasena > input').removeClass('is-invalid');
                var json = JSON.parse(xhr.responseText);
                console.log(json)
                if(json.correo.length != 0){
                    $('#correo > div').html(json.correo)
                    $('#correo > input').addClass('is-invalid');
                }
                if(json.contrasena.length != 0){
                    $('#contrasena > div').html(json.contrasena)
                    $('#contrasena > input').addClass('is-invalid');
                }

            },
            401: function(xhr){
                var json = JSON.parse(xhr.responseText);
                console.log(json);
                $('#alert').html('<div class="alert alert-danger" role="alert"> '+ json.mensaje + '</div>');
            }

        }

    });
})