<div class="col-lg-12">
             <!-- Image and text -->
             
    <div class="row">
        <div class="col-lg-2 col-md-2 rouded-lg">
             <div id=menu>
                <div class="d-flex justify-content-end align-items-center mt-2">
                    <b class="my-auto mr-1 menuTitle">MENU</b>
                    <a id="menu">
                     <img src="Recursos/Imagenes/icoMenu.png"  width="35" alt="menu">
                    </a>
                </div>
            </div>
                <hr class="bg-dark d-none">
       
            <div class="sidenav navbar-nav">
                <a class="icoMenu">
                    <img id="closeMenu" src="Recursos/Generales/Plugins/icons/build/svg/x2.svg" alt="">
                </a>
                <hr class="bg-white d-none">
                <a href="<?php echo base_url('admin/dashboard') ?>" id="indexit" class="">Dashboard</a>
                <a href="/clientes" id="clientesit" class="">Clientes</a>
                <a href="/catalogos" id="catalogosit" class="">Catálogos</a>
                <a href="/empleados" id="empleadosit" class="">Empleados</a>
                <a href="<?= base_url('admin/clientes')?>"id="empresasit" class="">Empresas</a>
                <a href="<?= base_url('admin/materiales')?>" id="materialesit" class="">Materiales</a>
                <a href="<?= base_url('admin/espectaculares')?>" id="espectacularesit" class="">Espectaculares</a>
                <a href="<?= base_url('admin/ventas')?>" id="ventasit" class="">Ventas</a>
                <a href="/vallas" id="vallasit" class="">Vallas</a>
                <a href="/vallasmoviles" id="vallasmovilesit" class="">Vallas Moviles</a>

                <div class="mt-auto">
                    <a href="#" class="useron">{{.Usuario.Nombre2}}</a>
                    <a href="<?= base_url('login/logout')?>" class="username">Cerrar Sesión</a>
                </div>
            
            </div>
        </div>
        <div class="col-lg-10 col-md-10 rouded-lg">
        <!-- <nav class="navbar navbar-dark navbar-lg bg-dark">
                <a class="navbar-brand" href="#">
                    <img src="<?php echo base_url('assets/images/logosis.svg')?>" width="100" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                </a>
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="<?=base_url('login/logout')?>">salir</a></li>
                </ul>
            </nav> -->
            <div class="container mt-4">