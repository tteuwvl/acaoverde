<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = intval($_POST["id"]);
    $nome = $_POST["nome"];
    $data = $_POST["data"];
    $descricao = $_POST["descricao"];
    $usuario = $_SESSION["usuario"];

    $conn = new mysqli("localhost", "root", "", "eventos_db");
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Verifica se o evento pertence ao usuário
    $check = $conn->prepare("SELECT foto FROM eventos WHERE id = ? AND usuario = ?");
    $check->bind_param("is", $id, $usuario);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows === 0) {
        echo "Você não tem permissão para atualizar esse evento.";
        exit();
    }

    $evento = $result->fetch_assoc();
    $foto = $evento['foto'];

    // Se nova foto foi enviada
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] === 0) {
        $pasta = "uploads/";
        if (!is_dir($pasta)) {
            mkdir($pasta, 0755, true);
        }

        $nomeArquivo = uniqid() . '_' . basename($_FILES["foto"]["name"]);
        $caminho = $pasta . $nomeArquivo;

        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $caminho)) {
            $foto = $caminho;
        }
    }

    $stmt = $conn->prepare("UPDATE eventos SET nome = ?, data = ?, descricao = ?, foto = ? WHERE id = ? AND usuario = ?");
    $stmt->bind_param("ssssis", $nome, $data, $descricao, $foto, $id, $usuario);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header("Location: eventos.php");
    exit();
}
?>
