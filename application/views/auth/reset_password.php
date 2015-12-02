<?php
echo $encabezado_html;
echo $encabezado_pagina;
?>
<script src="javascript/reestablecer.js"></script>

<section class="cuerpo">
    <div class="row col-md-12">         
        <div class="col-md-3"></div>
        <div class="col-md-6 help-block">
            <h1><?php //echo lang('forgot_password_heading');  ?></h1>
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
            <?php echo $message; ?>   
            <div class="panel panel-default ">
                <div class="panel-heading">    
                    <div class="col-md-1">
                    </div>                    
                    <h4>Reestablecer contraseña</h4> 
                </div>
                <div class="panel-body">
                    <?php echo form_open(base_url() . 'auth/reset_password/' . $code, array('class' => 'col-md-12')); ?>
                    <i class="col-md-1 glyphicon glyphicon-lock " style="font-size: 3.5em;padding: 2%;color:gray;"></i>
                    <div class="col-md-7">
                        <?php echo form_input($new_password); ?>   
                        <?php echo form_input($new_password_confirm); ?> 
                        <?php echo form_input($user_id); ?>
                        <?php echo form_hidden($csrf); ?>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary col-md-12  " id="">
                            <span class="glyphicon glyphicon-refresh btn_" style=""></span> 
                            Guardar
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
    <?php echo $pie_pagina;













