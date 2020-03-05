<!DOCTYPE html >
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link   rel="stylesheet" href="../vendors/bootstrapcss/bootstrap.min.css" />
    <link rel="stylesheet" href="../src/css/home.css">
    <title>AprendAqui2</title>
</head>
<body  class="bodyStyle">
<br>
<div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6">
                <div class="jumbotron" style="background-color: rgba(120, 144, 156, 0.55); color: white">
                    <div class="row">
                        <div class="offset-md-4 offset-1 col-12 col-md-7">
                            <h1>Professores</h1>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="offset-3 col-7">
                            <button type="button" data-target="#loginModal" data-toggle="modal"class="btn btn-danger btn-lg btn-block">Entrar</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="offset-3  col-7">
                            <button type="button" data-target="#cadastrarModalProfessor" data-toggle="modal"class="btn btn-primary btn-lg btn-block">Cadastre-se</button>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-12 col-sm-12 col-md-6">
                <div class="jumbotron" style="background-color: rgba(120, 144, 156, 0.55); color:white">
                    <div class="row">
                        <div class="offset-md-4 col-md-7 col-12 offset-3">
                            <h1>Alunos</h1>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="offset-3 col-7">
                            <button type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-danger btn-lg btn-block">Entrar</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="offset-3  col-7">
                            <button type="button" data-toggle="modal" data-target="#cadastrarModalAluno"class="btn btn-primary btn-lg btn-block">Cadastre-se</button>
                        </div>
                    </div>
                </div>
            </div >
        </div>
    </div>



        <!-- Modal Login-->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="titleLoginModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleLoginModal">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../routes/routes.php">
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input  type="text" name="email" class="form-control" placeholder="email" required/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input  type="password" name="password" class="form-control" placeholder="Senha" required/>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="login" class="btn btn-danger">Entrar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>


        <!-- Modal Cadastrar Professor-->
        <div class="modal fade" id="cadastrarModalProfessor" tabindex="-1" role="dialog" aria-labelledby="titleCadastroModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleCadastroModal">Cadastrar-se</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../routes/routes.php" enctype="multipart/form-data">
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input  type="text" name="name" class="form-control" placeholder="Nome" required/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input  type="text" name="email" class="form-control" placeholder="Email" required/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <?php require_once 'especialidades.php';?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <input  type="text" name="phone" class="form-control" placeholder="Telefone" required/>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input  type="text" name="cpf" class="form-control" placeholder="CPF" required/>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input  type="password" name="senha" class="form-control" placeholder="Senha" required/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input  type="text" name="address" class="form-control" placeholder="Endereço" required/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input  type="file" name="picture" class="form-control" placeholder="Adicione uma foto" required/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <textarea  type="text" rows="5" name="description" class="form-control" placeholder="Descreva suas habilidades" required></textarea>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="registerProfessor" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>



        <!-- Modal Cadastrar Aluno-->
        <div class="modal fade" id="cadastrarModalAluno" tabindex="-1" role="dialog" aria-labelledby="titleCadastroModalAluno" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titleCadastroModalAluno">Cadastrar-se</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="../routes/routes.php" enctype="multipart/form-data">
                    <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input  type="text" name="name" class="form-control" placeholder="Nome" required/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <input  type="text" name="email" class="form-control" placeholder="Email" required/>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <input  type="text" name="phone" class="form-control" placeholder="Telefone" required/>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input  type="text" name="cpf" class="form-control" placeholder="CPF" required/>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input  type="password" name="senha" class="form-control" placeholder="Senha" required/>
                                </div>
                                <div class="col-12 col-md-4">
                                    <input  type="file" name="picture" class="form-control" placeholder="Foto (Opcional)" />
                                </div>
                            </div>
                            
                           
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="registerAluno" class="btn btn-primary">Cadastrar</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    
</body>


<script src="../vendors/js/jquery/jquery.min.js"></script>
<script src ="../vendors/js/bootstrapjs/bootstrap.min.js"></script> 


</html>