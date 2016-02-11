<?php
echo $encabezado_html;
echo $encabezado_pagina;
?>
<br />
<script src="javascript/reloj.js"></script>
<!--<script src="javascript/curso_temario.js"></script>-->
<section class="cuerpo container-fluid">
    <!-- Boton de usuario -->
        <!--   <div class="alert alert-success col-md-12">
               <i class="glyphicon glyphicon-info-sign " style="font-size: 2em;"> </i>
               <a class="  close  " data-dismiss="alert" >X</a><br>
               <p style="margin-left:10%;">1. Da <b>click</b> en algun <b>tema</b>, apareceran sus subtemas.<br>
                   2. Da <b>click</b> en algun <b>subtema</b>, apareceran sus subsubtemas<br> 
                   3. Accede al contenido dando <b>click</b> en <b>IR</b>.<br>
                   4. Da <b>click</b> en algun <b>subsubtema</b> para ingresar a su contenido.
               </p>
           </div>-->
        <div class="panel panel-default ">
            <div  class="panel-heading">
                <h3 id="" style="" class="text- text-center text-primary">
                    <?php echo $curso; ?>
                </h3>
            </div>
            <div class="panel-body ">
                <table  class="table table-bordered table-hover table-striped table-responsive" data-toggle="table"  data-height=""  >
                    <thead style="background: rgba(0,182,95,.1);">
                    <th class="text-center" >Temas</th>
                    <th class="text-center" >Subtemas</th>
                    <th class="text-center" >Subsubtemas</th>
                    </thead> 
                    <tbody class="text-left">
                        <?php if ($temas != null) { ?>
                            <?php foreach ($temas as $tema): ?>
                                <tr>
                                    <!-- llenado de temas -->
                                    <td> 
                                        <?php if ($tema->subtemas != null) { ?>                               
                                            <div class="col-md-12"> <?php echo $tema->nt . '.' . $tema->nombret; ?></div>
                                        <?php } else { ?>
                                            <a class="col-md-12 text-left" href="tema_controller/muestra_tema/<?php echo $tema->idt; ?>"><?php echo $tema->nt . '.' . $tema->nombret; ?></a>
                                        <?php } ?>
                                    </td>
                                    <!-- llenado de subtemas -->
                                    <td>
                                        <?php
                                        if ($tema->subtemas != null) {
                                            foreach ($tema->subtemas as $subtema) {
                                                ?>
                                                <a class="col-md-12" href="tema_controller/muestra_subtema/<?php echo $subtema->ids; ?>"> <?php echo $subtema->nt . '. ' . $subtema->ns . '.' . $subtema->nombres; ?></a>                                                                   
                                                <?php
                                            } // fin foreach
                                        }
                                        ?>
                                    </td>
                                    <!-- llenado de subsubtemas -->
                                    <td>
                                        <?php
                                        if ($tema->subsubtemas != null) {
                                            foreach ($tema->subsubtemas as $subsubtema) {
                                                if ($subsubtema->idss != '') {
                                                    ?>
                                                    <a class="col-md-12" href="tema_controller/muestra_subsubtema/<?php echo $subsubtema->idss; ?>"> <?php echo $subsubtema->nt . '. ' . $subsubtema->ns . '. ' . $subsubtema->nss . '. ' . $subsubtema->nombress; ?></a>
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        } else {
                            ?>
                        <div class="col-md-12 alert alert-warning" >
                            <span class="glyphicon glyphicon-info-sign" style="float:left;"></span> 
                            <a class="  close  " data-dismiss="alert"  style="float:right;">X</a>
                            <p>No hay informacion disponible. El maestro aun no crea el temario.</p>
                        </div>
                    <?php } ?>

                    </tbody>
                </table>  
            </div>    <!-- fin panel body-->                                          
        </div>          <!-- fin panel default-->                              
    <?php print_r($this->session->all_userdata()); ?>
    <?php
    echo $pie_pagina;
    