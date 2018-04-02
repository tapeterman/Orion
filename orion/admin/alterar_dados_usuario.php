<?php
  session_start();
  require_once('../db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $almope_usuario =  $_POST['Almope'];
  $login_usuario =  $_POST['Login'];
  $nome_usuario =  $_POST['Nome'];
  $supervisor_usuario =  $_POST['Supervisor'];
  $permissao_usuario =  $_POST['Permissao'];
  $primeiro_nome =  $_POST['Primeiro_nome'];
  $status_roteamento_usuario =  $_POST['Status_roteamento'];
  $equipe =  $_POST['Equipe'];
  $turno =  $_POST['Turno'];
  $status_usuario =  $_POST['Status'];
  $senha_usuario = md5($_POST['Senha']);
  set_time_limit(0);
                  
    $sql = "UPDATE tb_login_portal 
            SET 
            Almope ='".$almope_usuario ."', 
            Login ='".$login_usuario."', 
            Nome ='".$nome_usuario."', 
            Supervisor ='".$supervisor_usuario."', 
            Permissao ='".$permissao_usuario."', 
            Status_roteamento ='".$status_roteamento_usuario."', 
            Status ='".$status_usuario."',
            Primeiro_nome ='".$primeiro_nome."', 
            Turno ='".$turno."', 
            Equipe ='".$equipe."',
            Senha ='".$senha_usuario."'
            where Almope = '".$almope_usuario."'";
    $resultado = mysqlI_query($link, $sql);
    if(!$resultado)
      echo 'ERRO';
    else{
      header("Location: usuarios_cadastrados.php?exito=1");
      exit;
    }
?>               
                    