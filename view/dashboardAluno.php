<?php

include '../controller/controller.class.php';


$controller = new Controller();
$controller->conectToDB();



if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['email']))
    header("Location:home.php");


$aluno = $controller->getAluno($_SESSION['email']);




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link   rel="stylesheet" href="../vendors/bootstrapcss/bootstrap.min.css" />

    <link  rel="stylesheet" href="../src/css/dashboardAluno.css"/>
    <link   rel="stylesheet" href="../vendors/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Dashboard</title>
</head>
<body>
    
    <?php require_once 'headerDashboard.php'?>

  
        <div class="row">
            <div class="col-3 containerPerfil">
                    <br>
                    <br>
          
                    <div class="col-12"><img class="perfilPic rounded"  alt="Imagem de Perfil"height="200"src="<?php echo $aluno->getPicture()  ?>"/></div>
                    <br>
                    <div class="col-12"><h6>Email: <?php echo $aluno->getEmail() ?></h6> </div>
                    <div class="col-12"><h6>Telefone: <?php echo $aluno->getPhone() ?></h6> </div>
                    <div class="col-12"><h6>Cpf: <?php echo $aluno->getCpf() ?></h6> </div>
                    <br>
                    <div class="col-12"><button class="btn  btn-block btn-secondary">Configurações</button></div>
          
            </div>
            
            <div class="col-6">
                <br>
                <br>
                <div class="col-12"><h3>Bem vindo <?php echo $aluno->getName()?></h3></div>
                <div class="container-fluid containerProfList">
                    <br>
                    <div class="col-12"><h3>Procurar Professores</h3></div>
                    <div class="col-12">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nome do Professor" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button style="background-color:#ddd;border:none" class="btn btn-outline-secondary" type="button">Procurar</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <?php require_once 'especialidades.php';?>
                    </div>
                    <br>
                    <div class="col-12">
                        <div class="overflow-auto">
                            <div class="list-group" id="list-tab" role="tablist">
                              
                                <?php $professores=  $controller->getProfessoresNotMatched();
                                    for($i=0; $i< sizeof($professores); $i++ ) { 
                                        $professor = $professores[$i];
                                        ?>
                                    <a class="list-group-item list-group-item-action " id="list-home-list" data-target="#modal<?php echo $i?>" data-toggle="modal" href="#" role="tab" aria-controls="home"><?php echo $professor->getName() . "-" .$professor->getEspecialidade(); ?></a>

                                  
                                    <div style="color:black" id="modal<?php echo $i?>"class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form method="POST" action="../routes/routes.php">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel"><?php echo $professor->getName(); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    
                                                    <div class="row">
                                                        <div class=" offset-1 col-4">
                                                            <div class="col-12">
                                                                <img src="<?php echo $professor->getPathPicture();?>" class=" img-fluid rounded "/>
                                                            </div>
                                                            <div class=" offset-2 col-10">
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star checked"></span>
                                                                <span class="fa fa-star"></span>
                                                                <span class="fa fa-star"></span>
                                                            </div>
                                                            <div class="col-12">
                                                                <h6>telefone: <?php echo $professor->getPhone() ?><h6>
                                                                <h6>email: <?php echo $professor->getEmail();?></h6>
                                                                <h6>Localização: <?php echo $professor->getAddress();?></h6>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <p> <?php echo $professor->getDescription() ?> </p>
                                                        </div>
                                                    </div>
                                                    <div class="row">

                                                        <div class="offset-1 col-10">
                                                            <!-- <div class="input-group mb-3">-->
                                                                <textarea type="text" name="mensagemMatch" class="form-control" placeholder="Enviar uma mensagem de Match" ></textarea>
                                                                <!-- <div class="input-group-append">
                                                                    <button style="background-color:#ddd;border:none" class="btn btn-outline-secondary" type="button">Enviar</button>
                                                                </div>
                                                            </div>-->
                                                            <br><br>
                                                        </div>
                                                        
                                                    </div>


                                                    <div class="modal-footer">

                                                        <button type="submit" name="solicitaMatch" value="<?php echo $professor->getId()?>"class="btn btn-lg btn-danger btn-block">Dar Match</button>
                                                    </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>

                                    <?php }?>
                             
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="col-3 messagensContainer">
                    <div class="col-12"><h5>Mensagens <i class="fa fa-comments" aria-hidden="true"></i></h5></div>
                    <div class="overflow-auto">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="isMatch list-group-item list-group-item-action " id="list-home-list" data-target="#" data-toggle="modal" href="#" role="tab" aria-controls="home">Armando Sanka</a>
                        </div>
                    </div>
            </div>




        </div>
  





</body>


<script src="../vendors/js/jquery/jquery.min.js"></script>
<script src ="../vendors/js/bootstrapjs/bootstrap.min.js"></script> 
</html>