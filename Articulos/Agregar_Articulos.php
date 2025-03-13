<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$Articulo = $_POST['Articulo'];
$Costo = $_POST['Costo'];
$Estado = $_POST['Estado'];

echo $Articulo." ".$Costo." ".$Estado;

$sql = "INSERT INTO articulos (Articulo, Costo, Estado) VALUES ('$Articulo', '$Costo', '$Estado')";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: Articulos.php");
} else {
   
    echo "Error al insertar el articulo: " . mysqli_error($con); 
}

?>