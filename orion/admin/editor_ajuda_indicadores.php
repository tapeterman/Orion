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
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ORION | Editor de Texto</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/plugins/summernote/summernote.css" rel="stylesheet">
        <link href="../css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
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
                        }catch(e){
                            try{
                                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                            }catch(e){
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
    <body>
        <?php include('header.php');?>
        <div class="row wrapper border-bottom white-bg">
                <div class="col-lg-10">
                    <h2>Editor de Texto</h2>
                    <ol class="breadcrumb">
                        <li><a href="home.php">Home</a></li>
                        <li><a>Indicadores</a></li>
                        <li class="active"><strong>Ajuda Indicadores Operacionais</strong></li>
                    </ol>
                </div>
                <div class="col-lg-2"></div>
            </div>
        <div id="wrapper">
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <form method="post" action="editor_texto.php">
                                    <h5>Dicas dos Indicadores</h5>
                                    <div class="col-lg-4">
                                        <select id="indicador" name="indicador" class="input-sm form-control input-s-sm inline"  onchange="fazerRequisicao('tabelas/texto_ajuda_indicadores.php?indicador='+this.value, 'texto2')">
                                            <option value='CANCELAMENTO DE RECEITA'><center>CANCELAMENTO DE RECEITA</center></option>
                                            <option value='CAUSA SOLUCAO'><center>CAUSA SOLUCAO</center></option>
                                            <option value='DESCONTO FORNECEDOR'><center>DESCONTO FORNECEDOR</center></option>
                                            <option value='FCR'><center>FCR</center></option>
                                            <option value='FILAS OMS'><center>FILAS OMS</center></option>
                                            <option value='NIVEL DE SERVICO'><center>NIVEL DE SERVICO</center></option>
                                            <option value='NOTA DE QUALIDADE'><center>NOTA DE QUALIDADE</center></option>
                                            <option value='ODC'><center>ODC</center></option>
                                            <option value='PRAZO'><center>PRAZO</center></option>
                                            <option value='RECORRENCIA'><center>RECORRENCIA</center></option>
                                            <option value='REINCIDENCIA'><center>REINCIDENCIA</center></option>
                                            <option value='START DE TRATAMENTO'><center>START DE TRATAMENTO</center></option>
                                            <option value='TMT'><center>TMT</center></option>
                                        </select>
                                    </div>
                                    <div class="ibox-content no-padding">
                                        <textarea id="texto" name="texto" class="summernote"></textarea>
                                    </div>
                                    <button id="salvar" class="btn btn-primary col-sm-2" type="submit" style="float: right;">
                                        <i class="fa fa-check"></i>
                                        Atualizar
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="ibox-content">
                                <div class="table-responsive">
                        <div class="ibox-content no-padding">
                            <div class="col-lg-12 float-e-margins" id="texto2" ></div>
                       </div> </div> </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../js/inspinia.js"></script>
        <script src="../js/plugins/pace/pace.min.js"></script>
        <script src="../js/plugins/summernote/summernote.min.js"></script>
        <link href="../css/plugins/toastr/toastr.min.css" rel="stylesheet">
        <script src="../js/plugins/toastr/toastr.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.summernote').summernote();
           });
        </script>
        <script>
            $(document).ready(function(){
                <?php 
                    if(isset($_GET['exito']) or $_GET['exito']==1) {
                        echo "
                        setTimeout(function() {
                            toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 4000
                            };
                            toastr.success('Dados alterados com sucesso', 'Sucesso');
                        }, 1300);"; 
                    
                    } 
                    else ;
                ?> 
            });
        </script>
    </body>
</html>
