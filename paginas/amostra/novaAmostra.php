<html>
    <head>
        <title>Kairos</title>
        <?php
        include "../include/include_css.php";
        include "../header/header.php";
        include "../menu_principal/menu_lateral.php";
        include '../include/include_classes.php';
        ?>   
        <link href="../../css/sb-admin.css" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
    <body onbeforeunload="return myFunction()">
        <?php
        
        if (isset($_POST['cadastrar'])){

            $cnpj = $_POST['cnpj'];
            $departamento = $_POST['departamento'];
            $atividade = $_POST['atividade'];
          
        }     
        if (isset($_POST['cadastrarAmostra'])):

            $cnpj = $_POST['cnpj'];
            $departamento = $_POST['departamento'];
            $atividade = $_POST['atividade'];          
            $hora_inicial = $_POST['hora_inicial'];
            $hora_final = $_POST['hora_final'];
            $quantidade = $_POST['quantidade'];
            $indice = intval(10);
            $amostra = new amostra();
            
            $amostra->setAtividade($atividade);
            $amostra->setDepartamento($departamento);
            $amostra->setIndice($indice);
            $amostra->setQuantidade($quantidade);
            $amostra->setTempoinicial($hora_inicial);
            $amostra->setTempofinal($hora_final);
            
            # Insert
            if ($amostra->insert()) {
                echo "<script> alert('Amostra cadastrada com sucesso')</script>";
            }

        endif;
        ?>        
        <div id="wrapper" >
            <div class="container-fluid">
                <form method="post" action="">
                    <div class="input-prepend">
                        <h1 class="page-header">
                            Registro de Amostra
                        </h1>                     
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo $cnpj; ?>" placeholder="CNPJ" readonly="readonly">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="departamento">Departamento</label>                                                                                
                                <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $departamento; ?>" placeholder="Departamento" readonly="readonly">   
                                </select>
                            </div>      
                            <div class="form-group col-lg-4">
                                <label for="atividade">Atividade</label>                                
                                <input type="text" class="form-control" id="atividade" name="atividade" value="<?php echo $atividade; ?>" placeholder="Atividade" readonly="readonly">
                            </div>                                          
                        </div>    
                        <div class="row"><hr width=95%></div>
                        <div class="row" id="amostra_lista">
                            <div class="form-group col-lg-4">
                                <label for="cnpj">Hora Inicial</label>
                                <input type="text" class="form-control" id="hora_inicial" name="hora_inicial" placeholder="Hora Inicial" >                                
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="cnpj">Hora Final</label>
                                <input type="text" class="form-control" id="hora_final" name="hora_final" placeholder="Hora Final" >                                
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="cnpj">Quantidade</label>
                                <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade" >                                
                            </div> 
                        </div>
                         
                        <div class="row">    
                            <div class="form-group col-lg-3"></div>
                            <div class="form-group col-lg-3">
                                <input type="submit" name="cadastrarAmostra" class="btn btn-success" value="Cadastrar Amostra">
                            </div>
                            <div class="form-group col-lg-3">
                                <input type="button" name="finalizar" class="btn btn-danger" value="Finalizar">
                            </div>                            
                        </div>                        
                </form>  
            </div> 
        </div>
    </body>
<?php include_once '../include/include_js.php'; ?>
    <script>
        function myFunction(){
            return "Deseja sair da pagina, seus dados não serão gravados";
        }
    </script>
</html>

