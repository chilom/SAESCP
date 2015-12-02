<?php echo $header_html; ?>
<?php echo $header; ?>
<script type="text/javascript" src="javascript/registrar.js"></script>
<section class="cuerpo">
    <div class="col-md-12">
        <div class="row">
            <br>
        </div>

        <div class="col-md-3 "  >          
        </div>
        <div class="col-md-5">
            <div class="panel panel-default ">
                <div class="panel-heading">                                       
                    <h4>Registro de usuario</h4> 
                </div>
                <div class="panel-body">
                    <?php echo form_open("auth/valida_entradas", array('class' => 'col-md', 'id' => 'form_registrar', 'type' => 'get')); ?>
                    <i class="glyphicon glyphicon-user  " style="font-size:5em;color:rgba(0,113,185,1);border-bottom: 0px solid rgba(0,113,185,1);"></i>
                    <p id="nota_estudiantes" hidden="true" class="text-primary">
                        NOTA: Estudiantes deberan usar su matricula, de otro modo no podran usar el sistema.
                    </p>
                    <p>
                        <label class="text-primary ">Rol:</label>
                        <input required="true" id="estudiante_checkbox" class="si-es-estudiante "  type="checkbox" name="estudiante" value="2">                    
                        <label class="si-es-estudiante" for="estudiante_checkbox">Estudiante</label>
                        &nbsp;&nbsp;&nbsp;
                        <input required="true" id="maestro_checkbox" class="no-es-estudiante "   type="checkbox" name="maestro"   value="3" >  
                        <label class="no-es-estudiante" for="maestro_checkbox" >Maestro</label>
                    <hr>                      
                    <?php echo form_input($username) ?>
                    </p>
                    <div> <?php echo form_input($nombre); ?></div> 
                    <div> <?php echo form_input($email); ?></div> 
                    <div class="col-md-8">
                        <?php echo form_input($password); ?>
                        <?php echo form_input($password_confirm); ?>
                    </div> 
                    <div class="col-md-4">      
                        <button type="submit" class="btn btn-primary col-md-12 " id="">
                            <span class="glyphicon glyphicon-save btn_" style=""></span> 
                            Registrarme
                        </button>      
                        <hr>
                        <a class="btn btn-default col-md-12" href="auth/">
                            <span class="glyphicon glyphicon-remove btn_" style=""></span>
                            Cancelar
                        </a>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <div class="panel-footer ">
                </div>
            </div>
        </div>
        <div class="error col-md-4" style=""> 
            <br>
            <br>
            <?php echo $message; ?>
        </div>
    </div>
    <?php echo $footer; 