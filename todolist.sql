CREATE DATABASE IF NOT EXISTS pantalones_market;
USE pantalones_market;

CREATE TABLE productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  referencia VARCHAR(50) NOT NULL,
  nombre VARCHAR(100) NOT NULL,
  tipo VARCHAR(50),
  talla VARCHAR(10),
  color VARCHAR(20),
  precio DECIMAL(10,2),
  stock INT
);

INSERT INTO productos (referencia, nombre, tipo, talla, color, precio, stock)
VALUES
('PM001', 'Pantalón Clásico', 'Formal', 'M', 'Negro', 85000, 10),
('PM002', 'Jean Slim Fit', 'Casual', 'L', 'Azul', 95000, 15),
('PM003', 'Pantalón Cargo', 'Deportivo', 'XL', 'Verde', 105000, 8),
('PM004', 'Pantalón de Lino', 'Verano', 'S', 'Beige', 115000, 5);
