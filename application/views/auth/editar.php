<?php
echo $header_html;
echo $header;
?>

<script src="javascript/editar.js"></script>
<script src="javascript/registrar.js"></script>

<section class="cuerpo">
    <?php echo $menu; ?>
    <div class="col-md-3"></div>
    <div class="col-md-6">
        <div id=""><?php echo $message; ?></div>
        <div class="panel panel-default text-">
            <div class="panel-heading ">  
                <div class="col-md-1">
                </div>                    
                <h4><?php echo lang('edit_user_heading'); ?></h4>                
            </div>
            <div class="panel-body">
                <h5 class="help-block text-left"><?php echo lang('edit_user_subheading'); ?></h5>
                <?php echo form_open(uri_string()); ?>
                <?php echo form_input($username); ?>
                <?php echo form_input($nombre); ?>
                <?php echo form_input($email); ?>
                <?php echo form_input($password); ?>
                <?php echo form_input($password_confirm); ?>
                <div class="col-md-8">       <?php if ($this->ion_auth->is_admin()): ?>
                        <h4 class="text-left">Rol de usuario:</h4>
                        <?php foreach ($groups as $group): ?>
                            <div class="col-md-4">  
                                <label class="checkbox">
                                    <?php
                                    $gID = $group['id'];
                                    $checked = null;
                                    $item = null;
                                    foreach ($currentGroups as $grp) {
                                        if ($gID == $grp->id) {
                                            $checked = ' checked="checked"';
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                                    <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                </label>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>
                    <?php echo form_hidden('id', $user->id); ?>
                    <?php echo form_hidden($csrf); ?>
                </div> 
                <div class="col-md-4">      
                    <button type="submit" class="btn btn-primary col-md-12 " id="">
                        <span class="glyphicon glyphicon-refresh btn_" style=""></span> 
                        Guardar cambios
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
    <?php echo $footer; ?>