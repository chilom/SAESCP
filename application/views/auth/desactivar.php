<?php 
//echo $header_html;
?>

<section class="col-md-12 jumbotron" style="background-color: gray;">
    <div class="row">
        <h1><?php echo lang('deactivate_heading'); ?></h1>
        <br>
        <b class="text-warning "><?php echo sprintf(lang('deactivate_subheading'), $user->username); ?></b>
    </div>

    <div class="col-md-3">    
    </div>
    <?php echo form_open("auth/desactiva/" . $user->id); ?>
    <br>
    <div class="input-group">
        <div class="input-group-addon">
            <?php echo lang('deactivate_confirm_y_label', 'confirm'); ?>
            <input type="radio" name="confirm" value="yes" checked="checked" />
        
            <?php echo lang('deactivate_confirm_n_label', 'confirm'); ?>
            <input type="radio" name="confirm" value="no" />
            <?php echo form_hidden($csrf); ?>
            <?php echo form_hidden(array('id' => $user->id)); ?>
        </div>

    </div>
    <hr>
    <div class="col-md-12">
        <div class="col-md-4"></div>
        <?php echo form_submit(array('class' => 'btn btn-primary col-md-4'), lang('deactivate_submit_btn')); ?>
    </div>
    <?php echo form_close(); ?>
</section>
</section>

