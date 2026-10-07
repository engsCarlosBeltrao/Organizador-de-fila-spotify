<?php

include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $musica = $_POST["musica"];
    $artista = $_POST["artista"];
    $solicitante = $_POST["solicitante"];
    $prioridade = $_POST["prioridade"];

    if (empty($musica) || empty($artista) || empty($solicitante)) {
        $mensagem = "Preencha todos os campos obrigatórios.";
    } else {

        $sql = "INSERT INTO pedidos (musica, artista, solicitante, prioridade)
                VALUES ('$musica', '$artista', '$solicitante', '$prioridade')";

        if ($conexao->query($sql)) {
            $mensagem = "Música cadastrada com sucesso!";
        } else {
            $mensagem = "Erro ao cadastrar música.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Música</title>
    <link rel="stylesheet" href="../front-end/css/style.css">
</head>

<body>

    <h1>Cadastrar Música</h1>

    <?php if (isset($mensagem)) { ?>
        <p><?php echo $mensagem; ?></p>
    <?php } ?>

    <form method="POST">

        <label for="musica">Nome da música:</label>
        <input type="text" id="musica" name="musica">

        <br><br>

        <label for="artista">Artista:</label>
        <input type="text" id="artista" name="artista">

        <br><br>

        <label for="solicitante">Quem pediu:</label>
        <input type="text" id="solicitante" name="solicitante">

        <br><br>

        <label for="prioridade">Prioridade:</label>
        <select id="prioridade" name="prioridade">
            <option value="Baixa">Baixa</option>
            <option value="Normal" selected>Normal</option>
            <option value="Alta">Alta</option>
        </select>

        <br><br>

        <button type="submit">Cadastrar música</button>

    </form>

    <br>

    <a href="back-end/index.php">Voltar para a fila</a>

</body>
</html>