<?php

include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDunidadMedida=$_GET["IDunidadMedida"];

// Verificar si existen productos con esta unidad de medida
$sql_check = "SELECT COUNT(*) AS total_productos FROM Productos WHERE IDUnidadMedida = '$IDunidadMedida'";
$result_check = mysqli_query($con, $sql_check);
$row_check = mysqli_fetch_assoc($result_check);

if ($row_check['total_productos'] > 0) {
    // Si existen productos con esta unidad de medida, mostrar un error y no eliminar
    echo "<script>
            alert('Error: No se puede eliminar la unidad de medida porque existen productos asociados a ella.');
            window.location.href = 'UnidadMedida.php'; // Redirigir de vuelta a la lista
          </script>";
    exit(); // Detener la ejecución del script
} else {
    // Si no existen productos, proceder con la eliminación
    $sql_delete = "DELETE FROM UnidadMedida WHERE IDUnidadMedida='$IDunidadMedida'";
    $query_delete = mysqli_query($con, $sql_delete);

    if($query_delete){
        Header("Location: UnidadMedida.php");
    } else {
        // Manejar el error de eliminación si ocurre
        echo "<script>
                alert('Error al eliminar la unidad de medida: " . mysqli_error($con) . "');
                window.location.href = 'UnidadMedida.php'; // Redirigir de vuelta a la lista
              </script>";
    }
}

?>