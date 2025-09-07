<?php
session_start();
require 'perguntas.php';

// Inicializa quiz
if (!isset($_SESSION['indice'])) {
    $_SESSION['indice'] = 0;
    $_SESSION['pontuacao'] = 0;
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$feedback = null;

if ($method === 'POST') {
    $resposta = $_POST['resposta'] ?? -1;

    // Confere resposta
    if (
        isset($perguntas[$_SESSION['indice']]['gabarito']) &&
        $resposta == $perguntas[$_SESSION['indice']]['gabarito']
    ) {
        $_SESSION['pontuacao']++;
        $feedback = "✅ Resposta correta!";
    } else {
        $gabarito = $perguntas[$_SESSION['indice']]['alternativas'][$perguntas[$_SESSION['indice']]['gabarito']];
        $feedback = "❌ Resposta errada! A correta era: <strong>$gabarito</strong>";
    }

    // Marca que foi respondida
    $_SESSION['respondida'] = true;
} else {
    $_SESSION['respondida'] = false;
}

$indice = $_SESSION['indice'];
$pergunta = $perguntas[$indice];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Mini Quiz Vasco</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
<div class="quiz-container">
    <h1>Quiz sobre o Vasco</h1>

    <?php if ($_SESSION['respondida'] ?? false): ?>
        <p><?= $feedback ?></p>
        <form method="post" action="index.php">
            <button type="submit" name="proxima">Próxima</button>
        </form>
        <?php
        // Quando clica em "Próxima", avança a questão
        if (isset($_POST['proxima'])) {
            $_SESSION['indice']++;
            if ($_SESSION['indice'] >= count($perguntas)) {
                header("Location: resultado.php");
                exit();
            }
            $_SESSION['respondida'] = false;
            header("Location: index.php");
            exit();
        }
        ?>
    <?php else: ?>
        <form id="quizForm" method="POST" action="index.php">
            <p><?= htmlspecialchars($pergunta['pergunta']) ?></p>
            <?php foreach ($pergunta['alternativas'] as $i => $alt): ?>
                <label class="option">
                    <input type="radio" name="resposta" value="<?= $i ?>">
                    <?= htmlspecialchars($alt) ?>
                </label><br>
            <?php endforeach; ?>
            <button type="submit">Responder</button>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
