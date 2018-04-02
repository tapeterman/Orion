
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
        <title>Orion | Resolvidos</title>
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
                    <li class="active"><strong>Resolvidos por Supervisor</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Resolvidos Online por supervisor</h5>
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
                                            <th><center>&lt;8</center></th>
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
                                            <th><center>&gt;20</center></th>
                                         </tr>
                                    </thead>
                                    <tbody>
                                        <?php set_time_limit(0);
                                            $sql = "SELECT supervisor,count(*) as Total,
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T')) <8 THEN 1 ELSE 0 END) AS '<8',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 8 THEN 1 ELSE 0 END) AS '8',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 9 THEN 1 ELSE 0 END) AS '9',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 10 THEN 1 ELSE 0 END) AS '10',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 11 THEN 1 ELSE 0 END) AS '11',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 12 THEN 1 ELSE 0 END) AS '12',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 13 THEN 1 ELSE 0 END) AS '13',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 14 THEN 1 ELSE 0 END) AS '14',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 15 THEN 1 ELSE 0 END) AS '15',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 16 THEN 1 ELSE 0 END) AS '16',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 17 THEN 1 ELSE 0 END) AS '17',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 18 THEN 1 ELSE 0 END) AS '18',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))= 19 THEN 1 ELSE 0 END) AS '19',
                                                    SUM(CASE WHEN hour(str_to_date(`DH_RESOLUCAO`, '%d/%m/%Y %T'))>19 THEN 1 ELSE 0 END) AS '>19'
                                                    from vw_resolvidas_online 
                                                    group by supervisor";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado))
                                                { 
                                        ?>                                                      
                                                <tr>
                                                    <td><center><?php echo $registro['SUPERVISOR'];?></center></td>
                                                    <td><center><?php echo $registro['Total'];?></center></td>
                                                    <td><center><?php echo $registro['<8'];?></center></td>
                                                    <td><center><?php echo $registro['8'];?></center></td>
                                                    <td><center><?php echo $registro['9'];?></center></td>
                                                    <td><center><?php echo $registro['10'];?></center></td>
                                                    <td><center><?php echo $registro['11'];?></center></td>
                                                    <td><center><?php echo $registro['12'];?></center></td>
                                                    <td><center><?php echo $registro['13'];?></center></td>
                                                    <td><center><?php echo $registro['14'];?></center></td>
                                                    <td><center><?php echo $registro['15'];?></center></td>
                                                    <td><center><?php echo $registro['16'];?></center></td>
                                                    <td><center><?php echo $registro['17'];?></center></td>
                                                    <td><center><?php echo $registro['18'];?></center></td>
                                                    <td><center><?php echo $registro['19'];?></center></td>
                                                    <td><center><?php echo $registro['>19'];?></center></td>
                                                </tr> 
                                        <?php }  }?>              
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><center>SUPERVISOR</center></th>
                                            <th><center>Total</center></th>
                                            <th><center>&lt;8</center></th>
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
                                            <th><center>&gt;20</center></th>
                                        </tr>
                                    </tfoot>
                                </table>
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
        <script src="../js/plugins/traducao.js"></script>
        <script>
            $(document).ready(function(){
                $('.dataTables-example').DataTable({
                    "language": {
                        "url": "../js/plugins/traducao.js"
                        },
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
