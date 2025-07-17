<!-- app/Views/comunidad/editar.php -->
<?= $this->extend('layout'); ?> <!-- Extiende el layout base -->

<?= $this->section('content'); ?> <!-- Contenido específico de la página -->

<h2>Editar Experiencia</h2>

<!-- Formulario para editar una experiencia -->
<form action="<?= base_url('comunidad/editar/' . $experiencia['id']); ?>" method="post" enctype="multipart/form-data">
    <label for="titulo">Título</label>
    <input type="text" name="titulo" value="<?= esc($experiencia['titulo']); ?>" required>

    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" required><?= esc($experiencia['descripcion']); ?></textarea>

    <label for="imagen">Imagen</label>
    <input type="file" name="imagen">

    <label for="precio">Precio</label>
    <input type="text" name="precio" value="<?= esc($experiencia['precio']); ?>" required>

    <label for="cupo">Cupo disponible</label>
    <input type="number" name="cupo" value="<?= esc($experiencia['cupo']); ?>" required>

    <label for="estado">Estado</label>
    <select name="estado">
        <option value="pendiente" <?= $experiencia['estado'] == 'pendiente' ? 'selected' : ''; ?>>Pendiente</option>
        <option value="aprobada" <?= $experiencia['estado'] == 'aprobada' ? 'selected' : ''; ?>>Aprobada</option>
        <option value="rechazada" <?= $experiencia['estado'] == 'rechazada' ? 'selected' : ''; ?>>Rechazada</option>
        <option value="cancelada" <?= $experiencia['estado'] == 'cancelada' ? 'selected' : ''; ?>>Cancelada</option>
    </select>

    <label for="fecha_inicio">Fecha de inicio</label>
    <input type="datetime-local" name="fecha_inicio" value="<?= esc($experiencia['fecha_inicio']); ?>" required>

    <button type="submit">Actualizar Experiencia</button>
</form>

<?= $this->endSection(); ?> <!-- Fin de la sección de contenido -->
