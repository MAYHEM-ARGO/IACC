<?php
// Mostrar errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Obtener datos del formulario
$id_vuelo = isset($_POST['id_vuelo']) ? trim($_POST['id_vuelo']) : '';
$origen = isset($_POST['origen']) ? trim($_POST['origen']) : '';
$destino = isset($_POST['destino']) ? trim($_POST['destino']) : '';
$fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
$plazas_disponibles = isset($_POST['plazas_disponibles']) ? trim($_POST['plazas_disponibles']) : '';
$precio = isset($_POST['precio']) ? trim($_POST['precio']) : '';

// Validar los datos
if (empty($id_vuelo) || empty($origen) || empty($destino) || empty($fecha) || empty($plazas_disponibles) || empty($precio)) {
    die("Todos los campos son obligatorios.");
}

// Validar formato de fecha
if (!DateTime::createFromFormat('Y-m-d', $fecha)) {
    die("Fecha inválida.");
}

// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "agencia");

// Verificar conexión
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Preparar la consulta
$consulta = "INSERT INTO vuelo (id_vuelo, origen, destino, fecha, plazas_disponibles, precio) VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexion, $consulta);

// Verificar si la preparación de la consulta fue exitosa
if ($stmt) {
    // Enlazar parámetros
    mysqli_stmt_bind_param($stmt, "issssi", $id_vuelo, $origen, $destino, $fecha, $plazas_disponibles, $precio);
    
    // Ejecutar la consulta
    $resultado = mysqli_stmt_execute($stmt);
    
    // Verificar si la ejecución de la consulta fue exitosa
    if ($resultado) {
        echo "Datos agregados correctamente";
    } else {
        echo "Error al ingresar los datos: " . mysqli_stmt_error($stmt);
    }
    
    // Cerrar la declaración
    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conexion);
}

// Cerrar la conexión
mysqli_close($conexion);
?>
