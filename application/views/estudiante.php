<?php
echo $header_html;
echo $header;
?>
<script src="assets/javascript/autenticacion.js"></script>    
<script src="assets/javascript/reloj.js"></script>    
<script src="assets/javascript/estudiante_inicio.js"></script>
<section class="cuerpo">
    <?php echo $menu; ?>
    <div class=" col-md-12 ">
        <div class="col-md-10"></div>                        
    </div>
    <div class="col-md-12">
        <div class="secccion_t_e col-md-2">
            <div class="panel panel-danger ">
                <div class="panel-heading">    
                    <h5 class="col-md- ">Temas a realizar</h5>  
                </div>
                <div class="panel-body" id="temas_realizar">
                    <div class="col-md-6 t_r" id="t_actual">
                        <i class="glyphicon glyphicon-flash"></i><br>
                    </div>

                    <div class="col-md-6 t_r" id="t_siguiente">
                        <i class="glyphicon glyphicon-chevron-right"></i>
                    </div>

                </div>      
            </div>
        </div>
        <div class="col-md-8">        
            <div class="col-md-12 seccion_estudiante" >
                <div class="col-md-"><?php echo $message; ?></div>
                <div class="panel panel-default ">                    
                    <div id="" class="panel-heading">
                        <h4 class="" >Mis cursos</h4>
                    </div>
                    <div class="panel-body">
                        <div id="mis_cursos" class="col-md-12">
                            <?php
                            if ($mis_cursos != null) {
                                foreach ($mis_cursos as $curso) {
                                    ?>
                                    <a class="col-md-4 btn btn-primary" href="curso_controller/llena_temario/<?php echo $curso->curso_id; ?>">
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
                    </div>
                </div>  
            </div>   <!-- fin de seccion estudiante-->
            <div class="col-md-10 seccion_avance" >
                <div class="panel panel-default ">
                    <div id="" class="panel-heading">
                        <h5 class="">Avance por curso </h5>
                    </div>
                    <div class="panel-body">
                        <input id='id' type="hidden" value="<?= $this->session->userdata('user_id'); ?>">
                        <div id="avance_curso" class="">
                        </div>
                    </div>               
                </div>  
            </div> 
        </div>
        <div class="col-md-2"> 
            <div class="panel panel-danger">
                <div class="panel-heading">           
                    <h5 class=" ">Resumen de mi actividad</h5>  
                </div>
                <div class="panel-body">
                </div>
            </div>
        </div>
    </div> 
    <?php echo $footer; ?>
