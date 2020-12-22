<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden De compra</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?=base_url("assets/images/logosis.png")?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>

     body{
        position: relative;
        width: 100%;
        height: 50%;
        /* max-height: 50%; */
        border: 1px solid #000;
        font-size: 12px;

    } 


    .encabezado1{
        width: 69%;
        float: left;
    }
    .encabezado1-texto{
        width: 70%;
        margin: auto;
        text-align: center;
        font-size: 12px;
    }
    .datos{
        width: 100%;
    }
    .border-botom{
        font-size: 13px;
        border-bottom: solid 2px #000;
        margin-bottom: 3px;
    }
    .caja{
        border: 1px solid #000;
        margin-bottom: 3px;
        border-radius: 50%;
        width: 50%;
        
    }

    .cajav{
        border: 1px solid #000;
        margin-bottom: 3px;
        border-radius: 50%;
        width: 49.5%;
        float: right;
        position: absolute;
        top: 148px;
        left:40.4%;
        
    }


    .encabezado2{
        width: 30%;
        float: right;
    }
    .folio{
        border: 1px solid #000;
        border-radius: 40px;
    }

    .informacion{
        border: 1px solid #000;
        border-radius: 20px;
        height: 150px;

    }

     .tabla{
        position: relative;
        display: block;

    } 
    
    </style>
</head>
<body>
    <div class="encabezado1">
        <div class="encabezado1-texto">
            <p>impresión en HD y DF de lona | vinil | Tela | Microperforado | Laser | Offset | Serigrafia | Recorte de vinil | Rotulacion vehicular</p>
        </div>
        <div class="datos">
            <p class="border-bottom">Cliente</p>
            <p class="border-bottom">Telefono</p>
            <p class="caja">Fecha:</p>
            <p class="caja">Impresor:</p>
            <p class="cajav">Vendedor:</p>
        </div>

    </div>
    <div class="encabezado2">
        <div class="folio">N</div>
        <div class="informacion">
            <p>La Soledad No. 115</p>

        </div>
    </div>
    <div class="tabla">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                </tr>
                <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                </tr>
                <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
                </tr>
            </tbody>
        </table>
    </div>


    
</body>
</html>