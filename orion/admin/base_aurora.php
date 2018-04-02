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
        <title>Orion | Aurora</title>
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
                        <li class="active"><strong>Base Aurora</strong></li>
                    </ol>
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Base Aurora</h5>
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
                                              <th><center>ID MANIFESTAÇÃO</center></th>
                                              <th><center>CPF/CNPJ</center></th>
                                              <th><center>NOME CLIENTE</center></th>
                                              <th><center>DATA ABERTURA</center></th>
                                              <th><center>TURNO</center></th>
                                              <th><center>LOGIN</center></th>
                                              <th><center>NOME</center></th>
                                              <th><center>SUPERVISOR</center></th>
                                              <th><center>TURNO</center></th>
                                              <th><center>CAMPANHA</center></th>
                                              <th><center>STATUS ROTEAMENTO</center></th>
                                            </tr>
                                        </thead>
                                        <tbody> 
                                            <?php set_time_limit(0);
                                                $sql = "SELECT 
                                                a.ID_DETALHE_MANIFESTACAO AS ID,
                                                a.CPF_CNPJ AS CPF,
                                                NM_CLIENTE, 
                                                DATE_FORMAT(STR_TO_DATE(a.DH_ABERTURA, '%d/%m/%Y %T'), '%d/%m/%Y %T') AS DATA_ABERTURA,
                                                IF(HOUR(a.HR_VENCIMENTO)<=14, 'MANHA', 'TARDE') AS TURNO, 
                                                a.LOGIN AS LOGIN, 
                                                a.NOME AS NOME, 
                                                a.SUPERVISOR AS SUPERVISOR, 
                                                B.TURNO AS TURNO, 
                                                a.CAMPANHA AS CAMPANHA, 
                                                b.status_roteamento AS STATUS_ROTEAMENTO
                                                FROM tb_portal_online as a 
                                                left join `tb_login_portal` as b on a.login = b.login 
                                                WHERE DS_FORMA_CONTATO <> 'BKO' 
                                                AND EMPRESA = 'ALMAVIVA' 
                                                AND AREA = 'ALM_OUVIDORIA_JDF' 
                                                ORDER by STR_TO_DATE(a.DH_ABERTURA, '%d/%m/%Y %T')"; 

                                                        $resultado = mysqlI_query($link, $sql);
                                                if(!$resultado)
                                                    echo 'ERRO';
                                                else{
                                                    $numero_registros = mysqlI_num_rows($resultado);
                                                    while($registro = mysqlI_fetch_array($resultado))
                                                {  
                                            ?> 
                                                    <tr>
                                                        <td scope="row"><center><?php echo $registro['ID'];?></center></td>
                                                        <td><center><?php echo $registro['CPF'];?></center></td>
                                                        <td><center><?php echo $registro['NM_CLIENTE'];?></center></td>
                                                        <td><center><?php echo $registro['DATA_ABERTURA'];?></center></td>
                                                        <td><center><?php echo $registro['TURNO'];?></center></td>
                                                        <td><center><?php echo $registro['LOGIN'];?></center></td>
                                                        <td><center><?php echo $registro['NOME'];?></center></td>
                                                        <td><center><?php echo $registro['SUPERVISOR'];?></center></td>
                                                        <td><center><?php echo $registro['TURNO'];?></center></td>
                                                        <td><center><?php echo $registro['CAMPANHA'];?></center></td>
                                                        <td><center><?php echo $registro['STATUS_ROTEAMENTO'];?></center></td>
                                                    </tr>
                                            <?php } }?> 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                              <th><center>ID MANIFESTAÇÃO</center></th>
                                              <th><center>CPF/CNPJ</center></th>
                                              <th><center>NOME CLIENTE</center></th>
                                              <th><center>DATA ABERTURA</center></th>
                                              <th><center>TURNO</center></th>
                                              <th><center>LOGIN</center></th>
                                              <th><center>NOME</center></th>
                                              <th><center>SUPERVISOR</center></th>
                                              <th><center>TURNO</center></th>
                                              <th><center>CAMPANHA</center></th>
                                              <th><center>STATUS ROTEAMENTO</center></th>
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
