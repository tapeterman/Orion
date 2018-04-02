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
      <th><center>DATA</center></th>
      <th><center>TIPO</center></th>
      <th><center>SISTEMA</center></th>
      <th><center>Nº CHAMADO</center></th>
      <th><center>HORA INICIO</center></th>
      <th><center>FRASEOLOGIA</center></th>
      <th><center>OBSERVAÇÃO</center></th>
    </tr>
  </thead>
  <tbody> 
    <?php 
      set_time_limit(0);
      $mes = $_GET['mes'];
        $sql = "SELECT * FROM tb_diario_bordo 
                where month(data) = '".$mes."'";
        $resultado = mysqlI_query($link, $sql);
      if(!$resultado)
        echo 'ERRO';
      else{
        $numero_registros = mysqlI_num_rows($resultado);
        while($registro = mysqlI_fetch_array($resultado)){  
    ?> 
      <tr>
        <td scope="row"><center><?php echo $registro['DATA'];?></center></td>
        <td><center><?php echo $registro['TIPO'];?></center></td>
        <td><center><?php echo $registro['SISTEMA'];?></center></td>
        <td><center><?php echo $registro['CHAMADO'];?></center></td>
        <td><center><?php echo $registro['HORA'];?></center></td>
        <td><center><?php echo $registro['FRASE'];?></center></td>
        <td><center><?php echo $registro['OBS'];?></center></td>       
      </tr>
    <?php } }?> 
     </tbody>
</table>
