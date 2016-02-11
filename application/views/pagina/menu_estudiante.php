<div class="col-md-12 "  style="">
    <nav class="navbar  navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" >
                    <div class=" col-md-12 " id="reloj_logico">

                    </div>  
                    <div class="  col-md-12" id="ver_reloj" hidden="true">
                        <span class="reloj glyphicon glyphicon-time" style="font-size: 1.2em;"> </span>
                        <span> &nbsp;&nbsp;&nbsp;ver reloj</span> 
                    </div>   
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="">
                        <a href="<?php echo base_url() . 'auth/' ?>" >
                            <i class="glyphicon glyphicon-home" style=""></i>
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo base_url() . 'estudiante_controller/muestra_pantalla_inscribir' ?>">
                            <i class="glyphicon glyphicon-ok-circle" style=""></i>
                            Inscribirme
                        </a>
                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="glyphicon glyphicon-user " style="font-size: 1em;"></i>
                            &nbsp; <?php echo $this->session->userdata('nombre'); ?>
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="auth/logout">
                                    Cerrar sesión
                                    &nbsp;<i class="glyphicon glyphicon-log-out " style=""></i>
                                </a>

                            </li>

                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>

    <div class="col-md-2"></div>

</div>

