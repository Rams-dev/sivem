<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogo</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="<?=base_url("assets/images/logosis.png")?>" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>

        body{
            font-family: 'Poppins', sans-serif;

        }
        .contenedor{
            font-family: 'Poppins', sans-serif;

            width:100%;
            height: 94%;
            max-height: 94%;
            /* border: 1px solid #000;  */
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
            /* max-width: 58%; */
             display: flex; 
            flex-wrap: wrap;
            line-height: 1.1;
            margin-top: -10px;
            /* position: relative; */

        }

        .bandalateral{
            position: absolute;
            left: 58%;
            top: 47%;
            transform:rotate(270deg);
             width: 88%;
            height: 60px;
             opacity:.3
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
            left:65%;
            top:90%;
            line-height: 1;
            /* border-left: 1px solid #000; */

        }
        .tabla{
            width:58%;
            max-width: 50%;
            display:flex;
        }

        th{
            font-size: 14px;

        }
        tr, td{
            font-size: 12px;
        }



    </style>
</head>
<body>
    <!-- <?php var_dump($medios)?> -->
    <div class="contenedor">
        <div class="centrado">
            <img src ="<?= BASEPATH.'../assets/images/logo_medios.jpg'?>" class="logo_medios_pg1" alt="">
            <h1 style="margin-top: 50px;">CATÁLOGO DE MEDIOS <?= date("Y")?></h1>
            <h3 style="margin-top: 50px; color:red;">INCLUYE: </h3><h3>INSTALACIÓN Y RETIRO DE MATERIAL</h3>
             <H3 style="color:red";>SUJETOS A: </H3>
        </div>
    </div>


<?php foreach($medios as $medio):?>

    <div class="contenedor">
        <img src="<?= BASEPATH.'../assets/images/logo_medios.jpg'?>" class="logo_medios" alt="">
        <div class="images">
            <div class="imagen-grande">
                <img src="<?= BASEPATH.'../assets/images/medios/'.$medio['vista_larga']?>" alt="" class="img-grande">
            </div>

            <div class="images-pequenas">
                <!-- <div class="image-pequena"> -->
                     <img src="<?= BASEPATH.'../assets/images/medios/'.$medio['vista_media']?>" class=" imagen-pequena" alt="">
                <!-- </div> -->
                <!-- <div class="image-pequena"> -->
                     <img src="<?= BASEPATH.'../assets/images/medios/'.$medio['vista_corta']?>" class=" imagen-pequena" alt="">
                <!-- </div>  -->
            </div>
        </div>
        <div class="info">
        <div class="tabla">
            <?php if($medio["tipo_medio"] == "Vallas movil"){?>
                <table class="table table-bordered table-sm">
                    <tr>
                        <th>SITIO</th>
                        <th colspan=3 style="color:red;"><?=$medio['nocontrol']?></th>
                    </tr>

                    <tr>
                        <th>Marca</th>
                        <th><?=$medio['marca']?></th>
                    </tr>
                    <tr>
                        <th>Modelo</th>
                        <th><?=$medio['modelo']?></th>
                    </tr>
                    <tr>
                        <th>Año</th>
                        <th><?=$medio["anio"]?></th>
                </table>

            <?php }else{?>
            <table class="table table-bordered table-sm">
                <tr>
                    <th>SITIO</th>
                    <th colspan=3 style="color:red;"><?=$medio['nocontrol']?></th>
                </tr>
                <tr>
                    <th colspan=4 style="text-align: center;">UBICACION</th>
                </tr>
                <tr>
                    <th>CALLE</th>
                    <td colspan=3><?=$medio['calle'].", No ".$medio['numero']?></td>
                </tr>
                <tr>
                    <th colspan =2>LOCALIDAD</th>
                    <th>MUNICIPIO</th>
                    <th>ESTADO</th>
                </tr>
                <tr>
                    <td colspan=2><?=$medio['localidad']?> </td>
                    <td><?=$medio['municipio']?></td>
                    <td><?=$medio['nombre']?></td>
                </tr>
                <tr>
                    <th colspan=2>MEDIDAS </th>
                    <th>STATUS</th>
                    <th>COSTO</th>
                </tr>
                <tr>
                    <td colspan=2><?=$medio['ancho'] . " x ". $medio['alto']. " METROS"?></td>
                    <td><?=$medio['status']?></td>
                    <td>$ <?=$medio['precio']?></td>
                </tr>
                </table>
            <?php }?>
            </div>
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