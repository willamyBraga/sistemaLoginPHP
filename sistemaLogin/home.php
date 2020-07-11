<?php
require_once 'db_conect.php';

session_start();

if(!isset($_SESSION['logado'])):
    header('Location: index.php');
endif;

$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$result = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_array($result);
mysqli_close($conexao);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Restrita</title>
</head>
<body>
    <h1>Olá <?php echo $dados['nome']; ?></h1>

    <a href="sair.php">sair</a>
</body>
</html>