<?php
echo $encabezado_html;
?>


<nav class="navbar  navbar-inverse col-md- navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand" >
                <span class=" ">SAESC P</span> 
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class=" ">
                </li>   
                <li class=" ">
                </li> 
            </ul>
        </div>
    </div>
</nav>
<section class="cuerpo">
    <div class="row col-md-12">         
        <div class="col-md-3"></div>
        <div class="col-md-6 help-block">
            <h1><?php //echo lang('forgot_password_heading');   ?></h1>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">            
        </div>
    </div>
    <div class="row col-md-12"> 
        <?php echo $message; ?>   
        <div class="panel panel-default ">
            <div class="panel-heading">    
                <div class="col-md-1">
                </div>                    
                <h3>
                    Reestablecer contraseña
                    <i class="glyphicon glyphicon-lock float_derecha" ></i>
                    <i class="glyphicon glyphicon-edit float_derecha" ></i>
                </h3> 
            </div>
            <div class="panel-body">
                <div class="col-md-3"></div>
                <?php echo form_open(base_url() . 'auth/reset_password/' . $code, array('class' => 'col-md-5')); ?>
                <?php echo form_input($new_password); ?>   
                <?php echo form_input($new_password_confirm); ?> 
                <?php echo form_input($user_id); ?>
                <?php echo form_hidden($csrf); ?>
                <button type="submit" class="btn btn-primary col-md-12  " id="">
                    <span class="glyphicon glyphicon-refresh btn_" style=""></span> 
                    Guardar
                </button>
                <a class="btn btn-default col-md-12" href="auth/">
                    <span class="glyphicon glyphicon-remove btn_" style=""></span>
                    Cancelar
                </a>
                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer ">
            </div>
        </div>

    </div>
    <script src="assets/javascript/reestablecer.js"></script>
    <?php echo $pie_pagina;?>













    