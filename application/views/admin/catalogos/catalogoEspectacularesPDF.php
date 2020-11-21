<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo de Espectaculares</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>


        .contenedor{
            width:100%;
            height: 96%;
            /* border: 1px solid #000; */
            margin-left: 40px;
            
        }
         .images{
            width: 95%;
            height:55%;
            /* border: 1px solid #000; */
            position: relative;
            margin-top: 10px;
         }
         .imagen-grande{
            width: 60%;
            min-height:55%;
            max-height:55%;
            /* border: 1px solid #000; */
            margin:2.5px;
            float: left;
        }

        .images-pequenas{
            width: 38%;
            height:55%;
            /* border: 1px solid #000; */
            margin: 1px;
             /* position: absolute;  */
            right: 0%;
            top: 0%;
            background-size: cover;
            background-size: 100% 100%;
        }

         .imagen-pequena{
            width: 100%;
            max-height: 27%;    
            min-height: 27%;    
            /* border: 1px solid #000; */
            margin: 2.5px
        } 
        .img-grande{
            width: 100%;
            min-height: 55%;
            max-height: 55%;
            background-size: cover;
            background-size: 100% 100%;
            margin:2.5px;
        }

        .logo_medios{
            height: 70px;
            margin: 0px;
        }
        p,b{
            margin:0px;
            padding:0px;
        }
        .p{
            margin-top:6px;
            margin-bottom:6px;
        }
        .info{
            max-width: 58%;
            /* display: flex; */
            flex-wrap: wrap;
            line-height: 1.1;

        }
      
        .bandalateral{
            position: absolute; 
            left: 58%;
            top: 47%;
            transform:rotate(270deg); 
             width: 90%;
            height: 70px; 
           
        }
        .centrado{
            text-align: center;

        }

        .logo_medios_pg1{
            height: 100px;
            margin-top: 50px;


        }
        .localizacion{
            position: absolute;
            left:80%;
            top:75%;
            text-align: center;
            
        }
        .img-location{
            width: 65px;
            height: 40px;
            margin:0px;
        }

        .foot{
            position: absolute;
            left:70%;
            top:90%;
            line-height: 1;
            margin-left: 1px solid #000;

        }

    </style>
</head>
<body>
    <!-- <?php var_dump($espectaculares)?> -->
    <div class="contenedor">
        <div class="centrado">
            <img src ="<?= BASEPATH.'../assets/images/logo_medios.jpg'?>" class="logo_medios_pg1" alt="">
            <h1 style="margin-top: 50px;">CATÁLOGO DE ESPECTACULARES <?= date("Y")?></h1>
            <h3 style="margin-top: 50px; color:red;">INCLUYE: </h3><h3>INSTALACIÓN Y RETIRO DE MATERIAL</h3>
            <H3 style="color:red";>SUJETOS A: </H3>
        </div>
    </div>


<?php foreach($medios as $espectacular):?>

    <div class="contenedor">

        <img src="<?= BASEPATH.'../assets/images/logo_medios.jpg'?>" class="logo_medios" alt="">
        <div class="images">
            <div class="imagen-grande"> 
                <img src="<?= BASEPATH.'../assets/images/espectaculares/'.$espectacular['vista_larga']?>" alt="" class="img-grande">
            </div>

            <div class="images-pequenas">
                <!-- <div class="image-pequena"> -->
                     <img src="<?= BASEPATH.'../assets/images/espectaculares/'.$espectacular['vista_media']?>" class=" imagen-pequena" alt="">
                <!-- </div> -->
                <!-- <div class="image-pequena"> -->
                     <img src="<?= BASEPATH.'../assets/images/espectaculares/'.$espectacular['vista_corta']?>" class=" imagen-pequena" alt=""> 
                <!-- </div>  -->
            </div>
        </div>
        <div class="info">
        <table class="table table-bordered table-sm">
            <tr>
                <th>SITIO</th>
                <th colspan=3 style="color:red;"><?=$espectacular['nocontrol']?></th>
            </tr>
            <tr>
                <th colspan=4 style="text-align: center;">UBICACION</th>
            </tr>
            <tr>
                <th>CALLE</th>
                <th colspan=3><?=$espectacular['calle'].", No ".$espectacular['numero']?></th>
            </tr>
            <tr>
                <th colspan =2>LOCALIDAD</th>
                <th>MUNICIPIO</th>
                <th>ESTADO</th>
            </tr>
                <td colspan=2><?=$espectacular['localidad']?> </t>
                <td><?=$espectacular['municipio']?></td>
                <td><?=$espectacular['nombre']?></td>
            </tr>
            </table>
            <!-- <div class="p">
                <p>SITIO: <b style="color:red;"><?=$espectacular['nocontrol']?></b><p>
                
            </div>
            <div class="p">
                <p>UBICACIÓN:</p> 
                <b><?=$espectacular['calle']." No ".$espectacular['numero'].", ".$espectacular['localidad'].", ".$espectacular['municipio'].", ". $espectacular['nombre'] ?></b>
            </div>
            <div class="p">
                <p>REFERENCIA</p>
                <B><?=$espectacular['referencias']?></B>
            </div>
            <div class="p">
                <p>MEDIDAS</p>
                <b><?=$espectacular['alto'] .'mts x '. $espectacular['ancho']. ' mts'?></b>
            </div> -->
        </div>

        <div class="localizacion">
            <img src="<?= BASEPATH.'../assets/images/location.png'?>" class="img-location" alt=""> <br>
            <a href="https://www.google.com.mx/maps/<?= $espectacular['latitud'] . ',' .$espectacular['longitud']?>"> <?= $espectacular['latitud']. " - ".$espectacular['longitud']?></a> 
        </div>

        <div class="foot">
            <small>La Soledad N* 115, Fracc. Colinas de la Soledad,
                San Felipe del Agua, Oaxaca, Oax. C.P 68044
                Tel. (951) 5038220, publi.home@hotmail.com
            </small>
        </div>
        <img src="<?= BASEPATH.'../assets/images/bandalateral.png'?>" alt="" class="bandalateral">   

    </div>
    <?php endforeach?>
</body>
</html>