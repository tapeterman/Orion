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
        <title>Orion | Recorrente</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        <script type="text/javascript">
            var httpRequest;
            function fazerRequisicao(url, destino){
                document.getElementById(destino).innerHTML = "<center><img src='../img/loader.gif></center>";
                if(window.XMLHttpRequest){
                    httpRequest = new XMLHttpRequest();
                }else if(window.ActiveXObject){
                    try{
                        httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    }
                    catch(e){
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
    <body onload="fazerRequisicao('tabelas/tabela_recorrente_dia.php?data=Data', 'tabela_recorrente_dia')">
        <?php include('header.php');?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Relatorios Online</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Relatorios Online</a></li>
                    <li class="active"><strong>Recorrente por Supervisor</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Recorrente por supervisor Dia</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-2 m-b-xs">
                                    <label class="btn-sm btn-white" for="datamaxima">Data Vencimento</label>
                                </div>
                                <div class="col-sm-2 m-b-xs">
                                    <select id="datamaxima" class="input-sm form-control input-s-sm inline" onchange="fazerRequisicao('tabelas/tabela_recorrente_dia.php?data='+this.value, 'tabela_recorrente_dia')">
                                        <option value='<?php echo date('d/m/Y', strtotime('+0 days'));;?>'><center><?php echo date('d/m/Y', strtotime('+0 days'));;?></center></option>
                                        <option value='<?php echo date('d/m/Y', strtotime('+1 days'));;?>'><center><?php echo date('d/m/Y', strtotime('+1 days'));;?></center></option>
                                        <option value='<?php echo date('d/m/Y', strtotime('+2 days'));;?>'><center><?php echo date('d/m/Y', strtotime('+2 days'));;?></center></option>
                                        <option value='<?php echo date('d/m/Y', strtotime('+3 days'));;?>'><center><?php echo date('d/m/Y', strtotime('+3 days'));;?></center></option>
                                        <option value='<?php echo date('d/m/Y', strtotime('+4 days'));;?>'><center><?php echo date('d/m/Y', strtotime('+4 days'));;?></center></option>
                                        <option value='<?php echo date('d/m/Y', strtotime('+5 days'));;?>'><center><?php echo date('d/m/Y', strtotime('+5 days'));;?></center></option>
                                    </select>
                                </div>
                            </div>
                            <div class="table-responsive" id="tabela_recorrente_dia"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Recorrente Total</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th><center>NOME</center></th>
                                            <th><center>Total</center></th>
                                            <th><center>RECORRENTE 2</center></th>
                                            <th><center>RECORRENTE 3</center></th>
                                            <th><center>RECORRENTE 4</center></th>
                                            <th><center>RECORRENTE 5</center></th>
                                            <th><center>&gt;RECORRENTE 5</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            set_time_limit(0);
                                            $sql = "SELECT NOME, COUNT(*) AS 'TOTAL', 
                                                    SUM(CASE WHEN RECORRENTE = 'RECORRENTE 2' THEN 1 ELSE 0 END) AS 'RECORRENTE_2', 
                                                    SUM(CASE WHEN RECORRENTE = 'RECORRENTE 3' THEN 1 ELSE 0 END) AS 'RECORRENTE_3', 
                                                    SUM(CASE WHEN RECORRENTE = 'RECORRENTE 4' THEN 1 ELSE 0 END) AS 'RECORRENTE_4', 
                                                    SUM(CASE WHEN RECORRENTE = 'RECORRENTE 5' THEN 1 ELSE 0 END) AS 'RECORRENTE_5', 
                                                    SUM(CASE WHEN RECORRENTE not in ('RECORRENTE 2','RECORRENTE 3', 'RECORRENTE 4', 'RECORRENTE 5') THEN 1 ELSE 0 END) AS '>RECORRENTE_5' 
                                                    FROM `tb_portal_online` 
                                                    WHERE `EMPRESA` = 'ALMAVIVA' 
                                                    and `DS_FORMA_CONTATO`<>'BKO' 
                                                    and `RECORRENTE` IS NOT NULL 
                                                    and NOME = '".$Nome."' 
                                                    GROUP BY NOME 
                                                    order by 'TOTAL' DESC ";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else {
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado)){
                                        ?>    
                                                <tr>
                                                    <td><center><?php echo $registro['NOME'];?></center></td>
                                                    <td><center><?php echo $registro['TOTAL'];?></center></td>
                                                    <td><center><?php echo $registro['RECORRENTE_2'];?></center></td>
                                                    <td><center><?php echo $registro['RECORRENTE_3'];?></center></td>
                                                    <td><center><?php echo $registro['RECORRENTE_4'];?></center></td>
                                                    <td><center><?php echo $registro['RECORRENTE_5'];?></center></td>
                                                    <td><center><?php echo $registro['>RECORRENTE_5'];?></center></td>
                                                </tr>
                                        <?php } }?>               
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><center>NOME</center></th>
                                            <th><center>Total</center></th>
                                            <th><center>RECORRENTE 2</center></th>
                                            <th><center>RECORRENTE 3</center></th>
                                            <th><center>RECORRENTE 4</center></th>
                                            <th><center>RECORRENTE 5</center></th>
                                            <th><center>&gt;RECORRENTE 5</center></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
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
