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
    echo "Evento não encontrado ou você não tem permissão para editá-lo.";
    exit();
}

$evento = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Editar Evento</title>
</head>
<body>
  <h1>Editar Evento</h1>

  <form action="atualizar_evento.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">

    <label>Nome:</label>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($evento['nome']); ?>" required><br><br>

    <label>Data:</label>
    <input type="date" name="data" value="<?php echo $evento['data']; ?>" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao"><?php echo htmlspecialchars($evento['descricao']); ?></textarea><br><br>

    <?php if (!empty($evento['foto'])): ?>
      <p>Foto atual: <img src="<?php echo $evento['foto']; ?>" width="100"></p>
    <?php endif; ?>

    <label>Nova Foto (opcional):</label>
    <input type="file" name="foto"><br><br>

    <button type="submit">Salvar</button>
    <a href="eventos.php">Cancelar</a>
  </form>
</body>
</html>
