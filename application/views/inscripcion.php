<?php
echo $header_html;
echo $header;
?>
<section class="cuerpo">
    <?php echo $menu; ?>
    <section id='maestro' class=" col-md-12 " style="">
        <div class="panel panel-default  ">
            <div class="panel-heading">    
                <h4 class="text-center text-">Validar inscripciones</h4>                  
            </div>
            <div class="panel-body">
                <?php foreach ($output->css_files as $file): ?>
                    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <?php endforeach; ?>
                <?php foreach ($output->js_files as $file): ?>
                    <script src="<?php echo $file; ?>"></script>
                <?php endforeach; ?>
                <script src="javascript/maestro.js"></script>
                <div class="tabla_crud"><?= $output->output; ?>  </div>  
            </div>
        </div>
        <?php
        echo $footer;
        ?>


