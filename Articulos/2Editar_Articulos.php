<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDarticulo=$_POST["IDarticulo"];
$Articulo = $_POST['Articulo'];
$Costo = $_POST['Costo'];
$Estado = $_POST['Estado'];

$sql="UPDATE articulos SET Articulo='$Articulo', Costo=$Costo, Estado='$Estado' WHERE IDarticulo='$IDarticulo'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Articulos.php");
}else{

}

?>
