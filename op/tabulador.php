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
                <h2>Tabulador</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="usuarios_cadastrados.php">Tabuladores</a></li>
                    <li class="active"><strong>Tabulador de Oportunidade 0800</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Tabulador</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form id="demo-form2" method="post" action="insere_dados_tabulador.php" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="IdManifestacao">ID_MANIFESTAÇÃO<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="IdManifestacao" name="IdManifestacao" required="required" class="form-control col-md-7 col-xs-12" placeholder="IdManifestacao" maxlenth="7">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="CpfCnpj">CPF/CNPJ<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="CpfCnpj" name="CpfCnpj" required="required" class="form-control col-md-7 col-xs-12" placeholder="CPF ou CNPJ" maxlenth="18">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3" for="Contrato">CONTRATO<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="Contrato" name="Contrato" required="required" class="form-control" placeholder="000/000000000" data-inputmask="'mask': '999/999999999'">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Oportunidade">OPORTUNIDADE<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="Oportunidade" name="Oportunidade" required="required" class="form-control col-md-7 col-xs-12 chosen-select" value="" class="input-sm form-control input-s-sm inline">
                                            <option value="VT SEM ACOMPANHAMENTO"><center>VT SEM ACOMPANHAMENTO</center></option>
                                            <option value="CONTESTACAO DENTRO DA ALÇADA NAO EFETUADA"><center>CONTESTACAO DENTRO DA ALÇADA NAO EFETUADA</center></option>
                                            <option value="CONTESTACAO FORA DA ALÇADA NAO EFETUADA"><center>CONTESTACAO FORA DA ALÇADA NAO EFETUADA</center></option>
                                            <option value="VT NAO AGENDADA"><center>VT NAO AGENDADA</center></option>
                                            <option value="MUDANCA DE PACOTE NAO EFETUADA"><center>MUDANCA DE PACOTE NAO EFETUADA</center></option>
                                            <option value="TEXTO SEM INFORMACOES PARA TRATAMENTO"><center>TEXTO SEM INFORMACOES PARA TRATAMENTO</center></option>
                                            <option value="FORA DO TEXTO PADRAO"><center>FORA DO TEXTO PADRAO</center></option>
                                            <option value="NAO VERIFICOU O HISTORICO E NAO PASSOU NEGATIVA/RESPOSTA"><center>NAO VERIFICOU O HISTORICO E NAO PASSOU NEGATIVA/RESPOSTA</center></option>
                                            <option value="NAO ENCAMINHOU PARA AREA PARA AGILIZAR TRATATIVA"><center>NAO ENCAMINHOU PARA AREA PARA AGILIZAR TRATATIVA</center></option>
                                            <option value="NAO LANCOU DESCONTO COM EVIDENCIA"><center>NAO LANCOU DESCONTO COM EVIDENCIA</center></option>
                                            <option value="ABRIU O MANIFESTO NO CONTRATO ERRADO"><center>ABRIU O MANIFESTO NO CONTRATO ERRADO</center></option>
                                            <option value="NAO EFETUOU FCR"><center>NÃO EFETUOU FCR</center></option>
                                            <option value="NAO ABRIU OCORRENCIA"><center>NÃO ABRIU OCORRENCIA</center></option>
                                            <option value="EXECUTOU PROCEDIMENTO DE FORMA INCORRETA"><center>EXECUTOU PROCEDIMENTO DE FORMA INCORRETA"/center></option>
                                            <option value="CLIENTE NA ANATEL"><center>CLIENTE NA ANATEL</center></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Observacao">Observação<span>*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea  type="textarea" id="Observacao" name="Observacao" class="form-control col-md-7 col-xs-12" maxlenth="200" ></textarea>
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
        <?php include('footer.php');?>
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
