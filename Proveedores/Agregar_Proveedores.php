<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$NombreProveedor = $_POST['NombreProveedor'];
$NombreContacto = $_POST['NombreContacto'];
$Telefono = $_POST['Telefono'];
$Correo = $_POST['Correo'];
$Direccion = $_POST['Direccion'];
$TiempoEntregaPromedio = $_POST['TiempoEntregaPromedio'];
$CondicionPago = $_POST['CondicionPago'];
$Estado = $_POST['Estado'];

echo $NombreProveedor." ".$NombreContacto." ".$Telefono." ".$Correo." ".$Direccion." ".$TiempoEntregaPromedio." ".$CondicionPago." ".$Estado;


$sql = "INSERT INTO proveedores (NombreProveedor, NombreContacto, Telefono, Correo, Direccion, TiempoEntregaPromedio, CondicionPago, Estado) VALUES ('$NombreProveedor', '$NombreContacto', '$Telefono', '$Correo', '$Direccion', '$TiempoEntregaPromedio', '$CondicionPago', '$Estado')";

$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: Proveedores.php");
} else {
   
    echo "Error al insertar el proveedor: " . mysqli_error($con); 
}

?>