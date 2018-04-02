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
      <th><center>NM_CLIENTE</center></th>
      <th><center>CLASSIFICACAO</center></th>
      <th><center>MOTIVO</center></th>
      <th><center>DEPARA</center></th>
      <th><center>CPF_CNPJ</center></th>
      <th><center>DS_FORMA_CONTATO</center></th>
      <th><center>DH_ABERTURA</center></th>
      <th><center>LN_ABERTURA</center></th>
      <th><center>NOME_CADASTRO</center></th>
      <th><center>SUPERVISOR_CADASTRO</center></th>
      <th><center>CAMPANHA_CADASTRO</center></th>
      <th><center>CONTRATO</center></th>
      <th><center>DH_MAXIMA</center></th>
      <th><center>DH_RESOLUCAO</center></th>
      <th><center>VALIDO</center></th>
      <th><center>CADASTRO_0800</center></th>
      <th><center>FCR</center></th>
      <th><center>RECORRENTE</center></th>
      <th><center>REINCIDENCIA</center></th>
      <th><center>CONTRATO_UNICO</center></th>
      <th><center>ODC</center></th>
      <th><center>TEMPO_ODC</center></th>
      <th><center>TEMPO_START</center></th>
      <th><center>LOGIN_START</center></th>
      <th><center>LOGIN_RESPONSAVEL</center></th>
      <th><center>NOME_RESPONSAVEL</center></th>
      <th><center>SUPERVISOR_RESPONSAVEL</center></th>
      <th><center>CAMPANHA_RESPONSAVEL</center></th>
      <th><center>FORMA_CONTATO</center></th>
      <th><center>DS_CAUSA_PROBLEMA</center></th>
      <th><center>PRAZO</center></th>
    </tr>
  </thead>
  <tbody> 
    <?php
      $mes = $_GET['mes'];
      $supervisor = $_GET['supervisor'];
      set_time_limit(0);
          $sql = "SELECT *
                from tb_indicadores_historico
                where MONTH(DH_ABERTURA) = '".$mes."'
                and (SUPERVISOR_RESPONSAVEL = '".$supervisor."' OR SUPERVISOR_CADASTRO = '".$supervisor."' OR '".$supervisor."' = 'TODOS')";
        $resultado = mysqlI_query($link, $sql);
        if(!$resultado)
          echo 'ERRO';
        else{
          $numero_registros = mysqlI_num_rows($resultado);
          while($registro = mysqlI_fetch_array($resultado)){
    ?> 
      <tr>
        <td scope="row"><?php echo $registro['NM_CLIENTE'];?></center></td>
        <td><center><?php echo $registro['CLASSIFICACAO'];?></center></td>
        <td><center><?php echo $registro['MOTIVO'];?></center></td>
        <td><center><?php echo $registro['DEPARA'];?></center></td>
        <td><center><?php echo $registro['CPF_CNPJ'];?></center></td>
        <td><center><?php echo $registro['DS_FORMA_CONTATO'];?></center></td>
        <td><center><?php echo $registro['DH_ABERTURA'];?></center></td>
        <td><center><?php echo $registro['LN_ABERTURA'];?></center></td>
        <td><center><?php echo $registro['NOME_CADASTRO'];?></center></td>
        <td><center><?php echo $registro['SUPERVISOR_CADASTRO'];?></center></td>
        <td><center><?php echo $registro['CAMPANHA_CADASTRO'];?></center></td>
        <td><center><?php echo $registro['CONTRATO'];?></center></td>
        <td><center><?php echo $registro['DH_MAXIMA'];?></center></td>
        <td><center><?php echo $registro['DH_RESOLUCAO'];?></center></td>
        <td><center><?php echo $registro['VALIDO'];?></center></td>
        <td><center><?php echo $registro['CADASTRO_0800'];?></center></td>
        <td><center><?php echo $registro['FCR'];?></center></td>
        <td><center><?php echo $registro['RECORRENTE'];?></center></td>
        <td><center><?php echo $registro['REINCIDENCIA'];?></center></td>
        <td><center><?php echo $registro['CONTRATO_UNICO'];?></center></td>
        <td><center><?php echo $registro['ODC'];?></center></td>
        <td><center><?php echo $registro['TEMPO_ODC'];?></center></td>
        <td><center><?php echo $registro['TEMPO_START'];?></center></td>
        <td><center><?php echo $registro['LOGIN_START'];?></center></td>
        <td><center><?php echo $registro['LOGIN_RESPONSAVEL'];?></center></td>
        <td><center><?php echo $registro['NOME_RESPONSAVEL'];?></center></td>
        <td><center><?php echo $registro['SUPERVISOR_RESPONSAVEL'];?></center></td>
        <td><center><?php echo $registro['CAMPANHA_RESPONSAVEL'];?></center></td>
        <td><center><?php echo $registro['FORMA_CONTATO'];?></center></td>
        <td><center><?php echo $registro['DS_CAUSA_PROBLEMA'];?></center></td>
        <td><center><?php echo $registro['PRAZO'];?></center></td>
      </tr>
    <?php }}?>
  </tbody>
  <tfoot>
      <tr>
      <th><center>NM_CLIENTE</center></th>
      <th><center>CLASSIFICACAO</center></th>
      <th><center>MOTIVO</center></th>
      <th><center>DEPARA</center></th>
      <th><center>CPF_CNPJ</center></th>
      <th><center>DS_FORMA_CONTATO</center></th>
      <th><center>DH_ABERTURA</center></th>
      <th><center>LN_ABERTURA</center></th>
      <th><center>NOME_CADASTRO</center></th>
      <th><center>SUPERVISOR_CADASTRO</center></th>
      <th><center>CAMPANHA_CADASTRO</center></th>
      <th><center>CONTRATO</center></th>
      <th><center>DH_MAXIMA</center></th>
      <th><center>DH_RESOLUCAO</center></th>
      <th><center>VALIDO</center></th>
      <th><center>CADASTRO_0800</center></th>
      <th><center>FCR</center></th>
      <th><center>RECORRENTE</center></th>
      <th><center>REINCIDENCIA</center></th>
      <th><center>CONTRATO_UNICO</center></th>
      <th><center>ODC</center></th>
      <th><center>TEMPO_ODC</center></th>
      <th><center>TEMPO_START</center></th>
      <th><center>LOGIN_START</center></th>
      <th><center>LOGIN_RESPONSAVEL</center></th>
      <th><center>NOME_RESPONSAVEL</center></th>
      <th><center>SUPERVISOR_RESPONSAVEL</center></th>
      <th><center>CAMPANHA_RESPONSAVEL</center></th>
      <th><center>FORMA_CONTATO</center></th>
      <th><center>DS_CAUSA_PROBLEMA</center></th>
      <th><center>PRAZO</center></th>
      </tr>
  </tfoot>
</table>