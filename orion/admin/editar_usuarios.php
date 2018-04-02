<?php
    require('restrito.php');
    require_once('../db.class.php');
    set_time_limit(0);
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    $Almope = $_SESSION['Almope'];
    $Login = $_SESSION['Login'];
    $Nome = $_SESSION['Nome'];
    $nome = $_SESSION['Primeiro_nome'];
    $almope_usuario=$_GET["almope"];
    if($_SESSION['Permissao']==3)
        $permissao = 'Adminisrador';
    elseif ($_SESSION['Permissao']==2)
        $permissao = 'Supervisor';
    else
        $permissao = 'Operador';
    
    $sql = "SELECT Almope, Login, Nome, Supervisor, Permissao, 
            Status_roteamento, Status, Primeiro_nome, Turno, 
            Equipe, Senha FROM tb_login_portal 
            WHERE Almope='".$almope_usuario."' ";
    $resultado = mysqlI_query($link, $sql);
    if(!$resultado)
        echo 'ERRO';
    else{
        $numero_registros = mysqlI_num_rows($resultado);
        $registro = mysqlI_fetch_array($resultado);
        $login_usuario =  $registro['Login'];
        $nome_usuario =  $registro['Nome'];
        $supervisor_usuario =  $registro['Supervisor'];
        $permissao_usuario =  $registro['Permissao'];
        $status_roteamento_usuario =  $registro['Status_roteamento'];
        $status_usuario =  $registro['Status'];
        $senha_usuario = $registro['Senha'];
        $primeiro_nome_usuario = $registro['Primeiro_nome'];
        $turno_usuario= $registro['Turno'];
        $equipe_usuario = $registro['Equipe'];
        if($permissao_usuario==3)
            $per = 'Adminisrador';
        elseif ($permissao_usuario==2)
            $per = 'Supervisor';
        else
            $per = 'Operador';
    }
?>?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orion | Editar Usuarios</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../css/plugins/iCheck/custom.css" rel="stylesheet">
        <link href="../css/plugins/chosen/bootstrap-chosen.css" rel="stylesheet">
        <link href="../css/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">
        <link href="../css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">
        <link href="../css/plugins/cropper/cropper.min.css" rel="stylesheet">
        <link href="../css/plugins/switchery/switchery.css" rel="stylesheet">
        <link href="../css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
        <link href="../css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">
        <link href="../css/plugins/datapicker/datepicker3.css" rel="stylesheet">
        <link href="../css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
        <link href="../css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">
        <link href="../css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
        <link href="../css/plugins/clockpicker/clockpicker.css" rel="stylesheet">
        <link href="../css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
        <link href="../css/plugins/select2/select2.min.css" rel="stylesheet">
        <link href="../css/plugins/touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
        <link href="../css/plugins/dualListbox/bootstrap-duallistbox.min.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php include('header.php');?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Usuarios</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="usuarios_cadastrados.php">Usuarios Cadastrados</a></li>
                    <li class="active"><strong>Editar Usuarios</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Editar Usuarios</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                    <div class="ibox-content">
                        <form id="demo-form2" method="post" action="alterar_dados_usuario.php" data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Almope">Almope<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="Almope" name="Almope" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $almope_usuario ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Login">Login<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="Login" name="Login" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $login_usuario ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Nome">Nome<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="Nome" name="Nome" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $nome_usuario ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Supervisor">Supervisor<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="Supervisor" name="Supervisor" required="required" class="form-control col-md-7 col-xs-12 chosen-select" value="" class="input-sm form-control input-s-sm inline">
                                        <option value="<?php echo $supervisor_usuario ;?>">
                                            <center><?php echo $supervisor_usuario ;?></center>
                                        </option>
                                        <?php set_time_limit(0);
                                            $sql = "select distinct Supervisor from tb_login_portal";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else {
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado))
                                                {  
                                        ?> 
                                        <option value='<?php echo $registro['Supervisor'];?>'>
                                            <center><?php echo $registro['Supervisor'];?>
                                            </center></option>
                                       <?php }}?>   
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Permissao">Permissão<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="Permissao" name="Permissao" required="required" class="form-control col-md-7 col-xs-12 chosen-select" value="" class="input-sm form-control input-s-sm inline">
                                        <option value="<?php echo $permissao_usuario ?>"><center><?php echo $per ;?></center></option>
                                        <option value="1"><center>OPERADOR</center></option>
                                        <option value="2"><center>SUPERVISOR</center></option>
                                        <option value="3"><center>ADMINISTRADOR</center></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Primeiro_nome">Primeiro Nome<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="Primeiro_nome" name="Primeiro_nome" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $primeiro_nome_usuario ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Turno">Turno<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="Turno" name="Turno" required="required" class="form-control col-md-7 col-xs-12 chosen-select" value="" class="input-sm form-control input-s-sm inline">
                                        <option value="<?php echo $turno_usuario ?>">
                                            <center><?php echo $turno_usuario ;?></center>
                                        </option>
                                        <option value="MANHA"><center>Manhã</center></option>
                                        <option value="TARDE"><center>Tarde</center></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Equipe">Equipe<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="Equipe" name="Equipe" required="required" class="form-control col-md-7 col-xs-12 chosen-select" value="" class="input-sm form-control input-s-sm inline">
                                        <option value="<?php echo $equipe_usuario ;?>">
                                            <center><?php echo $equipe_usuario ;?></center>
                                        </option>
                                        <?php set_time_limit(0);
                                            $sql = "select distinct Equipe from tb_login_portal";
                                                $resultado = mysqlI_query($link, $sql);
                                                if(!$resultado)
                                                    echo 'ERRO';
                                                else {
                                                    $numero_registros = mysqlI_num_rows($resultado);
                                                    while($registro = mysqlI_fetch_array($resultado))
                                                {  
                                        ?> 
                                             <option value='<?php echo $registro['Equipe'];?>'>
                                                <center><?php echo $registro['Equipe'];?></center>
                                            </option>
                                        <?php }}?>  
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Status_roteamento">Status Roteamento<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="Status_roteamento" name="Status_roteamento" required="required" class="form-control col-md-7 col-xs-12 chosen-select" value="" class="input-sm form-control input-s-sm inline">
                                        <option value="<?php echo $status_roteamento_usuario ?>">
                                            <center><?php echo $status_roteamento_usuario ;?></center>
                                        </option>
                                        <option value="ATIVO"><center>ATIVO</center></option>
                                        <option value="INATIVO"><center>INATIVO</center></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Status">Status<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select id="Status" name="Status" required="required" class="form-control col-md-7 col-xs-12 chosen-select" value="" class="input-sm form-control input-s-sm inline">
                                        <option value="<?php echo $status_usuario ;?>">
                                            <center><?php echo $status_usuario ;?></center>
                                        </option>
                                        <?php set_time_limit(0);
                                        $sql = "select distinct Status from tb_login_portal";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else {
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado))
                                            {  
                                        ?> 
                                                <option value='<?php echo $registro['Status'];?>'>
                                                    <center><?php echo $registro['Status'];?></center>
                                                </option>
                                            <?php }}?>   
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Senha</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" class="form-control" name="Senha" value="<?php echo $senha_usuario ?>">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button class="btn btn-primary" type="button" onclick="acessar('usuarios_cadastrados.php')">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Salvar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php include('footer.php') ;?>
        </div>
        </div>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/inspinia.js"></script>
        <script src="../js/plugins/pace/pace.min.js"></script>
        <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../js/plugins/chosen/chosen.jquery.js"></script>
        <script src="../js/plugins/jsKnob/jquery.knob.js"></script>
        <script src="../js/plugins/jasny/jasny-bootstrap.min.js"></script>
        <script src="../js/plugins/datapicker/bootstrap-datepicker.js"></script>
        <script src="../js/plugins/nouslider/jquery.nouislider.min.js"></script>
        <script src="../js/plugins/switchery/switchery.js"></script>
        <script src="../js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>
        <script src="../js/plugins/iCheck/icheck.min.js"></script>
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
        <script src="../js/plugins/clockpicker/clockpicker.js"></script>
        <script src="../js/plugins/cropper/cropper.min.js"></script>
        <script src="../js/plugins/fullcalendar/moment.min.js"></script>
        <script src="../js/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="../js/plugins/select2/select2.full.min.js"></script>
        <script src="../js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="../js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
        <script src="../js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>
        <script>
            $(document).ready(function(){
                $(".touchspin3").TouchSpin({
                    verticalbuttons: true,
                    buttondown_class: 'btn btn-white',
                    buttonup_class: 'btn btn-white'
                });
                $('.chosen-select').chosen({width: "100%"});
            });
        </script>
    </body>
</html>
