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
<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th><center>SUPERVISOR</center></th>
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
        if($_GET['data']=='Data')
          $data=date('d/m/Y');
        else
          $data=$_GET['data'];
          $sql = "SELECT SUPERVISOR, 
                  COUNT(*) AS 'TOTAL', 
                  SUM(CASE WHEN RECORRENTE = 'RECORRENTE 2' THEN 1 ELSE 0 END) AS 'RECORRENTE_2', 
                  SUM(CASE WHEN RECORRENTE = 'RECORRENTE 3' THEN 1 ELSE 0 END) AS 'RECORRENTE_3', 
                  SUM(CASE WHEN RECORRENTE = 'RECORRENTE 4' THEN 1 ELSE 0 END) AS 'RECORRENTE_4', 
                  SUM(CASE WHEN RECORRENTE = 'RECORRENTE 5' THEN 1 ELSE 0 END) AS 'RECORRENTE_5', 
                  SUM(CASE WHEN RECORRENTE not in ('RECORRENTE 2','RECORRENTE 3', 'RECORRENTE 4', 'RECORRENTE 5') THEN 1 ELSE 0 END) AS '>RECORRENTE_5' 
                  FROM `tb_portal_online` 
                  WHERE `EMPRESA` = 'ALMAVIVA' 
                  and `DS_FORMA_CONTATO`<>'BKO' 
                  and `RECORRENTE` IS NOT NULL 
                  and date_format(DT_VENCIMENTO, '%d/%m/%Y') = '".$data."' 
                  GROUP BY SUPERVISOR 
                  ORDER BY COUNT(*) DESC ";
          $resultado = mysqlI_query($link, $sql);
          if(!$resultado)
            echo 'ERRO';
          else{
            $numero_registros = mysqlI_num_rows($resultado);
            while($registro = mysqlI_fetch_array($resultado)){  
    ?> 
              <tr>
                <td><center><?php echo $registro['SUPERVISOR'];?></center></td>
                <td><center><?php echo $registro['TOTAL'];?></center></td>
                <td><center><?php echo $registro['RECORRENTE_2'];?></center></td>
                <td><center><?php echo $registro['RECORRENTE_3'];?></center></td>
                <td><center><?php echo $registro['RECORRENTE_4'];?></center></td>
                <td><center><?php echo $registro['RECORRENTE_5'];?></center></td>
                <td><center><?php echo $registro['>RECORRENTE_5'];?></center></td>
              </tr>
            <?php } }?>              
  </tbody>
</table>