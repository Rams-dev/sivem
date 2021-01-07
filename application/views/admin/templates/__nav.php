<div class="main">
<div class="loader"></div>

<nav class="navbar-horizontal " id="nav-horizontal">
    <a class="navbar-horizontal__logo" href="#">
        <img src="<?php echo base_url('assets/images/logosis.svg')?>" alt="Sivem logo" loading="lazy">
    </a>
    <ul class="navbar-horizontal_ul ml-auto"  >
        <li class="navbar-horizontal_li" id=menu> <a >MENU <i class="fas fa-bars"></i> </a></li>
    </ul>
    <ul class="navbar-horizontal_ul ml-auto" id="user__nav_horizontal">
        <li class="navbar-horizontal_li"><a href="<?= base_url('admin/perfil')?>"><i class="fas fa-user"></i>  <?= $this->session->userdata("nombre")?> </a></li>
        <li class="navbar-horizontal_li"><a href="<?= base_url('login/logout')?>"> <i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
    </ul>
</nav>
<div class="col-lg-12 col-md-12 col-xl-12">
    <div class="row">
        <div class=" col-lg-2 col-md-2 col-xl-1" >
            <div class="sidenav">
                <hr class="linea_oscura">
                <hr class="linea_blanca">
                <ul class="sidenav__ul">
                    <a href="<?php echo base_url('admin/dashboard') ?>" id="indexit" class="">Dashboard</a>
                    <a href="<?= base_url('admin/clientes')?>" id="clientesit" class="">  Clientes</a>
                    <a href="<?= base_url('admin/catalogos')?>" id="catalogosit" class="">Catálogos</a>
                    <?php if($this->session->userdata("tipo") == 1){?>
                    <a href="<?= base_url('admin/empleados')?>"id="empleadosit" class="">Empleados</a>
                    <?php }?>
                    <a href="<?= base_url('admin/materiales')?>" id="materialesit" class="">Materiales</a>
                    <a href="<?= base_url('admin/espectaculares')?>" id="espectacularesit" class="">Espectaculares</a>
                    <a href="<?= base_url('admin/ventas')?>" id="ventasit" class="">Ventas</a>
                    <a href="<?= base_url("admin/vallas_fijas")?>" id="vallasit" class="">Vallas fijas</a>
                    <a href="<?= base_url("admin/vallas_moviles")?>" id="vallasmovilesit" class="">Vallas Moviles</a>
                </ul>
                <ul class="sidenav__ul user ">
                    <hr class="bg-white">
                    <a href="<?= base_url('admin/perfil')?>" class="useron"><?= $this->session->userdata("nombre")?></a>
                    <a href="<?= base_url('login/logout')?>" class="username">Cerrar Sesión</a>
                </ul>
            
            </div>
        </div>
        <div class="col-lg-10 col-md-10 col-xl-11 col-sm-12 mt-5">
        
            <div class="container-fluid mt-4">
                <div class="mx-5">
