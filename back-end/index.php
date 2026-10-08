<?php

include "conexao.php";

$busca = $_GET["busca"] ?? "";
$prioridade = $_GET["prioridade"] ?? "";

$sql = "SELECT * FROM pedidos 
        WHERE (musica LIKE '%$busca%' 
        OR artista LIKE '%$busca%')";

if ($prioridade != "") {
    $sql .= " AND prioridade = '$prioridade'";
}

$resultado = $conexao->query($sql);
$total = $resultado->num_rows;

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fila de Músicas</title>
    <link rel="stylesheet" href="../front-end/css/style.css">
</head>

<body>

    <h1>🎵 Fila de Músicas</h1>

    <p class="subtitulo">Organizador de pedidos do Spotify</p>
    <p class="contador">
    <?php echo $total; ?> pedido(s) na fila
</p>
    <a href="cadastrar.php" class="botao-cadastrar">+ Cadastrar música</a>
    <form method="GET" class="filtros">

        <input
            type="text"
            name="busca"
            placeholder="Pesquisar música ou artista"
            value="<?php echo $busca; ?>"
        >

        <select name="prioridade">
            <option value="">Todas as prioridades</option>
            <option value="Baixa" <?php if ($prioridade == "Baixa") echo "selected"; ?>>Baixa</option>
            <option value="Normal" <?php if ($prioridade == "Normal") echo "selected"; ?>>Normal</option>
            <option value="Alta" <?php if ($prioridade == "Alta") echo "selected"; ?>>Alta</option>
        </select>

        <button type="submit">Pesquisar</button>

        <a href="index.php">Limpar filtros</a>

    </form>

    <hr>

    <?php if ($total == 0) { ?>

    <div class="vazio">
        <h2>Nenhuma música encontrada</h2>
        <p>Cadastre uma música ou altere os filtros da pesquisa.</p>
    </div>

    <?php } else { ?>

    <?php while ($pedido = $resultado->fetch_assoc()) { ?>

        <div class="card">
            <h2><?php echo $pedido["musica"]; ?></h2>

            <p>Artista: <?php echo $pedido["artista"]; ?></p>

            <p>Quem pediu: <?php echo $pedido["solicitante"]; ?></p>

           <p class="prioridade <?php echo strtolower($pedido["prioridade"]); ?>">
            Prioridade: <?php echo $pedido["prioridade"]; ?>
            </p>

            <a href="visualizar.php?id=<?php echo $pedido["id"]; ?>">
                Visualizar
            </a>

            <a href="editar.php?id=<?php echo $pedido["id"]; ?>">
                Editar
            </a>

            <a class="botao-excluir" href="excluir.php?id=<?php echo $pedido["id"]; ?>">
            Excluir
            </a>
        </div>

        <hr>

    <?php } ?>
    <?php } ?>

</body>
</html>