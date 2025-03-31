
<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDunidadMedida=$_GET["IDunidadMedida"];

$sql="DELETE FROM UnidadMedida WHERE IDunidadMedida='$IDunidadMedida'";
$query = mysqli_query($con, $sql);

if($query){
    Header("Location: UnidadMedida.php");
}else{

}

?>
