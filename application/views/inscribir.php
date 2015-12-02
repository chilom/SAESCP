
<?php
echo $header_html;
echo $header;
?>
<!--<script src="javascript/temario.js"></script>-->
<script src="assets/javascript/estudiante_inicio.js"></script>
<script src="assets/javascript/reloj.js"></script>

<section class="cuerpo">
    <?php echo $menu; ?>
    <div class="row col-md-12 ">
        <div class="col-md-10"></div>                                  
    </div>
    <section id="" class="   col-md-12" >  
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <?php echo $message; ?>
            <div id="err_insc"></div>
            <div class="panel panel-default ">
                <div class="panel-heading">    
                    <h4>Inscribir cursos</h4>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <?php echo form_open('estudiante_controller/verifica_no_inscrito', array('class' => '')); ?>
                        <i class="col-md-1 glyphicon glyphicon-briefcase icon_form" ></i> 
                        <div class="col-md-7"> 
                            <select class="form-control " name="curso_inscribir" id="curso_inscribir" required='true'>
                                <option value="">- Cursos -</option>
                            </select> 
                            <div id="loader_insc" >
                                <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif">
                                <span class="text-primary">cargando cursos...</span>
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary col-md-12 " id="" style="margin-top: 0%;">
                                <i class="glyphicon glyphicon-ok btn_"></i> 
                                Inscribirme
                            </button>
                            <hr>
                            <a class="btn btn-default col-md-12" href="auth/">
                                <span class="glyphicon glyphicon-remove btn_" style=""></span>
                                Cancelar
                            </a>
                        </div>

                        <input id='user_id' name="user_id" type="hidden" value="<?= $this->session->userdata('user_id'); ?>">                       

                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div class="panel-footer ">
                </div>
            </div>
        </div>
        <div class="col-md-2  ">        
        </div>
    </section>   
    <?php echo $footer; ?>







