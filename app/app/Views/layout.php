<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SUMAQ VIAJES</title>
    <style>
        /* Estilos generales */
        :root {
            /* Colores base */
            --primary-base: #96AFFF;  /* Color principal que proporcionaste */
            --primary-100: #E1E9FF;   /* Versión muy clara (10%) */
            --primary-200: #C2D4FF;   /* Versión clara (20%) */
            --primary-300: #A3BEFF;   /* Versión medio-clara */
            --primary-400: #84A9FF;   /* Versión medio */
            --primary-500: #96AFFF;   /* Color base */
            --primary-600: #7895E5;   /* Versión medio-oscura */
            --primary-700: #5A7BCB;   /* Versión oscura */
            --primary-800: #3C61B1;   /* Versión muy oscura */
            --primary-900: #1E4797;   /* Versión más oscura */

            /* Colores para la interfaz */
            --primary-color: var(--primary-500);       /* Color principal */
            --primary-light: var(--primary-300);       /* Para fondos claros */
            --primary-dark: var(--primary-700);        /* Para textos y elementos oscuros */
            --primary-hover: var(--primary-400);       /* Para efectos hover */
            --primary-active: var(--primary-600);      /* Para elementos activos */
            
            /* Colores complementarios */
            --accent-color: #FFA596;  /* Coral/naranja suave (complementario) */
            --success-color: #4CC9A7;  /* Verde turquesa */
            --warning-color: #FFBC42;  /* Amarillo mostaza */
            --error-color: #FF5C5C;    /* Rojo coral */
            
            /* Escala de grises */
            --gray-100: #F8F9FA;
            --gray-200: #E9ECEF;
            --gray-300: #DEE2E6;
            --gray-400: #CED4DA;
            --gray-500: #ADB5BD;
            --gray-600: #6C757D;
            --gray-700: #495057;
            --gray-800: #343A40;
            --gray-900: #212529;
            
            /* Variables de aplicación */
            --sidebar-width: 250px;
            --background-color: var(--gray-100);
            --text-color: var(--gray-900);
            --text-light: var(--gray-600);
            --border-color: var(--gray-300);
            
            /* Sombras */
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.15);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.18);
            
            /* Bordes */
            --border-radius-sm: 4px;
            --border-radius-md: 8px;
            --border-radius-lg: 12px;
            
            /* Transiciones */
            --transition-fast: 0.15s ease;
            --transition-normal: 0.3s ease;
            --transition-slow: 0.45s ease;
        }
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* Header con gradiente */
        header {
            background: linear-gradient(135deg, var(--primary-light), var(--primary-color), var(--primary-dark));
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 100;
            height: 60px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        /* Menú Lateral */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--primary-dark);
            position: fixed;
            top: 0;
            left: calc(-1 * var(--sidebar-width));
            transition: all 0.3s ease-out;
            padding-top: 80px;
            overflow-y: auto;
            z-index: 90;
            box-shadow: 2px 0 15px rgba(0,0,0,0.1);
        }

        .sidebar.open {
            left: 0;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            border-radius: 6px;
            margin: 8px 15px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            background-color: rgba(255,255,255,0.1);
            backdrop-filter: blur(5px);
            position: relative;
            overflow: hidden;
        }

        .sidebar a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: all 0.5s ease;
        }

        .sidebar a:hover {
            background-color: rgba(255,255,255,0.2);
            transform: translateX(10px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .sidebar a:hover::before {
            left: 100%;
        }

        .sidebar a.active {
            background-color: rgba(0,0,0,0.15);
            transform: translateX(10px);
            font-weight: bold;
            border-left: 3px solid white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .sidebar a i {
            margin-right: 10px;
            font-size: 18px;
            transition: all 0.3s;
        }

        .sidebar a:hover i {
            transform: scale(1.1);
        }

        /* Overlay para móviles */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 80;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Botón del menú */
        .menu-btn {
            font-size: 24px;
            color: white;
            cursor: pointer;
            z-index: 110;
            padding: 5px;
            transition: all 0.3s;
        }

        .menu-btn:hover {
            transform: scale(1.1);
        }

        .menu-btn.open {
            transform: rotate(90deg);
        }

        /* Información de usuario */
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.3s;
            padding: 5px 10px;
            border-radius: 20px;
        }

        .user-info:hover {
            background-color: rgba(255,255,255,0.2);
        }

        .user-info img {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid white;
            transition: all 0.3s;
        }

        .user-info:hover img {
            transform: scale(1.05);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .user-info span {
            font-size: 15px;
            font-weight: 600;
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        /* Contenido principal */
        .content {
            margin-top: 60px;
            padding: 25px;
            width: 100%;
            min-height: calc(100vh - 60px);
            transition: all 0.3s;
        }

        .content.open {
            transform: translateX(var(--sidebar-width));
        }

        /* Contenedor del contenido */
        .content-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            padding: 25px;
        }

        /* Logo en el sidebar */
        .sidebar-logo {
            position: absolute;
            top: 50px;
            left: 0;
            width: 100%;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }

        .sidebar-logo img {
            width: 80%;
            max-width: 180px;
            height: auto;
        }

        /* Responsive */
        @media (max-width: 768px) {
            :root {
                --sidebar-width: 50%;
            }
            
            .sidebar {
                padding-top: 300px;
            }
            
            .sidebar a {
                padding: 15px 20px;
                margin: 6px 10px;
            }
            
            .content.open {
                transform: translateX(50%);
            }
            
            .content {
                padding: 15px;
            }
            
            .content-container {
                padding: 20px;
            }
        }
    </style>
    <!-- Iconos (usando Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="menu-btn" onclick="toggleMenu()">&#9776;</div>
        
        <div class="user-info" onclick="toggleMenu()">
            <!-- Foto de perfil -->
            <img src="<?= base_url('upload/profile_pics/' . session()->get('user_id') . '.jpg') ?>" 
                 alt="Foto de perfil" 
                 onError="this.src='<?= base_url('upload/profile-avatar.jpg') ?>'">
            <span><?= session()->get('user_name') ?></span>
        </div>
    </header>

    <!-- Overlay -->
    <div class="overlay" onclick="toggleMenu()"></div>
    
    <!-- Sidebar -->
    <div id="mySidebar" class="sidebar">
        <!-- Logo -->
        <div class="sidebar-logo">
            <img src="<?= base_url('upload/logo.png') ?>" alt="Logo SUMAQ VIAJES">
        </div>

        <!-- Enlaces del menú lateral -->
        <a href="<?= base_url('/comunidad/experiencias') ?>" class="active">
            <i class="fas fa-compass"></i> Experiencias
        </a>
        <a href="<?= base_url('comunidad/crear-experiencia') ?>">
            <i class="fas fa-plus-circle"></i> Agregar Experiencia
        </a>
        <a href="<?= base_url('/comunidad/editar') ?>">
            <i class="fas fa-edit"></i> Editar Experiencia
        </a>
        
    </div>

    <!-- Contenido principal -->
    <div id="main" class="content">
        <div class="content-container">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

    <script>
        // Función para abrir/cerrar el menú
        function toggleMenu() {
            const sidebar = document.getElementById("mySidebar");
            const content = document.getElementById("main");
            const btn = document.querySelector('.menu-btn');
            const overlay = document.querySelector('.overlay');
            
            sidebar.classList.toggle("open");
            content.classList.toggle("open");
            btn.classList.toggle("open");
            overlay.classList.toggle("active");
            
            // Cerrar menú al hacer clic en un enlace (en móviles)
            if (window.innerWidth <= 768) {
                document.querySelectorAll('.sidebar a').forEach(link => {
                    link.addEventListener('click', () => {
                        sidebar.classList.remove("open");
                        content.classList.remove("open");
                        btn.classList.remove("open");
                        overlay.classList.remove("active");
                    });
                });
            }
        }
    </script>

</body>
</html>
