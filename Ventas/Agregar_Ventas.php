<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDcliente = $_POST['IDcliente'];
$FechaVenta = $_POST['FechaVenta'];
$NumeroFactura = $_POST['NumeroFactura'];
$Comentario = $_POST['Comentario'];
$IDmetodoPago = $_POST['IDmetodoPago'];
$CondicionPago = $_POST['CondicionPago'];
$FechaEstimadaEntrega = $_POST['FechaEstimadaEntrega'];
$Estado = $_POST['Estado'];
$Total = $_POST['Total'];


echo $IDcliente." ".$FechaVenta." ".$NumeroFactura." ".$Comentario." ".$IDmetodoPago." ".$CondicionPago." ".$FechaEstimadaEntrega." ".$Estado." "$Total;

// Validar si el IDcliente existe en la tabla clientes
$sql_cliente = "SELECT IDcliente FROM Clientes WHERE IDcliente = '$IDcliente'";
$query_cliente = mysqli_query($con, $sql_cliente);
if (mysqli_num_rows($query_cliente) == 0) {
    echo "Error: El ID de cliente ingresado no existe en la tabla de clientes.";
    exit();
}

// Validar si el NumeroFactura ya existe en la tabla Ventas
$sql_factura = "SELECT NumeroFactura FROM Ventas WHERE NumeroFactura = '$NumeroFactura'";
$query_factura = mysqli_query($con, $sql_factura);
if (mysqli_num_rows($query_factura) > 0) {
    echo "Error: El número de factura ingresado ya existe en otro registro de ventas.";
    exit();
}

// Validar si el IDmetodoPago existe en la tabla MetodoPago
$sql_metodo_pago = "SELECT IDmetodoPago FROM MetodoPago WHERE IDmetodoPago = '$IDmetodoPago'";
$query_metodo_pago = mysqli_query($con, $sql_metodo_pago);
if (mysqli_num_rows($query_metodo_pago) == 0) {
    echo "Error: El ID de método de pago ingresado no existe en la tabla de métodos de pago.";
    exit();
}

// Validar si la FechaEstimadaEntrega es igual o mayor a la FechaVenta
if (strtotime($FechaEstimadaEntrega) < strtotime($FechaVenta)) {
    echo "Error: La fecha estimada de entrega debe ser igual o posterior a la fecha de venta.";
    exit();
}

$sql = "INSERT INTO Ventas (IDcliente, FechaVenta, NumeroFactura, Comentario, IDmetodoPago, CondicionPago, FechaEstimadaEntrega, Estado, Total) VALUES ('$IDcliente', '$FechaVenta', '$NumeroFactura', '$Comentario', '$IDmetodoPago', '$CondicionPago', '$FechaEstimadaEntrega', '$Estado', '$Total')";

$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: Ventas.php");
} else {
    echo "Error al insertar la venta: " . mysqli_error($con);
}

?>