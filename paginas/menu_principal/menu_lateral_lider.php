
<?php 
   error_reporting(0);
?>

            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="../menu_principal/menu_principal.php"><i class="fa fa-tachometer"></i> Home</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#funcionario"><i class="glyphicon glyphicon-user"></i> Funcionario <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="funcionario" class="collapse">
                            <li>
                                <a href="../funcionario/cadastroFuncionario.php">Cadastrar Funcionario</a>
                            </li>
                            <li>
                                <a href="../funcionario/consultaFuncionario.php">Alterar Funcionario</a>
                            </li>                          
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#atividades"><i class="glyphicon glyphicon-check"></i> Atividades <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="atividades" class="collapse">
                            <li>
                                <a href="../atividade/cadastroAtividade.php">Cadastrar Atividades</a>
                            </li>
                            <li>
                                <a href="../atividade/consultaAtividade.php">Alterar Atividades</a>
                            </li>    
                            <li>
                                <a href="../produtividade/cadastraProdutividade.php">Cadastrar Produtividade</a>
                            </li>
                            <li>
                                <a href="../amostra/cadastroAmostra.php">Registrar Amostra</a>
                            </li>         
                            <li>
                                <a href="../parada/cadastroParada.php">Registrar Parada</a>
                            </li>       
                            <li>
                                <a href="../meta/cadastroMeta.php">Cadastrar Meta</a>
                            </li>                            
                        </ul>
                    </li>
                </ul>
            </div>