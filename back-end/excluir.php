<?php

include "conexao.php";

$id = $_GET["id"];

$sql = "SELECT * FROM pedidos WHERE id = $id";
$resultado = $conexao->query($sql);

if ($resultado->num_rows == 0) {
    die("Pedido não encontrado.");
}

$pedido = $resultado->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "DELETE FROM pedidos WHERE id = $id";

    if ($conexao->query($sql)) {
        header("Location: index.php");
        exit;
    } else {
        $mensagem = "Erro ao excluir o pedido.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Pedido</title>
</head>

<body>

    <h1>Excluir Pedido</h1>

    <p>
        Tem certeza que deseja excluir a música
        <strong><?php echo $pedido["musica"]; ?></strong>?
    </p>

    <?php if (isset($mensagem)) { ?>
        <p><?php echo $mensagem; ?></p>
    <?php } ?>

    <form method="POST">

        <button type="submit">
            Sim, excluir
        </button>

        <a href="index.php">
            Não, voltar
        </a>

    </form>

</body>

</html>