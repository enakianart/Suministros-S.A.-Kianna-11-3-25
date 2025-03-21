
<?php
function connection() {
    $servername = "localhost";
    $username = "root";
    $password = "lore";
    $database = "SuministrosSA";

    $connect = mysqli_connect($servername, $username, $password, $database); // Se agrega la base de datos a la conexion

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $connect;
}

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FechaCompra = $_POST["FechaCompra"];
    $NumeroFactura = $_POST["NumeroFactura"];
    $FechaEstimadaEntrega = $_POST["FechaEstimadaEntrega"];
    $EstadoCompra = $_POST["EstadoCompra"];
    $RecepcionProductos = $_POST["RecepcionProductos"];
    $CostoTotal = $_POST["CostoTotal"];
    $IDproveedor = $_POST["IDproveedor"];
    $IDmetodoPago = $_POST["IDmetodoPago"];

    // Validar FechaEstimadaEntrega
    if (strtotime($FechaEstimadaEntrega) < strtotime($FechaCompra)) {
        echo "<script>alert('Error: La fecha estimada de entrega debe ser igual o mayor a la fecha de compra.'); window.location.href='compras.php';</script>";
        exit;
    }

    // Insertar la compra
    $sql_insert_compra = "INSERT INTO Compras (FechaCompra, NumeroFactura, FechaEstimadaEntrega, EstadoCompra, RecepcionProductos, CostoTotal, IDproveedor, IDmetodoPago) VALUES ('$FechaCompra', '$NumeroFactura', '$FechaEstimadaEntrega', '$EstadoCompra', '$RecepcionProductos', '$CostoTotal', '$IDproveedor', '$IDmetodoPago')";

    if (mysqli_query($con, $sql_insert_compra)) {
        header("Location: Compras.php?mensaje=exito");
        exit;
    } else {
        header("Location: Compras.php?mensaje=error&error=" . urlencode(mysqli_error($con)));
        exit;
    }
}

mysqli_close($con);
?>