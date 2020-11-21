<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .images-pequenas{
            width: 38%;
            height: 50%;   
        }

    </style>
</head>
<body>
    <?php foreach($espectaculares as $espectacular):?>
    <img src="<?= BASEPATH.'../assets/images/espectaculares/'.$espectacular['vista_larga']?>" style="width: 60%; height: 50%" alt="" class="img-grande" id="imagen-grande">
    <div class="images-pequenas">
        <img src="<?= BASEPATH.'../assets/images/espectaculares/'.$espectacular['vista_media']?>" style="width: 100%; height: 100%" alt="" class="img-grande" id="imagen-grande">
        <img src="<?= BASEPATH.'../assets/images/espectaculares/'.$espectacular['vista_media']?>" style="width: 38%; height: 50%" alt="" class="img-grande" id="imagen-grande">

    </div>
    <?php endforeach?>
</body>
</html>