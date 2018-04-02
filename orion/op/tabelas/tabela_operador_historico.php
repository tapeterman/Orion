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
      <th><center>DATA ABERTURA</center></th>
      <th><center>CADASTRADAS</center></th>
      <th><center>FCR</center></th>
      <th><center>% FCR</center></th>
      <th><center>RECEBIDOS</center></th>
      <th><center>CLIENTE ÚNICO</center></th>
      <th><center>RECORRENTE 2</center></th>
      <th><center>% RECORRENTE 2</center></th>
      <th><center>RECORRENTE 3</center></th>
      <th><center>% RECORRENTE 3</center></th>
      <th><center>REINCIDENCIA</center></th>
      <th><center>% REINCIDENCIA</center></th>
      <th><center>ODC</center></th>
      <th><center>%ODC</center></th>
      <th><center>MEDIA DIAS MIGRAÇÃO ODC</center></th>
      <th><center>MEDIA EM HORAS START</center></th>
      <th><center>RESOLVIDO COM CONTATO</center></th>
      <th><center>% RESOLVIDO COM CONTATO</center></th>
      <th><center>RESOLVIDO SEM CONTATO</center></th>
      <th><center>% RESOLVIDO SEM CONTATO</center></th>
      <th><center>RESOLVIDOS DENTRO DO PRAZO</center></th>
      <th><center>RESOLVIDOS FORA DO PRAZO</center></th>
      <th><center>PRAZO</center></th>
      <th><center>ABERTAS DENTRO DO PRAZO</center></th>
      <th><center>OPORTUNIDADE PRAZO</center></th>
    </tr>
  </thead>
  <tbody> 
    <?php 
      set_time_limit(0);
      $mes = $_GET['mes'];
        $sql = "SELECT DISTINCT date_format(A.dh_abertura, '%d/%m/%Y') AS DATA_ABERTURA, C.ABERTAS, C.FCR, 
                C.P_FCR, B.RECEBIDOS, B.CLIENTE_UNICO, B.RECORRENTE_2, B.P_RECORRENTE_2, B.RECORRENTE_3, 
                B.P_RECORRENTE_3, B.REINCIDENCIA, B.P_REINCIDENCIA, B.ODC, B.P_ODC, B.MEDIA_ODC, 
                B.MEDIA_START, B.RESOLVIDO_COM_CONTATO, B.P_RESOLVIDO_COM_CONTATO, B.RESOLVIDO_SEM_CONTATO, 
                B.P_RESOLVIDO_SEM_CONTATO, B.DENTRO_DO_PRAZO, B.FORA_DO_PRAZO, B.PRAZO, B.ABERTO_DENTRO_DO_PRAZO, 
                B.P_OPORTUNIDADE  
                FROM tb_indicadores_historico AS A
                LEFT JOIN 
                (SELECT date_format(dh_abertura, '%d/%m/%Y') as 'DATA_ABERTURA',
                SUM(VALIDO) AS RECEBIDOS,
                SUM(CONTRATO_UNICO) AS CLIENTE_UNICO,
                SUM(CASE WHEN RECORRENTE=2 THEN 1 ELSE 0 END) AS RECORRENTE_2,
                SUM(CASE WHEN RECORRENTE=2 THEN 1 ELSE 0 END)/SUM(CONTRATO_UNICO)*100 P_RECORRENTE_2,
                SUM(CASE WHEN RECORRENTE=3 THEN 1 ELSE 0 END) AS RECORRENTE_3,
                SUM(CASE WHEN RECORRENTE=3 THEN 1 ELSE 0 END)/SUM(CONTRATO_UNICO)*100 P_RECORRENTE_3,
                SUM(REINCIDENCIA) AS REINCIDENCIA,
                SUM(REINCIDENCIA)/SUM(VALIDO)*100 AS P_REINCIDENCIA,
                SUM(ODC) AS ODC,
                SUM(ODC)/SUM(CONTRATO_UNICO)*100 AS P_ODC,
                AVG(TEMPO_ODC) AS MEDIA_ODC,
                AVG(TEMPO_START) AS MEDIA_START,
                SUM(CASE WHEN FORMA_CONTATO='COM CONTATO' THEN 1 ELSE 0 END) AS RESOLVIDO_COM_CONTATO,
                SUM(CASE WHEN FORMA_CONTATO='COM CONTATO' THEN 1 ELSE 0 END)/SUM(CASE WHEN FORMA_CONTATO<>'' THEN 1 ELSE 0 END)*100 AS P_RESOLVIDO_COM_CONTATO,
                SUM(CASE WHEN FORMA_CONTATO='SEM CONTATO' THEN 1 ELSE 0 END) AS RESOLVIDO_SEM_CONTATO,
                SUM(CASE WHEN FORMA_CONTATO='SEM CONTATO' THEN 1 ELSE 0 END)/SUM(CASE WHEN FORMA_CONTATO<>'' THEN 1 ELSE 0 END)*100 AS P_RESOLVIDO_SEM_CONTATO,
                SUM(CASE WHEN PRAZO='RDP' THEN 1 ELSE 0 END) AS DENTRO_DO_PRAZO,
                SUM(CASE WHEN PRAZO IN ('RFP','AFP') THEN 1 ELSE 0 END) AS FORA_DO_PRAZO,
                (SUM(CASE WHEN PRAZO='RDP' THEN 1 ELSE 0 END)/SUM(CASE WHEN PRAZO IN ('RFP','AFP','RDP') THEN 1 ELSE 0 END))*100 AS PRAZO,
                SUM(CASE WHEN PRAZO='ADP' THEN 1 ELSE 0 END) AS ABERTO_DENTRO_DO_PRAZO,
                (SUM(CASE WHEN PRAZO IN ('RDP','ADP') THEN 1 ELSE 0 END)/SUM(VALIDO))*100 AS P_OPORTUNIDADE
                FROM tb_indicadores_historico
                WHERE tb_indicadores_historico.NOME_RESPONSAVEL =  '" .$Nome. "'
                AND VALIDO = 1
                GROUP BY date_format(dh_abertura, '%d/%m/%Y')) AS B
                ON date_format(A.dh_abertura, '%d/%m/%Y') = B.DATA_ABERTURA
                LEFT JOIN
                (SELECT date_format(dh_abertura, '%d/%m/%Y') as 'DATA_ABERTURA',
                SUM(CADASTRO_0800) AS ABERTAS,
                SUM(FCR) AS FCR,
                SUM(FCR)/SUM(CADASTRO_0800)*100 AS P_FCR
                FROM `tb_indicadores_historico`
                WHERE tb_indicadores_historico.NOME_CADASTRO =  '" .$Nome. "'
                GROUP BY date_format(dh_abertura, '%d/%m/%Y')) AS C
                ON C.DATA_ABERTURA = date_format(A.dh_abertura, '%d/%m/%Y')
                WHERE MONTH(A.DH_ABERTURA) = '".$mes."'
                ORDER BY date_format(A.dh_abertura, '%d/%m/%Y') DESC;";
        $resultado = mysqlI_query($link, $sql);
      if(!$resultado)
        echo 'ERRO';
      else{
        $numero_registros = mysqlI_num_rows($resultado);
        while($registro = mysqlI_fetch_array($resultado)){  
    ?> 
      <tr>
        <td scope="row"><center><?php echo $registro['DATA_ABERTURA'];?></center></td>
        <td><center><?php echo $registro['ABERTAS'];?></center></td>
        <td><center><?php echo $registro['FCR'];?></center></td>
        <td class=<?php if($registro['P_FCR']>39) echo'"text-navy"'; else echo '"text-danger"';?>>
          <i class=<?php if($registro['P_FCR']>39) echo'"fa fa-level-up"'; 
            else echo '"fa fa-level-down"';?>>
          </i>
          <strong><?php echo round($registro['P_FCR'],2);?>%</strong>
        </td>
        <td><center><?php echo $registro['RECEBIDOS'];?></center></td>
        <td><center><?php echo $registro['CLIENTE_UNICO'];?></center></td>
        <td><center><?php echo $registro['RECORRENTE_2'];?></center></td>
        <td class=<?php if($registro['P_RECORRENTE_2']<9) echo'"text-navy"'; else echo '"text-danger"';?>>
          <i class=<?php if($registro['P_RECORRENTE_2']<9) echo'"fa fa-level-down"'; 
            else echo '"fa fa-level-up"';?>>

          <strong><?php echo round($registro['P_RECORRENTE_2'],2);?>%</strong>
        </td>
        <td><center><?php echo $registro['RECORRENTE_3'];?></center></td>
        <td class=<?php if($registro['P_RECORRENTE_3']<3) echo'"text-navy"'; else echo '"text-danger"';?>>
          <i class=<?php if($registro['P_RECORRENTE_3']<3) echo'"fa fa-level-down"'; 
            else echo '"fa fa-level-up"';?>>
          </i>
          <strong><?php echo round($registro['P_RECORRENTE_3'],2);?>%</strong>
        </td>
        <td><center><?php echo $registro['REINCIDENCIA'];?></center></td>
        <td class=<?php if($registro['P_REINCIDENCIA']<9) echo'"text-navy"'; else echo '"text-danger"';?>>
          <i class=<?php if($registro['P_REINCIDENCIA']<9) echo'"fa fa-level-down"'; 
            else echo '"fa fa-level-up"';?>>
          </i>
          <strong><?php echo round($registro['P_REINCIDENCIA'],2);?>%</strong>
        </td>
        <td><center><?php echo $registro['ODC'];?></center></td>
        <td class=<?php if($registro['P_ODC']<3) echo'"text-navy"'; else echo '"text-danger"';?>>
          <i class=<?php if($registro['P_ODC']<3) echo'"fa fa-level-down"'; 
            else echo '"fa fa-level-up"';?>>
          </i>
          <strong><?php echo round($registro['P_ODC'],2);?>%</strong>
        </td>
        <td><center><?php echo round($registro['MEDIA_ODC'],2);?></center></td>
        <td><center><?php echo round($registro['MEDIA_START'],2);?></center></td>
        <td><center><?php echo $registro['RESOLVIDO_COM_CONTATO'];?></center></td>
        <td class=<?php if($registro['P_RESOLVIDO_COM_CONTATO']>95) echo'"text-navy"'; else echo '"text-danger"';?>>
          <i class=<?php if($registro['P_RESOLVIDO_COM_CONTATO']>95) echo'"fa fa-level-up"'; 
            else echo '"fa fa-level-down"';?>>
          </i>
          <strong><?php echo round($registro['P_RESOLVIDO_COM_CONTATO'],2);?>%</strong>
        </td>
        <td><center><?php echo $registro['RESOLVIDO_SEM_CONTATO'];?></center></td>
        <td class=<?php if($registro['P_RESOLVIDO_SEM_CONTATO']<10) echo'"text-navy"'; else echo '"text-danger"';?>>
          <i class=<?php if($registro['P_RESOLVIDO_SEM_CONTATO']<10) echo'"fa fa-level-up"'; 
            else echo '"fa fa-level-down"';?>>
          </i>
          <strong><?php echo round($registro['P_RESOLVIDO_SEM_CONTATO'],2);?>%</strong>
        </td>
        <td><center><?php echo $registro['DENTRO_DO_PRAZO'];?></center></td>
        <td><center><?php echo $registro['FORA_DO_PRAZO'];?></center></td>
        <td class=<?php if($registro['PRAZO']>95) echo'"text-navy"'; else echo '"text-danger"';?>>
          <i class=<?php if($registro['PRAZO']>95) echo'"fa fa-level-up"'; 
            else echo '"fa fa-level-down"';?>>
          </i>
          <strong><?php echo round($registro['PRAZO'],2);?>%</strong>
        </td>
        <td><center><?php echo $registro['ABERTO_DENTRO_DO_PRAZO'];?></center></td>

        <td class=<?php if($registro['P_OPORTUNIDADE']>97) echo'"text-navy"'; else echo '"text-danger"';?>>
          <i class=<?php if($registro['P_OPORTUNIDADE']>97) echo'"fa fa-level-up"'; 
            else echo '"fa fa-level-down"';?>>
          </i>
          <strong><?php echo round($registro['P_OPORTUNIDADE'],2);?>%</strong>
        </td>
      </tr>
    <?php } }?> 
     </tbody>
</table>
