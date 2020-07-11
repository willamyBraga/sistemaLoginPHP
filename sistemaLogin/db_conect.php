<?php
$servidor = "localhost";
$usr = "root";
$senha = "";
$banco = "sistemaLogin";

$conexao = mysqli_connect($servidor, $usr, $senha, $banco);

if(mysqli_connect_error()):
    echo "Falha na conexão: ".mysqli_connect_error();
else:
    echo "Conexão feita com sucesso";
endif

?>