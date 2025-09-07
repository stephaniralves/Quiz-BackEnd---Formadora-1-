<?php

session_start();

$pontuacao = $_SESSION['pontuacao'] ?? 0;
$total = $_SESSION['indice'] ?? 0;

session_destroy();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado - Quiz Vasco</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<div class="quiz-container">
    <h1>Fim do Quiz!</h1>
    <p>Sua pontuação: <strong><?= $pontuacao ?> / <?= $total ?></strong></p>
    <a href="index.php" onclick="return confirmarReinicio();">
        <button>Reiniciar Quiz</button>
    </a>
</div>
</body>
</html>

