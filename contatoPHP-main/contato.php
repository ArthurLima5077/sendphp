<?php 
require __DIR__ . '/db.php';
require __DIR__ . '/helpers.php';

$erro = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['acao'] ?? '') === 'criar') {
    $titulo = trim($_POST['titulo'] ?? '');

    if ($titulo !== '') {
        $st = $pdo->prepare("INSERT INTO contato (titulo) VALUES (:t)");
        $st->execute([':t' => $titulo]);
        header("Location: contato.php");
        exit;
    } else {
        $erro = "O título não pode ficar vazio.";
    }
}
?>

<?php include __DIR__ . '/header.php'; ?>

<h2> Contato </h2>

<?php if ($erro): ?>
  <p style="color: darkred;"><?= e($erro) ?></p>
<?php endif; ?>

<form method="post" autocomplete="off">
  <input type="hidden" name="acao" value="criar">
  <p>
    Título:<br>
    <input type="text" name="titulo" required maxlength="255">
  </p>
  <p> <button class="btn waves-effect waves-light" type="submit">
    Salvar
   </button>
  </p>
</form>

<?php include __DIR__ . '/footer.php'; ?>

