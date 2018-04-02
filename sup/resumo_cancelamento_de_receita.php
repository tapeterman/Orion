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
      <title>Orion | Dashboard</title>
      <link href="../css/bootstrap.min.css" rel="stylesheet">
      <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
      <link href="../css/animate.css" rel="stylesheet">
      <link href="../css/style.css" rel="stylesheet">
      <link href="../css/plugins/jQueryUI/jquery-ui.css" rel="stylesheet">
  </head>
  <body>
    <?php include('header.php');?>
    <div class="wrapper wrapper-content">
      <div class="row">
        <div class="col-lg-4">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-success pull-right">Mês</span>
              <h5>Cancelamento de Receita</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">
                <?php
                  $sql = "SELECT sum(`TOTAL`) as Total 
                          FROM `tb_descontos_lancados` 
                          WHERE TIPO = 'CANCELAMENTO RECEITA' 
                          AND MONTH(DT_LANCAMENTO) = MONTH(CURDATE())";
                  $resultado = mysqlI_query($link, $sql);
                  if(!$resultado)
                    echo 'ERRO';
                  else { $registro = mysqlI_fetch_array($resultado);
                    $x=-$registro['Total'];
                    echo 'R$' . number_format(-$registro['Total'], 2, ',', '.'); 
                  }
                ?> 
              </h1>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-info pull-right">Mês</span>
              <h5>Cancelamento Justificado</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins"> 
                <?php
                  $sql = "SELECT SUM(`TOTAL`) as Total 
                          FROM `tb_descontos_lancados` 
                          WHERE TIPO = 'DESCONTO FORNECEDOR' 
                          AND MONTH(DT_LANCAMENTO) = MONTH(CURDATE())";
                  $resultado = mysqlI_query($link, $sql);
                  if(!$resultado)
                    echo 'ERRO';
                  else { $registro = mysqlI_fetch_array($resultado);
                    $y=$registro['Total'];
                    echo 'R$' . number_format($registro['Total'], 2, ',', '.'); 
                  }
                ?>                    
              </h1>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-primary pull-right">Mês</span>
              <h5>Delta Cancelamento</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">
                <?php echo 'R$' . number_format(($x-$y), 2, ',', '.');?> 
              </h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="wrapper wrapper-content  animated fadeInRight">
      <div class="row" id="sortable-view">
        <div class="col-lg-12">
          <div class="ibox ">
            <div class="ibox-title">
              <h5>Cancelamento de Receita por Supervisor</h5>
              <div class="ibox-tools">
                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                <a class="close-link"><i class="fa fa-times"></i></a>
              </div>
            </div>
            <div class="ibox-content">
              <table class="table table-striped table-bordered table-hover dataTables-example">
                <thead>
                  <tr>
                    <th><center>DATA</center></th>
                    <th><center>CANCELAMENTO DE RECEITA</center></th>
                    <th><center>DESCONTO TABULADO</center></th>
                    <th><center>DELTA</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    set_time_limit(0);
                    $sql = "SELECT date_format(`DT_LANCAMENTO`, '%d/%m/%Y') as Data,
                            - SUM(CASE WHEN `TIPO` = 'CANCELAMENTO RECEITA' THEN `TOTAL` ELSE 0 END) AS 'CANCELAMENTO', 
                            SUM(CASE WHEN `TIPO` = 'DESCONTO FORNECEDOR' THEN `TOTAL` ELSE 0 END) AS 'VALIDADO', 
                            SUM(CASE WHEN `TIPO` = 'DESCONTO FORNECEDOR' THEN `TOTAL` ELSE 0 END) + 
                            SUM(CASE WHEN `TIPO` = 'CANCELAMENTO RECEITA' THEN `TOTAL` ELSE 0 END) AS 'DELTA' 
                            FROM `tb_descontos_lancados` 
                            WHERE MONTH(DT_LANCAMENTO) = MONTH(CURDATE())
                            GROUP BY Data order by Data desc ";
                    $resultado = mysqlI_query($link, $sql);  
                    if(!$resultado)
                      echo 'ERRO';
                    else{
                      $numero_registros = mysqlI_num_rows($resultado);
                      while($registro = mysqlI_fetch_array($resultado)){  
                  ?> 
                      <tr>
                        <td scope="row"><center><?php echo $registro['Data'];?></center></td>
                        <td><center><?php echo 'R$' . number_format($registro['CANCELAMENTO'], 2, ',', '.');?></center></td>
                        <td><center><?php echo 'R$' . number_format($registro['VALIDADO'], 2, ',', '.');?></center></td>
                        <td><center><?php echo 'R$' . number_format($registro['DELTA'], 2, ',', '.');?></center></td>
                      </tr>
                  <?php } }?>          
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row" id="sortable-view">
          <div class="col-lg-12">
            <div class="ibox ">
              <div class="ibox-title">
                <h5>Cancelamento de Receita Dia</h5>
                <div class="ibox-tools">
                  <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                  <a class="close-link"><i class="fa fa-times"></i></a>
                </div>
              </div>
              <div class="ibox-content">
                <table class="table table-striped table-bordered table-hover dataTables-example">
                  <thead>
                    <tr>
                      <th><center>DATA</center></th>
                      <th><center>CANCELAMENTO DE RECEITA</center></th>
                      <th><center>DESCONTO TABULADO</center></th>
                      <th><center>DELTA</center></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      set_time_limit(0);
                      $sql = "SELECT SUPERVISOR,
                              - SUM(CASE WHEN `TIPO` = 'CANCELAMENTO RECEITA' THEN `TOTAL` ELSE 0 END) AS 'CANCELAMENTO', 
                              SUM(CASE WHEN `TIPO` = 'DESCONTO FORNECEDOR' THEN `TOTAL` ELSE 0 END) AS 'VALIDADO', 
                              SUM(CASE WHEN `TIPO` = 'DESCONTO FORNECEDOR' THEN `TOTAL` ELSE 0 END) + 
                              SUM(CASE WHEN `TIPO` = 'CANCELAMENTO RECEITA' THEN `TOTAL` ELSE 0 END) AS 'DELTA' 
                              FROM `tb_descontos_lancados` 
                              GROUP BY SUPERVISOR 
                              order by SUPERVISOR ";
                      $resultado = mysqlI_query($link, $sql);
                      if(!$resultado)
                        echo 'ERRO';
                      else {
                        $numero_registros = mysqlI_num_rows($resultado);
                        while($registro = mysqlI_fetch_array($resultado)) {  
                    ?> 
                        <tr>
                          <td scope="row"><center><?php echo $registro['SUPERVISOR'];?></center></td>
                          <td><center><?php echo 'R$' . number_format($registro['CANCELAMENTO'], 2, ',', '.');?></center></td>
                          <td><center><?php echo 'R$' . number_format($registro['VALIDADO'], 2, ',', '.');?></center></td>
                          <td><center><?php echo 'R$' . number_format($registro['DELTA'], 2, ',', '.');?></center></td>
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
    <?php include('footer.php') ;?>
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
    <script>
         $(document).ready(function(){
             <!-- Enable portlets -->
            WinMove();
        });
    </script>
  </body>
</html>
