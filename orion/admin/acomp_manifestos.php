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
                <h2>Roteamento</h2>
                <ol class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a>Roteamento</a></li>
                    <li class="active"><strong>Acompanhamento de Manifestos</strong></li>
                </ol>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Acompanhamento de Manifestos</h5>
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
                                            <th><center>CPF/CNPJ</center></th>
                                            <th><center>FORMA-CONTATO</center></th>
                                            <th><center>DATA ABERTURA</center></th>
                                            <th><center>CONTRATO</center></th>
                                            <th><center>AREA</center></th>
                                            <th><center>DATA VENCIMENTO</center></th>
                                            <th><center>LOGIN</center></th>
                                            <th><center>OPERADOR </center></th>
                                            <th><center>SUPERVISOR</center></th>
                                            <th><center>STATUS-ROT</center></th>
                                            <th><center>STATUS</center></th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        <?php set_time_limit(0);
                                            $sql = "SELECT p.CPF_CNPJ as CPF_CNPJ,
                                                    p.DS_FORMA_CONTATO as DS_FORMA_CONTATO,
                                                    DATE_FORMAT(STR_TO_DATE(p.DH_ABERTURA, '%d/%m/%Y'),'%d/%m/%Y') as DATA_ABERTURA, 
                                                    p.CONTRATO as CONTRATO,
                                                    p.AREA as AREA,
                                                    DATE_FORMAT(p.DT_VENCIMENTO, '%d/%m/%Y') as DT_VENCIMENTO,
                                                    l.Login as Login,
                                                    l.Nome as Nome,
                                                    l.Supervisor as Supervisor,
                                                    l.Status_Roteamento as Status_Roteamento,
                                                    l.Status as Status
                                                    FROM tb_portal_online as p
                                                    LEFT JOIN tb_login_portal as l ON p.LOGIN = l.LOGIN
                                                    WHERE STATUS_ROTEAMENTO <> 'ATIVO'
                                                    AND p.DS_FORMA_CONTATO<> 'BKO'";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado))
                                            {  
                                        ?> 
                                        <tr>
                                            <td scope="row"><center><?php echo $registro['CPF_CNPJ'];?></center></td>
                                            <td><center><?php echo $registro['DS_FORMA_CONTATO'];?></center></td>
                                            <td><center><?php echo $registro['DATA_ABERTURA'];?></center></td>
                                            <td><center><?php echo $registro['CONTRATO'];?></center></td>
                                            <td><center><?php echo $registro['AREA'];?></center></td>
                                            <td><center><?php echo $registro['DT_VENCIMENTO'];?></center></td>
                                            <td><center><?php echo $registro['Login'];?></center></td>
                                            <td><center><?php echo $registro['Nome'];?></center></td>
                                            <td><center><?php echo $registro['Supervisor'];?></center></td>
                                            <td><center><?php echo $registro['Status_Roteamento'];?></center></td>
                                            <td><center><?php echo $registro['Status'];?></center></td>
                                        </tr>
                                        <?php }}?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th><center>CPF/CNPJ</center></th>
                                            <th><center>FORMA-CONTATO</center></th>
                                            <th><center>DATA ABERTURA</center></th>
                                            <th><center>CONTRATO</center></th>
                                            <th><center>AREA</center></th>
                                            <th><center>DATA VENCIMENTO</center></th>
                                            <th><center>LOGIN</center></th>
                                            <th><center>OPERADOR </center></th>
                                            <th><center>SUPERVISOR</center></th>
                                            <th><center>STATUS-ROT</center></th>
                                            <th><center>STATUS</center></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php 
            include('footer.php') 
        ;?>
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