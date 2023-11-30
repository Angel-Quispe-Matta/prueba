<?php
session_start();

// Verificar si la variable de sesión del carrito existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Agregar un producto al carrito
if (isset($_POST['agregar'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Verificar si el producto ya está en el carrito
    if (array_key_exists($producto_id, $_SESSION['carrito'])) {
        $_SESSION['carrito'][$producto_id] += $cantidad;
    } else {
        $_SESSION['carrito'][$producto_id] = $cantidad;
    }
}

// Actualizar la cantidad de un producto en el carrito
if (isset($_POST['actualizar'])) {
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    // Verificar si la cantidad es mayor que cero antes de actualizar
    if ($cantidad > 0) {
        $_SESSION['carrito'][$producto_id] = $cantidad;
    } else {
        // Si la cantidad es cero o menor, eliminar el producto del carrito
        unset($_SESSION['carrito'][$producto_id]);
    }
}

// Eliminar un producto del carrito
if (isset($_GET['eliminar'])) {
    $producto_id = $_GET['eliminar'];
    unset($_SESSION['carrito'][$producto_id]);
}

// Mostrar el contenido del carrito
echo "<h2>Carrito de Compras</h2>";
echo "<table border='1'>";
echo "<tr><th>Producto</th><th>Cantidad</th><th>Acciones</th></tr>";

foreach ($_SESSION['carrito'] as $producto_id => $cantidad) {
    echo "<tr>";
    echo "<td>Producto $producto_id</td>";
    echo "<td>$cantidad</td>";
    echo "<td><a href='carrito.php?eliminar=$producto_id'>Eliminar</a></td>";
    echo "</tr>";
}

echo "</table>";

// Formulario para agregar productos al carrito
echo "<h2>Agregar Producto</h2>";
echo "<form method='post' action='carrito.php'>";
echo "Producto ID: <input type='text' name='producto_id'><br>";
echo "Cantidad: <input type='text' name='cantidad'><br>";
echo "<input type='submit' name='agregar' value='Agregar al Carrito'>";
echo "</form>";

// Formulario para actualizar la cantidad de productos en el carrito
echo "<h2>Actualizar Cantidad</h2>";
echo "<form method='post' action='carrito.php'>";
echo "Producto ID: <input type='text' name='producto_id'><br>";
echo "Nueva Cantidad: <input type='text' name='cantidad'><br>";
echo "<input type='submit' name='actualizar' value='Actualizar'>";
echo "</form>";
?>
