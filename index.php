<?php require __DIR__ . '/conexion.php'; ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Pantalones Market - CRUD</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css">
</head>
<body>
<main class="container">
  <nav>
    <ul><li><strong>Pantalones Market</strong></li></ul>
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="crear.php">Nuevo producto</a></li>
    </ul>
  </nav>

  <h2>Inventario</h2>

  <?php if (isset($_GET['ok'])): ?>
    <article class="contrast" style="border-left:4px solid #2a7;padding:.8rem;margin:.6rem 0">
      Operación realizada con éxito.
    </article>
  <?php endif; ?>

  <form method="get">
    <input type="search" name="q" placeholder="Buscar por nombre, referencia o tipo"
           value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>">
    <button type="submit">Buscar</button>
    <a class="secondary" href="index.php">Limpiar</a>
  </form>

  <?php
  $q = isset($_GET['q']) ? trim($_GET['q']) : '';
  if ($q !== '') {
    $like = "%".$conn->real_escape_string($q)."%";
    $sql  = "SELECT * FROM productos
             WHERE nombre LIKE '$like' OR referencia LIKE '$like' OR tipo LIKE '$like'
             ORDER BY id DESC";
  } else {
    $sql = "SELECT * FROM productos ORDER BY id DESC";
  }
  $res = $conn->query($sql);
  ?>

  <table>
    <thead>
      <tr>
        <th>ID</th><th>Ref</th><th>Nombre</th><th>Tipo</th>
        <th>Talla</th><th>Color</th><th>Precio</th><th>Stock</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php if ($res && $res->num_rows): ?>
      <?php while($r = $res->fetch_assoc()): ?>
        <tr>
          <td><?php echo $r['id']; ?></td>
          <td><?php echo htmlspecialchars($r['referencia']); ?></td>
          <td><?php echo htmlspecialchars($r['nombre']); ?></td>
          <td><?php echo htmlspecialchars($r['tipo']); ?></td>
          <td><?php echo htmlspecialchars($r['talla']); ?></td>
          <td><?php echo htmlspecialchars($r['color']); ?></td>
          <td>$<?php echo number_format($r['precio'], 0, ',', '.'); ?></td>
          <td><?php echo (int)$r['stock']; ?></td>
          <td>
            <a href="editar.php?id=<?php echo $r['id']; ?>">✏️ Editar</a>
            <a class="secondary"
               href="eliminar.php?id=<?php echo $r['id']; ?>"
               onclick="return confirm('¿Eliminar producto #<?php echo $r['id']; ?>?')">🗑️ Eliminar</a>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="9">Sin resultados</td></tr>
    <?php endif; ?>
    </tbody>
  </table>

</main>
</body>
</html>
