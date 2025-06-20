<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $data = $_POST["data"];
    $descricao = $_POST["descricao"];
    $usuario = $_SESSION["usuario"]; // Captura o nome do usuário logado

    $foto = "";
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $pastaDestino = "uploads/";
        if (!is_dir($pastaDestino)) {
            mkdir($pastaDestino, 0755, true); // Cria a pasta se não existir
        }

        $nomeArquivo = uniqid() . '_' . basename($_FILES["foto"]["name"]);
        $caminhoCompleto = $pastaDestino . $nomeArquivo;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminhoCompleto)) {
            $foto = $caminhoCompleto;
        }
    }

    $conn = new mysqli("localhost", "root", "", "eventos_db");
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Erro de conexão: " . $conn->connect_error);
    }

    // Atualizado para incluir o campo 'usuario'
    $sql = "INSERT INTO eventos (nome, data, descricao, foto, usuario) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nome, $data, $descricao, $foto, $usuario);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    header("Location: eventos.php");
    exit();
}
?>
