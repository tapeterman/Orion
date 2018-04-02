<?php
  session_start();
  require_once('../../db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $Almope = $_SESSION['Almope'];
  $Login = $_SESSION['Login'];
  $Nome = $_SESSION['Nome'];
  $permissao = $_SESSION['Permissao'];
  $date = date('d/m/Y');

  $FCR2= 0;
  $CADASTRADOS2= 0;
  $P_FCR2= 0;
  $RECORRENTE_1= 0;
  $RECORRENTE_2= 0;
  $P_REC_2 = 0;
  $RECORRENTE_3 = 0;
  $P_REC_3 = 0;
  $REINCIDENCIA = 0;
  $P_REINCIDENCIA = 0;
  $ODC = 0;
  $PODC = 0;
?>
<table class="table table-striped table-bordered table-hover dataTables-example">
  <thead>
    <tr>
      <th><center>DATA ABERTURA</center></th>
      <th><center>DATA MAXIMA</center></th>
      <th><center>FCR</center></th>
      <th><center>CADASTRADOS</center></th>
      <th><center>% FCR</center></th>
      <th><center>CLIENTE UNICO</center></th>
      <th><center>RECORRENTE 2</center></th>
      <th><center>% REC 2</center></th>
      <th><center>RECORRENTE 3</center></th>
      <th><center>% REC 3</center></th>
      <th><center>REINCIDENCIA</center></th>
      <th><center>% REINCIDENCIA</center></th>
      <th><center>ODC</center></th>
      <th><center>% ODC</center></th>
    </tr>
  </thead>
  <tbody> <?php set_time_limit(0);
    $mes = $_GET['mes'];
    $supervisor = $_GET['supervisor'];
      $sql = "SELECT
              DATE_FORMAT(DH_ABERTURA, '%d/%m/%Y') as DATA_ABERTURA,
              MIN(DATE_FORMAT(DH_MAXIMA, '%d/%m/%Y')) as DATA_MAXIMA,
              A.FCR2 AS FCR2,
              A.CADASTRADOS2 AS CADASTRADOS2,
              A.P_FCR2*100 AS P_FCR2,
              SUM(CONTRATO_UNICO) AS RECORRENTE_1,
              SUM(CASE WHEN RECORRENTE=2 THEN 1 ELSE 0 END) AS RECORRENTE_2,
              SUM(CASE WHEN RECORRENTE=2 THEN 1 ELSE 0 END)/ SUM(CONTRATO_UNICO)*100 AS P_REC_2,
              SUM(CASE WHEN RECORRENTE=3 THEN 1 ELSE 0 END) AS RECORRENTE_3,
              SUM(CASE WHEN RECORRENTE=3 THEN 1 ELSE 0 END)/ SUM(CONTRATO_UNICO)*100 AS P_REC_3,
              SUM(REINCIDENCIA) AS REINCIDENCIA,
              SUM(REINCIDENCIA)/ SUM(CASE WHEN `DS_FORMA_CONTATO` NOT IN ('BKO') THEN 1 ELSE 0 END)* 100 AS P_REINCIDENCIA,
              SUM(ODC) AS ODC,
              SUM(ODC)/ SUM(CONTRATO_UNICO)*100 AS PODC
              from `tb_indicadores_historico`
              LEFT JOIN (
                  SELECT DATE_FORMAT(DH_ABERTURA, '%d/%m/%Y') as DATA_ABERTURA,
                  SUM(FCR) AS FCR2, 
                  SUM(CADASTRO_0800) AS CADASTRADOS2, 
                  SUM(FCR)/SUM(CADASTRO_0800) AS P_FCR2
                  from `tb_indicadores_historico`
                  where MONTH(DH_ABERTURA) = '".$mes."'
                  and (SUPERVISOR_CADASTRO = '".$supervisor."' OR '".$supervisor."' = 'TODOS')
                  group by DATE_FORMAT(DH_ABERTURA, '%d/%m/%Y')) AS A 
                  ON DATE_FORMAT(tb_indicadores_historico.DH_ABERTURA, '%d/%m/%Y') = A.DATA_ABERTURA
              where MONTH(DH_ABERTURA) = '".$mes."'
              and (SUPERVISOR_RESPONSAVEL = '".$supervisor."' OR '".$supervisor."' = 'TODOS')
              AND FCR = '1'
              group by DATE_FORMAT(DH_ABERTURA, '%d/%m/%Y')";
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
        <td><center><?php echo $registro['FCR2'];?></center></td>
        <td><center><?php echo $registro['CADASTRADOS2'];?></center></td>
        <td><center><?php echo round($registro['P_FCR2'],2);?>%</center></td>
        <td><center><?php echo $registro['RECORRENTE_1'];?></center></td>
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
        $FCR2=$FCR2+$registro['FCR2'];
        $CADASTRADOS2=$CADASTRADOS2+$registro['CADASTRADOS2'];
        $P_FCR2 = round(($FCR2 /$CADASTRADOS2)*100,2);
        $RECORRENTE_1=$RECORRENTE_1+$registro['RECORRENTE_1'];
        $RECORRENTE_2=$RECORRENTE_2+$registro['RECORRENTE_2'];
        $P_REC_2 = round(($RECORRENTE_2 /$RECORRENTE_1*100),2);
        $RECORRENTE_3 = $RECORRENTE_3 +  $registro['RECORRENTE_3'];
        $P_REC_3 = round(($RECORRENTE_3 /$RECORRENTE_1*100),2);
        $REINCIDENCIA = $REINCIDENCIA  + $registro['REINCIDENCIA'];
        $P_REINCIDENCIA = round(($REINCIDENCIA /$FCR2*100),2);
        $ODC = $ODC + $registro['ODC'];
        $PODC = round(($ODC /$RECORRENTE_1*100),2);
      }}?>
      <tr>       
          <td scope="row"><center><strong>TOTAL</strong></center></td>
          <td><center><strong>-</strong></center></td>
          <td><center><strong><?php echo $FCR2;?></strong></center></td>
          <td><center><strong><?php echo $CADASTRADOS2;?></strong></center></td>
          <td><center><strong><?php echo $P_FCR2;?>%</strong></center></td>
          <td><center><strong><?php echo $RECORRENTE_1;?></strong></center></td>
          <td><center><strong><?php echo $RECORRENTE_2;?></strong></center></td>
          <td><center><strong><?php echo $P_REC_2;?>%</strong></center></td>
          <td><center><strong><?php echo $RECORRENTE_3;?></strong></center></td>
          <td><center><strong><?php echo $P_REC_3;?>%</strong></center></td>
          <td><center><strong><?php echo $REINCIDENCIA;?></strong></center></td>
          <td><center><strong><?php echo $P_REINCIDENCIA;?>%</strong></center></td>
          <td><center><strong><?php echo $ODC;?></strong></center></td>
          <td><center><strong><?php echo $PODC;?>%</strong></center></td> 
      </tr>
    </tbody>
    <tfoot>
        <tr>
          <th><center>DATA ABERTURA</center></th>
          <th><center>DATA MAXIMA</center></th>
          <th><center>FCR</center></th>
          <th><center>CADASTRADOS</center></th>
          <th><center>% FCR</center></th>
          <th><center>CLIENTE UNICO</center></th>
          <th><center>RECORRENTE 2</center></th>
          <th><center>% REC 2</center></th>
          <th><center>RECORRENTE 3</center></th>
          <th><center>% REC 3</center></th>
          <th><center>REINCIDENCIA</center></th>
          <th><center>% REINCIDENCIA</center></th>
          <th><center>ODC</center></th>
          <th><center>% ODC</center></th>
        </tr>
    </tfoot>
</table>
