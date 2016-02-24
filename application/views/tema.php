<?php
echo $encabezado_html;
echo $encabezado_pagina;
?>

<section class="cuerpo container-fluid">

    <section id='estudiante' class="col-md-12 " style=" background-color: #e5e5e5;">
        <!--   <div class="alert alert-success text-left">
               <i class="glyphicon glyphicon-info-sign col-md-2" style="font-size: 2em;"></i>
               <a class="  close  " data-dismiss="alert" >X</a>                                  
               <p> 1. Da click en algun subtema </p>  
               <p>   2. Accede al contenido dando click en IR. </p>  
               <p>   * En caso de tener subsubtemas, accede dando click en el subsubtema </p>  
           </div>-->
        <div class="col-md-3">
            <h4 id=""  class="text-left  head_tema_cont">
                Tema: <?php echo $tema; ?>
            </h4>

            <!--seccion link de contenido de subtema -->
            <div class="col-md-12">
                <h5 class="head_t_cont" >
                    <i class="glyphicon glyphicon-book" style="float:left;"></i>
                    Contenido</h5>                
                <div id="links_contenido" class="text-justify">
                    <?php
                    if ($contenido_tema != null) {
                        foreach ($contenido_tema as $ssclave) {
                            ?>
                            <li class="link_ss label-warning col-md-12" data="<?php echo $ssclave->id; ?>" value="<?php echo $ssclave->url; ?>">
                                <?php
                                echo '<i  class=" glyphicon glyphicon-link" style="float:right;"></i> &nbsp;' . $ssclave->nombre;
                                ?>                         
                            </li>                        
                            <?php
                        }
                    } else {
                        ?>    
                        <li class=" col-md-12 alert alert-warning text-center" value="">
                            <i class="glyphicon glyphicon-info-sign" style="float:left;"></i>
                            <a class="  close  " data-dismiss="alert" >X</a>&nbsp;
                            No hay contenido,<a href="curso_controller/"> volver</a>
                        </li>
                    <?php } ?>
                </div>
                <div id="loader_lectura_terminada" hidden="true">
                    <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                    <span class="text-primary">Cargando lectura</span>
                </div>

            </div>
            <hr>
            <div class="btn btn-success col-md-12" id="termine_leer"  >
                <i class="glyphicon glyphicon-eye-open icono_btn" ></i>
                Termine la lectura
            </div> 
            <hr>
            <div class="col-md-12">                
                <button id="btn_actividad" class="btn btn-primary botones_contenido col-md-12" disabled="true"> 
                    <i class="glyphicon glyphicon-file" style="float: left;"></i>
                    Actividades
                </button>
                <button id="btn_verificar" class="btn btn-success botones_contenido col-md-" disabled="true"> 
                    <i class="glyphicon glyphicon-check"></i>
                    Enviar resultados
                </button>
                <div id="loader_actividades" hidden="true">
                    <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                    <span class="text-primary">Cargando información</span>
                </div>

                <div class="" id="contenedor_actividades">

                </div>
                <div id="loader_actividad_terminada" hidden="true">
                    <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                    <span class="text-primary">Cargando actividad</span>
                </div>
                <div id="resultado_actividad" class="col-md-12 alert alert-success" hidden="true"></div>

            </div>
            <div class="col-md-12">
                <hr>
                <button id="btn_evaluacion" class="btn btn-primary botones_contenido col-md-12"  disabled="true">  
                    <i class="glyphicon glyphicon-education icono_btn"></i>
                    Evaluacion
                </button>
                <button id="btn_calificar" class="btn btn-success botones_contenido"  disabled="true">  
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
        </div>

        <div class="col-md-9 " id="contenido">
            <?php if ($contenido_tema != null) { ?>
                <div class="alert alert-success">
                    <i class="glyphicon glyphicon-info-sign" style="float:left;"></i>
                    Selecciona un enlace de contenido para comenzar la lectura.
                </div>
            <?php } else { ?>
                <div class="alert alert-success">
                    <i class="glyphicon glyphicon-alert" style="float:left;"></i>
                    <a class="  close  " data-dismiss="alert" >X</a>&nbsp;
                    No hay lecturas disponibles.
                </div>
            <?php } ?>
        </div>
        <input type="hidden" id="id_contenido">
    </section>



    <!-- ventanas modales de aviso -->

    <div id="modal_lectura" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-primary">Sistema de apoyo para la evaluación de saberes en cursos de programación.</h4>
                </div>
                <div class="modal-body">
                    <h2 class="text-success">Este archivo a sido leido, <br>
                        debiste leer bien.
                    </h2>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="glyphicon glyphicon-check"></i>
                        Aceptar</button>
                </div>
            </div>

        </div>
    </div>
    <div id="modal_actividad" class="modal fade" role="dialog">
        <div class="modal-dialog ">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-primary">Sistema de apoyo para la evaluación de saberes en cursos de programación.</h4>
                </div>
                <div class="modal-body">
                    <h2 class="text-success">Esta actividad a sido realizada.
                    </h2>                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">
                        <i class="glyphicon glyphicon-check"></i>
                        Aceptar</button>
                </div>
            </div>
        </div>
    </div>
<script src="assets/javascript/temas.js"></script>
<script src="assets/javascript/reloj.js"></script>
<script src="assets/javascript/contenido_subsubtema.js"></script>
    <?php echo $pie_pagina; ?>



