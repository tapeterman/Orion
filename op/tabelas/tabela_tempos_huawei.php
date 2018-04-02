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
<table class="table table-striped table-bordered table-hover dataTables-example">
  <thead>
    <tr>
      <th><center>DATA</center></th>
      <th><center>ATENDIDAS</center></th>
      <th><center>TMT</center></th>
      <th><center>LOGADO</center></th>
      <th><center>DISPONIVEL</center></th>
      <th><center>ACW</center></th>
      <th><center>PAUSA TOTAL</center></th>
      <th><center>PAUSA 20</center></th>
      <th><center>PARTICULAR</center></th>
      <th><center>PAUSA 10</center></th>
      <th><center>TREINAMENTO</center></th>
      <th><center>FEEDBACK</center></th>
      <th><center>SUPORTE</center></th>
      <th><center>SAUDE</center></th>
      <th><center>OUTROS</center></th>
      <th><center>SISTEM</center></th>
      <th><center>SHORTCALL</center></th>
      <th><center>CHAMADAS_REALIZADAS</center></th>
      <th><center>FALADO</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
      set_time_limit(0);
            $sql = "SELECT DIA, ATENDIDAS, TMT, SEC_TO_TIME(LOGADO) as LOGADO, SEC_TO_TIME(DISPONIVEL) AS DISPONIVEL, 
                           SEC_TO_TIME(ACW) AS ACW, SEC_TO_TIME(PAUSA_TOTAL) AS PAUSA_TOTAL, SEC_TO_TIME(INTERVALO_1) AS INTERVALO_1, 
                           SEC_TO_TIME(PARTICULAR) AS PARTICULAR, 
                           SEC_TO_TIME(INTERVALO_2) AS INTERVALO_2, SEC_TO_TIME(TREINAMENTO) AS TREINAMENTO, 
                           SEC_TO_TIME(FEEDBACK) AS FEEDBACK, SEC_TO_TIME(SUPORTE) AS SUPORTE, 
                           SEC_TO_TIME(SAUDE) AS SAUDE, SEC_TO_TIME(OUTROS) AS OUTROS, SEC_TO_TIME(SISTEM) AS SISTEM, SHORTCALL, 
                           CHAMADAS_REALIZADAS, SEC_TO_TIME(FALADO) AS FALADO
                           FROM tb_tempos_huawei
                           WHERE nome = '".$Nome."'
                           ORDER BY str_to_date(`DIA`, '%d/%m/%Y') desc";
            $resultado = mysqlI_query($link, $sql);
          if(!$resultado)
            echo 'ERRO';
          else{
            $numero_registros = mysqlI_num_rows($resultado);
            while($registro = mysqlI_fetch_array($resultado)){
    ?> 
            <tr>
              <td><center><?php echo $registro['DIA'];?></center></td>
              <td><center><?php echo $registro['ATENDIDAS'];?></center></td>
              <td><center><?php echo $registro['TMT'];?></center></td>
              <td><center><?php echo $registro['LOGADO'];?></center></td>
              <td><center><?php echo $registro['DISPONIVEL'];?></center></td>
              <td><center><?php echo $registro['ACW'];?></center></td>
              <td><center><?php echo $registro['PAUSA_TOTAL'];?></center></td>
              <td><center><?php echo $registro['INTERVALO_1'];?></center></td>
              <td><center><?php echo $registro['PARTICULAR'];?></center></td>
              <td><center><?php echo $registro['INTERVALO_2'];?></center></td>
              <td><center><?php echo $registro['TREINAMENTO'];?></center></td>
              <td><center><?php echo $registro['FEEDBACK'];?></center></td>
              <td><center><?php echo $registro['SUPORTE'];?></center></td>
              <td><center><?php echo $registro['SAUDE'];?></center></td>
              <td><center><?php echo $registro['OUTROS'];?></center></td>
              <td><center><?php echo $registro['SISTEM'];?></center></td>
              <td><center><?php echo $registro['SHORTCALL'];?></center></td>
              <td><center><?php echo $registro['CHAMADAS_REALIZADAS'];?></center></td>
              <td><center><?php echo $registro['FALADO'];?></center></td>
            </tr>
          <?php }}?>
            <tfoot>
              <tr>
                <th><center>DATA</center></th>
                <th><center>ATENDIDAS</center></th>
                <th><center>TMT</center></th>
                <th><center>LOGADO</center></th>
                <th><center>DISPONIVEL</center></th>
                <th><center>ACW</center></th>
                <th><center>PAUSA TOTAL</center></th>
                <th><center>PAUSA 20</center></th>
                <th><center>PARTICULAR</center></th>
                <th><center>PAUSA 10</center></th>
                <th><center>TREINAMENTO</center></th>
                <th><center>FEEDBACK</center></th>
                <th><center>SUPORTE</center></th>
                <th><center>SAUDE</center></th>
                <th><center>OUTROS</center></th>
                <th><center>SISTEM</center></th>
                <th><center>SHORTCALL</center></th>
                <th><center>CHAMADAS_REALIZADAS</center></th>
                <th><center>FALADO</center></th>
              </tr>
            <tfoot>
  </tbody>
</table>