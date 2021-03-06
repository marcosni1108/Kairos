<html>
    <head>
        <title>Kairos</title>
        <?php
          include "../include/include_css.php";
          include "../header/header.php";
          include "../../classes/model/validaOperario.php";
        ?>
        <link href="../../css/sb-admin.css" rel="stylesheet">
        <link rel="stylesheet" href="../../css/wickedpicker.css">
        <meta charset="UTF-8">
    </head>
    <body>
        <?php
          if(isset($_POST['cadastrar'])) {
              $cnpj = $_POST['cnpj'];
              $departamento = $_POST['departamento'];
              $atividade = $_POST['atividade'];
              $_SESSION["i"] = 0;
              $_SESSION["jcount"] = 0;
              $amostra = new amostra;
              $count = $amostra -> findAllAmostras($atividade);
              if($count) {
                  echo "<script>alert('Já existe um indece para essa atividade por favor selecione outra atividade');"
                  ."window.location='./cadastroAmostra.php'</script>";
              }
          } else if(isset($_POST['cadastrarAmostra'])) {
              if($_POST['hora_inicial']>=$_POST['hora_final']) {
                  echo "<script>alert('Hora inicial não pode ser maior que hora final!');"
                  ."</script>";
                  $cnpj = $_POST['cnpj'];
                  $departamento = $_POST['departamento'];
                  $atividade = $_POST['atividade'];
                  $hora_inicial = $_POST['hora_inicial'];
                  $hora_final = $_POST['hora_final'];
                  $quantidade = $_POST['quantidade'];
              } else {
                  $cnpj = $_POST['cnpj'];
                  $departamento = $_POST['departamento'];
                  $atividade = $_POST['atividade'];
                  $hora_inicial = $_POST['hora_inicial'];
                  $hora_final = $_POST['hora_final'];
                  $quantidade = $_POST['quantidade'];
                  $teste = str_replace(" ", "", $hora_inicial);

                  $hora_inicial = strtotime(str_replace(" ", "", $hora_inicial));
                  $hora_final = strtotime(str_replace(" ", "", $hora_final));

                  $tempoTotal = ($hora_final-$hora_inicial);
                  $tempoTotalMinutos = $tempoTotal/60;

                  $indice = $quantidade/$tempoTotalMinutos;

                  $filds1["departamento"] = $departamento;
                  $filds1["atividade"] = $atividade;
                  $filds1["hora_inicial"] = $hora_inicial;
                  $filds1["hora_final"] = $hora_final;
                  $filds1["quantidade"] = $quantidade;
                  $filds1["indice"] = $indice;


                  $json_result["amostra"] [] = $filds1;
                  $JSON = json_encode($json_result);

                  $fp = fopen("../../js/dataAmostra/dataAmostra".$_SESSION["jcount"] ++.".json", "w") or die('Cannot open file:');

                  // Escreve "exemplo de escrita" no bloco1.txt

                  $escreve = fwrite($fp, $JSON);
                  // Fecha o arquivo
                  fclose($fp);
              }
          }

          if(isset($_POST['finalizar'])) {
              if($_SESSION["jcount"]>=2) {

                  for($e = 0; $e<$_SESSION["jcount"]; $e++) {
                      $arquivo = "../../js/dataAmostra/dataAmostra".$e.".json";
                      $info = file_get_contents($arquivo);
                      $lendo = json_decode($info);
                      foreach($lendo -> amostra as $campo) {
                          $indice_autal = $campo -> indice;
                      }
                      for($w = $e+1; $w<$_SESSION["jcount"]; $w++) {
                          $arquivo = "../../js/dataAmostra/dataAmostra".$w.".json";
                          $info = file_get_contents($arquivo);
                          $lendo = json_decode($info);
                          foreach($lendo -> amostra as $campo) {
                              $indice_proximo = $campo -> indice;
                          }
                          //compara
                          if($indice_autal==$indice_proximo&&$w<>$_SESSION["jcount"]) {
                              $moda = true;
                              $media = false;
                              $contModa = $contModa+1;
                          } elseif($contModa==0) {
                              $media = true;
                              $moda = false;
                          }
                      }
                      if($moda==true) {

                          $indice_final_moda = $indice_autal;
                      } else
                      if($media==true) {
                          $indice_provisorio = $indice_final_media;
                          $indice_final_media = $indice_provisorio+$indice_autal;
                      }
                  }
                  $indice_final_media = $indice_final_media/$_SESSION["jcount"];

                  for($e = 0; $e<$_SESSION["jcount"]; $e++) {
                      $arquivo = "../../js/dataAmostra/dataAmostra".$e.".json";
                      $info = file_get_contents($arquivo);
                      $lendo = json_decode($info);
                      $amostra = new amostra();

                      foreach($lendo -> amostra as $campo) {

                          $amostra -> setDepartamento($campo -> departamento);
                          $amostra -> setAtividade($campo -> atividade);
                          $amostra -> setTempoinicial($campo -> hora_inicial);
                          $amostra -> setTempofinal($campo -> hora_final);
                          $amostra -> setQuantidade($campo -> quantidade);
                          $amostra -> setIndice($campo -> indice);

                          if($amostra -> insert()) {
                              console.log($arg);
                          }
                      }
                  }
                  if($media==true) {
                      $_SESSION["jcount"] = 0;
                      $format_numberMedia = number_format($indice_final_media, 2, ',', '');
                      echo "<script>
                                alert('Amostra cadastrada com sucesso á media é:  ".$format_numberMedia." indice por minuto');
                                location.href='cadastroAmostra.php';</script>";
                  } else {
                      $_SESSION["jcount"] = 0;
                      $format_numberModa = number_format($indice_final_moda, 2, ',', '');
                      echo "<script>
                                alert('Amostra cadastrada com sucesso á moda é:  ".$format_numberModa." indice por minuto');
                                location.href='cadastroAmostra.php';</script>";
                  }
              } else {

                  echo "<script> alert('Para finalizar mais de 2 amostras devem ser cadastradas')</script>";
              }
          }
        ?>
        <div id="wrapper" >
            <div class="container-fluid">
                <form id="amostra" method="post" action="">
                    <div class="input-prepend">
                        <h1 class="page-header">
                            Registro de Amostra
                        </h1>
                        <div class="alert alert-info alert-dismissible fade in" role="alert"> <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> <strong>Ajuda:</strong> Para cadastrar a amostra o usuário deverá colocar a hora inicial da atividade, hora final da atividade, quantidade e clicar no botão cadastrar amostra <br>
                            O minimo de amostras para se cadastrar são duas, para calcular o indice por minuto clique em finalizar.
                        </div>
                        <font size="4"><b>Quantidade de amostras: <?php echo $_SESSION["jcount"]; ?></b></font>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="cnpj">CNPJ</label>
                                <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo $cnpj; ?>" placeholder="CNPJ" readonly="readonly">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="departamento">Departamento</label>
                                <input type="text" class="form-control" id="departamentoNone" name="departamentoNone" value="<?php
                                  $departamentoclass = new departamento();
                                  $nameDept = $departamentoclass -> find($departamento);
                                  echo $nameDept -> nome;
                                ?>" placeholder="Departamento" readonly="readonly">
                                <input style="display: none" type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $departamento; ?>" placeholder="Departamento" readonly="readonly">

                            </div>
                            <div class="form-group col-lg-4">
                                <label for="atividade">Atividade</label>
                                <input type="text" class="form-control" id="AtividadeNone" name="AtividadeNone" value="<?php
                                  $atividadeclass = new atividade();
                                  $name = $atividadeclass -> find($atividade);
                                  echo $name -> nome;
                                ?>" placeholder="Atividade" readonly="readonly">
                                <input style="display: none" type="text" class="form-control" id="atividade" name="atividade" value="<?php echo $atividade; ?>" placeholder="Departamento" readonly="readonly">

                            </div>
                        </div>
                        <div class="row"><hr width=95%></div>
                        <div class="row" id="amostra_lista">
                            <div class="form-group col-lg-4">
                                <label for="cnpj">Hora Inicial</label>
                                <input type="text" class="form-control" id="hora_inicial" onkeypress="javascript: mascara(this, hora);" maxlength="5" name="hora_inicial" placeholder="Hora Inicial" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="cnpj">Hora Final</label>
                                <input type="text" class="form-control" id="hora_final"  onkeypress="javascript: mascara(this, hora);" maxlength="5" name="hora_final" placeholder="Hora Final" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="cnpj">Quantidade</label>
                                <input type="text" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-3"></div>
                            <div class="form-group col-lg-3">
                                <input  type="submit" name="cadastrarAmostra" class="btn btn-success" value="Cadastrar Amostra" id="teste">
                            </div>
                        </div>
                </form>
                <form  id="amostra" method="post" action="">
                    <div class="form-group col-lg-3" style="position:absolute; left:900px; top:466;">
                        <input  type="submit" name="finalizar"  class="btn btn-danger" value="Finalizar">
                    </div>
                </form>
            </div>
        </div>
    </body>
    <?php include_once '../include/include_js.php'; ?>
    <script type="text/javascript" src="../../js/validadores.js"></script>
    <script type="text/javascript" src="../../js/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="../../js/wickedpicker.js"></script>
    <script type="text/javascript" src="../../js/validarHora.js"></script>
</html>

