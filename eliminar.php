<?php require __DIR__ . '/conexion.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id) {
  $stmt = $conn->prepare("DELETE FROM productos WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
}
header("Location: index.php");
exit;
