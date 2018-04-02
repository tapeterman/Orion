<div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> 
                        <span><img alt="image" class="img-circle" src="../img/user-id2.jpg"/></span>
                        <a data-toggle="dropdown" class="dropdown-toggle">
                            <span class="clear"> 
                                <span class="block m-t-xs"> 
                                    <strong class="font-bold"><?php echo $nome ?></strong>
                                </span> 
                                <span class="text-muted text-xs block"><?php echo $permissao ?><b class="caret"></b></span> 
                            </span> 
                        </a>
                    </div>
                    <div class="logo-element"><a><i class="fa fa-eye"></i></a> Orion</div>
                </li>
                <li>
                    <a href="#"><i class="fa fa-home"></i> 
                        <span class="nav-label">Home</span> 
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="home.php">Home</a></li>
                        <li><a href="causa_ofensor.php">Causa Ofensor</a></li>
                        <li><a href="comunicados.php">Comunicados</a></li>
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
                                <li><a href="abertos_online_supervisor.php">Abertos Supervisor</a></li>
                                <li><a href="finalizados_online_supervisor.php">Finalizados por Supervisor</a></li>
                                <li><a href="start.php">Manifestos sem Start</a></li>
                                <li><a href="fcr.php">FCR por Supervisor</a></li>
                                <li><a href="recorrente.php">Recorrente</a></li>
                                <li><a href="prazo.php">Prazo por Supervisor</a></li>
                                <li><a href="controle_login.php">Controle Login</a></li>
                                <li><a href="tempos_huawei.php">Tempos Huawei</a></li>
                            </ul>
                            <a href="#">Relatorios Historico<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li><a href="resultado_historico.php">Indicadores histórico N2</a></li>
                                <li><a href="resultado_historico_0800.php">Indicadores histórico 0800</a></li>
                                <li><a href="resultado_historico_consolidado.php">Indicadores histórico Consolidado</a></li>
                                <li><a href="ranking_mes_campanha.php">Ranking Operadores</a></li>
                            </ul>
                            <a href="#">Relatorios Historico Supervisor<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li><a href="resultado_historico_supervisor.php">Indicadores por Supervisor</a></li>
                                <li><a href="resultado_historico_operador.php">Indicadores por Operador</a></li>
                                <li><a href="ranking_mes_campanha.php">Ranking Operadores</a></li>
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
                        <li><a href="base_historico.php">Indicadores histórico</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-users"></i>
                        <span class="nav-label">Usuarios</span> 
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="usuarios_cadastrados.php">Usuarios Cadastrados</a></li>
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
                    <a href="#"><i class="fa fa-exchange"></i>
                        <span class="nav-label">Roteamento</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="roteamento.php">Média</a></li>
                        <li><a href="manifestos_indevidos.php">Manifestos Indevidos</a></li>
                        <li><a href="acomp_manifestos.php">Acompanhamento Manifestos</a></li>
                        <li><a href="base_aurora.php">Base Aurora</a></li>
                    </ul>
                </li>
                <li>
                    <a href="diario_bordo.php"><i class="fa fa-book"></i>
                        <span class="nav-label">Diário de Bordo</span>
                        <span class="fa arrow"></span>
                    </a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-file-word-o"></i>
                        <span class="nav-label">Editor Texto</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="editor_ajuda_indicadores.php">Editor de Texto indicadores</a></li>
                        <li><a href="ajuda_indicador.php">Dicas Indicadores</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="fa fa-graduation-cap"></i>
                        <span class="nav-label">Capacitação</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a href="acomp_treinamento.php">Resumo de Treinamento</a></li>
                        <li><a href="escala_treinamento.php">Pendentes de Treinamento</a></li>
                        <li><a href="diario_bordo_treinamento.php">Diario de Bordo Treinamento</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i></a>
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
                    <li>
                        <span class="m-r-sm text-muted welcome-message"><?php echo $Nome ?></span>
                    </li>
                    <li>
                        <a href="../logout.php"><i class="fa fa-sign-out"></i> Log out
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-cloud-download"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-alerts">
                            <li>
                                <div>
                                    Bases Historico atualizada até:
                                    <span class="pull-right text-muted small">
                                        <?php set_time_limit(0);
                                            $sql = "SELECT DATE_FORMAT(max(horario),'%d/%m') AS 'DATA' 
                                                    from tb_atualizacoes
                                                    where tabela = 2";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado)){
                                        ?>
                                        <?php echo $registro['DATA'];?>
                                        <?php } }?>
                                    </span>
                                </div>
                            </li>
                            <hr>
                            <li>
                                <div>
                                    Bases Online atualizado até:
                                    <span class="pull-right text-muted small">
                                        <?php set_time_limit(0);
                                            $sql = "SELECT DATE_FORMAT(max(horario),'%d/%m %T') AS 'DATA' 
                                                    from tb_atualizacoes
                                                    where tabela = 1";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado)){
                                        ?>
                                        <?php echo $registro['DATA'];?>
                                        <?php } }?>
                                    </span>
                                </div>  
                            </li>
                            <hr>
                            <li>
                                <div>
                                    Cancelamento de Receita até:
                                    <span class="pull-right text-muted small">
                                        <?php set_time_limit(0);
                                            $sql = "SELECT DATE_FORMAT(max(horario),'%d/%m') AS 'DATA' 
                                                    from tb_atualizacoes
                                                    where tabela = 3";
                                            $resultado = mysqlI_query($link, $sql);
                                            if(!$resultado)
                                                echo 'ERRO';
                                            else{
                                                $numero_registros = mysqlI_num_rows($resultado);
                                                while($registro = mysqlI_fetch_array($resultado)){
                                        ?>
                                        <?php echo $registro['DATA'];?>
                                        <?php } }?>
                                    </span>
                                </div>  
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>

