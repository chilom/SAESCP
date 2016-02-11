<?php
echo $header_html;
echo $header;
?>
<br />
<section class=" container-fluid cuerpo">    
        <div class="panel panel-default ">
            <div class="panel-heading">                                       
                <h3>
                    Registro de usuario
                    <i class="glyphicon glyphicon-user float_derecha" ></i>
                    <i class="glyphicon glyphicon-plus-sign float_derecha"></i>
                </h3> 
            </div>
            <div class="panel-body">
                <div class="col-md-2"></div>
                <?php echo form_open("auth/valida_entradas", array('class' => 'col-md-5', 'id' => ' form-hprizontal', 'type' => '')); ?>
                <fieldset  class="">
                    <legend class="help-block">Datos requeridos</legend>
                    <label class="col-md- text-primary">Rol de usuario:</label>&nbsp;&nbsp;&nbsp;
                    <div class="col-md-" style="display:inline-block;"  >
                        <input required="true" id="estudiante_checkbox" class=" si-es-estudiante "  type="checkbox" name="estudiante" value="2">                    
                        <label class="si-es-estudiante  " for="estudiante_checkbox">Estudiante</label>
                    </div>
                    &nbsp;&nbsp;&nbsp;
                    <div class="col-md-" style="display:inline-block;" >
                        <input required="true" id="maestro_checkbox" class="no-es-estudiante  "   type="checkbox" name="maestro"   value="3" >  
                        <label class=" no-es-estudiante" for="maestro_checkbox" >Maestro</label>
                    </div>
                    <p id="nota_estudiantes" hidden="true" class="">
                        <br />NOTA: Estudiantes deberan usar su matricula, de otro modo no podran usar el sistema.
                    </p>
                    <hr>

                    <div class="input-group" style="//background: rgba(0,113,185,.7);padding-bottom: 0%;">
                        <span class="input-group-addon" id="basic-addon1" style="">
                            <i class="glyphicon glyphicon-user" style=""></i>
                        </span>
                        <?php echo form_input($username); ?>
                    </div>
                    <?php echo form_input($nombre); ?>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                        <?php echo form_input($email); ?>
                    </div>
                    <br>
                    <div class="input-group">
                        <span class="input-group-addon " id="basic-addon1">
                            <i class="glyphicon glyphicon-lock"></i>
                        </span>
                        <?php echo form_input($password); ?>
                    </div>
                    <?php echo form_input($password_confirm); ?>

                    <br />
                    <button type="submit" class="btn btn-primary col-md-12" id="" >
                        <span class="glyphicon glyphicon-save icon_left" style=""></span> 
                        Registrarme
                    </button> 
                  
                    <a class="btn btn-default col-md-12" href="auth/" style="margin-top: 1%;">
                        <span class="glyphicon glyphicon-remove icon_left" style=""></span>
                        Cancelar
                    </a>
                </fieldset>
                <?php echo form_close(); ?>
                <div class="col-md-5"> <?php echo $message; ?></div>
            </div>
            <div class="panel-footer ">
            </div>
        </div>
    <script type="text/javascript" src="assets/javascript/registrar.js"></script>
    <?php echo $footer; ?>
    