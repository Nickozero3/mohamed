<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cellstore</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
  />
  <link rel="shortcut icon" href="apple.ico" type="image/x-icon" />
</head>
<body>
  <header class="header">
    <div class="logo">
      <i class="fab fa-apple" style="font-size: 32px"></i>
      <span class="mi-texto">Cellstore</span>
    </div>
    <nav class="nav">
      <a href="productos.html">Productos</a>
      <!-- <a href="#ofertas">Ofertas</a>
      <a href="#contacto">Contacto</a> -->
    </nav>
  </header>

  <main class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-sm bg-white p-8 rounded-2xl shadow-lg">
      <h2 class="text-2xl font-bold text-center mb-6">Iniciar sesión</h2>
      <form action="log.php" method="POST">
        <div class="mb-4">
          <label class="block text-gray-700 mb-2" for="user_name">Usuario</label>
          <input
            class="w-full px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
            type="username"
            id="user_name"
            name="user_name"
            required
            placeholder="tu nombre de usuario"
          >
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 mb-2" for="password">Contraseña</label>
          <input
            class="w-full px-4 py-2 border rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500"
            type="password"
            id="password"
            name="password"
            required
            placeholder="••••••••"
          >
        </div>
        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-xl transition">
          Entrar
        </button>
      </form>
    </div>
  </main>

  <footer id="contacto" class="footer text-center p-4 bg-white mt-8 border-t">
    <p>📍 Córdoba, Argentina - © 2025 Cellstore</p>
    <a href="https://wa.me/543548554840" target="_blank" class="text-green-600 hover:underline">
      <i class="fa-brands fa-whatsapp"></i> WhatsApp
    </a>
  </footer>

  <script type="module" src="main.js"></script>
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
    crossorigin="anonymous"
  ></script>
</body>
</html>
