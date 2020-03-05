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

    <link  rel="stylesheet" href="../src/css/dashboardProfessor.css"/>
    <link   rel="stylesheet" href="../vendors/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <title>Dashboard</title>
</head>
<body>
    <?php require_once 'headerDashboard.php'?>


        <div class="row">
        
            <br><br>          
            <div class="col-3 containerPerfilProf "> 
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
                        <button class="btn btn-secondary btn-block">Configurações</button>
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="col-6">
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
                                            <button type="button" class="btn btn-light">Negociar</button>
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
                
            <div class="col-3 messagensContainer">
                    <div class="col-12"><h5>Mensagens <i class="fa fa-comments" aria-hidden="true"></i></h5></div>
                    <div class="overflow-auto">
                        <div class="list-group" id="list-tab" role="tablist">
                            <a class="isMatch list-group-item list-group-item-action " id="list-home-list" data-target="#" data-toggle="modal" href="#" role="tab" aria-controls="home">João Fulano</a>
                        </div>
                    </div>
            </div>
        </div>


    


</body>


<script src="../chart/node_modules/chart.js/dist/Chart.js"></script>
<script src="../vendors/js/jquery/jquery.min.js"></script>
<script src ="../vendors/js/bootstrapjs/bootstrap.min.js"></script> 


<script>
    var ctx = $('#MatchsWeek');




    var chartDataMatchs = {
    labels: ["S", "T", "Q", "Q", "S", "S", "D"],
    datasets: [{
        data: [45, 25, 20, 10,25,50,10],
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