<?php
    require_once('app/Models/Usuario.php');
    require_once('app/Controllers/ControllerUsuario.php');

    $usuarioDao = new ControllerUsuario();
    
    if(!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['idade'])){
        $usuario = new Usuario($_POST['nome'], $_POST['cpf'],$_POST['idade']);
        
        //var_dump($usuario); //Obter informações da variável
        $usuario ->validarDados();
        $usuarioDao->createUsuario($usuario);
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
                    <input type="text" name="nome" class="form-control form-control-lg bg-light" value="" required>
                </div>

                <div class="mb-3">
                    <label for="cpf" class="form-label fw-bold">CPF:</label>
                    <input type="text" name="cpf" class="form-control form-control-lg bg-light" value="" required>
                </div>

                <div class="mb-3">
                    <label for="idade" class="form-label fw-bold">Idade:</label>
                    <input type="text" name="idade" class="form-control form-control-lg bg-light" value="" required>
                </div>

                <div>
                    <label for="bob">
                    <img src="presidente_1.PNG" class="img-thumbnail" alt="bob" style="width: 50%; margin-bottom: 15px;">
                    <input class="ml-1" type="radio" name="voto" id="bob" value="option1">Bob, a esponja
                    </label>
                </div>

                <div>
                    <label for="estrela">
                    <img src="presidente_2.PNG" class="img-thumbnail" alt="patrick" style="width: 50%; margin-bottom: 15px;">
                    <input type="radio" name="voto" id="estrela" value="option2">Patrick, a estrela
                    </label>
                </div>
            </div>
            <div class="d-grid mb-4">
                <input type="submit" value="Calcular" class="btn btn-outline-primary btn-lg">
            </div>

        </form>
    </div>

    <?php if($usuarioDao-> readUsuario()){ ?>
        <div class="container">
            <h1>Registros</h1>
            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Cpf</th>
                        <th>Idade</th>
                        <th>Data de Registro</th>                
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarioDao->readUsuario() as $usuarios){ ?>
                    <tr>
                        <td><?php echo $usuarios["nome"]; ?></td>
                        <td><?php echo $usuarios["cpf"]; ?></td>
                        <td><?php echo $usuarios["idade"]; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($usuarios["data_registro"])); ?></td>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php } ?>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html> 