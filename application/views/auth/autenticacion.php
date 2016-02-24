<?php
echo $header_html;
echo $header;
?>
<br />
<section class='cuerpo  container-fluid'> 

    <div class="panel panel-default">
        <div class="panel-heading">    
            <h3 class="">Inicio de sesión
                <i class="glyphicon glyphicon-log-in float_derecha"></i>  
                <i class="glyphicon glyphicon-user float_derecha" ></i>
            </h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div id=""><?php echo $message; ?> </div> 
            </div>
            <?php echo form_open("auth/busca_usuario", array('class' => 'col-md-5', 'id' => 'form_autenticacion')); ?>
            <fieldset  class="">
                <legend class="help-block">Datos requeridos</legend>

                <div class="input-group" style="//background: rgba(0,113,185,.7);padding-bottom: 0%;">
                    <span class="input-group-addon" id="basic-addon1" style="">
                        <i class="glyphicon glyphicon-user" style=""></i>
                    </span>
                    <?php echo form_input($identity); ?>    
                </div>    
                <br />
                <div class="input-group" style="//background: rgba(0,113,185,.7);padding-bottom: 0%;">
                    <span class="input-group-addon" id="basic-addon1" style="">
                        <i class="glyphicon glyphicon-lock" style=""></i>
                    </span>
                    <?php echo form_input($password); ?>
                </div>   
                <br />
                <button type="submit" class="btn btn-primary col-md-12 " id="">
                    <span class="glyphicon glyphicon-log-in btn_" style=""></span> 
                    &nbsp;Iniciar sesión
                </button>
                <div class="col-md-12 text-center">
                    <br>
                    <?php
                    echo form_checkbox('remember', '1', FALSE, 'id="remember"', array('class' => 'clogin '));
                    echo form_label('Recordarme', '', array('for' => 'remember', 'class' => '')) //lang('login_remember_label', 'remember');
                    ?>
                </div>
            </fieldset>

            <?php echo form_close(); ?>
            <div class="col-md-2"></div>
            <div class="  text-justify  jumbotron col-md-5" style="padding: 2%;border-radius: 0em 0em 0em 0em;">          
                <i class="float-left glyphicon glyphicon-info-sign text-primary" style="transform: scale(2.5);"  ></i>
                <span class="text-primary">&nbsp;&nbsp;&nbsp;&nbsp;nformación</span>
                <div class="col-md-" style="line-height:1.6;color:black;">
                    <p class="help-block" id="informacion" ><br/>
                        Herramienta de apoyo para la evaluación de saberes pertenecientes a cursos afines a la <b>programación</b> informática.
                        Los cursos disponibles son presenciales e impartidos solo para estudiantes registrados, dicha herramienta esta disponible en la <b>F.E.I.</b>
                    </p>
                    <br />
                    <div class="col-md-10"></div>
                    <span class="col-md-2 float_derecha" id="">
                        <i  id="ocultar_informacion" class="btn  btn-default glyphicon glyphicon-eye-close text-center ver" style="transform: scale(1.5);"></i>
                        <i  id="ver_informacion" class="btn  btn-default glyphicon glyphicon-eye-open text-center ver"  style="transform: scale(1.5);" ></i>
                    </span> 
                </div>            
            </div>
        </div>
        <div class="panel-footer"></div>
    </div>
    <?php echo $footer; ?>
    