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
            <div class="col-lg-10">
                <h2>Causa Ofensor</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Guias</a></li>
                    <li class="active"><strong>Causa Ofensor</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Causa Ofensor</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="row m-t-lg">
                            <div class="col-lg-12">
                                <div class="tabs-container ">
                                    <div class="tabs-left">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#tab-1">CANCELAMENTO</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-2">VENDAS</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-3">TECNICO</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-4">RELACIONAMENTO</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-5">PRODUTOS</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-6">POLITICA</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-7">PORTABILIDADE</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-8">FINANCEIRO</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-9">FRAUDE</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-10">REGULATÓRIO</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-11">REDE EXTERNA</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-12">TI</a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-13">CLASSE 900</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="tab-1" class="tab-pane active">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'CANCELAMENTO '
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>

                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-2" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'VENDAS/MUDANÇA DE PACOTE '
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-3" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'TÉCNICO '
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-4" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'RELACIONAMENTO '
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-5" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'PRODUTOS '
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-6" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE (MOTIVO_CAUSA = 'POLITICA ' OR MOTIVO_CAUSA = 'POLÍTICA ')
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-7" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'PORTABILIDADE'
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-8" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'FINANCEIRO'
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-9" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'FRAUDE'
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-10" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'REGULATÓRIO'
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado)
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-11" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'REDE EXTERNA'
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado) 
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-12" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'TI'
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado) 
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="tab-13" class="tab-pane">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                            <thead>
                                                                <tr>
                                                                    <th><center>CAUSA</center></th>
                                                                    <th><center>QUANDO USAR</center></th>
                                                                    <th><center>SOLUCAO</center></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php set_time_limit(0);
                                                                    $sql = "SELECT CAUSA, QUANDO_USAR, SOLUCAO
                                                                            FROM tb_causa_ofensor
                                                                            WHERE MOTIVO_CAUSA = 'CLASSE 900 ERRO DE ABERTURA/MIGRACAO'
                                                                            order by causa";
                                                                    $resultado = mysqlI_query($link, $sql);
                                                                    if(!$resultado) 
                                                                        echo 'ERRO';
                                                                    else{
                                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                                        while($registro = mysqlI_fetch_array($resultado))
                                                                    {  
                                                                ?> 
                                                                <tr>
                                                                    <td scope="row"><center><?php echo $registro['CAUSA'];?></center></td>
                                                                    <td><center><?php echo $registro['QUANDO_USAR'];?></center></td>
                                                                    <td><center><?php echo $registro['SOLUCAO'];?></center></td>
                                                                </tr>
                                                                <?php }}?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php');?>
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
                    "language": {
                        "url": "js/traducao.js"
                        },
                });
            });
        </script>
    </body>
</html>