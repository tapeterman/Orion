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
      <th><center>CIDADE</center></th>
      <th><center>CONTRATO</center></th>
      <th><center>LOGIN</center></th>
      <th><center>OPERADOR</center></th>
      <th><center>SUPERVISOR</center></th>
      <th><center>CAMPANHA</center></th>
      <th><center>TOTAL</center></th>
      <th><center>QUANTIDADE</center></th>
    </tr>
  </thead>
  <tbody>
    <?php 
      set_time_limit(0);
      $sql = "SELECT DT_CANCELAMENTO AS 'DATA', OPERADORA AS 'CIDADE',
              NUM_CONTRATO AS 'CONTRATO', 
              LOGIN AS 'LOGIN',
              NOME AS 'OPERADOR', 
              SUPERVISOR AS 'SUPERVISOR',
              CAMPANHA AS 'CAMPANHA', 
              TOTAL AS 'TOTAL',
              QTD AS 'QUANTIDADE'
              FROM tb_cancelamento_operador
              where `NOME` = '".$Nome."'";
      $resultado = mysqlI_query($link, $sql);
      if(!$resultado) 
        echo 'ERRO';
      else{
        $numero_registros = mysqlI_num_rows($resultado);
        while($registro = mysqlI_fetch_array($resultado)){
    ?> 
          <tr>
            <td><center><?php echo $registro['DATA'];?></center></td>
            <td><center><?php echo $registro['CIDADE'];?></center></td>
            <td><center><?php echo $registro['CONTRATO'];?></center></td>
            <td><center><?php echo $registro['LOGIN'];?></center></td>
            <td><center><?php echo $registro['OPERADOR'];?></center></td>
            <td><center><?php echo $registro['SUPERVISOR'];?></center></td>
            <td><center><?php echo $registro['CAMPANHA'];?></center></td>
            <td><center><?php echo $registro['TOTAL'];?></center></td>
            <td><center><?php echo $registro['QUANTIDADE'];?></center></td>
          </tr>
    <?php }};?> 
    <tfoot>
      <tr>
        <th><center>DATA</center></th>
        <th><center>CIDADE</center></th>
        <th><center>CONTRATO</center></th>
        <th><center>LOGIN</center></th>
        <th><center>OPERADOR</center></th>
        <th><center>SUPERVISOR</center></th>
        <th><center>CAMPANHA</center></th>
        <th><center>TOTAL</center></th>
        <th><center>QUANTIDADE</center></th>
      </tr>
    <tfoot>
  </tbody>
</table>