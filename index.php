<?php
  $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orion | Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script>
      $(document).ready( function(){
        $('#btn_login').click(function(){
          var campo_vazio = false;
          if($('#campo_usuario').val() == ''){
            $('#campo_usuario').css({'border-color': '#A94442'});
            campo_vazio = true;
          }
          else {
            $('#campo_usuario').css({'border-color': '#CCC'});
          }
          if($('#campo_senha').val() == ''){
            $('#campo_senha').css({'border-color': '#A94442'});
            campo_vazio = true;
          } 
          else {
            $('#campo_senha').css({'border-color': '#CCC'});
          }
          if(campo_vazio) return false;
        });
      });         
    </script>
  </head>
  <body class="gray-bg">
    <div class="middle-box text-center loginscreen animated fadeInDown">
      <div>
        <div>
          <h1 class="logo-name"><a><i class="fa fa-eye"></i></a></h1>
        </div>
        <h3>Bem vindo ao Orion</h3>
        <p>Ferramenta desenvolvida para auxiliar no acompanhamento diario</p>
        <p>Login in</p>
        <form class="m-t" role="form" method="post" action="validar_acesso.php">
          <div class="form-group" >
            <input ype="text" class="form-control" placeholder="Usuario" name="usuario" id="campo_usuario">
          </div>
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Senha" name="senha" id="campo_senha" >
          </div>
          <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
        </form>
        <?php
          if($erro == 1){
            echo '<div class="alert alert-danger">
            Usuário e ou senha inválido(s)!
            </div>';
          }
        ?>
        <p class="m-t"> <small>Projeto Orion &copy; 2017</small> </p>
      </div>
    </div>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
