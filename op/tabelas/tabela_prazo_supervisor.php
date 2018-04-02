<?php
  session_start();
  require_once('../../db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $Almope = $_SESSION['Almope'];
  $Login = $_SESSION['Login'];
  $Nome = $_SESSION['Nome'];
  $permissao = $_SESSION['Permissao'];
?>
<table class="table table-striped table-bordered table-hover dataTables-example" >
  <thead>
    <tr>
      <th><center>OPERADOR</center></th>
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
      if($_GET['data']=='Data')
        $data=date('d/m/Y');
      else
        $data=$_GET['data'];
        $sql = "SELECT 
              `NOME`, 
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
              where DATE_FORMAT(`VENCIMENTO`, '%d/%m/%Y') = '".$data."' 
              and NOME = '".$Nome."'
              group by `NOME` order by RECEBIDO DESC ";
        $resultado = mysqlI_query($link, $sql);
        if(!$resultado)
          echo 'ERRO';
        else{
          $numero_registros = mysqlI_num_rows($resultado);
          while($registro = mysqlI_fetch_array($resultado)){  
    ?> 
          <tr>
            <td scope="row"><center><?php echo $registro['NOME'];?></center></td>
            <td><center><?php echo $registro['RECEBIDO'];?></center></td>
            <td><center><?php echo $registro['RDP'];?></center></td>
            <td><center><?php echo $registro['RFP'];?></center></td>
            <td><center><?php echo $registro['ADP'];?></center></td>
            <td><center><?php echo $registro['AFP'];?></center></td>
            <td><center><?php echo round($registro['PERDA'],2);?>%</center></td>
            <td class=<?php 
              if($registro['PRAZO']>95) echo'"text-navy"'; 
              else echo '"text-warning"';?>> <i class=<?php 
              if($registro['PRAZO']>95) echo'"fa fa-level-up"'; 
              else echo '"fa fa-level-down"';?>></i>
                <strong><?php echo round($registro['PRAZO'],2);?>%</strong></td>
            <td><center><?php echo round($registro['FINALIZADOS'],2);?>%</center></td>
            <td><center><?php echo round($registro['OPORTUNIDADE'],2);?>%</center></td>      
          </tr>
    <?php } }?>          
  </tbody>
</table>