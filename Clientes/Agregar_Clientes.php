<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$NombreCliente = $_POST['NombreCliente'];
$Telefono = $_POST['Telefono'];
$Correo = $_POST['Correo'];
$DireccionFactura = $_POST['DireccionFactura'];
$DireccionEnvio = $_POST['DireccionEnvio'];
$IDmetodoPago = $_POST['IDmetodoPago'];
$IDtipoCliente = $_POST['IDtipoCliente'];
$Estado = $_POST['Estado'];

echo $NombreCliente." ".$Telefono." ".$Correo." ".$DireccionFactura." ".$DireccionEnvio." ".$CondicionPago." ".$IDtipoCliente." ".$Estado;


$sql = "INSERT INTO clientes (NombreCliente, Telefono, Correo, DireccionFactura, DireccionEnvio, IDmetodoPago, IDtipoCliente, Estado) VALUES ('$NombreCliente', '$Telefono', '$Correo', '$DireccionFactura', '$DireccionEnvio', $IDmetodoPago, $IDtipoCliente, '$Estado')";

$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: Clientes.php");
} else {
   
    echo "Error al insertar el cliente: " . mysqli_error($con); 
}

?>