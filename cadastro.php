<?php
session_start();

// Verifica se o formulário foi enviado corretamente
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta e limpa os dados do formulário
    $nome = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $senha = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Criptografa a senha
    $notificacoes = isset($_POST['notifications']) ? 1 : 0;

    // Conecta ao banco de dados
    $conn = new mysqli("localhost", "root", "", "usuarios");
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Prepara e executa o SQL de inserção
    $sql = "INSERT INTO cadastros (nome, email, senha, notificacoes) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $email, $senha, $notificacoes);

    if ($stmt->execute()) {
        echo "✅ Cadastro realizado com sucesso!";
        // Exemplo: redirecionar para a página de login
        // header("Location: login.html");
        // exit();
    } else {
        echo "❌ Erro ao cadastrar: " . $stmt->error;
    }

    // Fecha a conexão
    $stmt->close();
    $conn->close();
} else {
    echo "Acesso inválido.";
}
?>
