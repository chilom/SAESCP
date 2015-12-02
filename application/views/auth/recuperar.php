<?php
echo $header_html;
echo $header;
$email = array('name' => 'email',
    'id' => 'identity',
    'class' => 'text-center form-control',
    'placeholder' => 'Nombre de usuario',
    'aria-describedby' => "sizing-addon1",
      //  'required' => 'true'
);
?>  
<script src="javascript/recuperar.js"></script>
<section class="cuerpo">
    <div class="row col-md-12">         
        <div class="col-md-3"></div>
        <div class="col-md-6 help-block">
            <h1><?php //echo lang('forgot_password_heading'); ?></h1>
        </div>
    </div>
    <div class="col-md-12">
            <div class="col-md-3">            
        </div>
    </div>
    <div class="row col-md-12"> 
        <div class="col-md-3 menu_i" >
            
        </div>
        <div class="col-md-6">
             <?php    echo $message;   ?>   
            <div class="panel panel-default ">
                <div class="panel-heading">    
                  <div class="col-md-1">
                      
                    </div>                    
                    <h4>Recuperar cuenta de acceso</h4> 
                </div>
                <div class="panel-body">
                    <?php echo form_open(base_url() . "auth/determina_existencia_usuario", array('class' => 'col-md-')); ?>
                   <br><p class="text-left help-block">* Si no eres usuario ve a la opción <a href="auth/muestra_pantalla_registrar"> registrarme</a></p>
                   <hr>
                    <i class="col-md-1 glyphicon glyphicon-user icon_form"></i>
                    <div class="col-md-7"><?php echo form_input($email); ?>
                       
                    </div> 
                   <div class="col-md-4">
                    <button type="submit" class="btn btn-primary col-md-12  " id="">
                        <span class="glyphicon glyphicon-send btn_" style=""></span> 
                        Enviar
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
    </div>
    <?php echo $footer; ?>