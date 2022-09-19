<?php
    require_once('app/Models/Usuario.php');
    require_once('app/Controllers/ControllerUsuario.php');

    $usuarioDao = new ControllerUsuario();
    
    if(!empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['idade']) && !empty($_POST['voto'])){
        $usuario = new Usuario($_POST['nome'], $_POST['cpf'],$_POST['idade'],$_POST['voto']);
        
        //var_dump($usuario); //Obter informações da variável
        $usuario ->validarDados();

        if (empty($usuario->erro)) {
            if ($usuario->getMsg() == "Idade Inválida!") {
                $class = "alert-danger";
            } elseif ($usuario->getMsg() == "CPF Inválido!") {
                $class = "alert-danger";
            }else {
                $class = "alert-success";
                $usuarioDao->createUsuario($usuario);
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
    <title>Relatório Votação</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-5">
    <div class="container border border-2 rounded-4 p-4 bg-white mb-5" style="max-width: 400px;">
        <form method="POST">
            <h1 class="mb-4 text-center">Relatório Votação</h1>
            <div class="row">
                <div class="col-sm-6 center">
                    <img src="presidente_1.PNG" class="img-thumbnail" alt="bob" style="width: 100%; margin-bottom: 15px;">
                    <label>X Votos</label>
                </div>

                <div class="col-sm-6">
                    <img src="presidente_2.PNG" class="img-thumbnail" alt="lula" style="width: 100%; margin-bottom: 15px;">
                    <label>Y Votos</label>
                </div>
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
    <?php } ?>

    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>