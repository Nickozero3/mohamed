<?php
// Activar toda la información de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Verificar si los datos POST están llegando
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Incluir conexión después de iniciar sesión
        require 'connect.php';
        
        // Verificar si la conexión se estableció
        if ($conn->connect_error) {
            throw new Exception("Error de conexión a la base de datos: " . $conn->connect_error);
        }

        // Obtener y limpiar datos
        $username = trim($_POST['user_name'] ?? '');
        $password = $_POST['password'] ?? '';

        // Validaciones básicas
        if (empty($username) || empty($password)) {
            throw new Exception("Nombre de usuario y contraseña son requeridos");
        }

        // Consulta preparada con manejo de errores
        $stmt = $conn->prepare("SELECT id, nombre, apellido, user_name, contra FROM Usuarios WHERE user_name = ?");
        
        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $conn->error);
        }

        $stmt->bind_param("s", $username);
        
        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            throw new Exception("Usuario no encontrado");
        }

        $usuario = $result->fetch_assoc();
        
        // Comparación de contraseña (sin hash)
        if ($password !== $usuario['contra']) {
            throw new Exception("Contraseña incorrecta");
        }

        // Autenticación exitosa
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'apellido' => $usuario['apellido'],
            'user_name' => $usuario['user_name']
        ];

        // Redirección exitosa
        header('Location: carga.php');
        exit();

    } catch (Exception $e) {
        // Mostrar mensaje detallado del error
        die("<div style='max-width:600px;margin:50px auto;padding:20px;border:1px solid #f00;background:#fee;'>
                <h2>Error en el sistema</h2>
                <p><strong>Mensaje:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                <p><strong>Archivo:</strong> " . $e->getFile() . " (línea: " . $e->getLine() . ")</p>
                <a href='index.html' style='display:inline-block;margin-top:20px;padding:10px 15px;background:#06c;color:white;text-decoration:none;'>Volver a intentar</a>
            </div>");
    }
} else {
    // Si alguien intenta acceder directamente al script
    header('Location: index.html');
    exit();
}