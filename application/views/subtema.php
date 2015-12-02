<?php
echo $encabezado_html;
echo $encabezado_pagina;
?>
<script src="assets/javascript/reloj.js"></script>
<script src="assets/javascript/temas.js"></script>

<section class="cuerpo">
    <?php echo $menu; ?>
    <section id='estudiante' class="col-md-12 " style=" ">
        <!--<div class="alert alert-success">
            <i class="glyphicon glyphicon-info-sign col-md-2" style="font-size: 2em;"></i>
            <a class="  close  " data-dismiss="alert" >X</a>                                  
            1. Da click en algun subtema<br>
            2. Accede al contenido dando click en IR.<br>
            * En caso de tener subsubtemas, accede dando click en el subsubtema     
        </div>-->
        <div class="col-md-3">
            <h4 id="head_tema"  class="text-left head_tema_cont">
                Subtema: <span class="text-lowercase"><?php echo $subtema; ?></span> 
            </h4>
            <div id="ss_aprender"  >
                <h4 class="head_t_cont" >subsubtemas</h4>                       
                <?php
                if ($subsubtemas != null) {
                    foreach ($subsubtemas as $ssclave) {
                        ?>
                        <li class="ssubtemas " value="<?php echo $ssclave->idss; ?>">
                            <?php
                            echo $ssclave->nt . '. ' . $ssclave->ns . '. ' . $ssclave->nss . '. ' . $ssclave->nombress;
                            ?>                         
                        </li>
                        <?php
                    }
                } else {
                    ?>    
                    <li class=" col-md-12 alert alert-warning" value="">
                        No hay subsubtemas,<a href="curso_controller/"> volver</a>
                    </li>
                <?php } ?>
            </div>   
            <div class="col-md-12">
                <h5 class="head_t_cont" >Contenido</h5>
                <div id="loader_cc" hidden="true">
                    <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                    <span class="help-block"> cargando...</span>
                </div>
                <div id="links_contenido" class="">

                </div>
                <div style="">
                    <hr>
                    <div class="btn btn-success" id="termine_leer" >
                        <i class="glyphicon glyphicon-eye-open"></i>
                        Termine la lectura</div> 
                    <hr>

                    <button class="btn btn-primary botones_contenido" > 
                        <i class="glyphicon glyphicon-file"></i>
                        actividad</button>

                    <button class="btn btn-primary botones_contenido" >  
                        <i class="glyphicon glyphicon-education"></i>
                        evaluacion
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="contenido">
        <?php print_r($this->session->all_userdata());?>

        </div>
    </section>
    <?php echo $pie_pagina; ?>



