
<html>
    <head>
        <title>Kairos</title>
        <?php
        include "../include/include_css.php";
        include "../menu_principal/menu_lateral.php";
        include "../../classes/model/validaOperario.php";
       // include "../header/header.php";
       // include '../include/include_classes.php';
        ?> 
        <meta charset="UTF-8">
       
    </head>
    <body >
        <?php
                $cMeta = new meta(); 
                if (isset($_POST['cadastrar'])):
                
                $departamento = $_POST['departamento'];
                $cnpj = $_POST['cnpj'];
                $atividade = $_POST['atividade'];
                $meta = $_POST['meta'];

                $cMeta->setDepartamento($departamento);
                $cMeta->setCnpj($cnpj);
                $cMeta->setAtividade($atividade);
                $cMeta->setMeta($meta);
                if ($cMeta->update()) {
                echo  "<script> alert('Meta Cadastrada com sucesso')</script>";
                
            }
                
            endif;
            ?>

        <!-- Wrapper da pagina -->
        <div id="page-wrapper" style="overflow-x: hidden; padding-left: 250px; height:100%; padding-top: 30px;">
            <!-- Primeira linha do wrapper -->
            <div class="row" >
                <div class="col-lg-12">
                    <h1 class="page-header">Cadastro de Meta</h1>
                </div>
            </div>
           
            <div class="row">
                
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <!-- Conteudo dentro de wrapper -->
                        <div class="panel-body">
                            <div id="chart">

                                <form method="post" action="">
                                    <div class="input-prepend">
                                        
                                        <div class="row">
                                                <div class="form-group col-lg-4">
                                                  <label for="departamento">Departamento</label>
                                                    <select  class="form-control" name="departamento" id="departamento">
                                                      <option value="--" selcted>--</option>  
                                                      <option value="1">Armazem</option>
                                                      <option value="2">Producao</option>
                                                      <option value="3">Transporte</option>
                                                      <option value="4">Protocolo</option>
                                                    </select>
                                                </div> 

                                                
                                                <div class="form-group col-lg-3">
                                                  <label for="gerente">CNPJ</label>
                                                    <select  class="form-control" name="cnpj" id="cnpj">
                                                      <option value="--" selcted>--</option>  
                                                      <option value="0525815">0525815</option>
                                                      <option value="808080880">808080880</option>
                                                      <option value="9950959">9950959</option>
                                                      <option value="70707007">70707007</option>
                                                    </select>
                                                </div> 
     

                                                <div class="form-group col-lg-3">
                                                  <label for="atividade">Atividade</label>
                                                    <select  class="form-control" name="atividade" id="atividade">
                                                      <option value="--" selcted>--</option>  
                                                      <option value="Empacotar">Empacotar</option>
                                                      <option value="Preparacao">Preparacao</option>
                                                    </select>
                                                </div>             
                                                <div class="form-group col-lg-4">
                                                  <label for="meta">Porcentagem de Meta</label>
                                                  <input type="number" class="form-control" onkeypress="javascript: mascara(this, soNumeros);" name="meta" id="meta" placeholder="%" required>
                                                </div>  
                                           
                                        </div>
    
                                        <div class="row">
                                            <div class="form-group col-lg-4">
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <input type="submit" name="cadastrar" class="btn btn-success" value="Cadastrar dados">
                                            </div>    
                                        </div>

                                        
                                            <!-- Modal -->
                                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                              <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    ...
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>                                        

                                    </div>
                                    					
                                </form>                                
                                
                            </div>
                        </div>
                    </div>
                  
                </div>
               
            </div>
        
        </div>        

    </body>
                <?php include_once '../include/include_js.php'; ?>
</html>
