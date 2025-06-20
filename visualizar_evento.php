<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: eventos.php");
    exit();
}

$id = intval($_GET['id']);
$usuario = $_SESSION['usuario'];

$conn = new mysqli("localhost", "root", "", "eventos_db");
$conn->set_charset("utf8");

$sql = "SELECT * FROM eventos WHERE id = ? AND usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id, $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Evento não encontrado ou você não tem permissão para visualizar.";
    exit();
}

$evento = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Visualizar Evento</title>
  <link rel="stylesheet" href="css/visualizar.css">
</head>
<body>
  <div class="container">
    <h1><?php echo htmlspecialchars($evento['nome']); ?></h1>

    <p><strong>📅 Data:</strong> <?php echo $evento['data']; ?></p>
    <p><strong>📝 Descrição:</strong><br><?php echo nl2br(htmlspecialchars($evento['descricao'])); ?></p>

    <?php if (!empty($evento['foto'])): ?>
      <div class="imagem">
        <img src="<?php echo $evento['foto']; ?>" alt="Foto do evento">
      </div>
    <?php endif; ?>

    <a href="eventos.php" class="botao">← Voltar</a>
  </div>
</body>
</html>
