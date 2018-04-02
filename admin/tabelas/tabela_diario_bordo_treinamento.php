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
    data,hora,nome_cadastro,solicitante,autorizacao,motivo
    <tr>
      <th><center>DATA</center></th>
      <th><center>HORA</center></th>
      <th><center>NOME CADASTRO</center></th>
      <th><center>SOLICITANTE</center></th>
      <th><center>AUTORIZAÇÃO</center></th>
      <th><center>MOTIVO</center></th>
    </tr>
  </thead>
  <tbody> 
    <?php 
      set_time_limit(0);
      $mes = $_GET['mes'];
        $sql = "SELECT * FROM tb_diario_bordo_treinamento
                where date_format(STR_TO_DATE(data, '%d/%m/%Y'),'%m-%Y') = '".$mes."'";
        $resultado = mysqlI_query($link, $sql);
      if(!$resultado)
        echo 'ERRO';
      else{
        $numero_registros = mysqlI_num_rows($resultado);
        while($registro = mysqlI_fetch_array($resultado)){  
    ?> 
      <tr>
        <td scope="row"><center><?php echo $registro['data'];?></center></td>
        <td><center><?php echo $registro['hora'];?></center></td>
        <td><center><?php echo $registro['nome_cadastro'];?></center></td>
        <td><center><?php echo $registro['solicitante'];?></center></td>
        <td><center><?php echo $registro['autorizacao'];?></center></td>
        <td><center><?php echo $registro['motivo'];?></center></td>
     </tr>
    <?php } }?> 
     </tbody>
</table>
