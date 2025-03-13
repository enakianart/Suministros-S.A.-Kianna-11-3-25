
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDarticulo=$_GET["IDarticulo"];

$sql="DELETE FROM articulos WHERE IDarticulo='$IDarticulo'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Articulos.php");
}else{

}

?>
