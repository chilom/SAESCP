<?php
echo $encabezado_html;
echo $encabezado_pagina;
?>
<section class="cuerpo">
    <?php echo $menu; ?>
    <section id='estudiante' class="col-md-12 " style=" ;">
        <!-- Boton de usuario -->
        <div class="col-md-12" style="margin-top:1%;">
            <div class="col-md-7"> </div>

            <div class="reloj col-md-2" id="reloj_logico">
                <div class=" "></div>         
            </div>  
            <div class=" reloj col-md-2 " id="ver_reloj" hidden="true">
                <span class="glyphicon glyphicon glyphicon-eye-open"> </span>  ver reloj 
            </div>
        </div>

        <?php echo $usuario; ?>

        <div class="col-md-8" > 
            <div class="panel panel-primary ">
                <div id="" class="panel-heading">Avance por curso</div>
                <div class="panel-body">
                    
                </div>
                <div class="panel-footer">

                </div>
            </div>                                        
        </div> 

    </section>
    <?php echo $pie_pagina; ?>
