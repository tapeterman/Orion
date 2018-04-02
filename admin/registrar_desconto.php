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
        <title>Orion | Abertos</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php include('header.php');?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Relatorios Online</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Relatorios Online</a></li>
                    <li class="active"><strong>Abertos por Supervisor</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight ">
            <div class="row col-sm-offset-1 col-sm-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span> Dados do Cliente
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <div class="input-group col-sm-10">
                                <span class="input-group-addon">Nº Contrato</span>
                                <input type="text" id="txtNumContrato" class="form-control parametro variavel parametro2 variavel2" title="Número completo do contrato" placeholder="000/0000000" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group col-xs-10">
                                <span class="input-group-addon">CPF/CNPJ</span>
                                <input type="text" id="txtCpf" class="form-control parametro variavel parametro2 variavel2" placeholder="CPF ou CNPJ" maxlenth="18">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-list-alt"></span> Dados da Ocorrência
                    </div>
                    <div class="panel-body">
                        <div class="ibox-content col-sm-12">
                            <div class="input-group col-sm-10">
                                <span class="input-group-addon" title="Motivo">Motivo</span>
                                <select id="slcMotivoOcorrencia" class="select2_demo_3 form-control" onchange="getComboA(this)">
                                    <option></option>
                                    <option>CLIENTE DESCONHECE O PRODUTO CONTRATADO</option>
                                    <option>CORREÇÃO DE CONTRATO</option>
                                    <option>DOAÇÃO DE APARELHO</option>
                                    <option>MUDANÇA DE ENDEREÇO PARA LOCAL NÃO CABEADO</option>
                                    <option>NÃO INFORMADA REGRAS DO PRODUTO</option>
                                    <option>NÃO TEM INFORMAÇÃO</option>
                                    <option>OFERTA INEXISTENTE</option>
                                    <option>OFERTA NÃO CUMPRIDA</option>
                                    <option>OPÇÃO BOLETO AO INVÉS DE DCC</option>
                                    <option>PRODUTO DESCONTINUADO</option>
                                    <option>PRODUTO NÃO SOLICITADO PELO CLIENTE</option>
                                    <option>PRODUTO OFERTADO FORA DO PACOTE VIGENTE</option>
                                    <option>QUEDA DE SINAL</option>
                                    <option>RESGATE DE LIGAÇÃO FORA DO PRAZO</option>
                                    <option>VALOR / PRODUTO/SERVIÇO DIVERGENTE DO SOLICITADO</option>
                                    <option >VALOR DO PRODUTO / OFERTA DIFERENTE DO COMERCIALIZADO</option>
                                </select>
                            </div>  
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group col-sm-12">
                                <span class="input-group-addon">Ofensor</span>
                                <input type="text" id="txtLoginOfensor" class="form-control parametro variavel" placeholder="Ofensor" maxlength="20">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="input-group col-sm-12">
                                <span class="input-group-addon" title="Data da venda">Data Venda</span>
                                <input type="text" class="form-control" data-mask="00/00/0000">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="col-xs-4 text-left" style="padding-top:10px;">
                                <label>Existe Evidência:</label>
                            </div>
                            <div class="col-xs-3 text-left">
                                <div class="radio">
                                    <label><input type="radio" name="opcoesGravacaoes" id="optNao" class="rbdVariavel variavel parametro2 variavel2" value="não" checked> NÃO </label>
                                </div>
                                <div class="radio">
                                    <label> <input type="radio" name="opcoesGravacaoes" id="optSim" class="rbdVariavel variavel parametro2 variavel2" value="sim"> SIM </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-ok"></span> Dados do Reembolso
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-6">
                            <div class="input-group col-sm-10">
                                <span class="input-group-addon" title="Valor do Reembolso/mês">Valor Reembolso</span>
                                <input type="text" id="txtVlrReembolso" class="form-control parametro variavel calculo-fatura parametro2 variavel2" placeholder="Valor/mês">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group col-sm-10">
                                <span class="input-group-addon" title="Data da venda">Qtd.(meses) Desconto</span>
                                <input type="text" id="txtMeses" class="form-control parametro variavel calculo-fatura parametro2 variavel2" title="Apenas valores entre 1 e 12 são aceitos" placeholder="Meses" maxlength="2">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group col-sm-10">
                                <span class="input-group-addon" title="Data da venda">Valor Total</span>
                                <input type="text" id="txtVlrTotalReembolso" class="form-control parametro parametro2 variavel2" placeholder="Valor total do desconto" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="input-group col-sm-10">
                                <span class="input-group-addon" title="Canal de solução">Canal Solução</span>
                                <select id="slcCanalSolucao" class="form-control variavel">
                                    <option>0800</option>
                                    <option>Pre-Anatel</option>
                                    <option>N2</option>
                                    <option>Cliente</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="_Script/ControleFornecedor.js" type="text/javascript"></script>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary col-sm-4 col-sm-offset-4" type="button"><i class="fa fa-check"></i>&nbsp;aaa</button> 
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
        <script>
            $(document).ready(function(){
                $('.dataTables-example').DataTable({
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},

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
