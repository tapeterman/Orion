<?php
  session_start();
  require_once('db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $Login = $_SESSION['Login'];
  $NumContrato=  $_POST['NumContrato'];
  $Cpf_Cnpj=  $_POST['Cpf_Cnpj'];
  $MotivoOcorrencia=  $_POST['MotivoOcorrencia'];
  $LoginOfensor=  $_POST['LoginOfensor'];
  $DataVenda=  $_POST['DataVenda'];
  $VlrReembolso=  round($_POST['VlrReembolso'],2);
  $QMeses=  $_POST['QMeses'];
  $TotalReembolso=  round($_POST['QMeses']*$_POST['VlrReembolso'],2);
  $CanalSolucao=  $_POST['CanalSolucao'];
  $Evidencia= $_POST['opcoesGravacaoes'];

if(!empty($_POST['NumContrato']) && 
    !empty($_POST['Cpf_Cnpj']) && 
      !empty($_POST['MotivoOcorrencia']) &&
        !empty($_POST['LoginOfensor']) &&
          !empty($_POST['DataVenda']) &&
            !empty($_POST['VlrReembolso']) &&
              !empty($_POST['QMeses']) &&
                !empty($_POST['CanalSolucao']) &&
                  !empty($_POST['opcoesGravacaoes'])
){
  set_time_limit(0);


   $sql = "INSERT into tb_lancamento_desconto 
            VALUES(
              '$NumContrato', 
              '$Cpf_Cnpj', 
              '$MotivoOcorrencia', 
              '$LoginOfensor', 
              '$DataVenda',
              '$VlrReembolso',
              '$QMeses', 
              '$TotalReembolso', 
              '$CanalSolucao', 
              '$Login', 
              curdate(), 
              '$Evidencia')";
    $resultado = mysqlI_query($link, $sql);
    if(!$resultado)
      echo $sql;
    else{
      header("Location: admin/home.php?exito=1");
      exit;}
}
?>
