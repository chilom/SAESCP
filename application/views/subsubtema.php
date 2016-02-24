<?php
echo $encabezado_html;
echo $encabezado_pagina;
?>
<script src="assets/javascript/reloj.js"></script>
<script src="assets/javascript/contenido_subsubtema.js"></script>

<section class="cuerpo">
    <section id='estudiante' class="col-md-12 " style="background-color: #e5e5e5; ">
        <!--<div class="alert alert-success">
            <i class="glyphicon glyphicon-info-sign col-md-2" style="font-size: 2em;"></i>
            <a class="  close  " data-dismiss="alert" >X</a>                                  
            1. Da click en algun subtema<br>
            2. Accede al contenido dando click en IR.<br>
            * En caso de tener subsubtemas, accede dando click en el subsubtema     
        </div>-->
        <div class="col-md-3">
            <h4 id="head_tema "  class="head_tema_cont text-left">
                Subsubtema: 
                <span class="text-lowercase" id="subsub_elegido" value="<?php echo $id_ss; ?>"><?php echo $subsubtema; ?></span> 
            </h4>
            <h5 class="head_t_cont" >Contenido</h5>
            <div id="loader_cc" hidden="true">
                <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                <span class="text-primary">cargando información</span>
            </div>
            <div id="links_contenido" class="text-left">
                <?php
                if ($contenido_ss != null) {
                    foreach ($contenido_ss as $ssclave) {
                        ?>
                        <li class="link_ss " data="<?php echo $ssclave->id; ?>" value="<?php echo $ssclave->url; ?>">
                            <?php
                            echo '<i  class=" glyphicon glyphicon-book"></i> &nbsp;' . $ssclave->nombre;
                            ?>                         
                        </li>                        
                        <?php
                    }
                } else {
                    ?>    
                    <li class=" col-md-12 alert alert-warning" value="">
                        <a class="  close  " data-dismiss="alert" >X</a>
                        No hay contenido,<a href="curso_controller/"> volver</a>
                    </li>
                <?php } ?>
            </div>

            <hr>
            <div class="btn btn-success" id="termine_leer"  >
                <i class="glyphicon glyphicon-eye-open"></i>
                Termine la lectura
            </div> 
            <hr>
            <div class="col-md-12">                
                <button id="btn_actividad" class="btn btn-primary botones_contenido col-md-" disabled="true"> 
                    <i class="glyphicon glyphicon-file"></i>
                    Actividades
                </button>
                <button id="btn_verificar" class="btn btn-primary botones_contenido col-md-" disabled="true"> 
                    <i class="glyphicon glyphicon-check"></i>
                    Verificar
                </button>
                <div id="loader_actividades" hidden="true">
                    <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                    <span class="help-block"> Espere...cargando información.</span>
                </div>

                <div class="" id="contenedor_actividades">
                </div>
                
                <div id="resultado_actividad" class="col-md-12 alert alert-success" hidden="true"></div>

            </div>
            <div class="col-md-12">
                <hr>
                <button id="btn_evaluacion" class="btn btn-primary botones_contenido col-md-5"  disabled="true">  
                    <i class="glyphicon glyphicon-education"></i>
                    Evaluacion
                </button>
                <button id="btn_calificar" class="btn btn-primary botones_contenido"  disabled="true">  
                    <i class="glyphicon glyphicon-check"></i>
                    Calificar
                </button>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <hr>
            </div>
            <div id="resultado_evaluacion" class="col-md-12 alert alert-success " hidden="true">

            </div>
            <input type="hidden" id="id_contenido">
        </div>
        <div class="col-md-9" id="contenido">
            <div class="alert alert-warning"> 
                <i class="glyphicon glyphicon-info-sign" style="float: left;"> </i>
                <a class="  close  " data-dismiss="alert" >X</a>&nbsp;&nbsp;&nbsp;
                Selecciona un  enlace de la seccion contenido para comenzar la lectura.
            </div>
        </div>
    </section>
            <?php print_r($this->session->all_userdata());?>

    <?php
    echo $pie_pagina;



    