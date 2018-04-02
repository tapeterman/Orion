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
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-success pull-right">Dia</span>
              <h5>Abertos</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">
                <?php
                  $sql = "SELECT count(*) as Quantidade 
                          FROM `tb_prazo_online` 
                          WHERE PRAZO ='ADP' 
                          AND `VENCIMENTO` ='".$data_atual_sql."' ";
                    $resultado = mysqlI_query($link, $sql);
                    if(!$resultado)
                      echo 'ERRO';
                    else { $registro = mysqlI_fetch_array($resultado);
                      echo $registro['Quantidade']; }
                ?> 
              </h1>
              <div class="stat-percent font-bold text-success">
                <?php
                  $sql = "SELECT sum(case when `PRAZO`='RDP' then 1 else 0 end) as RDP,
                          sum(case when PRAZO='ADP' then 1 else 0 end) as ADP,
                          count(*) as Recebido 
                          FROM tb_prazo_online 
                          where VENCIMENTO ='".$data_atual_sql."' ";
                    $resultado = mysqlI_query($link, $sql);
                    if(!$resultado)
                      echo 'ERRO';
                    else { $registro = mysqlI_fetch_array($resultado);
                      echo round(@($registro['RDP']/($registro['Recebido']-$registro['ADP'])*100),2); }?>% </i>
                      <i class="fa fa-bolt"></i>
              </div>
                <small>Prazo Entregue</small>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-info pull-right">Dia</span>
              <h5>Resolvidos</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">                              
                <?php
                  $sql = "SELECT count(*) as Quantidade 
                          FROM `vw_resolvidas_online` 
                          where CAMPANHA IN ('PRE ANATEL N2','OUVIDORIA N2') ";
                       $resultado = mysqlI_query($link, $sql);
                        if(!$resultado)
                          echo '0';
                        else { $registro = mysqlI_fetch_array($resultado);
                          echo $registro['Quantidade'];
                        }
                ?> 
              </h1>
              <small>Resolvidos hoje</small>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label label-primary pull-right">Total</span>
              <h5>Sem Start</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">
                <?php
                  $sql = "select count(*) as Quantidade from `tb_portal_online` where empresa='ALMAVIVA' and `DS_FORMA_CONTATO`<>'BKO' and `ICR`<>'0'";
                  $resultado = mysqlI_query($link, $sql);
                  if(!$resultado)
                    echo 'ERRO';
                  else { $registro = mysqlI_fetch_array($resultado);
                        echo $registro['Quantidade']; 
                  }
                ?> 
              </h1>
              <small>Manifestos Sem Start</small>
            </div>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="ibox float-e-margins">
            <div class="ibox-title">
              <span class="label llabel-primary pull-right">Dia</span>
              <h5>FCR Online</h5>
            </div>
            <div class="ibox-content">
              <h1 class="no-margins">
                <?php
                  $sql = "SELECT SUM(CASE WHEN `FCR`='FCR' THEN 1 ELSE 0 END) AS 'TOTAL' 
                          FROM `tb_fcr_online`";
                  $resultado = mysqlI_query($link, $sql);
                  if(!$resultado)
                    echo 'ERRO';
                  else { $registro = mysqlI_fetch_array($resultado);
                    echo round($registro['TOTAL'],2);
                  }
                ?>
              </h1>
              <div class="stat-percent font-bold text-success">
                <?php
                  $sql = "SELECT SUM(CASE WHEN `FCR`='FCR' THEN 1 ELSE 0 END)/COUNT(*)*100 AS 'TOTAL' 
                          FROM `tb_fcr_online`";
                  $resultado = mysqlI_query($link, $sql);
                  if(!$resultado)
                    echo 'ERRO';
                  else { $registro = mysqlI_fetch_array($resultado);
                    echo round($registro['TOTAL'],2);
                  }
                ?>% 
                <i class="fa fa-bolt"></i>
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
              <h5>Prazo Online N2</h5>
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
                    <th><center>VENCIMENTO</center></th>
                    <th><center>RECEBIDOS</center></th>
                    <th><center>RDP</center></th>
                    <th><center>RFD</center></th>
                    <th><center>ADP</center></th>
                    <th><center>AFD</center></th>
                    <th><center>% PERDA</center></th>
                    <th><center>% PRAZO</center></th>
                    <th><center>% FINALIZADOS</center></th>
                    <th><center>% OPORTUNIDADE PRAZO</center></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    set_time_limit(0);
                    $sql = "SELECT date_format(`VENCIMENTO`,'%d/%m/%Y') as VENCIMENTOS, 
                          count(*) as RECEBIDO, 
                          sum(case when `PRAZO`='RDP' then 1 else 0 end) as 'RDP' ,
                          sum(case when `PRAZO`='RFP' then 1 else 0 end) as 'RFP', 
                          sum(case when `PRAZO`='ADP' then 1 else 0 end) as 'ADP',
                          sum(case when `PRAZO`='AFP' then 1 else 0 end) as 'AFP' ,
                          (sum(case when `PRAZO`='RFP' then 1 else 0 end)+sum(case when `PRAZO`='AFP' then 1 else 0 end))/count(*)*100 as PERDA,
                          sum(case when `PRAZO`='RDP' then 1 else 0 end)/(count(*)-sum(case when `PRAZO`='ADP' then 1 else 0 end))*100 as PRAZO,
                          sum(case when `PRAZO`='RDP' then 1 else 0 end)/count(*)*100 as FINALIZADOS,
                          (sum(case when `PRAZO`='RDP' then 1 else 0 end)+sum(case when `PRAZO`='ADP' then 1 else 0 end))/count(*)*100 as OPORTUNIDADE
                          from `tb_prazo_online`        
                          group by date_format(`VENCIMENTO`,'%d/%m/%Y') 
                          order by `VENCIMENTO` ";
                     $resultado = mysqlI_query($link, $sql);
                      if(!$resultado)
                        echo 'ERRO';
                      else{
                        $numero_registros = mysqlI_num_rows($resultado);
                        while($registro = mysqlI_fetch_array($resultado)){  
                  ?> 
                          <tr>
                            <td scope="row"><center><?php echo $registro['VENCIMENTOS'];?></center></td>
                            <td><center><?php echo $registro['RECEBIDO'];?></center></td>
                            <td><center><?php echo $registro['RDP'];?></center></td>
                            <td><center><?php echo $registro['RFP'];?></center></td>
                            <td><center><?php echo $registro['ADP'];?></center></td>
                            <td><center><?php echo $registro['AFP'];?></center></td>
                            <td><center><?php echo round($registro['PERDA'],2);?>%</center></td>
                            <td class=<?php if($registro['PRAZO']>95) echo'"text-navy"'; else echo '"text-warning"';?>> <i class=<?php if($registro['PRAZO']>95) echo'"fa fa-level-up"'; else echo '"fa fa-level-down"';?>></i><strong><?php echo round($registro['PRAZO'],2);?>%</strong></td>
                            <td><center><?php echo round($registro['FINALIZADOS'],2);?>%</center></td>
                            <td class=<?php if($registro['OPORTUNIDADE']>95) echo'"text-navy"'; else echo '"text-warning"';?>> <i class=<?php if($registro['OPORTUNIDADE']>95) echo'"fa fa-level-up"'; else echo '"fa fa-level-down"';?>></i><strong><?php echo round($registro['OPORTUNIDADE'],2);?>%</strong></td> 
                          </tr>
                            
                  <?php } }?>          
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="wrapper wrapper-content  animated fadeInRight">
          <div class="row" id="sortable-view">
            <div class="col-lg-12">
              <div class="ibox ">
                <div class="ibox-title">
                  <h5>Prazo Online 0800</h5>
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
                        <th><center>HORARIO</center></th>
                        <th><center>FORECAST</center></th>
                        <th><center>OFERECIDAS</center></th>
                        <th><center>ATENDIDAS</center></th>
                        <th><center>ATENDIDAS EM 10</center></th>
                        <th><center>DESVIO</center></th>
                        <th><center>NS</center></th>
                        <th><center>TMT PLANEJADO</center></th>
                        <th><center>TMT REAL</center></th>
                        <th><center>DESVIO TMT</center></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        set_time_limit(0);
                        $sql = "SELECT TIME_FORMAT(str_to_date(HORARIO, '%d/%m/%Y %T'), '%H:%i') as 'HORARIO',
                                      Forecast,OFERECIDAS,ATENDIDAS,ATENDIDAS_EM_10,DESVIO,
                                      NS,TMT_PLANEJADO,TMT_REAL,DESVIO_TMT
                                      FROM `tb_ns_0800`
                                      WHERE STR_TO_DATE(HORARIO, '%d/%m/%Y') = CURDATE()
                                      UNION
                                      select 'TOTAL' as HORARIO, sum(Forecast) AS Forecast,
                                      sum(OFERECIDAS) as OFERECIDAS, sum(ATENDIDAS) AS ATENDIDAS, 
                                      sum(ATENDIDAS_EM_10) AS ATENDIDAS_EM_10, 
                                      (sum(OFERECIDAS)/sum(Forecast)-1)*100 AS DESVIO,
                                      SUM(ATENDIDAS_EM_10)/sum(OFERECIDAS)*100 AS NS,
                                      sum(falado_planejado)/sum(Forecast) as TMT_PLANEJADO, 
                                      SUM(falado_real)/sum(ATENDIDAS) AS TMT_REAL,
                                      ((SUM(falado_real)/sum(ATENDIDAS))/(sum(falado_planejado)/sum(Forecast))-1)*100 AS DESVIO_TMT
                                      from 
                                      (SELECT HORARIO, Forecast, OFERECIDAS, ATENDIDAS, ATENDIDAS_EM_10, 
                                        TMT_PLANEJADO, TMT_REAL, TMT_PLANEJADO*Forecast as falado_planejado, 
                                        TMT_REAL*ATENDIDAS as falado_real
                                      FROM `tb_ns_0800`
                                      WHERE STR_TO_DATE(HORARIO, '%d/%m/%Y') = CURDATE()) as a";
                          $resultado = mysqlI_query($link, $sql);
                          if(!$resultado)
                              echo 'ERRO';
                          else{
                            $numero_registros = mysqlI_num_rows($resultado);
                            while($registro = mysqlI_fetch_array($resultado)){  
                      ?> 
                        <tr>
                          <td scope="row"><center><?php echo $registro['HORARIO'];?></center></td>
                          <td><center><?php echo $registro['Forecast'];?></center></td>
                          <td><center><?php echo $registro['OFERECIDAS'];?></center></td>
                          <td><center><?php echo $registro['ATENDIDAS'];?></center></td>
                          <td><center><?php echo $registro['ATENDIDAS_EM_10'];?></center></td>
                          <td class=<?php if($registro['DESVIO']<0) echo'"text-navy"';
                            else echo '"text-danger"';?>> <i class=<?php if($registro['DESVIO']<0) echo '"fa fa-level-down"'; 
                            else echo '"fa fa-level-up"';?>></i><strong><?php echo round($registro['DESVIO'],2);?>%</strong></td>
                          <td class=<?php if($registro['NS']>90) echo'"text-navy"'; 
                            else echo '"text-danger"';?>> <i class=<?php if($registro['NS']>90) echo'"fa fa-level-up"'; 
                            else echo '"fa fa-level-down"';?>></i><strong><?php echo round($registro['NS'],2);?>%</strong></td>
                          <td><center><?php echo round($registro['TMT_PLANEJADO'],0);?></center></td>
                          <td><center><?php echo round($registro['TMT_REAL'],0);?></center></td>
                          <td class=<?php if($registro['DESVIO_TMT']<0) echo'"text-navy"'; 
                            else echo '"text-danger"';?>><i class=<?php if($registro['DESVIO_TMT']<0) echo'"fa fa-level-down"'; 
                            else echo '"fa fa-level-up"';?>></i><strong><?php echo round($registro['DESVIO_TMT'],2);?>%</strong></td> 
                        </tr>
                      <?php }} ?>          
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row" id="sortable-view">
              <div class="col-lg-6">
                <div class="ibox ">
                  <div class="ibox-title">
                    <h5>ICR</h5>
                    <div class="ibox-tools">
                      <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                      <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <div class="ibox-content">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th><center>Dias Sem Registro</center></th>
                          <th><center>QUANTIDADE</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          set_time_limit(0);
                          $total=0;
                           $sql = "SELECT `ICR`, COUNT(`ICR`) as Quantidade 
                                  from `tb_portal_online` 
                                  where empresa='ALMAVIVA' 
                                  and TIPO='ICR' and ICR<>'0' 
                                  group by `ICR` 
                                  order by `ICR` DESC ";
                            $resultado = mysqlI_query($link, $sql);
                            if(!$resultado)
                              echo 'ERRO';
                            else{
                              $numero_registros = mysqlI_num_rows($resultado);
                              while($registro = mysqlI_fetch_array($resultado)){  
                        ?> 
                            <tr>
                              <td scope="row"><center><?php echo $registro['ICR'];?> dia(s) </center></td>
                              <td><center><?php echo $registro['Quantidade'];?></center></td>
                              <?php $total= $total+$registro['Quantidade'];?>
                            </tr>
                        <?php } }?>          
                            <tr>
                              <td scope="row"><center><strong>Total ICR</strong></center></td>
                              <td><center><strong><?php echo $total;?></strong></center></td>
                            </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="ibox ">
                  <div class="ibox-title">
                    <h5>Em Aberto</h5>
                    <div class="ibox-tools">
                      <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                      <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <div class="ibox-content">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th><center>STATUS</center></th>
                          <th><center>QUANTIDADE</center></th>
                          <th><center>ACUMULADO</center></th>
                          <th><center>BKO</center></th>
                          <th><center>TOTAL</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          set_time_limit(0);
                          $total=0;
                          $total1=0;
                          $total2=0;
                          $acumulado=0;
                           $sql = "SELECT `DT_VENCIMENTO` , 
                                  `STATUS_VENCIMENTO`,
                                  SUM(CASE WHEN `DS_FORMA_CONTATO` NOT IN('BKO') THEN 1 ELSE 0 END) AS QUANTIDADE,
                                  SUM(CASE WHEN `DS_FORMA_CONTATO` IN ('BKO') THEN 1 ELSE 0 END) AS BKO,
                                  COUNT(`STATUS_VENCIMENTO`) as TOTAL
                                  from `tb_portal_online` 
                                  where empresa='ALMAVIVA' 
                                  group by `STATUS_VENCIMENTO` 
                                  order by `DT_VENCIMENTO`  ";
                         $resultado = mysqlI_query($link, $sql);
                         if(!$resultado)
                            echo 'ERRO';
                         else{
                            $numero_registros = mysqlI_num_rows($resultado);
                            while($registro = mysqlI_fetch_array($resultado)){  
                        ?> 
                              <tr>
                                <td scope="row"><center><?php echo $registro['STATUS_VENCIMENTO'];?></center></td>
                                <td><center><?php echo $registro['QUANTIDADE'];?></center></td>
                                <td><center><?php echo $acumulado + $registro['QUANTIDADE'];?></center></td>
                                <td><center><?php echo $registro['BKO'];?></center></td>
                                <td><center><?php echo $registro['TOTAL'];?></center></td>
                                <?php $total= $total+$registro['QUANTIDADE'];
                                $total1= $total1+$registro['BKO'];
                                $total2= $total2+$registro['TOTAL'];
                                $acumulado=$acumulado + $registro['QUANTIDADE'];
                                ?>
                              </tr>
                        <?php } }?>          
                            <tr>
                             <td scope="row"><center><strong>Total Abertos</strong></center></td>
                                <td><center><strong><?php echo $total;?></strong></center></td>
                                <td><center><strong><?php echo $acumulado;?></strong></center></td>
                                <td><center><strong><?php echo $total1;?></strong></center></td>
                                <td><center><strong><?php echo $total2;?></strong></center></td>
                            </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="ibox">
                  <div class="ibox-title">
                    <h5>Pendentes Start</h5>
                    <div class="ibox-tools">
                      <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                      <a class="close-link"><i class="fa fa-times"></i></a>
                    </div>
                  </div>
                  <div class="ibox-content">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th><center>DATA ABERTURA</center></th>
                          <th><center>QUANTIDADE</center></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          set_time_limit(0);
                          $total=0;
                          $sql = "SELECT DATE_FORMAT(STR_TO_DATE(`DH_ABERTURA`, '%d/%m/%Y'), '%d/%m/%Y') AS Data_Abertura,
                                  count(*) as Quantidade 
                                  from `tb_portal_online`
                                  where empresa='ALMAVIVA' 
                                  and `DS_FORMA_CONTATO`<>'BKO' 
                                  and `ICR`<>'OK' 
                                  group by STR_TO_DATE(`DH_ABERTURA`, '%d/%m/%Y') ";
                          $resultado = mysqlI_query($link, $sql);
                          if(!$resultado)
                            echo 'ERRO';
                          else{
                            $numero_registros = mysqlI_num_rows($resultado);
                            while($registro = mysqlI_fetch_array($resultado))
                          {  
                        ?> 
                            <tr>
                              <td scope="row"><center><?php echo $registro['Data_Abertura'];?></center></td>
                              <td><center><?php echo $registro['Quantidade'];?></center></td>
                              <?php $total= $total+$registro['Quantidade'];?>
                            </tr>
                        <?php } }?>          
                            <tr>
                             <td scope="row"><center><strong>Total sem Start</strong></center></td>
                              <td><center><strong><?php echo $total;?></strong></center></td>
                            </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="ibox">
                    <div class="ibox-title">
                      <h5>Recorrente</h5>
                      <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                      </div>
                    </div>
                    <div class="ibox-content">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th><center>RECORRENTE</center></th>
                            <th><center>QUANTIDADE</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            set_time_limit(0);
                            $total=0;
                            $sql = "SELECT RECORRENTE, COUNT(*) as Quantidade 
                                    from `tb_portal_online` 
                                    where empresa='ALMAVIVA' 
                                    and DS_FORMA_CONTATO not in ('BKO') 
                                    and RECORRENTE IS NOT NULL 
                                    group by `RECORRENTE` 
                                    order by Quantidade DESC ";
                            $resultado = mysqlI_query($link, $sql);
                            if(!$resultado)
                              echo 'ERRO';
                            else{
                              $numero_registros = mysqlI_num_rows($resultado);
                              while($registro = mysqlI_fetch_array($resultado)){  
                          ?> 
                              <tr>
                                <td scope="row"><center><?php echo $registro['RECORRENTE'];?></center></td>
                                <td><center><?php echo $registro['Quantidade'];?></center></td>
                                <?php $total= $total+$registro['Quantidade'];?>
                              </tr>
                          <?php } }?>  
                              <tr>
                                <td scope="row"><center><strong>Total ICR</strong></center></td>
                                <td><center><strong><?php echo $total;?></strong></center></td>
                              </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="ibox ">
                    <div class="ibox-title">
                      <h5>Em Abertos por Fila</h5>
                      <div class="ibox-tools">
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                        <a class="close-link"><i class="fa fa-times"></i></a>
                      </div>
                    </div>
                    <div class="ibox-content">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th><center>AREA</center></th>
                            <th><center>QUANTIDADE</center></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            set_time_limit(0);
                            $total=0;
                            $sql = "SELECT AREA, COUNT(*) as Quantidade 
                                    from `tb_portal_online` 
                                    where empresa='ALMAVIVA'  
                                    group by `AREA` 
                                    order by Quantidade DESC ";
                            $resultado = mysqlI_query($link, $sql);
                            if(!$resultado)
                              echo 'ERRO';
                            else{
                              $numero_registros = mysqlI_num_rows($resultado);
                              while($registro = mysqlI_fetch_array($resultado)){  
                          ?> 
                              <tr>
                                <td scope="row"><center><?php echo $registro['AREA'];?></center></td>
                                <td><center><?php echo $registro['Quantidade'];?></center></td>
                                <?php $total= $total+$registro['Quantidade'];?>
                              </tr>
                          <?php } }?>          
                              <tr>
                               <td scope="row"><center><strong>Total ICR</strong></center></td>
                                <td><center><strong><?php echo $total;?></strong></center></td>
                              </tr>
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
                        toastr.success('Registrado com sucesso', 'Sucesso');
                    }, 1300);"; } else ;
                ?> });
        </script>
  </body>
</html>
