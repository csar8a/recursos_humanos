<nav class="navbar navbar-expand-lg navbar-light bg-light">


    <?php
        $route = $_SERVER['REQUEST_URI'];
        if (strpos($route, 'main') === false):
        ?>
    <div class="container-fluid">
        <!--INTERNAS-->

        <button type="button" id="sidebarCollapse" class="btn btn-info" style="background: #ffffff;">
            <i class="fas fa-align-left" style="color: #79AAFF;"></i>
        </button>

        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <a class="navbar-brand" style="margin-left:20px; font-size:20px"><?php echo (isset($bar) ? $bar : ''); ?></a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="nav navbar-n av ml-auto">
                <li class="nav-item active">
                    
                </li>
            </ul>
        </div>
    </div>

    <?php else: ?>
    <!--DASHBOARD-->
    <div class="container-fluid">

        <a class="nav-link" href="#"><?php echo $this->session->userdata('s_nombrePersona'); ?></a>

        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fas fa-align-justify"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" >

            <ul class="nav navbar-nav ml-auto">
                <button type="button" id="sidebarCollapse" class="btn btn-info" style="background: #ffffff;color:black"
                    onclick="window.location.href='<?=site_url('C_dashboard/cerrarSesion')?>'">
                    <i class="fas fa-power-off" style="color: #79AAFF;"></i>
                </button>
            </ul>



        </div>

    </div>
    <?php endif;?>





</nav>