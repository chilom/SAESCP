<?php
echo $encabezado_html;
echo $encabezado_pagina;
?>
<section class="cuerpo">
    <div class="row col-md-12">         
        <div class="col-md-3"></div>
        <div class="col-md-6 help-block">
            <h1><?php //echo lang('forgot_password_heading');         ?></h1>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-3">            
        </div>
    </div>
    <div class=" col-md-12"> 
        <div class="col-md-3 menu_i" >

        </div>
        <div class="col-md-6">
            <?php echo $message; ?>   
            <div class="panel panel-primary ">
                <div class="panel-heading">    
                    <div class="col-md-1">
                        <a class="btn btn-danger " href="auth/">
                            <i class="glyphicon glyphicon-remove " style=""></i></a>
                    </div>                    
                    <h1><?php echo lang('reset_password_heading'); ?></h1>
                </div>
                <div class="panel-body ">
                    <?php
                    $email = array('name' => 'email',
                        'id' => 'email',
                        'class' => 'text-center form-control',
                        'placeholder' => 'Nombre de usuario',
                        'aria-describedby' => "sizing-addon1",
                            //'required' => 'true'
                    );
                    ?>
                    <h1><?php echo lang('forgot_password_heading'); ?></h1>
                    <p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label); ?></p>
                    <?php echo form_open("auth/forgot_password"); ?>
                    <p>
                        <label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label); ?></label> <br />
                        <?php echo form_input($email); ?>
                    </p>

                    <p><?php echo form_submit('submit', lang('forgot_password_submit_btn')); ?></p>

                    <?php echo form_close(); ?>

                </div>
                <div class="panel-footer ">

                </div>
            </div>
        </div>
    </div>

</section>
<?php echo $pie_pagina; ?>

















