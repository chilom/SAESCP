<?php
echo $header_html;
echo $header;
?>
<script src="assets/javascript/maestro.js"></script>
<br />
<section class="cuerpo">
    <section id='maestro' class=" col-md-12 " style="">

        <div class="panel panel-default  ">
            <div class="panel-heading"> 
                <h3  class=" text- text-left" style="">
                    Administración de cursos    
                    <i class="glyphicon glyphicon-briefcase float_derecha" ></i>
                    <i class="glyphicon glyphicon-cog float_derecha" ></i>
                </h3>  
            </div>
            <div class="panel-body">
                <?php echo $message; ?>
                <?php foreach ($output->css_files as $file): ?>
                    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
                <?php endforeach; ?>
                <?php foreach ($output->js_files as $file): ?>
                    <script src="<?php echo $file; ?>"></script>
                <?php endforeach; ?>
                <?php echo $output->output; ?>     
            </div>
        </div>
    </section>       
    <link rel="stylesheet" href="assets/hojas_estilo_cascada/general.css">
    <?php echo $footer; ?>



















