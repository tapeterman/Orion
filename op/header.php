<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span><img alt="image" class="img-circle" src="../img/user-id2.jpg" /></span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold"><?php echo $nome ?></strong>
                                </span> 
                                <span class="text-muted text-xs block"><?php echo $permissao ?>
                                    <b class="caret"></b>
                                </span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="profile.html">Profile</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                            <li><a href="mailbox.html">Mailbox</a></li>
                            <li class="divider"></li>
                            <li><a href="../logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        <a><i class="fa fa-eye"></i></a> Orion
                    </div>
                </li>
                <li>
                    <a href="#"><i class="fa fa-home"></i>
                        <span class="nav-label">Home</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="causa_ofensor.php">Causa Ofensor</a></li>
                        <li><a href="campanhas.php">Campanhas</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o"></i>
                        <span class="nav-label">Relatorios</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li>
                            <a href="#">Relatorios Online<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li><a href="abertos_online.php">Manifestos Abertos</a></li>
                                <li><a href="finalizados_online.php">Finalizados</a></li>
                                <li><a href="start.php">Manifestos sem Start</a></li>
                                <li><a href="fcr.php">FCR</a></li>
                                <li><a href="recorrente.php">Recorrente</a></li>
                                <li><a href="prazo.php">Prazo</a></li>
                                <li><a href="controle_login.php">Controle Login</a></li>
                                <li><a href="tempos_huawei.php">Tempos Huawei</a></li>
                            </ul>
                            <a href="#">Indicadores Historico<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li><a href="resultado_historico_operador.php">Dia a Dia Indicadores</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-database"></i>
                        <span class="nav-label">Bases</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="base_abertos.php">Abertos</a></li>
                        <li><a href="base_prazo.php">Prazo</a></li>
                        <li><a href="base_fcr.php">FCR</a></li>
                        <li><a href="base_cancelamento.php">Cancelamento Receita</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users"></i>
                        <span class="nav-label">Usuarios</span> 
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="trocar_senha.php">Trocar Senha</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-usd"></i>
                        <span class="nav-label">Cancel. de Receita</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="resumo_cancelamento_de_receita.php">Resumo</a></li>
                    </ul>
                </li>
                <li>
                    <a href="acomp_treinamento.php"><i class="fa fa-graduation-cap"></i>
                        <span class="nav-label">Capacitação</span>
                        <span class="fa arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="ranking_mes_campanha.php"><i class="fa fa-list-ol"></i>
                        <span class="nav-label">Ranking Operadores</span>
                        <span class="fa arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="ajuda_indicador.php"><i class="fa fa-file-word-o"></i>
                        <span class="nav-label">Como melhorar meu Indicador</span>
                        <span class="fa arrow"></span>
                    </a>
                </li>
                <?php if($_SESSION['Equipe'] == 'NIVEL 2' or $_SESSION['Equipe'] == 'NIVEL 3' or $_SESSION['Equipe'] == 'NIVEL 2 08:12') 
                    echo ('<li>
                    <a href="#"><i class="fa fa-book"></i>
                        <span class="nav-label">Tabulador</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="tabulador.php">Tabulador de Oportunidade</a></li>
                    </ul>
                </li> ')  ?>
            </ul>
        </div>
    </nav>
        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#">
                            <i class="fa fa-bars"></i>
                        </a>
                        <form role="search" class="navbar-form-custom" action="#">
                            <div class="form-group">
                                <input type="text" placeholder="Pesquisar..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">
                            <button type="button" class="btn btn-default btn-rounded" data-toggle="modal" data-target="#myModal5">
                                Desconto Fornecedor
                            </button></span>
                        </li>
                        <li><span class="m-r-sm text-muted welcome-message"><?php echo $Nome ?></span></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out"></i> Log out</a></li>
                    </ul>
                </nav>
            </div>