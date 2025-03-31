
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDdetalleVenta=$_GET["IDdetalleVenta"];

$sql="DELETE FROM DetalleVentas WHERE IDdetalleVenta='$IDdetalleVenta'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: DetalleVentas.php");
}else{

}

?>
