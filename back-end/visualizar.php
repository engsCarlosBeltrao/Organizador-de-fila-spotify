<?php

include "conexao.php";

$id = $_GET["id"];

$sql = "SELECT * FROM pedidos WHERE id = $id";
$resultado = $conexao->query($sql);

if ($resultado->num_rows == 0) {
    die("Pedido não encontrado.");
}

$pedido = $resultado->fetch_assoc();

$youtube = $pedido["youtube"] ?? "";
$video_id = "";

if (!empty($youtube)) {

    if (strpos($youtube, "watch?v=") !== false) {

        parse_str(parse_url($youtube, PHP_URL_QUERY), $parametros);

        if (isset($parametros["v"])) {
            $video_id = $parametros["v"];
        }

    } elseif (strpos($youtube, "youtu.be/") !== false) {

        $video_id = explode("youtu.be/", $youtube)[1];

        $video_id = explode("?", $video_id)[0];

    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Visualizar Pedido</title>

    <link rel="stylesheet" href="../front-end/css/style.css">
</head>

<body>
    <header class="cabecalho">
    <img src="../img/banner.png" alt="Beltrao Organizador de Fila">
    </header>
    
    <h1>Pedido Musical</h1>

    <div class="card">

        <h2><?php echo $pedido["musica"]; ?></h2>

        <p>
            <strong>Artista:</strong>
            <?php echo $pedido["artista"]; ?>
        </p>

        <p>
            <strong>Quem pediu:</strong>
            <?php echo $pedido["solicitante"]; ?>
        </p>

        <p>
            <strong>Prioridade:</strong>
            <?php echo $pedido["prioridade"]; ?>
        </p>

        <?php if (!empty($video_id)) { ?>

            <div class="video">
                <iframe
                    src="https://www.youtube.com/embed/<?php echo $video_id; ?>"
                    title="Vídeo da música"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
            </div>

        <?php } ?>

    </div>

    <a href="index.php" class="botao-voltar">
        ← Voltar para a fila
    </a>

</body>

</html>