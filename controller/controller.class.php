<?php

if(!isset($_SESSION))
session_start();


include '../model/Aluno.class.php';
include '../model/Professor.class.php';

class Controller {




 function conectToDB(){
  
    $con = mysql_connect("localhost", "root", "") or die('Não foi possível conectar ao BD');
    mysql_select_db("aprendaqui2",$con) or die("Banco de dados nao encontrado");



 }



 function registerProfessor($name, $email, $phone, $especialidade, $password, $address, $description, $file){

    $password = md5($password);
    

    $folder = "../database/dataimages/$name";
    @mkdir($folder);

    $path = $folder."/".$file['picture']['name'];
    move_uploaded_file($file['picture']['tmp_name'], $path );


    $query = mysql_query("INSERT INTO `professores` (`name`, `email`, `phone`, `especialidade`, `password`, `address`, `description`, `picture`) VALUES ('$name', '$email', '$phone', '$especialidade', '$password', '$address', '$description', '$path')");

    

 }


 function registerAluno($name, $email, $cpf, $phone, $password, $file){

   $password = md5($password);
   $picture = "";

   if(isset($file)){

      $folder = "../database/dataimages/$name";
      @mkdir($folder);
      $path = $folder."/".$file['picture']['name'];
      move_uploaded_file($file['picture']['tmp_name'], $path );
      $picture = $path;
   }

   $query = mysql_query("INSERT INTO `alunos` (`name`, `email`, `cpf`, `phone`, `password`, `picture`) VALUES ('$name', '$email', '$cpf', '$phone', '$password', '$picture')");


 }


 function login($email, $password){


   $queryProfessor = mysql_query("SELECT *FROM `professores` WHERE `email` = '$email' AND `password`='$password'");


   $queryAluno = mysql_query("SELECT *FROM `alunos` WHERE `email` = '$email' AND `password`='$password'");




   if(@mysql_num_rows($queryProfessor) > 0 ){

         $_SESSION['email'] = $email;
         $_SESSION['id'] = mysql_fetch_array(mysql_query("SELECT*FROM `professores` WHERE `email`='$email' AND `password`='$password'"))['id'];
         return "../view/dashboardProfessor.php";

   }
   else if(@mysql_num_rows($queryAluno) > 0){

      $_SESSION['email'] = $email;
      $_SESSION['id'] = mysql_fetch_array(mysql_query("SELECT*FROM `alunos` WHERE `email`='$email' AND `password`='$password'"))['id'];
      return "../view/dashboardAluno.php";

   }
   else{
      

      return false;

   }

 }



 function getAluno($email){

   $query = mysql_query("SELECT*FROM `alunos` WHERE `email` = '$email'");

   $aluno = mysql_fetch_array($query);
   $aluno = new Aluno($aluno['id'],$aluno['name'],$aluno['email'], $aluno['phone'], $aluno['cpf'], $aluno['password'], $aluno['picture']);
 

   return $aluno;
 }


 function getProfessor($email){

   $query = mysql_query("SELECT*FROM `professores` WHERE `email` = '$email'");

   $professor = mysql_fetch_array($query);
   $professor = new Professor($professor['id'],$professor['name'],$professor['email'],$professor['phone'], $professor['especialidade'], $professor['password'], $professor['address'], $professor['description'], $professor['picture']);

   return $professor;

 }


 function getProfessoresNotMatched(){

   $idAluno = $_SESSION['id'];

   $professores = [];
  
   $query = mysql_query("SELECT*FROM `professores` ");
 
   if(@mysql_num_rows($query) > 0){

      while($professor = mysql_fetch_array($query)){

         
         $idProfessor = $professor['id'];
         $queryMatch = mysql_query("SELECT*FROM `aluno_professor_match` WHERE `idAluno`='$idAluno' AND `idProfessor` = '$idProfessor'  ");

         if(@mysql_num_rows($queryMatch) == 0){ //Não solicitou match ainda para este professor, pode exibir

            $professor = new Professor($professor['id'],$professor['name'],$professor['email'],$professor['phone'], $professor['especialidade'], $professor['password'], $professor['address'], $professor['description'], $professor['picture']);
            $professores[] = $professor; //adiciona na ultima posição do array


         }

   
      }

      return $professores;
   }
   else{
      return false;
   }



 }


 function getMatchAlunosRequires(){

  
   $idProfessor = $_SESSION['id'];
   
   $query1 = mysql_query("SELECT*FROM `aluno_professor_match` WHERE `idProfessor`='$idProfessor' AND `isMatch`=0");
   
   $alunos = [[]];
   
   if(mysql_num_rows($query1) > 0){
      
      while($match = mysql_fetch_array($query1)){

         $info = [];
         $idAluno = $match['idAluno'];
         
         $query2 = mysql_query("SELECT*FROM  `alunos` WHERE `id` = '$idAluno' ");

         $aluno = mysql_fetch_array($query2);
         $info[] = new Aluno($aluno['id'],$aluno['name'],$aluno['email'], $aluno['phone'], $aluno['cpf'], $aluno['password'], $aluno['picture']);
         $info[] = $match['msgMatch'];
         $alunos[] = $info;


      }
    
      return $alunos;

   }
   else{

      
      return false;
   }
   



 }



 function requireMatch($idProf, $mensagemMatch){

   
   $idAluno = $_SESSION['id'];
   $f = false;

   return mysql_query("INSERT INTO `aluno_professor_match` (`idProfessor`, `idAluno`, `isMatch`, `msgMatch`) VALUES ('$idProf','$idAluno', '$f', '$mensagemMatch')");



 }



 function doMatch($idAluno, $idProfessor){



  return  mysql_query("UPDATE `aluno_professor_match` SET `isMatch`=1 WHERE `idAluno`='$idAluno' AND `idProfessor`='$idProfessor'");



 }


 function refuseMatch($idAluno, $idProfessor){


   return mysql_query("DELETE FROM `aluno_professor_match` WHERE `idAluno`='$idAluno' AND `idProfessor`='$idProfessor'");

 }



}