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
<?php
  $indicador = $_GET['indicador'];
  set_time_limit(0);
      $sql = "SELECT TEXTO
            from tb_ajuda_indicadores
            where INDICADOR = '" .$indicador. "'";
      $resultado = mysqlI_query($link, $sql);

      if(!$resultado)
          echo 'ERRO';
      else{
          $numero_registros = mysqlI_num_rows($resultado);
          while($registro = mysqlI_fetch_array($resultado)){
            echo $registro['TEXTO'];
  ?>
  <?php }}?>