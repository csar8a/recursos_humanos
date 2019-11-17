<nav id="sidebar">
    <div class="sidebar-header">
        <img src="<?php echo base_url(); ?>public/utils/img/logo_bellavista.png" alt="logo" width="200px"
            height="85px">
    </div>

    <ul class="list-unstyled components">
    <li>
            <a href="#"><b><?php echo $this->session->userdata('s_nombrePersona'); ?></b></a>
        </li>
    </ul>

    <ul class="list-unstyled components">
        <li>
            <a href="main">Dashboard</a>
        </li>
        <?php echo $modulos_usuario_sb ?>
    </ul>

    <ul class="list-unstyled CTAs">
        <?php if($this->session->userdata('s_roles') == 2): ?>
        <li>
            <a href="gestion_permisos" class="download">Gesti&oacute;n de Permisos</a>
        </li>
        <li>
            <a href="<?=site_url('C_dashboard/cerrarSesion')?>" class="article">Cerrar sesi&oacute;n</a>
        </li>
        <?php else: ?>
        <li>
            <a class="download" href="<?=site_url('C_dashboard/cerrarSesion')?>" class="article">Cerrar
                sesi&oacute;n</a>
        </li>
        <?php endif; ?>
    </ul>
</nav>