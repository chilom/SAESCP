<?php
//campos para tema
$numero = array('' => '- numero de tema -', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10);
$nombre_tema = array('class' => ' form-control text-center ', 'name' => 'nombre_tema', 'placeholder' => 'Nombre del tema', 'value' => $this->form_validation->set_value('nombre_tema'),
        //'required' => 'true'
);
$desc_tema = array('class' => ' form-control text-center ',
    'name' => 'desc_tema', 'rows' => 2,
    'placeholder' => 'Descripcion del tema',
    'type' => 'text',
    'value' => $this->form_validation->set_value('desc_tema'),
        // 'required' => 'true'
);

//campos para subtema
$numero_s = array('' => '- numero de subtema -', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10);
$nombre_stema = array('class' => ' form-control text-center ', 'name' => 'nombre_stema', 'placeholder' => 'Nombre del subtema', 'value' => $this->form_validation->set_value('nombre_stema'),
    'required' => 'true'
);
$desc_stema = array('class' => ' form-control text-center', 'name' => 'desc_stema', 'placeholder' => 'Descripcion del subtema', 'value' => $this->form_validation->set_value('desc_stema'),
    'required' => 'true', 'rows' => 2,
);

//campos para subsubtema
$numero_ss = array('' => '- numero de subsubtema -', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 9, 9 => 9, 10 => 10);
$nombre_sstema = array(
    'class' => '   text-center form-control', 'name' => 'nombre_sstema', 'placeholder' => 'Nombre del subsubtema',
    'required' => 'true', 'value' => $this->form_validation->set_value('nombre_sstema'));
$desc_sstema = array('class' => ' form-control text-center', 'name' => 'desc_sstema', 'placeholder' => 'Descripcion del subsubtema',
    'required' => 'true', 'value' => $this->form_validation->set_value('desc_sstema'), 'rows' => 2
);

echo $encabezado_html;
echo $encabezado_pagina;
?>
<br />
<section class="cuerpo container-fluid">
    <div class="col-md-3 text-left" style="background-color: rgba(0,0,0,.1);border-radius: 1em;">
        <hr>
        <h3 class="text-center" style="background: rgba(0,113,185,1);padding: 10%;color: white;">
            <i class="glyphicon glyphicon-menu-hamburger" style="float: left;"></i>
            Registro de temario
        </h3>
        <hr>
        <ul class="nav nav-pills nav-stacked" id="myTabs">

            <li class="active">
                <a href="#t"  data-toggle="tab">
                    <span class="badge">1</span>
                    temas</a></li>
            <li>
                <a href="#st"  data-toggle="tab">
                    &nbsp;&nbsp;    <span class="badge">2</span>
                    subtemas</a></li>
            <li>
                <a href="#sst"  data-toggle="tab">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  <span class="badge">3</span>
                    subsubtemas</a></li>
        </ul>
        <hr>
    </div>     
    <!-- tabs para temario -->
    <div class="col-md-9">
        <div class="tab-content">
            <div class="tab-pane active " id="t">
                <div class="panel panel-default ">
                    <div   class="panel-heading ">
                        <h4 class="text-left " >
                            Registrar tema
                            <i class="glyphicon glyphicon-file float_derecha" ></i>
                            <i class="glyphicon glyphicon-plus-sign float_derecha" ></i>
                        </h4>                            
                    </div>
                    <div class="panel-body">       
                        <!--   Form para registrar temas -->
                        <form id="form_ajax_tema"  class="form_temario col-md-7" action="<?php echo base_url() ?>temario_controller/valida_entradas_tema" method="post">
                            <div id="loader_t">
                                <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                                <span class="text-primary">Cargando información...</span>
                            </div>
                            <select id="cursos_temario"   class="form-control " name="cursos_tema" value =<?php $this->form_validation->set_value('cursos_tema'); ?> >                          
                                <option value="" >                           
                                    - cursos -           
                                </option>
                            </select> 
                            <?php echo form_dropdown('numero_tema', $numero, '', array('class' => 'form-control  ')); ?>  
                            <?php echo form_input($nombre_tema); ?>  
                            <?php echo form_textarea($desc_tema); ?>    
                            <button type="submit" class="btn btn-primary col-md-12" id="btn-tema">                               
                                <i class="glyphicon glyphicon-save" style="float: left;"></i>   Agregar tema
                            </button>   
                        </form>
                        <div class="col-md-5"><?php echo $message; ?></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="st">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4 class="text-left " >
                            Registrar subtema
                            <i class="glyphicon glyphicon-file float_derecha" ></i>
                            <i class="glyphicon glyphicon-plus-sign float_derecha" ></i>
                        </h4>  
                    </div>
                    <div class="panel-body">
                        <!--   Form para registrar subtemas-->
                        <form id="form_ajax_subtema "  class="form_temario col-md-7 " action="<?php echo base_url() ?>temario_controller/valida_entradas_subtema" method="post">
                            <div id="loader_st">
                                <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                                <span class="text-primary">Cargando información...</span>
                            </div>
                            <select id="cursos_s"  required="true" class="form-control  " name="cursos_s"    value =<?php $this->form_validation->set_value('cursos_s'); ?>>
                                <option value="" placeholder="">
                                    - cursos -           
                                </option>
                            </select>
                            <select  id="temas" name="temas" required="true" class="form-control ">
                                <option value="">- temas -</option>
                            </select>                                 
                            <?php echo form_dropdown('numero_subtema', $numero_s, 0, array('class' => 'form-control ', 'required' => 'true')); ?>                                     
                            <?php echo form_input($nombre_stema); ?>                                    
                            <?php echo form_textarea($desc_stema); ?>    
                            <button type="submit" class="btn btn-primary col-md-12 " id="">                               
                                <i class="glyphicon glyphicon-save" style="float: left;"></i> Agregar subtema
                            </button>     
                        </form>
                        <div class="col-md-5"><?php echo $message_s; ?></div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="sst">
                <div class="panel panel-default ">
                    <div class="panel-heading">
                        <h4 class="text-left ">
                            Registrar subsubtema
                            <i class="glyphicon glyphicon-file float_derecha" ></i>
                            <i class="glyphicon glyphicon-plus-sign float_derecha" ></i>
                        </h4> 
                    </div>
                    <div class="panel-body">
                        <!--   Form para registrar subsubtemas-->
                        <form id="form_ajax_subsubtema"  class="form_temario col-md-7" action="<?php echo base_url() ?>temario_controller/valida_entradas_subsubtema" method="post">
                            <div id="loader_sst">
                                <img src="<?php echo base_url() ?>assets/imagenes/ajax-loader.gif"> 
                                <span class="text-primary">Cargando información...</span>
                            </div>
                            <select id="cursos_ss"  required="true" class="form-control " name="cursos_ss"   value =<?php $this->form_validation->set_value('cursos_ss'); ?>>
                                <option value="" >
                                    - cursos -           
                                </option>
                            </select>                        
                            <select id="temas2" name="temas2" required="true" class="form-control " value =<?php $this->form_validation->set_value('temas2'); ?>>
                                <option class="" value="">- temas -</option>
                            </select>     
                            <select id="subtemas" name="subtemas"  required="true" class="form-control " value =<?php $this->form_validation->set_value('subtemas'); ?>>
                                <option value="">- subtemas -</option>
                            </select> 
                            <?= form_dropdown('numero_ssubtema', $numero_ss, 0, array('class' => 'form-control', 'required' => 'true')); ?>                                                        
                            <?= form_input($nombre_sstema); ?>                   
                            <?php echo form_textarea($desc_sstema); ?>   
                            <button type="submit" class="btn btn-primary col-md-12 " id="">  
                                <i class="glyphicon glyphicon-save" style="float: left;"></i>  Agregar subsubtema
                            </button>                    
                        </form> 
                        <div class="col-md-5"><?php echo $message_ss; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/javascript/temario.js"></script>
    <?php echo $pie_pagina; ?>