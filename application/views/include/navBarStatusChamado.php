<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
            <a class="navbar-brand" href="<?php echo base_url('home/'); ?>">
                <b class="logo-icon p-l-10">
                    <img src="<?php echo base_url('assets/img/newLogoW.png') ?>">
                </b>
                <span class="logo-text">
                    <img src="<?php echo base_url('assets/img/newLogoDiscovery.png') ?>">
                </span>
            </a>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
            </ul>
            <ul class="navbar-nav float-right">




                <li class="nav-item">
                    <!--					<a class="nav-link waves-effect waves-dark" href="-->
                    <?php  ?>
                    <!--"> Projetos </a>-->
                    <!-- <a class="nav-link waves-effect waves-dark" data-toggle="modal" data-target="#"> Novo Status de Chamado </a> -->
                    <a class="nav-link waves-effect waves-dark" data-toggle="modal" data-target="#"> ... </a>
                </li>



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/img/user.png') ?>" alt="user" class="rounded-circle" width="31"> &nbsp;
                        <?php echo $this->session->userdata('userName'); ?> </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="<?php echo base_url('perfil/trocarSenha'); ?>"> <i class="fa fa-key m-r-5 m-l-5"></i> Trocar senha </a>
                        <a class="dropdown-item" id="buttonLogout"><i class="fa fa-power-off m-r-5 m-l-5"></i> Sair </a>
                    </div>
                </li>





            </ul>
        </div>
    </nav>
</header> 