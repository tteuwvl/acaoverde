<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $usuario = $_SESSION["usuario"];

    $conn = new mysqli("localhost", "root", "", "eventos_db");
    $conn->set_charset("utf8");

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Verifica se o evento pertence ao usuário
    $verifica = $conn->prepare("SELECT id FROM eventos WHERE id = ? AND usuario = ?");
    $verifica->bind_param("is", $id, $usuario);
    $verifica->execute();
    $verifica->store_result();

    if ($verifica->num_rows > 0) {
        // Pode apagar
        $delete = $conn->prepare("DELETE FROM eventos WHERE id = ?");
        $delete->bind_param("i", $id);
        if ($delete->execute()) {
            header("Location: eventos.php#form"); 
            exit();
        } else {
            echo "Erro ao deletar o evento.";
        }
        $delete->close();
    } else {
        echo "Você não tem permissão para deletar esse evento.";
    }

    $verifica->close();
    $conn->close();
}
?>
