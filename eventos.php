<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

$usuario = $_SESSION['usuario'];
$conn = new mysqli("localhost", "root", "", "eventos_db");
$conn->set_charset("utf8");

// Buscar os eventos do usuário
$sql = "SELECT * FROM eventos WHERE usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Eventos</title>
  <link rel="stylesheet" href="css/styles3.css">
  <link rel="shortcut icon" href="img/iconsite.png">
</head>
<body>

  <button class="menu-button" onclick="toggleMenu()">☰ Menu</button>

  <div class="sidebar" id="sidebar">
    <button class="close-menu" onclick="toggleMenu()">✖</button>
    <h2 style="color: #28a745;">Menu</h2>
    <ul>
      <li><a href="#" class="active">📅 Meus Eventos</a></li>
      <li><a href="#" onclick="toggleForm()">Cadastrar Novo Evento</a></li>
      <li><a href="logout.php">Sair</a></li>
    </ul>
  </div>

  <div class="content">
    <div class="profile">
      <p><strong>👤 Usuário:</strong> <span style="color:#ffffff;"><?php echo htmlspecialchars($usuario); ?></span></p>
    </div>

    <h1 style="color: #28a745;">Bem-vindo ao Gerenciador de Eventos</h1>

    <div class="button-container">
      <button onclick="toggleForm()">Cadastrar Evento</button>
    </div>

    <div id="form-container" style="display:none;">
      <h2 style="color: #28a745;">Novo Evento</h2>
      <form id="eventForm" action="salvar_evento.php" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome do Evento:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="data">Data:</label>
        <input type="date" id="data" name="data" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao"></textarea><br><br>

        <label for="foto">Anexar Foto:</label>
        <input type="file" id="foto" name="foto"><br><br>

        <button type="submit">Cadastrar</button>
      </form>
    </div>

    <h2 style="color: #28a745;">Seus Eventos Cadastrados</h2>

    <table border="1" cellpadding="10">
      <tr>
        <th>Nome</th>
        <th>Data</th>
        <th>Descrição</th>
        <th>Foto</th>
        <th>Ações</th>
      </tr>
      <?php while ($evento = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo htmlspecialchars($evento['nome']); ?></td>
        <td><?php echo $evento['data']; ?></td>
        <td><?php echo htmlspecialchars($evento['descricao']); ?></td>
        <td>
          <?php if (!empty($evento['foto'])): ?>
            <img src="<?php echo $evento['foto']; ?>" width="100">
          <?php endif; ?>
        </td>
        <td>
          <a href="visualizar_evento.php?id=<?php echo $evento['id']; ?>">Visualizar</a> |
          <a href="editar_evento.php?id=<?php echo $evento['id']; ?>">Editar</a>
          <form method="POST" action="deletar_evento.php" style="display:inline;" onsubmit="return confirm('Excluir este evento?');">
            <input type="hidden" name="id" value="<?php echo $evento['id']; ?>">
            <button type="submit">Excluir</button>
          </form>
        </td>
      </tr>
      <?php endwhile; ?>
    </table>
  </div>

  <script>
    function toggleForm() {
      const formContainer = document.getElementById("form-container");
      formContainer.style.display = formContainer.style.display === "none" ? "block" : "none";
    }

    function toggleMenu() {
      const sidebar = document.getElementById("sidebar");
      sidebar.style.left = sidebar.style.left === "0px" ? "-300px" : "0px";
    }

    // Se estiver vindo de deletar_evento.php#form, abrir o formulário
    window.addEventListener("load", function () {
      if (window.location.hash === "#form") {
        toggleForm();
      }
    });
  </script>

</body>
</html>
