<?php
  session_start();
  require_once('../../db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $Almope = $_SESSION['Almope'];
  $Login = $_SESSION['Login'];
  $Nome = $_SESSION['Nome'];
  $permissao = $_SESSION['Permissao'];
  $bko = 0;
  $recebidos = 0;
  $rdp =  0;
  $rfp =  0;
  $recorrente2 =  0;
  $recorrente3 =  0;
  $reincidencia =  0;
  $odc =  0;
?>
<table class="table table-striped table-bordered table-hover dataTables-example">
  <thead>
    <tr>
      <th><center>DATA ABERTURA</center></th>
      <th><center>DATA MAXIMA</center></th>
      <th><center>BKO</center></th>
      <th><center>RECEBIDOS</center></th>
      <th><center>RDP</center></th>
      <th><center>RFP</center></th>
      <th><center>PRAZO</center></th>
      <th><center>RECORRENTE 2</center></th>
      <th><center>% RECORRENTE 2</center></th>
      <th><center>RECORRENTE 3</center></th>
      <th><center>% RECORRENTE 3</center></th>
      <th><center>REINCIDENCIA</center></th>
      <th><center>% REINCIDENCIA</center></th>
      <th><center>MIGRAÇÃO ODC</center></th>
      <th><center>% MIGRAÇÃO ODC</center></th>
    </tr>
  </thead>
  <tbody> 
    <?php set_time_limit(0);
      $mes = $_GET['mes'];
      $supervisor = $_GET['supervisor'];
      $sql = "SELECT DATE_FORMAT(DH_ABERTURA, '%d/%m/%Y') as DATA_ABERTURA,
              MIN(DATE_FORMAT(DH_MAXIMA, '%d/%m/%Y')) as DATA_MAXIMA,
              SUM(CASE WHEN `DS_FORMA_CONTATO` = 'BKO' THEN 1 ELSE 0 END) AS BKO,
              SUM(CASE WHEN `DS_FORMA_CONTATO` NOT IN ('BKO') THEN 1 ELSE 0 END) AS RECEBIDOS,
              SUM(CASE WHEN `PRAZO` IN ('RDP') THEN 1 ELSE 0 END) AS RDP,
              SUM(CASE WHEN `PRAZO` IN ('RFP','AFD') THEN 1 ELSE 0 END) AS RFP,
              SUM(CASE WHEN `PRAZO`='RDP' AND VALIDO=1 THEN 1 ELSE 0 END)/SUM(CASE WHEN VALIDO=1 AND `PRAZO`<>'ADP' THEN 1 ELSE 0 END)* 100 AS PRAZO,
              SUM(CASE WHEN RECORRENTE=2 THEN 1 ELSE 0 END) AS RECORRENTE_2,
              SUM(CASE WHEN RECORRENTE=2 THEN 1 ELSE 0 END)/ SUM(CONTRATO_UNICO)* 100 AS P_REC_2,
              SUM(CASE WHEN RECORRENTE=3 THEN 1 ELSE 0 END) AS RECORRENTE_3,
              SUM(CASE WHEN RECORRENTE=3 THEN 1 ELSE 0 END)/ SUM(CONTRATO_UNICO)* 100 AS P_REC_3,
              SUM(REINCIDENCIA) AS REINCIDENCIA,
              SUM(REINCIDENCIA)/ SUM(CASE WHEN `DS_FORMA_CONTATO` NOT IN ('BKO') THEN 1 ELSE 0 END)* 100 AS P_REINCIDENCIA,
              SUM(ODC) AS ODC,
              SUM(ODC)/ SUM(CONTRATO_UNICO)* 100 AS PODC
              FROM `tb_indicadores_historico`
              WHERE MONTH(DH_ABERTURA) = '".$mes."'
              AND `CAMPANHA_RESPONSAVEL` = 'OUVIDORIA N2'
              AND (SUPERVISOR_RESPONSAVEL = '".$supervisor."' OR '".$supervisor."' = 'TODOS')
              GROUP BY DATE_FORMAT(DH_ABERTURA, '%d/%m/%Y')";
      $resultado = mysqlI_query($link, $sql);
      if(!$resultado)
        echo 'ERRO';
      else{
        $numero_registros = mysqlI_num_rows($resultado);
        while($registro = mysqlI_fetch_array($resultado)){  
    ?> 
          <tr>
            <td scope="row"><center><?php echo $registro['DATA_ABERTURA'];?></center></td>
            <td><center><?php echo $registro['DATA_MAXIMA'];?></center></td>
            <td><center><?php echo $registro['BKO'];?></center></td>
            <td><center><?php echo $registro['RECEBIDOS'];?></center></td>
            <td><center><?php echo $registro['RDP'];?></center></td>
            <td><center><?php echo $registro['RFP'];?></center></td>
            <td><center><?php echo round($registro['PRAZO'],2);?>%</center></td>
            <td><center><?php echo $registro['RECORRENTE_2'];?></center></td>
            <td><center><?php echo round($registro['P_REC_2'],2);?>%</center></td>
            <td><center><?php echo $registro['RECORRENTE_3'];?></center></td>
            <td><center><?php echo round($registro['P_REC_3'],2);?>%</center></td>
            <td><center><?php echo $registro['REINCIDENCIA'];?></center></td>
            <td><center><?php echo round($registro['P_REINCIDENCIA'],2);?>%</center></td>
            <td><center><?php echo $registro['ODC'];?></center></td>
            <td><center><?php echo round($registro['PODC'],2);?>%</center></td>
          </tr>
          <?php 
            $bko=$bko+$registro['BKO'];
            $recebidos= $recebidos + $registro['RECEBIDOS'];
            $rdp = $rdp + $registro['RDP'];
            $rfp = $rfp + $registro['RFP'];
            $prazo = round(($rdp/($rdp + $rfp))*100,2);
            $recorrente2 = $recorrente2 + $registro['RECORRENTE_2'];
            $p_recorrente2 = round(($recorrente2 /$recebidos*100),2);
            $recorrente3 = $recorrente3 +  $registro['RECORRENTE_3'];
            $p_recorrente3 = round(($recorrente3 /$recebidos*100),2);
            $reincidencia = $reincidencia  + $registro['REINCIDENCIA'];
            $p_reincidencia = round(($reincidencia /$recebidos*100),2);
            $odc = $odc + $registro['ODC'];
            $p_odc = round(($odc /$recebidos*100),2);       
        } }?> 
        <tr>       
            <td scope="row"><center><strong>TOTAL</strong></center></td>
            <td><center><strong>-</strong></center></td>
            <td><center><strong><?php echo $bko;?></strong></center></td>
            <td><center><strong><?php echo $recebidos;?></strong></center></td>
            <td><center><strong><?php echo $rdp;?></strong></center></td>
            <td><center><strong><?php echo $rfp;?></strong></center></td>
            <td><center><strong><?php echo $prazo;?></strong>%</center></td>
            <td><center><strong><?php echo $recorrente2;?></strong></center></td>
            <td><center><strong><?php echo $p_recorrente2;?>%</strong></center></td>
            <td><center><strong><?php echo $recorrente3;?></strong></center></td>
            <td><center><strong><?php echo $p_recorrente3;?>%</strong></center></td>
            <td><center><strong><?php echo $reincidencia;?></strong></center></td>
            <td><center><strong><?php echo $p_reincidencia;?>%</strong></center></td>
            <td><center><strong><?php echo $odc;?></strong></center></td>
            <td><center><strong><?php echo $p_odc;?></strong>%</center></td>
        </tr>
  </tbody>
  <tfoot>
    <tr>
      <th><center>DATA ABERTURA</center></th>
      <th><center>DATA MAXIMA</center></th>
      <th><center>BKO</center></th>
      <th><center>RECEBIDOS</center></th>
      <th><center>RDP</center></th>
      <th><center>RFP</center></th>
      <th><center>PRAZO</center></th>
      <th><center>RECORRENTE 2</center></th>
      <th><center>% RECORRENTE 2</center></th>
      <th><center>RECORRENTE 3</center></th>
      <th><center>% RECORRENTE 3</center></th>
      <th><center>REINCIDENCIA</center></th>
      <th><center>% REINCIDENCIA</center></th>
      <th><center>MIGRAÇÃO ODC</center></th>
      <th><center>% MIGRAÇÃO ODC</center></th>
    </tr>
  <tfoot>
</table>
