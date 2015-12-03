<?php
echo $header_html;
echo $header;
?>
<section class='cuerpo '>        
    <div class=" text-blanco text-justify h3 jumbotron col-md-5">                      
        <div style="line-height: 1.5em;" class="" >
            <i class="glyphicon glyphicon-info-sign icon_form float-left"></i>  

            <hr>
            <p id="informacion" class="col-md-">
                Herramienta de apoyo para la evaluación de saberes, pertenecientes a cursos afines a la programación informática.
                Los cursos disponibles son presenciales e impartidos  en la F.E.I.         
            </p> 
            <span class="btn btn-primary float-right" id="ocultar_informacion">
                Ocultar información
            </span> 
        </div>
        <div class="col-md-6">
        </div>

        <ul class="nav nav-stacked col-md-6">
            <li class=" btn btn-default " >
                <a href="<?php echo base_url() . 'auth/muestra_pantalla_registrar'; ?>" >
                    <i class=" glyphicon glyphicon-save icon_left">                        
                    </i>
                    Registrarme
                </a>
            </li>
            <li class=" btn btn-default" >
                <a href="<?php echo base_url() . 'auth/muestra_pantalla_recuperar'; ?>" class="">
                    <i class=" glyphicon glyphicon-envelope icon_left">                       
                    </i>
                    Recuperar cuenta
                </a>
            </li>                   
        </ul>     
    </div>

    <div class="col-md-1"></div>

    <div class="col-md-4 panel_auth" id="autenticar">
        <div id="error_expir"><?php echo $message; ?> </div> 
        <div class="panel panel-default  ">
            <div class="panel-heading">    
                <h4 class="">Inicio de sesión</h4>
            </div>
            <div class="panel-body">
                <span class="help-block text-left" ><b>Nota:</b> solo usuarios registrados.</span>
                <hr>
                <?php echo form_open("auth/busca_usuario", array('class' => '', 'id' => 'form_autenticacion')); ?>
                <div class= "col-md-1"></div>
                <div class="col-md-10">
                    <?php echo form_input($identity); ?>    
                    <?php echo form_input($password); ?>
                    <button type="submit" class="btn btn-success col-md-12 " id="">
                        <span class="glyphicon glyphicon-log-in btn_" style=""></span> 
                        Iniciar sesión
                    </button>
                </div>
                <div class="col-md-12 text-center">
                    <br>
                    <?php
                    echo form_checkbox('remember', '1', FALSE, 'id="remember"', array('class' => 'clogin '));
                    echo form_label('Recordarme', '', array('for' => 'remember', 'class' => '')) //lang('login_remember_label', 'remember');
                    ?>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer"></div>
        </div>
    </div>
    <?php echo $footer; ?>
    