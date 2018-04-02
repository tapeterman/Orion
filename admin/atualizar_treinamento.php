<?php
  session_start();
  require_once('../db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $Almope =  $_GET['almope'];
  $Assunto =  $_GET['assunto'];
  $Status= $_GET['status'];
  $Login = $_SESSION['Login'];
  $Cpf = $_SESSION['Login'];
  $Nome = $_SESSION['Nome'];
  set_time_limit(0);
    $sql = "UPDATE tb_escala_treinamento 
              SET 
              DATA_REALIZADA = CURDATE(), 
              STATUS = '".$Status."',
              T_INSTRUTOR ='".$Login."',
              CPF_INSTRUTOR ='".$Login."',
              NOME_INSTRUTOR ='".$Nome."'
              where ASSUNTO = '".$Assunto."'
              and ALMOPE = '".$Almope."'
              and DATE_FORMAT(MES_REFERENCIA,'%m/%Y') = DATE_FORMAT(CURDATE(),'%m/%Y')";
    $resultado = mysqlI_query($link, $sql);
    if(!$resultado)
      echo 'ERRO';
    else{
      header("Location: escala_treinamento.php?Assunto2=".$Assunto);
      exit;
    }
?>