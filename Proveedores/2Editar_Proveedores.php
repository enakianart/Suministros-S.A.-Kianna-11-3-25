<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDproveedor=$_POST["IDproveedor"];
$NombreProveedor = $_POST['NombreProveedor'];
$NombreContacto = $_POST['NombreContacto'];
$Telefono = $_POST['Telefono'];
$Correo = $_POST['Correo'];
$Direccion = $_POST['Direccion'];
$TiempoEntregaPromedio = $_POST['TiempoEntregaPromedio'];
$CondicionPago = $_POST['CondicionPago'];
$Estado = $_POST['Estado'];

$sql="UPDATE proveedores SET NombreProveedor='$NombreProveedor', NombreContacto='$NombreContacto', Telefono='$Telefono', Correo='$Correo', Direccion='$Direccion', TiempoEntregaPromedio='$TiempoEntregaPromedio', CondicionPago='$CondicionPago', Estado='$Estado' WHERE IDproveedor='$IDproveedor'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Proveedores.php");
}else{

}

?>
