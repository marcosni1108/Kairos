<html>
    <head>
        <title>Kairos</title>
            <?php
        include "../include/include_css.php";
        include "../header/header.php";
//        include "../menu_principal/menu_lateral.php";
//        include '../include/include_classes.php';
        include "../../classes/model/validaOperario.php";
        ?>   
        
        <meta charset="UTF-8">
    </head>
    <body >
             
        <div id="wrapper" >
            <div class="container-fluid">
                <form method="post" action="novaAmostraClasse.php">
                    <div class="input-prepend">
                        <h1 class="page-header">
                            Registro de Amostra
                        </h1>          
                        <div class="alert alert-info alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Ajuda:</strong>
                           Para cadastrar amostra o usuário deve escolher o departamento, selecionar a atividade e clicar no botão cadastrar dados. <br>
                           <strong>Obs:</strong> A pagina será redirecionada para que o usuário coloque as informações adicionais.  </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="cnpj">CNPJ</label>
                                <select  class="form-control" name="cnpj" id="cnpj" required>                                                  
                                   
                                </select>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="departamento">Departamento</label>
                                <select  class="form-control" name="departamento" id="cmbDepartamento" required>                                                  
                                   
                                </select>
                            </div>      
                            <div class="form-group col-lg-4">
                                <label for="atividade">Atividade</label>
                                <select  class="form-control" name="atividade" id="cmbAtividade" required>                                                  
                                   
                                </select>
                            </div>                                          
                        </div>    
                        <div class="row"><hr width=95%></div>   
                        <div class="row">    
                            <div class="form-group col-lg-4"></div>
                            <div class="form-group col-lg-4">
                                <input id="btnCadastrar" type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar Dados">
                                
                            </div>    
                        </div>                        
                </form>  
            </div> 
        </div>
    </body>
<?php include_once '../include/include_js.php'; ?>
    <script src="../../js/populaComboAmostra.js"></script>
</html>
