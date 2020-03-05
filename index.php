<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AprendAqui</title>
</head>
<body>

    <?php 
        session_start();

        if(isset($_SESSION['auth'])){

            if($_SESSION['type_user'] == 'aluno'){
                header("Location: view/dashBoardAluno.php");
            }
            else{

                header("Location: view/dashBoardProfessor.php");
            }
            
        }
        else{
            header("Location: view/home.php");
        }


    ?>

    
</body>
</html>