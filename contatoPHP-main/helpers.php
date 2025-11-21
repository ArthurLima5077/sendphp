<?php
function e(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

function upload_foto(string $campo, string $destDir = 'uploads'): ?string {
  if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] === UPLOAD_ERR_NO_FILE) return null;
  if ($_FILES[$campo]['error'] !== UPLOAD_ERR_OK) return null;

  if (!is_dir($destDir)) { @mkdir($destDir, 0777, true); }
  $tmp  = $_FILES[$campo]['tmp_name'];
  $name = basename($_FILES[$campo]['name']);
  $ext  = strtolower(pathinfo($name, PATHINFO_EXTENSION));
  $permitidas = ['jpg','jpeg','png','gif','webp'];

  if (!in_array($ext, $permitidas)) return null;

  $novo = $destDir . '/' . uniqid('img_', true) . '.' . $ext;
  return move_uploaded_file($tmp, $novo) ? $novo : null;
}
