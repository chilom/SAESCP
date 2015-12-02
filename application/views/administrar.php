<?php
echo $header_html;
echo $header;
?>
<section class="cuerpo ">
    <?php echo $menu; ?>      
    <div class=" col-md-12">
        <div class="panel panel-default  ">
            <div class="panel-heading">    
                <h4 class="">Administración avanzada de usuarios
                    <i class="glyphicon glyphicon-remove-sign  float_derecha" style="margin-left: 1%;"></i>
                    <i class="glyphicon glyphicon-check  float_derecha" style="margin-left: 1%;"></i>
                    <i class="glyphicon glyphicon-search  float_derecha" style="margin-left: 1%;"></i>
                    <i class="glyphicon glyphicon-export  float_derecha" style=""></i>
                </h4>
            </div>
            <div class="panel-body">
                <?php foreach ($output->css_files as $file): ?>
                    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <?php endforeach; ?>
                <?php foreach ($output->js_files as $file): ?>
                    <script src="<?php echo $file; ?>"></script>
                <?php endforeach; ?>
                <div class="table-responsive ">
                    <?php echo $output->output; ?>    
                </div>
            </div>
            <div class="panel-footer"></div>
        </div>
    </div>
    <?php echo $footer; ?>