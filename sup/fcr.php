<?php
    require('restrito.php');
    require_once('../db.class.php');
    set_time_limit(0);
    $objDb = new db();
    $link = $objDb->conecta_mysql();
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
        <title>Orion | FCR</title>
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
                <h2>Relatorios Online</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Relatorios Online</a></li>
                    <li class="active"><strong>FCR por Supervisor</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>FCR Online por supervisor/hora</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                    <thead>
                                        <tr>
                                            <th><center>SUPERVISOR</center></th>
                                            <th><center>Total</center></th>
                                            <th><center>8</center></th>
                                            <th><center>9</center></th>
                                            <th><center>10</center></th>
                                            <th><center>11</center></th>
                                            <th><center>12</center></th>
                                            <th><center>13</center></th>
                                            <th><center>14</center></th>
                                            <th><center>15</center></th>
                                            <th><center>16</center></th>
                                            <th><center>17</center></th>
                                            <th><center>18</center></th>
                                            <th><center>19</center></th>
                                            <th><center>20</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            set_time_limit(0);
                                            $sql = "SELECT `SUPERVISOR`,
                                                            SUM(CASE WHEN `FCR`='FCR' THEN 1 ELSE 0 END)/COUNT(*)*100 AS 'TOTAL',
                                                            SUM(CASE WHEN `ABERTURA`='8' and `FCR`='FCR' THEN 1 ELSE 0 END)/COUNT(*)*100 AS '8',
                                                            SUM(CASE WHEN `ABERTURA`='9' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '9',
                                                            SUM(CASE WHEN `ABERTURA`='10' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '10',
                                                            SUM(CASE WHEN `ABERTURA`='11' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '11',
                                                            SUM(CASE WHEN `ABERTURA`='12' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '12',
                                                            SUM(CASE WHEN `ABERTURA`='13' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '13',
                                                            SUM(CASE WHEN `ABERTURA`='14' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '14',
                                                            SUM(CASE WHEN `ABERTURA`='15' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '15',
                                                            SUM(CASE WHEN `ABERTURA`='16' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '16',
                                                            SUM(CASE WHEN `ABERTURA`='17' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '17',
                                                            SUM(CASE WHEN `ABERTURA`='18' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '18',
                                                            SUM(CASE WHEN `ABERTURA`='19' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '19',
                                                            SUM(CASE WHEN `ABERTURA`='20' and `FCR`='FCR' THEN 1 ELSE 0 END) /COUNT(*)*100 AS '20'
                                                            FROM `tb_fcr_online` 
                                                            GROUP BY `SUPERVISOR`";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado)) { 
                                        ?> 
                                                <tr>
                                                    <td><center><?php echo $registro['SUPERVISOR'];?></center></td>
                                                    <td><center><?php echo round($registro['TOTAL'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['8'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['9'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['10'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['11'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['12'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['13'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['14'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['15'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['16'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['17'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['18'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['19'],2);?>%</center></td>
                                                    <td><center><?php echo round($registro['20'],2);?>%</center></td>
                                                </tr> 
                                        <?php } }?>              
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><center>SUPERVISOR</center></th>
                                            <th><center>Total</center></th>
                                            <th><center>8</center></th>
                                            <th><center>9</center></th>
                                            <th><center>10</center></th>
                                            <th><center>11</center></th>
                                            <th><center>12</center></th>
                                            <th><center>13</center></th>
                                            <th><center>14</center></th>
                                            <th><center>15</center></th>
                                            <th><center>16</center></th>
                                            <th><center>17</center></th>
                                            <th><center>18</center></th>
                                            <th><center>19</center></th>
                                            <th><center>20</center></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>FCR Online por Operador</h5>
                                    <div class="ibox-tools">
                                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        <a class="fullscreen-link"><i class="fa fa-expand"></i></a>
                                        <a class="close-link"><i class="fa fa-times"></i></a>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                                            <thead>
                                                <tr>
                                                    <th><center>NOME</center></th>
                                                    <th><center>SUPERVISOR</center></th>
                                                    <th><center>GERADOS</center></th>
                                                    <th><center>FCR</center></th>
                                                    <th><center>TOTAL</center></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    set_time_limit(0);
                                                    $sql = "SELECT NOME,
                                                            SUPERVISOR,
                                                            count(*) as GERADOS,
                                                            SUM(CASE WHEN `FCR`='FCR' THEN 1 ELSE 0 END) as FCR,
                                                            SUM(CASE WHEN `FCR`='FCR' THEN 1 ELSE 0 END)/COUNT(*)*100 AS 'TOTAL'
                                                            FROM `tb_fcr_online`
                                                            GROUP BY NOME
                                                            ORDER BY (SUM(CASE WHEN `FCR`='FCR' THEN 1 ELSE 0 END)/COUNT(*))";
                                                    $resultado = mysqlI_query($link, $sql);
                                                    if(!$resultado)
                                                        echo 'ERRO';
                                                    else{
                                                        $numero_registros = mysqlI_num_rows($resultado);
                                                        while($registro = mysqlI_fetch_array($resultado)){ 
                                                ?> 
                                                    <tr>
                                                        <td><center><?php echo $registro['NOME'];?></center></td>
                                                        <td><center><?php echo $registro['SUPERVISOR'];?></center></td>
                                                        <td><center><?php echo $registro['GERADOS'];?></center></td>
                                                        <td><center><?php echo $registro['FCR'];?></center></td>
                                                        <td class=<?php if($registro['TOTAL']>30) echo'"text-navy"'; 
                                                            else echo '"text-danger"';?>>
                                                            <center><?php echo round($registro['TOTAL'],2);?>%</center>
                                                        </td>
                                                    </tr>
                                                <?php } }?>              
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th><center>NOME</center></th>
                                                    <th><center>SUPERVISOR</center></th>
                                                    <th><center>MGERADOS</center></th>
                                                    <th><center>FCR</center></th>
                                                    <th><center>TOTAL</center></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('footer.php') ;?>
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
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ExampleFile'},
                        {extend: 'pdf', title: 'ExampleFile'},
                        {extend: 'print',
                         customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');
                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ]
                });
            });
        </script>
    </body>
</html>