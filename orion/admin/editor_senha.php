<?php
  session_start();
  require_once('../db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $Nome = $_SESSION['Nome'];
  $Login = $_SESSION['Login'];
  $Nova_senha =  md5($_POST['Senha']);

    set_time_limit(0);
    $sql = "UPDATE tb_login_portal 
            SET
            Senha ='".$Nova_senha."'
            WHERE Nome ='".$Nome."'
            AND Almope ='".$Login."'";
    $resultado = mysqlI_query($link, $sql);
    if(!$resultado)
      echo 'ERRO';
    else{
      header("Location: trocar_senha.php?exito=1");
      exit;
    }
?>