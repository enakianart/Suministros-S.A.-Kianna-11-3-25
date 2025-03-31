
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDhistorial_Inventario=$_GET["IDhistorial_Inventario"];

$sql="DELETE FROM Historial_Inventario WHERE IDhistorial_Inventario='$IDhistorial_Inventario'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: Historial_Inventario.php");
}else{

}

?>
