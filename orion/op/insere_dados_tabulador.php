<?php
  session_start();
  require_once('../db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();

  $Almope = $_SESSION['Almope'];
  $IdManifestacao =  $_POST['IdManifestacao'];
  $CpfCnpj =  $_POST['CpfCnpj'];
  $Contrato =  $_POST['Contrato'];
  $Oportunidade =  $_POST['Oportunidade'];
  $Observacao= $_POST['Observacao'];
  $Data = date('d/m/Y');
 
  set_time_limit(0);


  $sql = " INSERT INTO `tb_retroalimetacao`(`ALMOPE`, `IDMANIFESTACAO`, `CPFCNPJ`, `CONTRATO`, `OPORTUNIDADE`, `OBSERVACAO`, `DATA`) VALUES ('". $Almope ."','". $IdManifestacao ."','". $CpfCnpj ."','". $Contrato ."','". $Oportunidade ."','". $Observacao ."','". $Data ."') ";
                  
    $resultado = mysqlI_query($link, $sql);
    if(!$resultado)
      echo 'ERRO';
    else{
      header("Location: tabulador.php?exito=1");
      exit;
    }
?>               
                    