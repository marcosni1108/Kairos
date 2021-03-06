<?php

  require_once 'Crud.php';

  class funcionario extends Crud {

      protected $table = 'funcionario';
      private $matricula;
      private $nome;
      private $cpf;
      private $email;
      private $login;
      private $senha;
      private $nivel;
      private $status;

      function getStatus() {
          return $this -> status;
      }

      function setStatus($status) {
          $this -> status = $status;
      }

      function getMatricula() {
          return $this -> matricula;
      }

      function getCpf() {
          return $this -> cpf;
      }

      function getLogin() {
          return $this -> login;
      }

      function getSenha() {
          return $this -> senha;
      }

      function getNivel() {
          return $this -> nivel;
      }

      function setMatricula($matricula) {
          $this -> matricula = $matricula;
      }

      function setCpf($cpf) {
          $this -> cpf = $cpf;
      }

      function setLogin($login) {
          $this -> login = $login;
      }

      function setSenha($senha) {
          $this -> senha = $senha;
      }

      function setNivel($nivel) {
          $this -> nivel = $nivel;
      }

      public function setNome($nome) {
          $this -> nome = $nome;
      }

      public function getNome() {
          return $this -> nome;
      }

      public function setEmail($email) {
          $this -> email = $email;
      }

      public function insert() {

          $sql = "INSERT INTO $this -> table ( matricula, nome, cpf ,email, login, senha, nivel,status)"
                  ." VALUES (:matricula, :nome, :cpf , :email, :login, :senha, :nivel,:status)";
          $stmt = DB::prepare($sql);
          $stmt -> bindParam(':matricula', $this -> matricula);
          $stmt -> bindParam(':nome', $this -> nome);
          $stmt -> bindParam(':cpf', $this -> cpf);
          $stmt -> bindParam(':email', $this -> email);
          $stmt -> bindParam(':login', $this -> login);
          $stmt -> bindParam(':senha', $this -> senha);
          $stmt -> bindParam(':nivel', $this -> nivel);
          $stmt -> bindParam(':status', $this -> status);

          try {
              $stmt -> execute();
              return "OK";
          } catch(PDOException $e) {
              if(isset($e -> errorInfo[1])&&$e -> errorInfo[1]=='1062') {
                  $erro = $this -> trataErro($e -> errorInfo[2]);
                  return $erro;
              }
          }
      }

      public function update($id) {

          $sql = "UPDATE $this -> table SET nome= :nome, "
                  ."email=:email,"
                  ."login=:login,"
                  ."nivel= :nivel "
                  ."WHERE id = :id";
          $stmt = DB::prepare($sql);

          $stmt -> bindParam(':nome', $this -> nome);
          $stmt -> bindParam(':email', $this -> email);
          $stmt -> bindParam(':login', $this -> login);
          $stmt -> bindParam(':nivel', $this -> nivel);
          $stmt -> bindParam(':id', $id);
          try {
              $stmt -> execute();
              return 'OK';
          } catch(PDOException $e) {
              if(isset($e -> errorInfo[1])&&$e -> errorInfo[1]=='1062') {
                  $erro = $this -> trataErro($e -> errorInfo[2]);
                  return $erro;
              }
          }
      }

      public function verificaLogin($login, $senha) {

          $sql = "SELECT * FROM $this -> table WHERE login = :login AND senha= :senha and status = 'A'";
          $stmt = DB::prepare($sql);
          $stmt -> bindParam(':login', $login);
          $stmt -> bindParam(':senha', $senha);
          $stmt -> execute();

          return $stmt -> fetchAll();
      }

      public function whereNivel($nivel) {
          $sql = "SELECT * FROM $this -> table WHERE nivel = :nivel and status = 'A'";
          $stmt = DB::prepare($sql);
          $stmt -> bindParam(':nivel', $nivel, PDO::PARAM_INT);
          $stmt -> execute();
          return $stmt -> fetchAll();
      }

      public function acessoNivel($login) {
          $sql = "SELECT nivel FROM $this -> table WHERE login = :login";
          $stmt = DB::prepare($sql);
          $stmt -> bindParam(':login', $login);
          $stmt -> execute();
          return $stmt -> fetchAll();
      }

      public function whereNome($nome) {
          $sql = "SELECT * FROM $this -> table WHERE nome = :nome";
          $stmt = DB::prepare($sql);
          $stmt -> bindParam(':nome', $nome);
          $stmt -> execute();
          return $stmt -> fetchAll();
      }

      public function updateSenha($login) {

          $sql = "UPDATE $this -> table SET senha= :senha "
                  ."WHERE login = :login";
          $stmt = DB::prepare($sql);
          $stmt -> bindParam(':senha', $this -> senha);
          $stmt -> bindParam(':login', $login);
          return $stmt -> execute();
      }

      public function status($id, $status) {

          $sql = "UPDATE $this -> table SET status= :status "
                  ."WHERE id = :id";
          $stmt = DB::prepare($sql);
          $stmt -> bindParam(':status', $status);
          $stmt -> bindParam(':id', $id);
          return $stmt -> execute();
      }

      public function findAllAtivos() {
          $sql = "SELECT * FROM $this -> table where status = 'A'";
          $stmt = DB::prepare($sql);
          $stmt -> execute();
          return $stmt -> fetchAll();
      }

      public function trataErro($erro) {

          if(strripos($erro, 'matricula')) {
              return "Essa matricula já está cadastrada.";
          } else if(strripos($erro, 'login')) {
              return "Esse login já está cadastrado.";
          } else if(strripos($erro, 'cpf')) {
              return "Esse CPF já está cadastrado.";
          } else {
              return "Não foi possivel cadastrar o usuário.";
          }
      }

  }
