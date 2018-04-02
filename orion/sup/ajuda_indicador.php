<?php
    require('restrito.php');
    require_once('../db.class.php');
    $objDb = new db();
    $link = $objDb->conecta_mysql();
    set_time_limit(0);
    $Almope = $_SESSION['Almope'];
    $Login = $_SESSION['Login'];
    $Nome = $_SESSION['Nome'];
    $nome = $_SESSION['Primeiro_nome'];
    if($_SESSION['Permissao']==3)
        $permissao = 'Adminisrador';
    elseif ($_SESSION['Permissao']==2)
        $permissao = 'Supervisor';
    else
        $permissao = 'Operador';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orion | Abertos</title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="../css/plugins/dataTables/datatables.min.css" rel="stylesheet">
        <link href="../css/animate.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
    </head>
    <body>
        <?php include('header.php');?>
        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-12">
                <h2>Como Melhorar Meu Indicador</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Guias</a></li>
                    <li class="active"><strong>Dicas Indicadores</strong></li>
                </ol>
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox full-height-scroll">
                        <div class="fh-breadcrumb">
                            <div class="fh-column">
                                <div class="full-height-scroll">
                                    <ul class="list-group elements-list">
                                        <?php set_time_limit(0);
                                            $sql = "SELECT INDICADOR, INDICE FROM tb_ajuda_indicadores ";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado)){
                                        ?>
                                            <li class="list-group-item">        
                                                <a data-toggle="tab" href="#<?php echo $registro['INDICE'];?>">
                                                    <strong><?php echo $registro['INDICADOR'];?></strong>
                                                    <div class="small m-t-xs"></div>
                                                </a>
                                            </li>
                                        <?php } }?>
                                    </ul>
                                </div>
                            </div>
                            <div class="full-height">
                                <div class="full-height-scroll white-bg border-left">
                                    <div class="element-detail-box">
                                        <div class="tab-content">
                                            <?php set_time_limit(0);
                                                $sql = "SELECT INDICE, TEXTO FROM tb_ajuda_indicadores";
                                                $resultado = mysqlI_query($link, $sql);
                                                if(!$resultado)
                                                    echo 'ERRO';
                                                else{
                                                    $numero_registros = mysqlI_num_rows($resultado);
                                                    while($registro = mysqlI_fetch_array($resultado)){
                                            ?>
                                                <div id="<?php echo $registro['INDICE'];?>" class="tab-pane">
                                                     <?php echo $registro['TEXTO'];?>
                                                </div>
                                            <?php } }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php') ;?>
        </div>
        </div>
        <script src="../js/jquery-3.1.1.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
        <script src="../js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
        <script src="../js/plugins/dataTables/datatables.min.js"></script>
        <script src="../js/inspinia.js"></script>
        <script src="../js/plugins/pace/pace.min.js"></script>
        <script>
            $(document).ready(function(){
                $('.dataTables-example').DataTable({
                });
            });
        </script>
    </body>
</html>