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
    if($_SESSION['Permissao']==3)
        $permissao = 'Adminisrador';
    elseif ($_SESSION['Permissao']==2)
        $permissao = 'Supervisor';
    else
        $permissao = 'Operador';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orion | Controle Login</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        <script type="text/javascript">
            function limpaDiv(){
                document.getElementById("data").value="";
                document.getElementById("hora").value="";
                document.getElementById("solicitante").value="";
                document.getElementById("autorizacao").value="";
                document.getElementById("motivo").value="";
            }
        </script>
        <script type="text/javascript">
            var httpRequest;
            function fazerRequisicao(url, destino){
                document.getElementById(destino).innerHTML = "<center><img src='../img/loader.gif'></center>";
                if(window.XMLHttpRequest){
                    httpRequest = new XMLHttpRequest();
                }
                else if(window.ActiveXObject){
                    try{
                        httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch(e){
                        try{
                            httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        catch(e){
                            alert("Impossível instanciar o objeto XMLHttpRequest para esse navegador/versão");
                        }
                    }
                }
                if(!httpRequest){
                    alert("Erro ao tentar criar uma instância do objeto XMLHttpRequest");
                    return false;
                }
                httpRequest.onreadystatechange = situacaoRequisicao;
                httpRequest.open("GET", url);
                httpRequest.send();
                function situacaoRequisicao(){
                    if(httpRequest.readyState == 4){
                        if(httpRequest.status == 200){
                            document.getElementById(destino).innerHTML = httpRequest.responseText;
                            $('.dataTables-example').DataTable({
                                pageLength: 25,
                                responsive: true,
                                dom: '<"html5buttons"B>lTfgitp',
                                buttons: [
                                    { extend: 'copy'},
                                    {extend: 'csv'},
                                    {extend: 'excel', title: 'tabela_recorrente'},
                                    {extend: 'print',
                                        customize: function (win){
                                            $(win.document.body).addClass('white-bg');
                                            $(win.document.body).css('font-size', '10px');
                                            $(win.document.body).find('table')
                                                .addClass('compact')
                                                .css('font-size', 'inherit');
                                        }
                                    }
                                ]
                            });
                        }
                    }
                }
            }
        </script>
    </head>
    <body>
        <?php include('header.php');?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Diário de Bordo</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Diário de Bordo</a></li>
                    <li class="active"><strong>Diário de Bordo</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight ">
            <form id="demo-form2" method="post" action="../insert_diario_bordo_treinamento.php" data-parsley-validate class="form-horizontal form-label-left">
                <div class="row col-sm-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="panel-heading">
                                    <span class="glyphicon"></span> Diario de bordo Capacitação
                                </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <label class="input-group-addon" title="Data" for="Data">Data</label>
                                    <input type="text" id="data" name="data" class="form-control" required="required" data-mask="99/99/9999">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group">
                                    <label class="input-group-addon" title="hora" for="hora">Hora</label>
                                    <input type="text" id="hora" name="hora" class="form-control" required="required" data-mask="99:99:99">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <label class="input-group-addon" title="solicitante" for="hora">Solicitante</label>
                                    <input type="text" id="solicitante" name="solicitante" class="form-control" required="required">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <label class="input-group-addon" title="autorizacao" for="hora">Autorizado por</label>
                                    <input type="text" id="autorizacao" name="autorizacao" class="form-control" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12">
                                <div class="input-group">
                                    <label class="input-group-addon" title="motivo" for="Data">Motivo</label>
                                    <input type="text" id="motivo" name="motivo" class="form-control" required="required">
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal" onclick="limpaDiv()">limpar</button>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Diário de Bordo Operacional</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                            <a class="close-link"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-sm-1 m-b-xs">
                                <label class="btn-sm btn-white" for="mes">Mês</label>
                            </div>
                            <div class="col-sm-2 m-b-xs">
                                <select id="mes" class="input-sm form-control input-s-sm inline">
                                    <?php set_time_limit(0);
                                        $sql = "SELECT distinct date_format(STR_TO_DATE(data, '%d/%m/%Y'),'%m-%Y') AS 'MES' 
                                                FROM `tb_diario_bordo_treinamento`
                                                ORDER BY STR_TO_DATE(DATA, '%m-%Y') desc";
                                        $resultado = mysqlI_query($link, $sql);
                                        if(!$resultado)
                                            echo 'ERRO';
                                        else {
                                            $numero_registros = mysqlI_num_rows($resultado);
                                            while($registro = mysqlI_fetch_array($resultado)){  

                                        ?> 
                                            <option value='<?php echo $registro['MES'];?>'>
                                                <center><?php echo $registro['MES'];?></center>
                                            </option>
                                        <?php }}?> 
                                </select>
                            </div>
                            <button class="btn btn-primary col-sm-2" type="button" 
                                onclick="fazerRequisicao('tabelas/tabela_diario_bordo_treinamento.php?mes='+mes.options[mes.selectedIndex].value, 'tabela_diario_bordo_treinamento')">
                                <i class="fa fa-check"></i>Atualizar
                            </button>
                        </div>
                        <div id="tabela_diario_bordo_treinamento" class="table-responsive" >
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
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../js/plugins/dataTables/datatables.min.js"></script>
        <script src="../js/inspinia.js"></script>
        <script src="../js/plugins/pace/pace.min.js"></script>
        <script src="../js/demo/peity-demo.js"></script>
        <script type="text/javascript">
            function limpaDiv(){
                document.getElementById("data").value="";
                document.getElementById("hora").value="";
                document.getElementById("solicitante").value="";
                document.getElementById("autorizacao").value="";
                document.getElementById("motivo").value="";
            }
        </script>
    </body>
</html>