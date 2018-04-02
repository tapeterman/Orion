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
                document.getElementById("supervisor").onchange = function () {
                    var supervisor = document.getElementById("supervisor").value;
                };
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
                    <h2>Relatorios Historico</h2>
                    <ol class="breadcrumb">
                        <li><a href="home.php">Home</a></li>
                        <li><a>Relatorios Historico</a></li>
                        <li class="active"><strong>Historico Resultados N2+0800</strong></li>
                    </ol>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                      <thead>
                                        <tr>
                                          <th><center>RANK</center></th>
                                          <th><center>OPERADOR</center></th>
                                          <th><center>SUPERVISOR</center></th>
                                          <th><center>CAMPANHA</center></th>
                                          <th><center>PONTOS</center></th>
                                          <th><center>APROVEITAMENTO</center></th>
                                          <th><center>RESOLVIDOS</center></th>
                                          <th><center>RECORRENTE</center></th>
                                          <th><center>REINCIDENCIA</center></th>
                                          <th><center>ODC</center></th>
                                          <th><center>RESOLVIDO SEM CONTATO</center></th>
                                          <th><center>FORA DO PRAZO</center></th>
                                        </tr>
                                      </thead>
                                      <tbody> <?php set_time_limit(0);
                                        $mes = $_GET['mes'];
                                        $campanha = $_GET['campanha'];
                                         $sql1 = "SET @RANK = 0;";
                                          $sql = "SELECT 
                                                  @RANK := @RANK+1 as RANK,
                                                  PONTOS/RESOLVIDOS*100 as 'APROVEITAMENTO',
                                                  A.*
                                                  FROM
                                                  (SELECT 
                                                  NOME_RESPONSAVEL as OPERADOR,
                                                  SUPERVISOR_RESPONSAVEL AS SUPERVISOR,
                                                  CAMPANHA_RESPONSAVEL AS CAMPANHA,
                                                  COUNT(NOME_RESPONSAVEL)-(SUM(CASE WHEN b.recorrente=1 THEN 1 ELSE 0 END)+SUM(REINCIDENCIA)+SUM(ODC)+SUM(CASE WHEN FORMA_CONTATO='SEM CONTATO' THEN 1 ELSE 0 END)
                                                  +SUM(CASE WHEN PRAZO IN ('RFP','AFP') THEN 1 ELSE 0 END)) AS PONTOS,
                                                  COUNT(NOME_RESPONSAVEL) AS RESOLVIDOS,
                                                  SUM(CASE WHEN b.recorrente=1 THEN 1 ELSE 0 END) AS RECORRENTE_3,
                                                  SUM(REINCIDENCIA) AS REINCIDENCIA,
                                                  SUM(ODC) AS ODC,
                                                  SUM(CASE WHEN FORMA_CONTATO='SEM CONTATO' THEN 1 ELSE 0 END) AS RESOLVIDO_SEM_CONTATO,
                                                  SUM(CASE WHEN PRAZO IN ('RFP','AFP') THEN 1 ELSE 0 END) AS FORA_DO_PRAZO
                                                  FROM tb_indicadores_historico
                                                  left join
                                                  (select contrato,1 as recorrente from tb_indicadores_historico where tb_indicadores_historico.RECORRENTE = 3) as b
                                                  on  b.contrato = tb_indicadores_historico.CONTRATO and tb_indicadores_historico.recorrente = 2
                                                  WHERE MONTH(DH_ABERTURA) = 10
                                                  AND VALIDO = 1
                                                  GROUP BY NOME_RESPONSAVEL, SUPERVISOR_RESPONSAVEL) AS A
                                                  ORDER BY PONTOS DESC";
                                          mysqlI_query($link, $sql1);
                                          $resultado = mysqlI_query($link, $sql);
                                        if(!$resultado)
                                          echo 'ERRO';
                                        else{
                                          $numero_registros = mysqlI_num_rows($resultado);
                                          while($registro = mysqlI_fetch_array($resultado)){  
                                        ?> 
                                          <tr>
                                            <td scope="row"><center><?php echo $registro['RANK'];?></center></td>
                                            <td><center><?php echo $registro['OPERADOR'];?></center></td>
                                            <td><center><?php echo $registro['SUPERVISOR'];?></center></td>
                                            <td><center><?php echo $registro['CAMPANHA'];?></center></td>
                                            <td><center><?php echo $registro['PONTOS'];?></center></td>
                                            <td class=<?php if($registro['APROVEITAMENTO']>90) {echo'"text-navy"'; }
                                                else if($registro['APROVEITAMENTO']>80) echo'"text-warning"';
                                                else{echo '"text-danger"';}?>>
                                              <i class=<?php if($registro['APROVEITAMENTO']>90) echo'"fa fa-level-up"'; 
                                                else if($registro['APROVEITAMENTO']>80) echo'"fa fa-minus"';
                                                else echo '"fa fa-level-down"';?>>
                                              <strong><?php echo round($registro['APROVEITAMENTO'],2);?>%</strong>
                                            </td>
                                            <td><center><?php echo $registro['RESOLVIDOS'];?></center></td>
                                            <td><center><?php echo $registro['RECORRENTE_3'];?></center></td>
                                            <td><center><?php echo $registro['REINCIDENCIA'];?></center></td>
                                            <td><center><?php echo $registro['ODC'];?></center></td>
                                            <td><center><?php echo $registro['RESOLVIDO_SEM_CONTATO'];?></center></td>
                                            <td><center><?php echo $registro['FORA_DO_PRAZO'];?></center></td>
                                          </tr>
                                          <?php 
                                            }}?> 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th><center>RANK</center></th>
                                              <th><center>OPERADOR</center></th>
                                              <th><center>SUPERVISOR</center></th>
                                              <th><center>CAMPANHA</center></th>
                                              <th><center>PONTOS</center></th>
                                              <th><center>APROVEITAMENTO</center></th>
                                              <th><center>RESOLVIDOS</center></th>
                                              <th><center>RECORRENTE</center></th>
                                              <th><center>REINCIDENCIA</center></th>
                                              <th><center>ODC</center></th>
                                              <th><center>RESOLVIDO SEM CONTATO</center></th>
                                              <th><center>FORA DO PRAZO</center></th>
                                            </tr>
                                        </tfoot>
                                    </table>
























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
