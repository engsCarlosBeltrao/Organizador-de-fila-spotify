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

    $musica = $_POST["musica"];
    $artista = $_POST["artista"];
    $solicitante = $_POST["solicitante"];
    $prioridade = $_POST["prioridade"];

    if (empty($musica) || empty($artista) || empty($solicitante)) {

        $mensagem = "Preencha todos os campos obrigatórios.";

    } else {

        $sql = "UPDATE pedidos SET
                musica = '$musica',
                artista = '$artista',
                solicitante = '$solicitante',
                prioridade = '$prioridade'
                WHERE id = $id";

        if ($conexao->query($sql)) {
            header("Location: visualizar.php?id=$id");
            exit;
        } else {
            $mensagem = "Erro ao atualizar o pedido.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pedido</title>
</head>

<body>

    <h1>Editar Pedido</h1>

    <?php if (isset($mensagem)) { ?>
        <p><?php echo $mensagem; ?></p>
    <?php } ?>

    <form method="POST">

        <label for="musica">Nome da música:</label>
        <input
            type="text"
            id="musica"
            name="musica"
            value="<?php echo $pedido["musica"]; ?>"
        >

        <br><br>

        <label for="artista">Artista:</label>
        <input
            type="text"
            id="artista"
            name="artista"
            value="<?php echo $pedido["artista"]; ?>"
        >

        <br><br>

        <label for="solicitante">Quem pediu:</label>
        <input
            type="text"
            id="solicitante"
            name="solicitante"
            value="<?php echo $pedido["solicitante"]; ?>"
        >

        <br><br>

        <label for="prioridade">Prioridade:</label>

        <select id="prioridade" name="prioridade">

            <option value="Baixa" <?php if ($pedido["prioridade"] == "Baixa") echo "selected"; ?>>
                Baixa
            </option>

            <option value="Normal" <?php if ($pedido["prioridade"] == "Normal") echo "selected"; ?>>
                Normal
            </option>

            <option value="Alta" <?php if ($pedido["prioridade"] == "Alta") echo "selected"; ?>>
                Alta
            </option>

        </select>

        <br><br>

        <button type="submit">Salvar alterações</button>

    </form>

    <br>

    <a href="index.php">Voltar para a fila</a>

</body>

</html>