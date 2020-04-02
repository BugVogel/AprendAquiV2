<?php
if(!isset($_SESSION))
session_start();
include '../controller/controller.class.php';

$controller = new Controller();

$controller->conectToDB();


if(isset($_POST['registerProfessor'])){

    $file= $_FILES;


   $controller->registerProfessor($_POST['name'],$_POST['email'], $_POST['phone'], $_POST['especialidade'], $_POST['senha'], $_POST['address'], $_POST['description'], $file);
    

    echo "<script>alert('Professor cadastrado com sucesso!')</script>";
    echo "<meta http-equiv='refresh' content='0, url=../view/home.php'>";
   


}



if(isset($_POST['registerAluno'])){


    


    $controller->registerAluno($_POST['name'],$_POST['email'], $_POST['phone'], $_POST['cpf'], $_POST['senha'], $_FILES);
    
    echo "<script>alert('Aluno cadastrado com sucesso!')</script>";
    echo "<meta http-equiv='refresh' content='0,url=../view/home.php'>";


}


if(isset($_POST['login'])){

    $password = $_POST['password'];
    $password = md5($password);

    $link = $controller->login($_POST['email'], $password );



    if($link){

   

        echo "<script>alert('Bem vindo ao AprendAqui!')</script>";
        echo "<meta http-equiv='refresh' content='0,url=$link'>";

    }
    else{
     
        echo "<script>alert('Nome ou senha inválidos')</script>";
        echo "<meta http-equiv='refresh' content='0,url=../view/home.php' > ";
    }


}


if(isset($_POST['solicitaMatch'])){


    $idProfessor = $_POST['solicitaMatch'];

    $mensagemMatch = $_POST['mensagemMatch'];


    if($controller->requireMatch($idProfessor, $mensagemMatch)){

        echo "<script>alert('Você acaba de solicitar um Match !')</script>";

    }
    else{
        echo "<script>alert('Match não realizado!')</script>";
    }


    echo "<meta http-equiv='refresh' content='0,url=../view/dashboardAluno.php' > ";

    



}



if(isset($_POST['match'])){

    $idAluno = $_POST['match'];
    $idProfessor = $_SESSION['id'];


    if($controller->doMatch($idAluno, $idProfessor)){

        echo "<script>alert('Você acaba de dar um Match! Agora converse com o seu cliente')</script>";
    }
    else{
        echo "<script>alert('Ops! Match não realizado, houve algum problema')</script>";

    }


    echo "<meta http-equiv='refresh' content='0,url=../view/dashboardProfessor.php' > ";



}

if(isset($_POST['updateProfessor'])){


    if($controller->updateProfessor($_POST)){
        echo "<script>alert('Informações atualizadas!')</script>";
    }
    else{
        echo "<script>alert('Ops! Houve algum problema')</script>";
    }


    echo "<meta http-equiv='refresh' content='0,url=../view/dashboardProfessor.php' > ";

}


if(isset($_POST['updateAluno'])){

    
    if($controller->updateAluno($_POST)){
        echo "<script>alert('Informações atualizadas!')</script>";
    }
    else{
        echo "<script>alert('Ops! Houve algum problema')</script>";
    }

    echo "<meta http-equiv='refresh' content='0,url=../view/dashboardAluno.php' > ";

    
}




if(isset($_POST['refuseMatch'])){

    $idAluno = $_POST['refuseMatch'];
    $idProfessor = $_SESSION['id'];




    if($controller->refuseMatch($idAluno, $idProfessor)){

        echo "<script>alert('Match recusado com sucesso.')</script>";
    }
    else{
        echo "<script>alert('Ops! Match não recusado, houve algum problema')</script>";

    }


    echo "<meta http-equiv='refresh' content='0,url=../view/dashboardProfessor.php' > ";

}


if(isset($_GET['logoff'])){

    unset($_SESSION['email']);
    header("Location:../view/home.php");

}