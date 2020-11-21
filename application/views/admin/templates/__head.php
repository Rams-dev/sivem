<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <script>
        const data = window.location.pathname;
        const title = data.substr(1);
        window.document.title = title.toUpperCase()+" | SIVEM";
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espectaculares | SIVEM</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('assets/select2/dist/css/select2.min.css')?>">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous"></script>
    <script src="<?= base_url('assets/select2/dist/js/select2.min.js')?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstra0p0@04.50.300/d0is0t0/j0000s/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/template.css')?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dropify/dist/css/dropify.css')?>">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/dropify/dist/fonts.css')?>"> -->


    <!--------------------------------------- D A T A  T A B L E S ------------------------------------->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!------------------------------------- O W L  C A R R U S S E L------------------------------------------- -->
    <link rel="stylesheet" href="<?= base_url('assets/OwlCarousel/dist/assets/owl.carousel.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/OwlCarousel/dist/assets/owl.theme.default.css')?>">
    <script src="<?= base_url('assets/OwlCarousel/dist/owl.carousel.min.js')?>"></script>

    <!-------------------------------------------------------- A L E R T I F Y ------------------------------------------- -->

    <link rel="stylesheet" href="<?= base_url('assets/AlertifyJS/build/css/alertify.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('assets/AlertifyJS/build/css/themes/default.min.css')?>">
    <script src="<?= base_url('assets/AlertifyJS/build/alertify.min.js')?>"></script>


    <!-------------------------------------------------------- F O N T A W E S O M E ------------------------------------------- -->

    <script src="https://kit.fontawesome.com/03e7806b0f.js" crossorigin="anonymous"></script>

</head>
<body>