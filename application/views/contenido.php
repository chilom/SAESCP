<?php
$tipo_contenido = array('' => 'Tipo de contenido', 1 => 'interno', 2 => 'externo');
$url_contenido = array('type' => 'url', 'class' => ' form-control ', 'name' => 'url_contenido', 'placeholder' => 'URL del contenido', 'required' => 'true');
$nombre_contenido = array('type' => 'text', 'class' => ' form-control ', 'name' => 'nombre_contenido', 'placeholder' => 'Nombre', 'required' => 'true');
$atrib = array('id' => 'form_ajax_contenido', 'class' => 'col-md-6');
$atipo = array('class' => 'form-control',);
echo $encabezado_html;
echo $encabezado_pagina;
?>
<br />
<section class="cuerpo container-fluid">   
    <div class="col-md-12">            
        <div class="panel panel-default ">
            <div class="panel-heading">  
                <h3 class="text-left " style=""> 
                    Registro de contenido
                    <i class="glyphicon glyphicon-book float_derecha" ></i>
                    <i class="glyphicon glyphicon-plus-sign float_derecha" ></i>
                </h3>
            </div>
            <div class="panel-body"> 
                <div class="col-md-2"></div>
                <?= form_open(base_url() . 'contenido_controller/valida_entradas_contenido', $atrib); ?> 
                <fieldset  class="">
                    <legend class="help-block">Datos requeridos</legend>
                    <div id="loader_cont">
                        <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                        <span class="text-primary">Cargando información...</span>
                    </div> 
                    <select id="cursos_cont" class="form-control" required="true" name="cursos_cont"  >
                        <option value="">- Cursos -</option>
                    </select>      
                    <select  id="temas_cont" class="form-control" required="true"  name="temas_cont" >
                        <option value="">- Temas -</option>
                    </select> 
                    <br />
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <select id="stemas_cont"   class="form-control" name="stemas_cont" >
                                <option value="">- Subtemas -</option>
                            </select> 
                        </div>
                        <div class="col-md-6">
                            <select id="sstemas_cont"   class="form-control" name="sstemas_cont">
                                <option value="">- Subsubtemas -</option>
                            </select> 
                        </div>
                    </div>                    
                    <div class="col-md-6">
                        <hr>
                        <select id="tipo_contenido" required="true"  class="form-control" name="tipo_contenido" >
                            <option value="">-Tipo-</option>
                            <option value="1">interno</option>
                            <option value="2">externo</option>
                        </select> 
                    </div>     
                    <div class="col-md-6"><hr><?= form_input($nombre_contenido); ?></div>  
                    <?= form_input($url_contenido); ?>     
                    <div class="col-md-4"></div>
                    <button type="submit" class="btn btn-primary col-md-12  " id="">
                        <i class="glyphicon glyphicon-save " style="float:left;"></i>
                        Agregar contenido
                    </button>   
                </fieldset>
                <?= form_close(); ?>
                <div class="col-md-4"><?php echo $message; ?></div>
            </div>                
        </div> <!-- fin panel body-->              
    </div><!-- fin panel default-->
</div>
<script src="assets/javascript/temario.js"></script>
<script src="assets/javascript/contenido.js"></script>
<?php echo $pie_pagina; ?>