<!-- app/Views/profile.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil - SUMAQ VIAJES</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .profile-image {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            font-size: 18px;
        }

        .profile-info h3 {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="profile-header">
        <div class="profile-image">
            <img src="/uploads/<?= $user['foto_perfil'] ?>" alt="Foto de perfil">
        </div>
        <div class="profile-info">
            <h3><?= $user['nombre'] ?></h3>
            <p>Tipo de usuario: <?= $user['tipo_usuario'] ?></p>
        </div>
    </div>
</body>
</html>
