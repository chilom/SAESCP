<?php
echo $header_html;
echo $header;
$email = array('name' => 'email',
    'id' => 'identity',
    'class' => 'text-center form-control',
    'placeholder' => 'Nombre de usuario',
    'aria-describedby' => "sizing-addon1",
    'required' => 'true',
    'autofocus' >= "autofocus",
    'pattern' => ".{9,30}", 'title' => "Mi matricula: so9011559.(9 a 30 caracteres)"
);
?>  
<br />
<section class="cuerpo container-fluid">
        <div class="panel panel-default ">
            <div class="panel-heading">    
                <h3>Recuperar cuenta de acceso
                    <i class="glyphicon glyphicon-lock float_derecha" ></i>
                    <i class="glyphicon glyphicon-refresh float_derecha" ></i>
                </h3> 
            </div>
            <div class="panel-body">
                <div class="col-md-2"></div>
                <?php echo form_open(base_url() . "auth/determina_existencia_usuario", array('class' => 'col-md-5', 'role' => 'form')); ?>
                <fieldset  class="">
                    <legend class="help-block">Datos requeridos</legend>
                    <br /><p class="text-left help-block">Nota:Si no eres usuario registrado ve a la opción <a href="auth/muestra_pantalla_registrar"> registrarme</a></p>
                    <div class="col-md-12">
                        <div class="input-group col-md-">
                            <span class="input-group-addon " id="basic-addon1">
                                <i class="glyphicon glyphicon-user"></i>
                            </span>
                            <?php echo form_input($email); ?>
                        </div>                
                        <br />
                        <button type="submit" class="btn btn-primary col-md-12  " id="">
                            <span class="glyphicon glyphicon-send btn_" ></span> 
                            Enviar
                        </button>
                        <a class="btn btn-default col-md-12" href="auth/" style="margin-top: 1%;">
                            <span class="glyphicon glyphicon-remove btn_" style=""></span>
                            Cancelar
                        </a>
                    </div>
                </fieldset>
                <?php echo form_close(); ?>

                <div class="col-md-5"><?php echo $message; ?></div>

            </div>
            <div class="panel-footer ">
            </div>
        </div>
    <script src="assets/javascript/recuperar.js"></script>
    <?php echo $footer; ?>