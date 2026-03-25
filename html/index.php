<?php
// Conexión a la base de datos
$conn = new mysqli('db', 'tec', 'Tec123.', 'tec');

// --- Lógica: Agregar ---
if (isset($_POST['agregar'])) {
    $nombre = $_POST['nombre']; 
    $precio = $_POST['precio'];
    $conn->query("INSERT INTO productos (nombre, precio) VALUES ('$nombre', '$precio')");
    header("Location: index.php");
    exit();
}

// --- Lógica: Eliminar ---
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conn->query("DELETE FROM productos WHERE id=$id");
}

// --- Lógica: Actualizar ---
if (isset($_POST['actualizar'])) {
    $id = $_POST['id']; 
    $nombre = $_POST['nombre']; 
    $precio = $_POST['precio'];
    $conn->query("UPDATE productos SET nombre='$nombre', precio='$precio' WHERE id=$id");
    
}


// --- Lógica: Cargar datos para editar ---
$edit_row = null;
if (isset($_GET['editar'])) {
    $id_edit = $_GET['editar'];
    $res = $conn->query("SELECT * FROM productos WHERE id=$id_edit");
    $edit_row = $res->fetch_assoc();
}

// Obtener todos los productos
$productos = $conn->query("SELECT * FROM productos ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Kitty Beauty - Gestión</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="favicon.png">
</head>
<body>

<div class="container">
    <h1>Kitty Beauty Inventory</h1>

    <form method="POST">
        <h3 style="color: var(--rosa-medio); margin-top: 0;">
            <?php echo $edit_row ? "Editar Producto" : "Agregar Nuevo"; ?>
        </h3>
        <input type="hidden" name="id" value="<?php echo $edit_row['id'] ?? ''; ?>">
        <input type="text" name="nombre" placeholder="Nombre del servicio" value="<?php echo $edit_row['nombre'] ?? ''; ?>" required>
        <input type="number" step="0.01" name="precio" placeholder="Precio$" value="<?php echo $edit_row['precio'] ?? ''; ?>" required>
        
        <?php if ($edit_row): ?>
            <button type="submit" name="actualizar" class="btn btn-add">Guardar</button>
            <a href="index.php" class="btn" style="background:#eee; color:#777;">Cancelar</a>
        <?php else: ?>
            <button type="submit" name="agregar" class="btn btn-add">Añadir</button>
        <?php endif; ?>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Servicio</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $productos->fetch_assoc()): ?>
            <tr>
                <td><strong>#<?php echo $row['id']; ?></strong></td>
                <td><?php echo $row['nombre']; ?></td>
                <td>$<?php echo number_format($row['precio'], 2); ?></td>
                <td>
                    <a href="?editar=<?php echo $row['id']; ?>" class="btn btn-edit">Editar</a>
                    <a href="?eliminar=<?php echo $row['id']; ?>" class="btn btn-del" onclick="return confirm('¿Eliminar registro?')">Borrar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>