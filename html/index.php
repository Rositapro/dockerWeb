<?php
$host = 'db'; // Nombre del servicio en docker-compose
$user = 'tec';
$pass = 'Tec123.';
$db   = 'tec';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
echo "<h1>Conexión Exitosa a MariaDB</h1>";
phpinfo(); // Para verificar los 128MB de custom.ini
?>