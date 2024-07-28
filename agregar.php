<?php
session_start();
// Verificar si el parámetro id está presente
if (isset($_GET['id'])) {
    // Obtener el ID del producto desde el parámetro GET
    $productoId = $_GET['id'];
    // Agregar el producto al carrito
    $_SESSION['carrito'][$productoId] = 1; // valor por defecto, es modificable.
}
header('Location: productos.php'); // Redirigir de vuelta a la página de productos
