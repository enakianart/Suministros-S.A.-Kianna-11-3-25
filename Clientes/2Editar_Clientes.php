<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDcliente = $_POST['IDcliente']; 
$NombreCliente = $_POST['NombreCliente'];
$Telefono = $_POST['Telefono'];
$Correo = $_POST['Correo'];
$DireccionFactura = $_POST['DireccionFactura'];
$DireccionEnvio = $_POST['DireccionEnvio'];
$IDmetodoPago = $_POST['IDmetodoPago'];
$IDtipoCliente = $_POST['IDtipoCliente'];
$Estado = $_POST['Estado'];

$sql = "UPDATE clientes SET NombreCliente='$NombreCliente', Telefono='$Telefono', Correo='$Correo', DireccionFactura='$DireccionFactura', DireccionEnvio='$DireccionEnvio', IDmetodoPago=$IDmetodoPago, IDtipoCliente=$IDtipoCliente, Estado='$Estado' WHERE IDcliente='$IDcliente'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: Clientes.php");
} else {
    echo "Error al actualizar el cliente: " . mysqli_error($con);
}

?>