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
    $data_atual_sql = date('Y-m-d');
    $data_atual=date('d/m/y');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orion | Capacitação</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="../css/animate.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/plugins/jQueryUI/jquery-ui.css" rel="stylesheet">
  </head>
  <body>
    <?php include('header.php');?>
    <div class="wrapper wrapper-content animated fadeInRight">
      <div class="row">
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-success pull-right">Mês</span>
              <h5>Quantidade Agendada</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">
                <?php
                  $sql = "SELECT COUNT(ASSUNTO) AS PROGRAMADO
                          FROM `tb_escala_treinamento`
                          WHERE date_format(MES_REFERENCIA,'%m/%Y') = date_format(curdate(),'%m/%Y')
                          and status <> 'INATIVO'
                          and NOME = '".$Nome."'";
                    $resultado = mysqlI_query($link, $sql);
                    if(!$resultado)
                      echo '0';
                    else { $registro = mysqlI_fetch_array($resultado);
                      echo $registro['PROGRAMADO']; }
                ?>
              </h1>
              <div class="stat-percent font-bold text-success">
                <?php
                  $sql = "SELECT sum(case when `STATUS`='PRESENTE' then 1 else 0 end)/
                              (COUNT(ASSUNTO)-sum(case when `STATUS`='INATIVO' then 1 else 0 end))*100 AS CONCLUIDO_PRESENTES
                              FROM `tb_escala_treinamento`
                              WHERE date_format(MES_REFERENCIA,'%m/%Y') = date_format(curdate(),'%m/%Y')
                              and NOME = '".$Nome."'";
                    $resultado = mysqlI_query($link, $sql);
                    if(!$resultado)
                      echo '0';
                    else { $registro = mysqlI_fetch_array($resultado);
                      echo round($registro['CONCLUIDO_PRESENTES'],2); }?>% </i>
                      <i class="fa fa-bolt"></i>
              </div>
              <small>Realizado</small>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-info pull-right">Mês</span>
              <h5>Realizado</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">                              
                <?php
                  $sql = "SELECT sum(case when `STATUS`='PRESENTE' then 1 else 0 end) AS REALIZADO
                              FROM `tb_escala_treinamento`
                              WHERE date_format(MES_REFERENCIA,'%m/%Y') = date_format(curdate(),'%m/%Y')
                              and NOME = '".$Nome."'";
                       $resultado = mysqlI_query($link, $sql);
                        if(!$resultado)
                          echo '0';
                        else { $registro = mysqlI_fetch_array($resultado);
                          echo $registro['REALIZADO'];
                        }
                ?> 
              </h1>
              <small>Operadores Treinados</small>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-primary pull-right">Total</span>
              <h5>Ativos</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">
                <?php
                  $sql = "SELECT COUNT(OPERADORES) AS OPERADORES FROM (SELECT DISTINCT NOME AS OPERADORES
                          FROM `tb_escala_treinamento`
                          WHERE date_format(MES_REFERENCIA,'%m/%Y') = date_format(curdate(),'%m/%Y')
                          and status <> 'INATIVO'
                          and NOME = '".$Nome."') AS A";
                  $resultado = mysqlI_query($link, $sql);
                  if(!$resultado)
                    echo '0';
                  else { $registro = mysqlI_fetch_array($resultado);
                        echo $registro['OPERADORES']; 
                  }
                ?> 
              </h1>
              <small>Operadores Ativos</small>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label llabel-primary pull-right">Mês</span>
              <h5>Inativos</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">
                <?php
                  $sql = "SELECT COUNT(OPERADORES) AS OPERADORES FROM (SELECT DISTINCT NOME AS OPERADORES
                          FROM `tb_escala_treinamento`
                          WHERE date_format(MES_REFERENCIA,'%m/%Y') = date_format(curdate(),'%m/%Y')
                          and status = 'INATIVO' and NOME = '".$Nome."') AS A";
                  $resultado = mysqlI_query($link, $sql);
                  if(!$resultado)
                    echo '0';
                  else { $registro = mysqlI_fetch_array($resultado);
                    echo round($registro['OPERADORES'],2);
                  }
                ?>
              </h1>
               <small>Operadores Inativos</small>
            </div>
          </div>
        </div>
      </div>
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row" id="sortable-view">
          <div class="col-lg-12">
            <div class="ibox ">
              <div class="ibox-title">
                <h5>Resumo Treinamento</h5>
                <div class="ibox-tools">
                  <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                  <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
              </div>
              <div class="ibox-content">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th><center>ASSUNTO</center></th>
                      <th><center>PROGRAMADO</center></th>
                      <th><center>REALIZADO</center></th>
                      <th><center>INATIVOS</center></th>
                      <th><center>% CONCLUIDOS</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      set_time_limit(0);
                      $sql = "SELECT ASSUNTO, COUNT(ASSUNTO) AS PROGRAMADO, 
                              sum(case when `STATUS`='PRESENTE' then 1 else 0 end) AS REALIZADO,
                              sum(case when `STATUS`='INATIVO' then 1 else 0 end) AS QTD_INATIVO, 
                              sum(case when `STATUS`='PRESENTE' then 1 else 0 end)/
                              (COUNT(ASSUNTO)-sum(case when `STATUS`='INATIVO' then 1 else 0 end))*100 AS CONCLUIDO_PRESENTES
                              FROM `tb_escala_treinamento`
                              WHERE date_format(MES_REFERENCIA,'%m/%Y') = date_format(curdate(),'%m/%Y')
                              and NOME = '".$Nome."'
                              GROUP BY ASSUNTO";
                       $resultado = mysqlI_query($link, $sql);
                        if(!$resultado)
                          echo 'ERRO';
                        else{
                          $numero_registros = mysqlI_num_rows($resultado);
                          while($registro = mysqlI_fetch_array($resultado)){  
                    ?> 
                            <tr>
                              <td scope="row"><center><?php echo $registro['ASSUNTO'];?></center></td>
                              <td><center><?php echo $registro['PROGRAMADO'];?></center></td>
                              <td><center><?php echo $registro['REALIZADO'];?></center></td>
                              <td><center><?php echo $registro['QTD_INATIVO'];?></center></td>
                              <td><center><?php echo round($registro['CONCLUIDO_PRESENTES'],2);?>%</center></td>
                            </tr>
                    <?php } }?>
                  </tbody>
                </table>
              </div>
              <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                      <div class="ibox-title">
                        <h5>Analitico Treinamentos</h5>
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
                                <th><center>ASSUNTO</center></th>
                                <th><center>ASSUNTO DASHBOARD</center></th>
                                <th><center>CARGA HORARIA</center></th>
                                <th><center>HORARIO DA LABORAL</center></th>
                                <th><center>DATA PROGRAMADA</center></th>
                                <th><center>MOTIVO</center></th>
                                <th><center>DATA REALIZADA</center></th>
                                <th><center>STATUS</center></th>
                                <th><center>T INSTRUTOR</center></th>
                                <th><center>NOME INSTRUTOR</center></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php set_time_limit(0);
                                $sql = "SELECT ASSUNTO, ASSUNTO_DASHBOARD, 
                                        CARGA_HORARIA, TURNO_OPERADOR, 
                                        HORARIO_DA_LABORAL, DATA_PROGRAMADA, 
                                        ALMOPE, CPF, NOME, SUPERVISOR, 
                                        SKILL, MOTIVO, DATA_REALIZADA, 
                                        STATUS, T_INSTRUTOR, CPF_INSTRUTOR, NOME_INSTRUTOR 
                                        from `tb_escala_treinamento`
                                        WHERE date_format(MES_REFERENCIA,'%m/%Y') = date_format(curdate(),'%m/%Y')
                                        and NOME = '".$Nome."'";
                                $resultado = mysqlI_query($link, $sql);
                                if(!$resultado)
                                    echo 'ERRO';
                                else{
                                    $numero_registros = mysqlI_num_rows($resultado);
                                    while($registro = mysqlI_fetch_array($resultado))
                                {  ?> 
                                <tr>
                                  <td><center><?php echo $registro['ASSUNTO'];?></center></td>
                                  <td><center><?php echo $registro['ASSUNTO_DASHBOARD'];?></center></td>
                                  <td><center><?php echo $registro['CARGA_HORARIA'];?></center></td>
                                  <td><center><?php echo $registro['HORARIO_DA_LABORAL'];?></center></td>
                                  <td><center><?php echo $registro['DATA_PROGRAMADA'];?></center></td>
                                  <td><center><?php echo $registro['MOTIVO'];?></center></td>
                                  <td><center><?php echo $registro['DATA_REALIZADA'];?></center></td>
                                  <td><center><?php echo $registro['STATUS'];?></center></td>
                                  <td><center><?php echo $registro['T_INSTRUTOR'];?></center></td>
                                  <td><center><?php echo $registro['NOME_INSTRUTOR'];?></center></td>
                                </tr>
                                <?php } }?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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
    <script src="../js/plugins/flot/jquery.flot.js"></script>
    <script src="../js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="../js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="../js/plugins/flot/jquery.flot.time.js"></script>
    <script src="../js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../js/demo/peity-demo.js"></script>
    <script src="../js/inspinia.js"></script>
    <script src="../js/plugins/pace/pace.min.js"></script>
    <script src="../js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="../js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../js/plugins/easypiechart/jquery.easypiechart.js"></script>
    <script src="../js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script src="../js/demo/sparkline-demo.js"></script>
    <script src="../js/plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
    <script src="../js/plugins/dataTables/datatables.min.js"></script>
  </body>
</html>
