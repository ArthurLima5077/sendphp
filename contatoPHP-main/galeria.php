<?php
require __DIR__ . '/db.php'; 


$st = $pdo->query("SELECT id, titulo, foto_path FROM sobre WHERE foto_path IS NOT NULL AND foto_path <> '' ORDER BY id DESC");
$fotos = $st->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include __DIR__ . '/header.php'; ?>

<h2>Galeria de Fotos - Sobre a Oficina</h2>

<?php if (!$fotos): ?>
    <p>Não há fotos cadastradas.</p>
<?php else: ?>
    <div style="display:flex; flex-wrap:wrap; gap:15px;">
        <?php foreach ($fotos as $foto): ?>
            <div style="text-align:center;">
                <img src="<?= e($foto['foto_path']) ?>" alt="<?= e($foto['titulo']) ?>" width="150" style="border:1px solid #ccc; padding:5px;">
                <p><?= e($foto['titulo']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


