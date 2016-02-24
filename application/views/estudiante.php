<?php
echo $header_html;
echo $header;
?>
<section class="cuerpo container-fluid">

    <div class="col-md-12 seccion_estudiante" >
        <div class="col-md-"><?php echo $message; ?></div>
        <div class="panel panel-default ">                    
            <div id="" class="panel-heading">
                <h4 class="" >
                    Mis cursos
                    <i class="glyphicon glyphicon-briefcase float_derecha"></i>
                </h4>
            </div>
            <div class="panel-body">
                <div id="mis_cursos" class="col-md-12">
                    <?php
                    if ($mis_cursos != null) {
                        foreach ($mis_cursos as $curso) {
                            ?>
                            <a class="col-md-12 mis_cursos text-center " href="curso_controller/llena_temario/<?php echo $curso->curso_id; ?>">
                                <?php echo $curso->nombre; ?>  
                            </a>
                            <?php
                        }
                    } else {
                        ?>
                        <div class="col-md-12 alert alert-warning" >
                            <b>Sin informacion, pobablemente el maestro aun esta administrando los cursos.</b> 
                        </div>
                    <?php } ?>
                </div>

                <hr>
                <div class="col-md-8 seccion_avance" >
                    <div class="panel panel-default ">
                        <div id="" class="panel-heading">
                            <h5 class="">Avance por curso </h5>
                        </div>
                        <div class="panel-body">
                            <input id='id' type="hidden" value="<?= $this->session->userdata('user_id'); ?>">
                            <div id="avance_curso" class="">
                                <span id="resultado_avance_curso">Aun no inicias ningún curso.</span>
                            </div>
                        </div>               
                    </div>  
                </div> 

                <div class="col-md-4"> 
                    <div class="panel panel-info">
                        <div class="panel-heading">           
                            <h5 class=" ">Resumen de mi actividad</h5>  
                        </div>
                        <div class="panel-body">
                            <span id="resultado_resumen">Aun no hay actividad en ningún curso.</span>
                        </div>
                    </div>
                </div>
                <div class="secccion_t_e col-md-4">
                    <div class="panel panel-info ">
                        <div class="panel-heading">    
                            <h5 class="col-md- ">Temas a realizar</h5>  
                        </div>
                        <div class="panel-body" id="temas_realizar">
                            <div class="col-md-6 t_r btn btn-block btn-default" id="t_actual">
                                <i class="glyphicon glyphicon-flash"></i>Siguiente
                            </div>

                            <div class="col-md-6 t_r btn btn-block btn-default" id="t_siguiente">
                                <i class="glyphicon glyphicon-chevron-right"></i>Anterior
                            </div>
                        </div>      
                    </div>
                </div>
            </div>
        </div>
    </div>  
</div>   <!-- fin de seccion estudiante-->



<script src="assets/javascript/autenticacion.js"></script>    
<script src="assets/javascript/reloj.js"></script>    
<script src="assets/javascript/estudiante_inicio.js"></script>
<?php echo $footer; ?>
