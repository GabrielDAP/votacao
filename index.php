<?php
    require_once('app/Models/Usuario.php');
    require_once('app/Controllers/ControllerUsuario.php');

    $usuarioDao = new ControllerUsuario();
    
    if(!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['idade']) && !empty($_POST['voto'])){
        $usuario = new Usuario($_POST['nome'], $_POST['cpf'],$_POST['idade'],$_POST['voto']);
        
        //var_dump($usuario); //Obter informações da variável
        $usuario ->validarDados();

        if (empty($usuario->erro)) {
            if ($usuario->getMsg() == "Votação efetuada com sucesso!") {
                $class = "alert-success";
                $usuarioDao->createUsuario($usuario);
            }else {
                $class = "alert-danger";
            }
        }
    }


    
    

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de IMC</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-5">
    <div class="container border border-2 rounded-4 p-4 bg-white mb-5" style="max-width: 400px;">
        <form method="POST">
            <h1 class="mb-4 text-center">Votação</h1>
            <div class="row">
                <div class="mb-3">
                    <label for="nome" class="form-label fw-bold">Nome do Eleitor:</label>
                    <input type="text" name="nome" class="form-control form-control-lg bg-light" value="" required placeholder="Digite seu nome">
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label fw-bold">CPF:</label>
                    <input type="text" name="cpf" class="form-control form-control-lg bg-light" value="" required placeholder="Digite seu CPF" minlength="11" maxlength="11">
                </div>

                <div class="mb-3">
                    <label for="idade" class="form-label fw-bold">Idade:</label>
                    <input type="text" name="idade" class="form-control form-control-lg bg-light" value="" required placeholder="Digite sua idade">
                </div>

                <div>
                    <label for="bob">
                    <img src="presidente_1.PNG" class="img-thumbnail" alt="bob" style="width: 50%; margin-bottom: 15px;">
                    <input class="ml-1" type="radio" name="voto" id="bob" value="22">Bob, a esponja
                    </label>
                </div>

                <div>
                    <label for="lula">
                    <img src="presidente_2.PNG" class="img-thumbnail" alt="lula" style="width: 50%; margin-bottom: 15px;">
                    <input type="radio" name="voto" id="lula" value="13">Lula, o Molusco
                    </label>
                </div>
            </div>
            <div class="d-grid mb-4">
                <input type="submit" value="Votar" class="btn btn-outline-primary btn-lg">
            </div>

            <?php if(isset($usuario) && empty($usuario->erro)){ ?>
            <div class="alert text-center fs-4 <?php echo $class ?>" role="alert"> 
                <span><?php echo $usuario->getMsg(); ?></span>
            </div>
            <?php } ?>
            <div class="container text-center d-grid mb-4">
                <a class="btn btn-warning btn-lg rounded-2 mb-4" href="relatorio.php" target="_blank">Relatório</a>
            </div>
        </form>
    </div>
    
    
  <!-- <?php if($usuarioDao-> readUsuario()){ ?>
        <div class="container">
            <h1>Registros</h1>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Cpf</th>
                        <th>Idade</th>
                        <th>Voto</th>   
                        <th>Data de Registro</th>   
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarioDao->readUsuario() as $usuarios){ ?>
                    <tr>
                        <td><?php echo $usuarios["nome"]; ?></td>
                        <td><?php echo $usuarios["cpf"]; ?></td>
                        <td><?php echo $usuarios["idade"]; ?></td>
                        <td><?php echo $usuarios["voto"]; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($usuarios["data_registro"])); ?></td>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?> -->

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>