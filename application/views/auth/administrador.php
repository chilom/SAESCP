<?php echo $header_html;?>
<section class="cuerpo container-fluid">
    <?php echo $menu; ?>
           <div class="panel panel-default text-justify "  >
            <div class="panel-heading">    
                <h3  class=" " style="">
                    Administración básica de usuarios    
                    <i class="glyphicon glyphicon-edit float_derecha" style="margin-left: 1%;"></i>
                    <i class="glyphicon glyphicon-search float_derecha" style="margin-left: 1%;"></i>
                    <i class="glyphicon glyphicon-plus-sign float_derecha" style=""></i>
                </h3>   
            </div>
            <div class="panel-body  " >
                <div class="col-md-12"><?php echo $message; ?> </div> 
                <a href="auth/muestra_pantalla_registrar" class="btn btn-success text-left" style="float: right;"> 
                    Nuevo 
                </a>

                <table  id="" class="tablas table table-responsive table-bordered col-md-12" data-toggle="table"  data-height=""  style="">
                    <thead style="">
                    <th class="text-center" >Nombre de usuario</th>
                    <th class="text-center" >Nombre a mostrar</th>
                    <th class="text-center" >Correo electronico</th>
                    <th class="text-center" >Rol</th>    
                    <th class="text-center" >Acciones</th>                                    
                    </thead> 
                    <tbody >
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($user->nombre, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                                <td class="text-center">
                                    <?php foreach ($user->groups as $group): ?>
                                        <?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?><br />
                                    <?php endforeach ?>
                                </td>
                                <td class="text-center"><?php echo anchor("auth/muestra_pantalla_editar/" . $user->id, 'Editar'); ?></td>
                            </tr>
                        <?php endforeach; ?></tbody>
                </table>  
            </div>
            <div class="panel-footer"></div>
        </div>
        <br /> 
    <?php echo $footer; ?>



