<?php
echo $header_html;
echo $header;
?>
<br />
<section class="cuerpo container-fluid">
    <div id='maestro' class=" " style="">
        <div class="panel panel-default  ">
            <div class="panel-heading">    
                <h3 class="text-left ">Validar inscripciones
                    <i class="glyphicon glyphicon-list-alt float_derecha" ></i>
                    <i class="glyphicon glyphicon-ok float_derecha" ></i>
                </h3>
            </div>
            <div class="panel-body">
                <?php foreach ($output->css_files as $file): ?>
                    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <?php endforeach; ?>
                <?php foreach ($output->js_files as $file): ?>
                    <script src="<?php echo $file; ?>"></script>
                <?php endforeach; ?>
                <div class="tabla_crud"><?= $output->output; ?>  </div>  
            </div>
        </div>
    </div>
    <script src="javascript/maestro.js"></script>
    <?php echo $footer; ?>


