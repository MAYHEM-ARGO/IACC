<?php
session_start();
// Verificar si el parámetro id está presente
if (isset($_GET['id'])) {
    // Obtener el ID del producto desde el parámetro GET
    $productoId = $_GET['id'];
    // Eliminar el producto del carrito
    unset($_SESSION['carrito'][$productoId]);
}
header('Location: carrito.php'); // Redirigir de vuelta a la página del carrito
