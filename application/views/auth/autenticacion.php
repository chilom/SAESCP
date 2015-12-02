<?php
echo $header_html;
echo $header;
?>
<section class='cuerpo '> 
    <div class="col-md-4 " style="border-radius: 5%;margin:  1%;background: rgba(0,0,0,0);">
        <br>
        <div class="col-md-12 text-blanco alert alert-warning    alert-dismissible text-justify h3">                      
            <p style="line-height: 1.5em;">
                <br>
                <i class="glyphicon glyphicon-info-sign "></i>&nbsp;
                Herramienta de apoyo para la evaluación de saberes, pertenecientes a cursos afines a la programación informática.<br>
                Los cursos disponibles son presenciales e impartidos  en la F.E.I.  
            <hr>
            </p>
            <div class="col-md-2"></div>
            <ul class="nav nav-pills nav-stacked col-md-8">
                <li class=" " >
                    <a href="<?php echo base_url() . 'auth/muestra_pantalla_registrar'; ?>" class="btn btn-primary">
                        <i class="glyphicon glyphicon-save  glyphicon glyphicon-user btn_">                        
                        </i>
                        Registrarme
                    </a>
                </li>
                <br>
                <li class="">
                    <a href="<?php echo base_url() . 'auth/muestra_pantalla_recuperar'; ?>" class="btn btn-primary ">
                        <i class="glyphicon glyphicon-envelope glyphicon glyphicon-envelope btn_ ">                       
                        </i>
                        Recuperar cuenta
                    </a>
                </li>                   
            </ul> 
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-4 panel_auth" id="autenticar">
        <br>
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
    <div class="col-md-2"></div>
    <?php echo $footer; ?>
    