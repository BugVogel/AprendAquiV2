<?php

include '../controller/controller.class.php';


$controller = new Controller();
$controller->conectToDB();



if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['email']))
    header("Location:home.php");


$professor = $controller->getProfessor($_SESSION['email']);




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link   rel="stylesheet" href="../vendors/bootstrapcss/bootstrap.min.css" />
    <link  rel="stylesheet" href="../src/css/chat.css"/>
    <link  rel="stylesheet" href="../src/css/dashboardProfessor.css"/>
    <link   rel="stylesheet" href="../vendors/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <title>Dashboard</title>
</head>
<body>
    <?php require_once 'headerDashboard.php'?>


        <div class="row">
        
            <br><br>          
            <div class="col-md-3 col-12 containerPerfilProf "> 
                <div class="row">
                    <div class="col-12 ">
                        <br>
                        <img style="border-radius:50px;"class="rounded img-fluid" src="<?php echo $professor->getPathPicture()?>" /> 
                    </div>
                    <div class="col-12">
                    
                        <div class="col-12">
                            <div class=" offset-2 col-10">
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star checked"></span>
                                <span class="fa fa-star"></span>
                                <span class="fa fa-star"></span>
                            </div>
                        </div>
                        <p>Especialidade: <?php echo $professor->getEspecialidade()?></p>
                        <p>Email: <?php echo $professor->getEmail()?></p>
                        <p>Telefone: <?php echo $professor->getPhone()?></p>
                        <button type="button" data-target="#modalConfig" data-toggle="modal"class="btn btn-secondary btn-block">Configurações</button>

                        <div id="modalConfig" class="modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Editar informações</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="../routes/routes.php?updateProfessor">
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <label><strong>Nome</strong></label>
                                                    <input  type="text" name="name" value="<?php echo $professor->getName() ?>"class="form-control" placeholder="Nome" required/>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <label><strong>Email</strong></label>
                                                    <input  type="text" name="email" value="<?php echo $professor->getEmail() ?>" class="form-control" placeholder="Email" required/>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12 col-7">
                                                    <label><strong>Especialidade</strong></label>
                                                    <?php require_once 'especialidades.php';?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <label><strong>Telefone</strong></label>
                                                    <input  type="text" name="phone" value="<?php echo $professor->getPhone() ?>" class="form-control" placeholder="Telefone" required/>
                                                </div>
                                             
                                                
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <label><strong>Endereço</strong></label>
                                                    <input  type="text" name="address" class="form-control" value="<?php echo $professor->getAddress() ?>" placeholder="Endereço" required/>
                                                </div>
                                            </div>
                                            <br>
                                            
                                            
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <label><strong>Descrição</strong></label>
                                                    <textarea  type="text" name="description" rows="5"  class="form-control" placeholder="Descreva suas habilidades" required ><?php echo $professor->getDescription() ?></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="modal-footer">
                                                <button type="submit" name="updateProfessor" class="btn btn-primary btn-block">Salvar mudanças</button>
                                        
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 ">
                <div class="col-12"><h4>Bem vindo <?php echo $professor->getName(); ?></h4></div>
                <br>
                <div class="row">
                    <div class="col-12">
                        <div class="col-12"><h5>Acompanhe seus Matchs</h5></div>
                        <div class="col-12"><canvas id="MatchsWeek" width="400" height="200"></canvas></div>
                    </div>
                </div>
                <br><br>
                <div class="row ">
                    <div class="col-12 ">
                        <h5>Solicitações de Matchs</h5>
                    </div>
                    <?php $alunos = $controller->getMatchAlunosRequires();
                            
                            if($alunos){ ?>
                    <form method="POST" action="../routes/routes.php">
                        <div class="col-12 ">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                <div class="carousel-inner">

                                 
                                        <?php
                                            for($i=1; $i< sizeof($alunos); $i++){ //Primeiro item esta sempre vindo null
                                                $aluno = $alunos[$i][0];
                                                $matchMsg = $alunos[$i][1];
                                                
                                                
                                                
                                    ?>
                                    <div class="carousel-item <?php echo $i == 1 ? 'active' : '' ?>">
                                        <img class="d-block w-100"  src="<?php echo $aluno->getPicture()?>" alt="foto do estudante">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5><?php echo $aluno->getName()?></h5>
                                            <p><?php echo $matchMsg;?></p>
                                            <button type="submit"  value="<?php echo $aluno->getId(); ?>"name="match"class="btn btn-danger">Match</button>
                                            <button type="submit" value="<?php echo $aluno->getId(); ?>"name="refuseMatch"class="btn btn-secondary">Recusar</button>
                                        </div>
                                    </div>

                                    <?php   }
                                       
                                        ?>
                                            
                                        
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </form>

                    <?php }else { ?>
                    <div class="col-12 ">
                        <div class="alert alert-dark" role="alert">
                            Não existem solicitações de Match no momento.
                        </div>
                    </div>

                    <?php }?>
                </div>
                
                
            </div>
                
            <!-- Enviar e receber mensagens-->
                <div class="col-md-3 col-12 messagensContainer">
                    <div class="col-12"><h5>Mensagens <i class="fa fa-comments" aria-hidden="true"></i></h5></div>
                    <div >
                        <div class="list-group" id="list-tab" role="tablist">
                            <?php  $alunos = $controller->getStudantsConversation($professor);?>
                            <input type="hidden" id="idUsuario" value="<?php echo $professor->getId()?>" />
                            <?php if($alunos){
                                    for($i=0; $i<sizeof($alunos); $i++){ ?>
                                        <a class="<?php echo  $alunos[$i]->getIsMatch() ? "isMatch" : "" ?> list-group-item list-group-item-action borderRadius " id="list-home-list" data-target="#modal<?php echo $i?>" data-toggle="modal" href="#" role="tab" aria-controls="home"><?php echo $alunos[$i]->getName()?></a>
                                        
                                    <div style="color:black" id="modal<?php echo $i?>"class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                               
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Chat de negociação com <?php echo $alunos[$i]->getName()?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="offset-1 col-10">
                                                            <h5>Mensagem inicial do estudante: <br></h5>
                                                            <p style="text-align:justify"><?php echo $alunos[$i]->getFirstMessage() ?></p>
                                                        </div>
                                                    </div>
                                                    <form  class="chat">
                                                        <div class="row">
                                                            <div class="offset-1 col-10">
                                                                <div id="messages<?php echo $alunos[$i]->getId() ?>" class="messages pre-scrollable">   </div>
                                                            </div>
                                                            <input type="hidden" name="idAuth" value="<?php echo $professor->getId()?>"/>
                                                            <input type="hidden" name="idDestiny" value="<?php echo $alunos[$i]->getId()?>"/>
                                                            <input type="hidden" name="nameAuth"  value="<?php echo $professor->getName()?>"/>
                                                            <input type="hidden" name="nameDestiny"  value="<?php echo $alunos[$i]->getName()?>"/>
                                                        </div>
                                                        <br>

                                                        <div class="row">

                                                            <div class="offset-1 col-10">
                                                                <div class="input-group mb-3">
                                                                    <textarea name="message" type="text" class="form-control" placeholder="Enviar uma mensagem de Match" ></textarea>
                                                                    <div class="input-group-append">
                                                                        <button style="background-color:#ddd;border:none" class="btn btn-outline-secondary"  type="submit">Enviar</button>
                                                                    </div>
                                                                </div>
                                                                <br><br>
                                                            </div>
                                                            
                                                        </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php }?>
                                <?php } else {?>
                                <div class="col-12 ">
                                    <div class="alert alert-dark" role="alert">
                                        Não existem conversações no momento.
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            <!-- Fim de Enviar e receber mensagens-->


        </div>
        <!-- Fim da row principal -->
       
    


</body>


<script src="../chart/node_modules/chart.js/dist/Chart.js"></script>
<script src="../vendors/js/jquery/jquery.min.js"></script>
<script src ="../vendors/js/bootstrapjs/bootstrap.min.js"></script> 
<script src="../vendors/js/socket/socket.io.js"></script>
<script src="../src/js/chat.js"></script>


<script>
    var ctx = $('#MatchsWeek');




    var chartDataMatchs = {
    labels: ["S", "T", "Q", "Q", "S", "S", "D"],
    datasets: [{
        data: [10, 5, 2, 1,2,8,4],
        backgroundColor: [
           '#6ffd8c',
             '#36a2eb',
            '#cc65fe',
            '#ffce56',
            '#6ffd8c',
            '#36a2eb',
            '#6ffd8c',
         

        ]
       
    }],
   
    };

    var matchWeekChart = new Chart(ctx,{

        type: 'line',
        data: chartDataMatchs,
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                    beginAtZero: false
                    }
                }]
                },
                legend: {
                display: false
                }
        },
        

    })

  

</script>

</html>