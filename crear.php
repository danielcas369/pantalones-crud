<?php
require __DIR__ . '/conexion.php';

$errores = [];
// Para preservar valores si hay errores
$referencia = $nombre = $tipo = $talla = $color = '';
$precio = $stock = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // 1) Sanitizar / normalizar
  $referencia = trim($_POST['referencia'] ?? '');
  $nombre     = trim($_POST['nombre'] ?? '');
  $tipo       = trim($_POST['tipo'] ?? '');
  $talla      = trim($_POST['talla'] ?? '');
  $color      = trim($_POST['color'] ?? '');
  $precioRaw  = $_POST['precio'] ?? null;
  $stockRaw   = $_POST['stock'] ?? null;

  // 2) Validar
  if ($referencia === '' || strlen($referencia) > 20) {
    $errores[] = "La referencia es obligatoria y no debe superar 20 caracteres.";
  }
  if ($nombre === '' || strlen($nombre) > 100) {
    $errores[] = "El nombre es obligatorio y no debe superar 100 caracteres.";
  }
  if ($tipo === '' || strlen($tipo) > 50) {
    $errores[] = "El tipo es obligatorio y no debe superar 50 caracteres.";
  }
  if ($talla === '' || strlen($talla) > 10) {
    $errores[] = "La talla es obligatoria y no debe superar 10 caracteres.";
  }
  if ($color === '' || strlen($color) > 30) {
    $errores[] = "El color es obligatorio y no debe superar 30 caracteres.";
  }

  // Números
  $precio = filter_var($precioRaw, FILTER_VALIDATE_FLOAT);
  if ($precio === false || $precio < 0) {
    $errores[] = "El precio debe ser un número válido mayor o igual a 0.";
  }

  $stock = filter_var($stockRaw, FILTER_VALIDATE_INT);
  if ($stock === false || $stock < 0) {
    $errores[] = "El stock debe ser un número entero mayor o igual a 0.";
  }

  // 3) Insertar si no hay errores
  if (!$errores) {
    $stmt = $conn->prepare(
      "INSERT INTO productos (referencia,nombre,tipo,talla,color,precio,stock)
       VALUES (?,?,?,?,?,?,?)"
    );
    // precio (double -> d), stock (int -> i)
    $stmt->bind_param(
      "sssssid",
      $referencia, $nombre, $tipo, $talla, $color, $precio, $stock
    );
    $stmt->execute();
    header("Location: index.php?ok=1");
    exit;
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Nuevo producto</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
<main class="container">
  <h2>Nuevo producto</h2>

  <?php if ($errores): ?>
    <article class="contrast" style="border-left:4px solid #d33;padding:.8rem">
      <strong>Corrige lo siguiente:</strong>
      <ul style="margin:.3rem 0 .2rem 1rem">
        <?php foreach ($errores as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </article>
  <?php endif; ?>

  <form method="post" novalidate>
    <div class="grid">
      <label>Referencia
        <input name="referencia" maxlength="20" required
               value="<?= htmlspecialchars($referencia) ?>">
      </label>
      <label>Nombre
        <input name="nombre" maxlength="100" required
               value="<?= htmlspecialchars($nombre) ?>">
      </label>
    </div>
    <div class="grid">
      <label>Tipo
        <input name="tipo" maxlength="50" required
               value="<?= htmlspecialchars($tipo) ?>">
      </label>
      <label>Talla
        <input name="talla" maxlength="10" required
               value="<?= htmlspecialchars($talla) ?>">
      </label>
    </div>
    <div class="grid">
      <label>Color
        <input name="color" maxlength="30" required
               value="<?= htmlspecialchars($color) ?>">
      </label>
      <label>Precio
        <input type="number" step="0.01" min="0" name="precio" required
               value="<?= $precio !== '' ? htmlspecialchars((string)$precio) : '' ?>">
      </label>
      <label>Stock
        <input type="number" min="0" name="stock" required
               value="<?= $stock !== '' ? htmlspecialchars((string)$stock) : '' ?>">
      </label>
    </div>
    <button type="submit">Guardar</button>
    <a class="secondary" href="index.php">Cancelar</a>
  </form>
</main>
</body>
</html>
