<?php
	if (!isset($_SESSION)) session_start();
		$nivelpermissao = 2;
	if (!isset($_SESSION['Almope']) or ($_SESSION['Permissao'] < $nivelpermissao)) {
		session_destroy();
		header("Location: ../index.php"); exit;
	}