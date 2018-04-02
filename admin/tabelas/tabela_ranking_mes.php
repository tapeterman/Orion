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
?>
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
              WHERE MONTH(DH_ABERTURA) = '".$mes."'
              AND (CAMPANHA_RESPONSAVEL = '".$campanha."' OR '".$campanha."' = 'TODOS')
              AND VALIDO = 1
              AND NOME_RESPONSAVEL <> 'OMB_IRIDE_JDF'
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
