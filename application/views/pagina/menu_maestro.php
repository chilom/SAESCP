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
                <span class="navbar-brand" >
                    SAESC P
                </span>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class=" ">
                        <a href="<?php echo base_url() . 'auth/' ?>" >
                            <i class="glyphicon glyphicon-home" style=""></i>
                            Inicio
                        </a>
                    </li>   
                    <li class=" ">
                        <a href="<?php echo base_url() . 'maestro_controller/muestra_pantalla_inscripcion' ?>" >
                            <i class="glyphicon glyphicon-list " style=""></i>
                            Inscripciones
                        </a>
                    </li> 
                    <li class=" ">
                        <a href="<?php echo base_url() . 'temario_controller/muestra_pantalla_temario' ?>" >
                            <i class="glyphicon glyphicon-list-alt" style=""></i>
                            Temario
                        </a>
                    </li> 
                    <li class=" ">
                        <a href="<?php echo base_url() . 'contenido_controller/muestra_pantalla_contenido' ?>" >
                            <i class="glyphicon glyphicon-briefcase" style=""></i>
                            Contenido
                        </a>
                    </li> 
                    <li class=" ">
                        <a href="<?php echo base_url() . 'actividades_controller/muestra_pantalla_actividades' ?>" >
                            <i class="glyphicon glyphicon-file" style=" "></i>
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
</div>

