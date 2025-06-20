<?php
$conn = new mysqli("localhost", "root", "", "eventos_db");
?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AçãoVerde</title>

  <link rel="shortcut icon" href="img/iconsite.png">
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
  <header class="header">
    <img src="img/pgog.png" alt="Logo AçãoVerde" class="logo">
    <div class="login-container">
      <a href="#sobrenos" class="link">Sobre Nós</a>
      <a href="#eventos2" class="link">Eventos</a>
      <a href="login.html" class="login"><i class="fas fa-user"></i> Login</a>
      <a href="cadastro.html" class="login"><i class="fas fa-user"></i> Cadastrar-se</a>
    </div>
  </header>

  <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="img/c01.jpg" class="d-block w-100" alt="Imagem 1">
      </div>
      <div class="carousel-item">
        <img src="img/c02.jpg" class="d-block w-100" alt="Imagem 2">
      </div>
      <div class="carousel-item">
        <img src="img/c03.jpg" class="d-block w-100" alt="Imagem 3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
  </div>

  <div class="Ajude-nos">
    <h1>Ajude-nos a cuidar do nosso meio ambiente</h1>
    <p>Para isso:</p>
  </div>

  <div id="evento" class="cards-container">
    <div class="cards-row">
      <div class="card">
        <h3>🌱 Preserve as árvores</h3>
      </div>
      <div class="card">
        <h3>🚿 Reduzir o consumo de água</h3>
      </div>
      <div class="card">
        <h3>🗑️ Cuidar bem do seu lixo</h3>
      </div>
    </div>
    <div class="cards-row">
      <div class="card">
        <h3>♻️ Reutilize, reaproveite e recicle tudo o que for possível</h3>
      </div>
      <div class="card">
        <h3>🔌 Reduzir o consumo de energia elétrica</h3>
      </div>
      <div class="card">
        <h3>🦜 Defender a biodiversidade</h3>
      </div>
    </div>

    <!-- Eventos cadastrados dinamicamente -->
     <h2 class="mt-4 mb-3">🌎 Nossos Eventos</h2>
    <div id="eventos2" class="container">
      <div class="row">
        <?php
        $sql = "SELECT * FROM eventos ORDER BY data DESC";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
          echo "<div class='col-md-4 mb-4'>";
          echo "<div class='card h-100'>";
          if ($row['foto']) {
            echo "<img src='" . htmlspecialchars($row['foto']) . "' class='card-img-top' alt='Evento'>";
          } else {
            echo "<img src='img/caps01.jpg' class='card-img-top' alt='Imagem padrão'>";
          }
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'>" . htmlspecialchars($row['nome']) . "</h5>";
          echo "<p class='card-text'><strong>Data:</strong> " . $row['data'] . "</p>";
          echo "<p class='card-text'>" . nl2br(htmlspecialchars($row['descricao'])) . "</p>";
          echo "<a href='#' class='btn btn-success'>Participar do Evento</a>";
          echo "</div></div></div>";
        }

        $conn->close();
        ?>
      </div>
    </div>
  </div>

  <section class="section">
    <div class="image">
      <img src="img/mata-atlantica-atlantic-forest-i.png" alt="">
    </div>
    <div class="content">
      <h1>A Importância de Preservar o Meio Ambiente</h1>
      <p><p>Preservar o meio ambiente significa proteger esses recursos para as gerações atuais e futuras. Entre as principais ações para a preservação ambiental, destacam-se o uso consciente da água e da energia, a reciclagem de materiais, a redução da emissão de poluentes e o respeito às áreas de preservação ambiental.</p></p>
    </div>
  </section>

  <section class="section reverse">
    <div class="image">
      <img src="img/planet-earth-on-a-green-backgrou.png" alt="">
    </div>
    <div class="content">
      <h1>Por que é importante se unir ao meio ambiente?</h1>
 <p>Preservar o meio ambiente significa proteger esses recursos para as gerações atuais e futuras. Entre as principais ações para a preservação ambiental, destacam-se o uso consciente da água e da energia, a reciclagem de materiais, a redução da emissão de poluentes e o respeito às áreas de preservação ambiental.</p>
    </div>
  </section>

  <section id="sobrenos" class="sobre">
    <h2>Sobre o AçãoVerde</h2>
    <p>O AçãoVerde é uma iniciativa dedicada à preservação ambiental e ao desenvolvimento sustentável. Nosso objetivo é conscientizar e engajar pessoas na proteção da natureza, promovendo ações que fazem a diferença.</p>
  </section>

  <footer>
    <div class="footer-container">
      <div class="footer-links">
        <h3>Links Úteis</h3>
        <ul>
          <li><a href="#">Política de Privacidade</a></li>
          <li><a href="#">Termos de Uso</a></li>
          <li><a href="#">Suporte</a></li>
        </ul>
      </div>
      <div class="footer-social">
        <h3>Redes Sociais</h3>
        <div class="social-icons">
          <a href="#"><img src="img/facebook-new.png" alt="Facebook" class="social-icon-img"></a>
          <a href="#"><img src="img/instagram-new.png" alt="Instagram" class="social-icon-img"></a>
        </div>
      </div>
    </div>
    <div class="copyright">
      © 2025 Todos os direitos reservados.
    </div>
  </footer>
</body>
</html>
