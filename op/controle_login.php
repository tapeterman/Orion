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
            var httpRequest;
            function fazerRequisicao(url, destino){
                document.getElementById(destino).innerHTML = "<center><img src='../img/loader.gif'></center>";
                if(window.XMLHttpRequest){
                    httpRequest = new XMLHttpRequest();
                }else if(window.ActiveXObject){
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

                        }
                    }
                }
            }
        </script>
    </head>
    <body onload="fazerRequisicao('tabelas/tabela_login_iride.php?data=Data', 'tabela_login_iride')">
        <?php include('header.php');?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Relatorios Online</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Relatorios Online</a></li>
                    <li class="active"><strong>Controle Login Iride/Ponto</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Controle Login Iride/Ponto</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div id="tabela_login_iride" class="table-responsive" ></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php') ;?>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../js/plugins/dataTables/datatables.min.js"></script>
        <script src="../js/inspinia.js"></script>
        <script src="../js/plugins/pace/pace.min.js"></script>
        <script src="../js/demo/peity-demo.js"></script>
        <script>
            $(document).ready(function(){
                $('.dataTables-example').DataTable({
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'tabela_recorrente'},
                        {extend: 'pdf', title: 'tabela_recorrente'},

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
            });
        </script>
    </body>
</html>
