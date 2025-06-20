<?php
session_start();

// Verifica se os dados foram enviados via POST
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die("Por favor, preencha o formulário corretamente.");
}

$usuario = trim(strtolower($_POST['username']));
$senha = trim($_POST['password']);

// Verifica se os campos não estão vazios
if (empty($usuario) || empty($senha)) {
    die("Usuário e senha são obrigatórios.");
}

// Conecta ao banco de dados
$conn = new mysqli("localhost", "root", "", "usuarios");
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Busca o usuário pelo e-mail
$sql = "SELECT * FROM cadastros WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se encontrou o usuário
if ($result && $result->num_rows === 1) {
    $row = $result->fetch_assoc();

    // Verifica a senha digitada com o hash do banco
    if (password_verify($senha, $row['senha'])) {
        $_SESSION['usuario'] = $row['nome'];
        header("Location: eventos.php");
        exit();
    } else {
        // Senha incorreta
        echo "<div style='color: red; font-weight: bold;'>❌ Senha incorreta.</div>";
    }
} else {
    // Usuário não encontrado
    echo "<div style='color: red; font-weight: bold;'>❌ Usuário não encontrado.</div>";
    echo "<div style='margin-top: 5px;'>Você digitou: <strong>" . htmlspecialchars($usuario) . "</strong></div>";
}

// Encerra a conexão
$stmt->close();
$conn->close();
?>
