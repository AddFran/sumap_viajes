<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Imágenes de la Experiencia</title>
</head>
<body>
    <h2>Imágenes asociadas a la experiencia #2</h2>

    <?php if (empty($imagenes)): ?>
        <p>No hay imágenes registradas para esta experiencia.</p>
    <?php else: ?>
        <?php foreach ($imagenes as $img): ?>
            <div style="display:inline-block; margin:10px; text-align:center;">
                <img src="<?= base_url($img['ruta_imagen']) ?>" alt="Imagen experiencia" width="200"><br>
                <small><?= esc($img['descripcion'] ?? '') ?></small>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <br><br>
    <a href="<?= base_url('comunidad/menu') ?>"><button>← Volver al Menú</button></a>
</body>
</html>
