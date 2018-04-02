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
      <th><center>ALMOPE</center></th>
      <th><center>NOME</center></th>
      <th><center>SUPERVISOR</center></th>
      <th><center>SKILL</center></th>
      <th><center>LOGADO</center></th>
      <th><center>TURNO_OPERADOR</center></th>
      <th><center>MOTIVO</center></th>
      <th><center>CARGA_HORARIA</center></th>
      <th><center>HORARIO_DA_LABORAL</center></th>
      <th><center>DATA_PROGRAMADA</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
      set_time_limit(0);
          $supervisor=$_GET['supervisor'];
          $assunto=$_GET['assunto'];
          $sql = "SELECT A.ASSUNTO, A.CARGA_HORARIA, A.TURNO_OPERADOR, A.HORARIO_DA_LABORAL, 
                  A.DATA_PROGRAMADA, A.ALMOPE, A.NOME, A.SUPERVISOR, A.SKILL, A.MOTIVO, 
                  IF(B.LOGIN_PONTO <> '-','LOGADO','DESLOGADO') as LOGADO
                  from tb_escala_treinamento AS A
                  LEFT JOIN tb_login_iride_ponto AS B ON A.NOME = B.NOME AND STR_TO_DATE(DIA, '%d/%m/%Y')= CURDATE()
                  where assunto = '".$assunto."'
                  and (supervisor = '".$supervisor."' or '".$supervisor."' = 'TODOS')
                  AND DATA_REALIZADA = '0000-00-00'";
            $resultado = mysqlI_query($link, $sql);
          if(!$resultado)
            echo 'ERRO';
          else{
            $numero_registros = mysqlI_num_rows($resultado);
            while($registro = mysqlI_fetch_array($resultado)){
    ?>
            <tr>
              <td><center><?php echo $registro['ALMOPE'];?></center></td>
              <td><center><?php echo $registro['NOME'];?></center></td>
              <td><center><?php echo $registro['SUPERVISOR'];?></center></td>
              <td><center><?php echo $registro['SKILL'];?></center></td>
              <td><center><?php echo $registro['LOGADO'];?></center></td>
              <td><center><?php echo $registro['TURNO_OPERADOR'];?></center></td>
              <td><center><?php echo $registro['MOTIVO'];?></center></td>
              <td><center><?php echo $registro['CARGA_HORARIA'];?></center></td>
              <td><center><?php echo $registro['HORARIO_DA_LABORAL'];?></center></td>
              <td><center><?php echo $registro['DATA_PROGRAMADA'];?></center></td>
              </td>
            </tr>
          <?php }}?>
            <tfoot>
              <tr>
                <th><center>ALMOPE</center></th>
                <th><center>NOME</center></th>
                <th><center>SUPERVISOR</center></th>
                <th><center>SKILL</center></th>
                <th><center>LOGADO</center></th>
                <th><center>TURNO_OPERADOR</center></th>
                <th><center>MOTIVO</center></th>
                <th><center>CARGA_HORARIA</center></th>
                <th><center>HORARIO_DA_LABORAL</center></th>
                <th><center>DATA_PROGRAMADA</center></th>
              </tr>
            <tfoot>
  </tbody>
</table>