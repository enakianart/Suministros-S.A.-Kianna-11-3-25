<?php

// Incluir el archivo de conexión
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IDinventario = $_POST['IDinventario'];
    $IDproducto = $_POST["IDproducto"];
    $Ubicacion = $_POST["Ubicacion"];
    $StockActual = $_POST["StockActual"];
    $StockMinimo = $_POST["StockMinimo"];
    $StockMaximo = $_POST["StockMaximo"];
    $IDunidadMedida = $_POST["IDunidadMedida"];
    $Estado = $_POST["Estado"];
    $NumeroSerie = $_POST["NumeroSerie"];

    $errores = array();

    // Validar que IDunidadMedida exista en la tabla UnidadMedida
    $sql_check_unidad = "SELECT IDunidadMedida FROM UnidadMedida WHERE IDunidadMedida = '$IDunidadMedida'";
    $result_unidad = mysqli_query($con, $sql_check_unidad);
    if (mysqli_num_rows($result_unidad) == 0) {
        $errores[] = "Error: El IDunidadMedida no existe en la tabla UnidadMedida.";
    }

    // Verificar si el IDproducto existe
    $sql_check_producto = "SELECT COUNT(*) FROM Productos WHERE IDproducto = $IDproducto";
    $result_check_producto = mysqli_query($con, $sql_check_producto);
    $row_check_producto = mysqli_fetch_array($result_check_producto);

    if ($row_check_producto[0] == 0) {
        echo "<script>alert('Error: El ID de producto no existe.'); window.location.href='DetalleCompras.php';</script>";
        exit;
    }

    // Validar que StockActual no sobrepase StockMaximo
    if ($StockActual > $StockMaximo) {
        $errores[] = "Error: El stock actual no puede ser mayor que el stock máximo.";
    }

    // Validar que StockActual no sea menor que StockMinimo
    if ($StockActual < $StockMinimo) {
        $errores[] = "Error: El stock actual no puede ser menor que el stock mínimo.";
    }

    // Validar que NumeroSerie sea único (excluyendo el registro actual)
    $sql_check_serie = "SELECT NumeroSerie FROM Inventario WHERE NumeroSerie = '$NumeroSerie' AND IDinventario != '$IDinventario'";
    $result_serie = mysqli_query($con, $sql_check_serie);
    if (mysqli_num_rows($result_serie) > 0) {
        $errores[] = "Error: El número de serie ya existe en otro registro.";
    }

    if (empty($errores)) {
        $sql = "UPDATE Inventario SET IDproducto='$IDproducto', Ubicacion='$Ubicacion', StockActual='$StockActual', StockMinimo='$StockMinimo', StockMaximo='$StockMaximo', IDunidadMedida='$IDunidadMedida', Estado='$Estado', NumeroSerie='$NumeroSerie' WHERE IDinventario='$IDinventario'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            Header("Location: Inventario.php?mensaje=actualizado");
            exit;
        } else {
            echo "Error al actualizar el inventario: " . mysqli_error($con);
        }
    } else {
        foreach ($errores as $error) {
            echo "<div style='color: red;'>$error</div>";
        }
        // Incluir el formulario de edición nuevamente para que el usuario pueda corregir los errores
        include("1Actualizar_Inventario.php");
        exit;
    }
} else {
    // Si se accede a este script directamente sin POST, podrías redirigir o mostrar un mensaje
    header("Location: Inventario.php");
    exit;
}

mysqli_close($con);

?>