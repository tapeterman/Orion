<?php
	session_start();
	require_once('db.class.php');
	$usuario = $_POST['usuario'];
	$senha = ($_POST['senha']);
	$senha1 = md5($_POST['senha']);
	$sql = " SELECT Almope, Login, Nome, Supervisor, Primeiro_nome, Permissao, Senha, Status_roteamento, Status 
			FROM `tb_login_portal` 
			WHERE Almope = '".$usuario."' 
			AND (Senha = '".$senha."' or Senha = '".$senha1."') " ;
	$objDb = new db();
	$link = $objDb->conecta_mysql();
	$resultado_id = mysqli_query($link, $sql);
	if($resultado_id){
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if(isset($dados_usuario['Almope'])){
			$_SESSION['Almope'] = $dados_usuario['Almope'];
			$_SESSION['Login'] = $dados_usuario['Login'];
			$_SESSION['Nome'] = $dados_usuario['Nome'];
			$_SESSION['Supervisor'] = $dados_usuario['Supervisor'];
			$_SESSION['Primeiro_nome'] = $dados_usuario['Primeiro_nome'];
			$_SESSION['Permissao'] = $dados_usuario['Permissao'];
			$_SESSION['Senha'] = $dados_usuario['Senha'];
			$_SESSION['Status_roteamento'] = $dados_usuario['Status_roteamento'];
			$_SESSION['Status'] = $dados_usuario['Status'];
			if($_SESSION['Permissao'] == 3 )
				header('Location: admin/home.php');
			elseif ($_SESSION['Permissao'] == 2 )
				header('Location: sup/home.php');
			else 
				header('Location: op/home.php');
		} 
		else {
			header('Location: index.php?erro=1');
		}
	}
	else {
		echo 'Erro na execução da consulta, favor entrar em contato com o admin do site';
	}
?>