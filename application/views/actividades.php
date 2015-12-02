<?php
$url_actividad = array(
    'type' => 'url',
    'class' => ' form-control text-center',
    'name' => 'url_actividad',
    'placeholder' => 'URL de actividad',
    'required' => 'true'
);
$nombre_actividad = array(
    'class' => ' form-control text-center',
    'name' => 'nombre_actividad',
    'placeholder' => 'Nombre de actividad',
    'required' => 'true',
);

$crea_actividad = array(
    'class' => 'btn btn-primary form-control',
    'id' => 'crea_actividad', 'value' => 'Agregar actividad');
$atr = array('class' => '', 'style' => '');

echo $encabezado_html;
echo $encabezado_pagina;
?>    
<script src="javascript/temario.js"></script>
<script src="javascript/actividades.js"></script>

<section class="cuerpo">
    <?php echo $menu ?>
    <section id='' class=" col-md-12 " style=" ">       
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="panel panel-default ">
                <div class="panel-heading">    
                    <h4 class="text-center help-block">
                        <i class="glyphicon glyphicon-file" style="float: left;"></i>
                        Registro de actividades</h4>
                </div>
                <div class="panel-body">
                    <?php echo $message; ?>  

                    <div  id="error_act" class="text-primary">

                    </div>
                    <?= form_open(base_url() . 'actividades_controller/valida_entradas_actividad', $atr); ?>                  
                    <div id="loader_act">
                        <img src="<?php echo base_url() ?>imagenes/ajax-loader.gif"> 
                        <span class="text-primary">cargando información</span>
                    </div>   
                    <select class="form-control " required="true" id="cursos_act" name="cursos_act" >
                        <option value="">- cursos -</option>
                    </select>       
                    <select class="form-control " required="true" id="temas_act" name="temas_act" >
                        <option value="">- temas -</option>
                    </select> 
                    <div class="col-md-12">   
                        <hr>
                        <div class="col-md-6">                    
                            <select class="form-control" id="stemas_act" name="stemas_act" >
                                <option value="">- subtemas -</option>
                            </select>                             
                        </div>
                        <div class="col-md-6">
                            <select class="form-control"  id="sstemas_act" name="sstemas_act" >
                                <option value="">- subsubtemas -</option>
                            </select>  
                            <br>
                        </div>
                    </div>
                    <?= form_input($nombre_actividad); ?> 
                    <?= form_input($url_actividad); ?> 
                    <div class="col-md-4"></div>
                    <button type="submit" class="btn btn-primary col-md-12 " id="">
                        <i class="glyphicon glyphicon-save " style="float:left;"></i>
                        Agregar actividad
                    </button> 
                    <?= form_close(); ?>
                </div> <!-- fin panel body-->
            </div>  <!-- fin panel default-->
        </div>
    </section>
    <?php echo $pie_pagina; ?>