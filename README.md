Pantalones - CRUD en PHP y MySQL

Proyecto SENA: aplicación CRUD (Crear, Leer, Actualizar, Eliminar) para gestionar inventario de pantalones.

Requisitos
- XAMPP o similar (Apache + MySQL + PHP 8+)
- Navegador web 

Instalación
1. Clonar este repositorio o descargar el `.zip`.
2. Copiar la carpeta `pantalones-crud` dentro de la carpeta `htdocs` de XAMPP.
3. Abrir [phpMyAdmin](http://localhost/phpmyadmin).
4. Crear una base de datos llamada `pantalones_market`.
5. Importar el archivo `todolist.sql` (incluido en este proyecto).

Uso
1. Iniciar Apache y MySQL desde el panel de XAMPP.
2. Abrir en el navegador: [http://localhost/pantalones-crud](http://localhost/pantalones-crud)
3. Desde aquí podrás:
   - **Listar** todos los productos
   - **Buscar** por nombre, referencia o tipo
   - **Crear** nuevos productos
   - **Editar** productos existentes
   - **Eliminar** productos

Archivos principales
- `conexion.php` → Configuración de conexión a la base de datos
- `index.php` → Listado y búsqueda de productos
- `crear.php` → Formulario para agregar productos
- `editar.php` → Formulario para actualizar productos
- `eliminar.php` → Acción para borrar productos
- `todolist.sql` → Script para crear tabla y datos iniciales


Desarrollado como proyecto tareas Sena, Jose Daniel Castrillon Villegas.
