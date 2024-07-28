<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id_hotel = isset($_POST['id_hotel']) ? trim($_POST['id_hotel']) : '';
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$ubicacion = isset($_POST['ubicacion']) ? trim($_POST['ubicacion']) : '';
$habitaciones_disponibles = isset($_POST['habitaciones_disponibles']) ? trim($_POST['habitaciones_disponibles']) : '';
$tarifa_noche = isset($_POST['tarifa_noche']) ? trim($_POST['tarifa_noche']) : '';


if (empty($id_hotel) || empty($nombre) || empty($ubicacion) || empty($habitaciones_disponibles) || empty($tarifa_noche)) {
    die("Todos los campos son obligatorios.");
}

$conexion = mysqli_connect("localhost", "root", "", "agencia");

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}


$consulta = "INSERT INTO hotel (id_hotel, nombre, ubicacion, habitaciones_disponibles, tarifa_noche) VALUES (?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conexion, $consulta);

if ($stmt) {
  
    mysqli_stmt_bind_param($stmt, "sssss", $id_hotel, $nombre, $ubicacion, $habitaciones_disponibles, $tarifa_noche);
    
   
    $resultado = mysqli_stmt_execute($stmt);
    
   
    if ($resultado) {
        echo "Datos agregados correctamente";
    } else {
        echo "Error al ingresar los datos: " . mysqli_stmt_error($stmt);
    }
    
 
    mysqli_stmt_close($stmt);
} else {
    echo "Error al preparar la consulta: " . mysqli_error($conexion);
}


mysqli_close($conexion);
?>
