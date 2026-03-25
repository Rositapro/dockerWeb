<?php
$conn = new mysqli('db', 'tec', 'Tec123.', 'tec');

// Lógica para Agregar
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $conn->query("INSERT INTO productos (nombre, precio) VALUES ('$nombre', '$precio')");
}

// Lógica para Eliminar
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conn->query("DELETE FROM productos WHERE id=$id");
}

$productos = $conn->query("SELECT * FROM productos");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Inventario Tec</title>
    <style>
        body { font-family: sans-serif; margin: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        .btn-del { color: red; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Gestión de Productos - Kitty Beauty 💅</h1>
    
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre del producto" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio" required>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
        <?php while($row = $productos->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['nombre']; ?></td>
            <td>$<?php echo $row['precio']; ?></td>
            <td>
                <a href="?eliminar=<?php echo $row['id']; ?>" class="btn-del">Eliminar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>