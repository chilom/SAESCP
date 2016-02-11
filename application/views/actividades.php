<?php
$url_actividad = array(
    'type' => 'url',
    'class' => ' form-control text-center',
    'name' => 'url_actividad',
    'placeholder' => 'URL',
    'required' => 'true'
);
$nombre_actividad = array(
    'class' => ' form-control text-center',
    'name' => 'nombre_actividad',
    'placeholder' => 'Nombre',
    'required' => 'true',
);

$crea_actividad = array(
    'class' => 'btn btn-primary form-control',
    'id' => 'crea_actividad', 'value' => 'Agregar actividad');
$atr = array('class' => 'col-md-6', 'style' => '');

echo $encabezado_html;
echo $encabezado_pagina;
?>    
<br />
<section class="cuerpo  container-fluid">
    <div class="panel panel-default ">
        <div class="panel-heading">    
            <h3 class="text-left">
                Registro de actividades
                <i class="glyphicon glyphicon-file float_derecha" ></i>
                <i class="glyphicon glyphicon-plus-sign float_derecha" ></i>
            </h3>
        </div>
        <div class="panel-body">
            <div class="col-md-2"></div>
            <?= form_open(base_url() . 'actividades_controller/valida_entradas_actividad', $atr); ?>                  
            <fieldset  class="">
                <legend class="help-block">Datos requeridos</legend>
                <div id="loader_act">
                    <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                    <span class="text-primary">Cargando información...</span>
                </div>   
                <select class="form-control " required="true" id="cursos_act" name="cursos_act" >
                    <option value="">- Cursos -</option>
                </select>       
                <select class="form-control " required="true" id="temas_act" name="temas_act" >
                    <option value="">- Temas -</option>
                </select> 
                <div class="col-md-12">   
                    <br />
                    <div class="col-md-6">                    
                        <select class="form-control" id="stemas_act" name="stemas_act" >
                            <option value="">- Subtemas -</option>
                        </select>                             
                    </div>
                    <div class="col-md-6">
                        <select class="form-control"  id="sstemas_act" name="sstemas_act" >
                            <option value="">- Subsubtemas -</option>
                        </select>  
                        <br>
                    </div>
                </div>
                <hr>
                <?= form_input($nombre_actividad); ?> 
                <?= form_input($url_actividad); ?> 
                <div class="col-md-4"></div>
                <button type="submit" class="btn btn-primary col-md-12 " id="">
                    <i class="glyphicon glyphicon-save " style="float:left;"></i>
                    Agregar actividad
                </button> 
            </fieldset>
            <?= form_close(); ?>
            <div class="col-md-4"><?php echo $message; ?></div>
        </div> <!-- fin panel body-->
    </div>  <!-- fin panel default-->

    <script src="assets/javascript/temario.js"></script>
    <script src="assets/javascript/actividades.js"></script>
    <?php echo $pie_pagina; ?>