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
        <title>Orion | Agenda</title>
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
                <h2>Agenda Operador</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Relatorios Online</a></li>
                    <li class="active"><strong>Agenda Operador</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Agenda Operador</h5>
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
                                <th colspan="5">Agenda Operador</th>
                                
                            </thead>


                                <?php set_time_limit(0);
                                            $sql = "SELECT distinct NOME
                                                    from tb_portal_online
                                                    where STATUS_VENCIMENTO in ('VENCE D+2','VENCE D+4')
                                                    and CLASS <> 'EXPURGO'
                                                    and SUPERVISOR = '".$Nome."'
                                                    ORDER BY NOME";    

                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado)){
                                        ?> 
                                    <tbody>
                                        <tr>
                                        <?php $operador=$registro['NOME'];?>
                                            <th colspan="5"><center><?php echo $registro['NOME'];?></center></th>
                                            
                        
                                        </tr>
                                    
                                    <tr>
                                            <th><center>NOME</center></th>
                                            <th><center>CPF/CNPJ</center></th>
                                            <th><center>DATA MAXIMA</center></th>
                                            <th><center>HORA</center></th>
                                            <th><center>VALIDAÇÃO</center></th>
                                        </tr>

                                        <?php set_time_limit(0);
                                            $sql1 = "SELECT  NM_CLIENTE, CPF_CNPJ, DATE_FORMAT(DT_VENCIMENTO,'%d/%m/%Y') AS DATA_VENCIMENTO, HOUR(HR_VENCIMENTO ) AS HORAS
                                                from tb_portal_online
                                                where STATUS_VENCIMENTO in ('VENCE D+2','VENCE D+4')
                                                and CLASS <> 'EXPURGO'
                                                and SUPERVISOR = '".$Nome."'
                                                AND NOME = '".$operador."'
                                                ORDER BY DT_VENCIMENTO, HR_VENCIMENTO";    

                                            $resultado1 = mysqlI_query($link, $sql1);
                                            if(!$resultado1)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros1 = mysqlI_num_rows($resultado1);
                                                while($registro1 = mysqlI_fetch_array($resultado1)){
                                        ?> 
                                                <tr>
                                                    <td><center><?php echo $registro1['NM_CLIENTE'];?></center></td>
                                                    <td><center><?php echo $registro1['CPF_CNPJ'];?></center></td>
                                                    <td><center><?php echo $registro1['DATA_VENCIMENTO'];?></center></td>
                                                    <td><center><?php echo $registro1['HORAS'];?></center></td>
                                                    <td><center></center></td>
                                                </tr>
                                            <?php }};?> 

                                            <?php set_time_limit(0);
                                            $sql2 = "select 
                                                    SUM(CASE WHEN TIPO = 'ICR' AND ICR >0 THEN 1 ELSE 0 END) AS ICR,
                                                    SUM(CASE WHEN ICR > 0 THEN 1 ELSE 0 END) AS START,
                                                    SUM(CASE WHEN DT_VENCIMENTO < curdate() THEN 1 ELSE 0 END) AS BACKLOG
                                                    from tb_portal_online
                                                    where CLASS <> 'EXPURGO'
                                                    AND NOME = '".$operador."'
                                                    GROUP BY NOME";    

                                            $resultado2 = mysqlI_query($link, $sql2);
                                            if(!$resultado2)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros2 = mysqlI_num_rows($resultado2);
                                                while($registro2 = mysqlI_fetch_array($resultado2)){
                                        ?> 

                                                <tr>
                                                    <td><center>ICR</center></td>
                                                    <td><center><?php echo $registro2['ICR'];?></center></td>
                                                    <td><center>META</center></td>
                                                    <td><center><?php echo $registro2['ICR'];?></center></td>
                                                    <td><center></center></td>
                                                </tr>
                                                <tr>
                                                    <td><center>START</center></td>
                                                    <td><center><?php echo $registro2['START'];?></center></td>
                                                    <td><center>META</center></td>
                                                    <td><center><?php echo $registro2['START'];?></center></td>
                                                    <td><center></center></td>
                                                </tr>
                                                <tr>
                                                    <td><center>BACKLOG</center></td>
                                                    <td><center><?php echo $registro2['BACKLOG'];?></center></td>
                                                    <td><center>META</center></td>
                                                    <td><center><?php echo $registro2['BACKLOG'];?></center></td>
                                                    <td><center></center></td>
                                                </tr>

                                                 <?php  }} }}?>
                                                 </tbody>
                                                 <tfoot>
                                        <tr>
                                            <th><center>-</center></th>
                                            <th><center>-</center></th>
                                            <th><center>-</center></th>
                                            <th><center>-</center></th>
                                            <th><center>-</center></th>
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
