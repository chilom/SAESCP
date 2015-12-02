<div class="col-md-12 "  style="">
    <div class="col-md-1"></div>
    <nav class="navbar  navbar-inverse col-md-10">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="navbar-brand" >
                    <i class="glyphicon glyphicon-briefcase"></i> 
                </span>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class=" ">
                        <a href="<?php echo base_url() . 'auth/' ?>" class="glyphicon glyphicon-home ">
                            Inicio
                        </a>
                    </li>   
                    <li class=" ">
                        <a href="<?php echo base_url() . 'maestro_controller/muestra_pantalla_inscripcion' ?>" class="glyphicon glyphicon-check ">
                            <i class="glyphicon glyphicon icon_aux" style=""></i>
                            Inscripciones
                        </a>
                    </li> 
                    <li class=" ">
                        <a href="<?php echo base_url() . 'temario_controller/muestra_pantalla_temario' ?>" class="glyphicon glyphicon-list ">
                            <i class="glyphicon glyphicon-plus-sign icon_aux" style=""></i>
                            Temario
                        </a>
                    </li> 
                    <li class=" ">
                        <a href="<?php echo base_url() . 'contenido_controller/muestra_pantalla_contenido' ?>" class="glyphicon glyphicon-briefcase">
                            <i class="glyphicon glyphicon-plus-sign icon_aux" style=""></i>
                            Contenido
                        </a>
                    </li> 
                    <li class=" ">
                        <a href="<?php echo base_url() . 'actividades_controller/muestra_pantalla_actividades' ?>" class="glyphicon glyphicon-file ">
                            <i class="glyphicon glyphicon-plus-sign icon_aux" style=" "></i>
                            Actividades
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
                                    <i class="glyphicon glyphicon-log-out " style="font-size: 1.5em;"></i>
                                    &nbsp;Cerrar sesión
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

