<?php
  session_start();
  require_once('../db.class.php');
  $objDb = new db();
  $link = $objDb->conecta_mysql();
  $texto =  $_POST['texto'];
  $indicador =  $_POST['indicador'];
  $Nome =  $_SESSION['Nome'];

    set_time_limit(0);
    $sql = "UPDATE tb_ajuda_indicadores 
            SET
            DT_MODIFICACAO = NOW(),
            NOME ='".$Nome ."', 
            TEXTO ='".$texto."' 
            WHERE INDICADOR ='".$indicador."'";
    $resultado = mysqlI_query($link, $sql);
    if(!$resultado)
      echo 'ERRO';
    else{
      header("Location: editor_ajuda_indicadores.php?exito=1");
      exit;
    }
?>