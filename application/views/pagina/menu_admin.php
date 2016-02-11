<nav class="navbar  navbar-inverse col-md- navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                        <div class="navbar-brand" >
                <span class=" ">SAESC P</span> 
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class=" ">
                    <a href="<?php echo base_url() . 'auth/' ?>" >
                        <i class="glyphicon glyphicon-home "></i>
                        Inicio
                    </a>
                </li>   
                <li class=" ">
                    <a href="<?php echo base_url() . 'administrador_controller/muestra_pantalla_administrar' ?>">
                        <i class="glyphicon glyphicon-check" style=""></i>
                        Activación de usuarios
                    </a>
                </li> 
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle text-capitalize" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="glyphicon glyphicon-user " style="font-size: 1em;"></i>
                        &nbsp; <?php echo $this->session->userdata('nombre'); ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="auth/logout">
                                Cerrar sesión
                                <i class="glyphicon glyphicon-log-out " style="font-size: 1em;"></i>
                            </a>

                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


