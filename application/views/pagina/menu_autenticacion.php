

<nav class="navbar navbar-inverse navbar-fixed-top header">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand" href="#">SAESC P</span>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="">
                    <a href="<?php echo base_url() . 'auth/muestra_pantalla_registrar'; ?>" >
                        <i class=" glyphicon glyphicon-save icon_left">                        
                        </i>&nbsp;&nbsp;&nbsp;
                        Registrarme
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url() . 'auth/muestra_pantalla_recuperar'; ?>" class="">
                        <i class=" glyphicon glyphicon-envelope icon_left">                       
                        </i>&nbsp;&nbsp;&nbsp;
                        Recuperar cuenta
                    </a>
                </li>

            </ul>

            <ul class="nav navbar-nav navbar-right">

                <li><a href="#">Créditos</a></li>                            
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
