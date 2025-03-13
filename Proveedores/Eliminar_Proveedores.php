
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDproveedor=$_GET["IDproveedor"];

$sql="DELETE FROM proveedores WHERE IDproveedor='$IDproveedor'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Proveedores.php");
}else{

}

?>
