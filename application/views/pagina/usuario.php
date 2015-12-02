
<div class="panel panel-primary" id="usuario">
    <div class="panel-heading">           
        <i class="glyphicon glyphicon-user"style="float: left;"></i>
        <?php
        echo $this->session->userdata('nombre');
        ?>

    </div>
    <div class="text-center ">
        <a href="auth/logout">
            <i class="glyphicon glyphicon-log-out " style="font-size: 1.5em;"></i>
        </a>
    </div>
</div>
