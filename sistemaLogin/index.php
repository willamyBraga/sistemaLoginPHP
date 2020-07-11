<?php

require_once 'db_conect.php';
session_start();

if(isset($_POST['btn-entrar'])):
    $erros = array();
    $login = mysqli_escape_string($conexao, $_POST['login']);
    $senha = mysqli_escape_string($conexao, $_POST['senha']);

    if(empty($login) or empty($senha)):
        $erros[] = "<li> O Campo login/senha precisa ser preenchido </li>";
    else:
        $sql = "SELECT login FROM usuarios WHERE login = '$login'";
        $result = mysqli_query($conexao, $sql);

        if(mysqli_num_rows($result) > 0):
            $senha = md5($senha);
            $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
            $result = mysqli_query($conexao, $sql);

            if(mysqli_num_rows($result) == 1):
                $dados = mysqli_fetch_array($result);
                $_SESSION['logado'] = true;
                $_SESSION['id_usuario'] = $dados['id'];
                header('Location: home.php');
            else:
                $erros[] = "<li> Usuario ou senha não confere </li>";
            endif;
        else:
            $erros[] = "<li> Usuario não existe </li>";
        endif;
    
    endif;

endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Login</h1>
    <?php
        if(!empty($erros)):
            foreach($erros as $erro):
                echo $erro;
            endforeach;
        endif;
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        Login: <input type="text" name="login"><br>
        Senha: <input type="password" name="senha" id=""><br>
        <button type="submit" name="btn-entrar">Entrar</button>
    </form>
</body>
</html>