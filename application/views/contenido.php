<?php
$tipo_contenido = array('' => 'Tipo de contenido', 1 => 'interno', 2 => 'externo');
$url_contenido = array('type' => 'url', 'class' => ' form-control ', 'name' => 'url_contenido', 'placeholder' => 'URL del contenido', 'required' => 'true');
$nombre_contenido = array('type' => 'text', 'class' => ' form-control ', 'name' => 'nombre_contenido', 'placeholder' => 'Nombre del contenido', 'required' => 'true');

$atrib = array('id' => 'form_ajax_contenido');
$atipo = array('class' => 'form-control',);
echo $encabezado_html;
echo $encabezado_pagina;
?>

<section class="cuerpo">
    <?php echo $menu ?>
    <section id='' class=" col-md-12 " style=" ">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">            
            <?php echo $message; ?>  
            <div class="panel panel-default ">
                <div class="panel-heading">  
                    <h4 class="text-center help-block " style=""> 
                            <i class="glyphicon glyphicon-book" style="float: left;"></i>
                        Registro de contenido
                    </h4>
                </div>
                <div class="panel-body">

                    <div id="loader_cont">
                        <img src="<?php echo base_url() ?>imagenes/ajax-loader.gif"> 
                        <span class="text-primary">cargando información</span>
                    </div>                    
                    <?= form_open(base_url() . 'contenido_controller/valida_entradas_contenido', $atrib); ?> 
                    <select id="cursos_cont" class="form-control" required="true" name="cursos_cont"  >
                        <option value="">-Selecciona curso-</option>
                    </select>      
                    <select  id="temas_cont" class="form-control" required="true"  name="temas_cont" >
                        <option value="">-Selecciona tema-</option>
                    </select> 
                    <hr>                
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <select id="stemas_cont"   class="form-control" name="stemas_cont" >
                                <option value="">-Selecciona subtema-</option>
                            </select> 
                        </div>
                        <div class="col-md-6">
                            <select id="sstemas_cont"   class="form-control" name="sstemas_cont">
                                <option value="">-Selecciona subsubtema-</option>
                            </select> 
                        </div>
                    </div>
                    <div class="col-md-12"><hr>
                        <?= form_input($nombre_contenido); ?>     
                        <div class="col-md-3">
                            <select id="tipo_contenido" required="true"  class="form-control" name="tipo_contenido" >
                                <option value="">-Tipo-</option>
                                <option value="1">interno</option>
                                <option value="2">externo</option>
                            </select> 
                        </div>     
                        <div class="col-md-9">
                            <?= form_input($url_contenido); ?>     
                        </div>  
                        <div class="col-md-4"></div>
                        <button type="submit" class="btn btn-primary col-md-12  " id="">
                            <i class="glyphicon glyphicon-save " style="float:left;"></i>
                            Agregar contenido
                        </button>   
                        <?= form_close(); ?>
                    </div>
                </div> <!-- fin panel body-->              
            </div><!-- fin panel default-->
        </div>
    </section>


    <script src="javascript/temario.js"></script>
    <script src="javascript/contenido.js"></script>
    <?php echo $pie_pagina; ?>