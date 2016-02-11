<?php 
echo $header_html; 
echo $header;
?> 
<br />
<section class="cuerpo container-fluid">
        <div class="panel panel-default ">
            <div class="panel-heading">                                       
                <h3>
                    Inscripciones
                    <i class="glyphicon glyphicon-briefcase float_derecha" ></i>
                    <i class="glyphicon glyphicon-check float_derecha"></i>
                </h3> 
            </div>
            <div class="panel-body">
                <div class="col-md-2"></div>
                <?php echo form_open('estudiante_controller/verifica_no_inscrito', array('class' => 'col-md-5')); ?>
                <fieldset  class="">
                    <legend class="help-block">Datos requeridos</legend>
                    <select class="form-control " name="curso_inscribir" id="curso_inscribir" required='true'>
                        <option value="">- Cursos -</option>
                    </select> 
                    <div id="loader_insc" >
                        <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif">
                        <span class="text-primary">Cargando cursos...</span>
                    </div>     
                    <br />
                    <button type="submit" class="btn btn-primary col-md-12 " id="" >
                        <i class="glyphicon glyphicon-ok btn_"></i> 
                        Inscribirme
                    </button>

                    <a class="btn btn-default col-md-12" href="auth/" style="margin-top: 2%;">
                        <span class="glyphicon glyphicon-remove btn_" style=""></span>
                        Cancelar
                    </a>
                    <input id='user_id' name="user_id" type="hidden" value="<?= $this->session->userdata('user_id'); ?>">                       
                </fieldset>
                <?php echo form_close(); ?>
                <div class="col-md-5"><?php echo $message; ?></div>
            </div>
            <div class="panel-footer ">
            </div>
        </div>
    <script src="assets/javascript/reloj.js"></script>    
    <script src="assets/javascript/estudiante_inicio.js"></script>
 <?php echo $footer; ?>







