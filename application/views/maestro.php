<?php
echo $header_html;
echo $header;
?>
<script src="assets/javascript/maestro.js"></script>
<section class="cuerpo">
    <?php echo $menu; ?>
    <section id='maestro' class=" col-md-12 " style="">

        <div class="panel panel-default  ">
            <div class="panel-heading"> 
                <h4  class=" text- text-center" style="">
                    Administración de cursos    
                </h4>  
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
    <script src="assets/javascript/bootstrap.min.js"></script>   
    <?php
    echo $footer;?>



















    