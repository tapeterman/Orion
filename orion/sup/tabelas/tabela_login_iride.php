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
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th><center>DIA</center></th>
      <th><center>NOME</center></th>
      <th><center>SUPERVISOR</center></th>
      <th><center>LOGIN IRIDE</center></th>
      <th><center>LOGIN PONTO</center></th>
      <th><center>DIFERENÇA</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
      set_time_limit(0);
      if($_GET['data']=='Data')
        $data=date('d/m/Y');
      else
        $data=$_GET['data'];
      if($_GET['supervisor']=='TODOS'){
        $sql = "SELECT date_format(str_to_date(`DIA`, '%d/%m/%Y'), '%d/%m/%Y') as DIA , 
               `NOME`, SUPERIOR, LOGIN_IRIDE, LOGIN_PONTO, DIFERENCA 
               FROM `tb_login_iride_ponto` 
               WHERE DIA = '".$data."' 
               AND LOGIN_PONTO <>'-' 
               ORDER BY SUPERIOR, `DIA` ";
        $resultado = mysqlI_query($link, $sql);
      }
      else{
        $supervisor=$_GET['supervisor'];
        $sql = "SELECT date_format(str_to_date(`DIA`, '%d/%m/%Y'), '%d/%m/%Y') as DIA , 
               `NOME`, SUPERIOR, LOGIN_IRIDE, LOGIN_PONTO, DIFERENCA 
               FROM `tb_login_iride_ponto` 
               WHERE DIA = '".$data."' 
               AND SUPERIOR = '".$supervisor."' 
               AND LOGIN_PONTO <>'-' 
               ORDER BY SUPERIOR, `DIA` ";
        $resultado = mysqlI_query($link, $sql);
      }
      if(!$resultado)
        echo 'ERRO';
      else {
        $numero_registros = mysqlI_num_rows($resultado);
        while($registro = mysqlI_fetch_array($resultado))
      {  
      ?> 
      <tr>
        <td scope="row"><center><?php echo $registro['DIA'];?></center></td>
        <td><center><?php echo $registro['NOME'];?></center></td>
        <td><center><?php echo $registro['SUPERIOR'];?></center></td>
        <td><center><?php echo $registro['LOGIN_IRIDE'];?></center></td>
        <td><center><?php echo $registro['LOGIN_PONTO'];?></center></td>
        <td><center><?php echo $registro['DIFERENCA'];?></center></td>
      </tr>
    <?php } }?>          
  </tbody>
</table>