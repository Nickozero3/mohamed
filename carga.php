<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cargar Nuevo Producto - Cellstore</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
  />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f5f7;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 800px;
      margin: 30px auto;
      padding: 20px;
      background: white;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    h1 {
      color: #333;
      text-align: center;
      margin-bottom: 30px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 600;
      color: #555;
    }
    input[type="text"],
    input[type="number"],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
      box-sizing: border-box;
    }
    input[type="file"] {
      width: 100%;
      padding: 12px;
      border: 1px dashed #ccc;
      border-radius: 8px;
      background: #f9f9f9;
    }
    .preview-img {
      max-width: 200px;
      max-height: 200px;
      margin-top: 10px;
      display: none;
      border-radius: 8px;
      border: 1px solid #eee;
    }
    .btn-submit {
      background-color: #0071e3;
      color: white;
      border: none;
      padding: 12px 24px;
      font-size: 16px;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s;
    }
    .btn-submit:hover {
      background-color: #0062c3;
    }
    .form-row {
      display: flex;
      gap: 20px;
    }
    .form-col {
      flex: 1;
    }
  </style>
</head>
<body>
  <div class="container">
      <?php if (isset($_SESSION['usuario']['es_admin']) && $_SESSION['usuario']['es_admin']): ?>
    <div class="admin-panel">
        <a href="panel_admin.html" class="admin-link">Panel de Administración</a>
    </div>
    <?php endif; ?>
    <h1><i class="fas fa-plus-circle"></i> Cargar Nuevo Producto</h1>
    
    <form action="guardar_producto.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nombre">Nombre del Producto</label>
        <input type="text" id="nombre" name="nombre" required placeholder="Ej: iPhone 15 Pro Max">
      </div>
      
      <div class="form-row">
        <div class="form-col">
          <div class="form-group">
            <label for="categoria">Categoría</label>
            <select id="categoria" name="categoria" required>
              <option value="">Seleccione una categoría</option>
              <option value="smartphone">Smartphone</option>
              <option value="tablet">Tablet</option>
              <option value="accesorio">Accesorio</option>
              <option value="wearable">Wearable</option>
              <option value="otros">Otros</option>
            </select>
          </div>
        </div>
        
        <div class="form-col">
          <div class="form-group">
            <label for="almacenamiento">Almacenamiento</label>
            <select id="almacenamiento" name="almacenamiento" required>
              <option value="">Seleccione capacidad</option>
              <option value="64GB">64GB</option>
              <option value="128GB">128GB</option>
              <option value="256GB">256GB</option>
              <option value="512GB">512GB</option>
              <option value="1TB">1TB</option>
            </select>
          </div>
        </div>
      </div>
      
      <div class="form-group">
        <label for="precio">Precio (USD)</label>
        <input type="number" id="precio" name="precio" required min="0" step="0.01" placeholder="Ej: 999.99">
      </div>
      
      <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion" rows="4" placeholder="Descripción detallada del producto"></textarea>
      </div>
      
      <div class="form-group">
        <label for="foto">Imagen del Producto</label>
        <input type="file" id="foto" name="foto" accept="image/*" required>
        <img id="preview" class="preview-img" alt="Vista previa de la imagen">
      </div>
      
      <div class="form-group">
        <button type="submit" class="btn-submit">Guardar Producto</button>
      </div>
    </form>
  </div>

  <script>
    // Vista previa de la imagen seleccionada
    document.getElementById('foto').addEventListener('change', function(e) {
      const preview = document.getElementById('preview');
      const file = e.target.files[0];
      
      if (file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        }
        
        reader.readAsDataURL(file);
      } else {
        preview.style.display = 'none';
      }
    });