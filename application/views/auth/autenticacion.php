<?php
echo $header_html;
echo $header;
?>
<section class='cuerpo '> 
    <div class=" text-blanco text-justify  jumbotron col-md-5" style="border-radius: 0em 0em 1em 0em;">          
        <i class="float-left glyphicon glyphicon-info-sign  col-md- " style="transform:scale(3.5);color:rgba(0,113,185,1);"  ></i>                                                                                                                                          
        <p id="informacion" class="col-md-" style="line-height:1.6;color:black;">
            <br />
            Herramienta de apoyo para la evaluación de saberes pertenecientes a cursos afines a la <b>programación</b> informática.
            Los cursos disponibles son presenciales e impartidos solo para estudiantes registrados, dicha herramienta esta disponible en la <b>F.E.I.</b>
            <br />
        <div class="col-md-10"></div>
        <span class="col-md-2 " id="">
            <i  id="ocultar_informacion" class="btn  btn-default glyphicon glyphicon-eye-close text-center " style="transform: scale(2);color:gray;"></i>
            <i  id="ver_informacion" class="btn  btn-default glyphicon glyphicon-eye-open text-center "  style="transform: scale(2);color:gray;" ></i>
        </span> 
        </p>            
    </div>
    <div class="col-md-7">
        <div class="col-md-6"></div>
        <ul class="nav nav-pills  col-md-6" style="" id="menu_auth">
            <li class=" col-md-" role="presentation">
                <a href="<?php echo base_url() . 'auth/muestra_pantalla_registrar'; ?>" >
                    <i class=" glyphicon glyphicon-save icon_left">                        
                    </i>&nbsp;&nbsp;&nbsp;
                    Registrarme
                </a>
            </li>
            <li class="col-md-" role="presentation">
                <a href="<?php echo base_url() . 'auth/muestra_pantalla_recuperar'; ?>" class="">
                    <i class=" glyphicon glyphicon-envelope icon_left">                       
                    </i>&nbsp;&nbsp;&nbsp;
                    Recuperar cuenta
                </a>
            </li>                   
        </ul>    
        <div class="col-md-1"></div>
        <div class="col-md-8 panel_auth" id="autenticar">

            <div id="error_expir"><?php echo $message; ?> </div> 
            <div class="panel panel-default  ">
                <div class="panel-heading">    
                    <h4 class="">Inicio de sesión</h4>
                </div>
                <div class="panel-body">
                    <?php echo form_open("auth/busca_usuario", array('class' => '', 'id' => 'form_autenticacion')); ?>
                    <div class= "col-md-2"></div>
                    <div class="col-md-8">
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
    </div>
    <?php echo $footer; ?>
    