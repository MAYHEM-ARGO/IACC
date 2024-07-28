<?php
session_start();
// Verificar si el carrito está vacío
if (empty($_SESSION['carrito'])) {
    echo "El carrito está vacío";
} else {
    echo "<ul>";
    foreach ($_SESSION['carrito'] as $productoId => $cantidad) {
        echo "<li>Producto ID: " . $productoId . " Cantidad: " . $cantidad . " <a href='eliminar.php?id=" . $productoId . "'>Eliminar</a></li>";
    }
    echo "</ul>";
}
