<?php
function connection() {
    $servername = "localhost";
    $username = "root";
    $password = "lore";
    $database = "SuministrosSA";

    $connect = mysqli_connect($servername, $username, $password, $database);
    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    return $connect;
}

$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Validar que NumeroSerie sea único
    $sql_check_serie = "SELECT NumeroSerie FROM Inventario WHERE NumeroSerie = '$NumeroSerie'";
    $result_serie = mysqli_query($con, $sql_check_serie);
    if (mysqli_num_rows($result_serie) > 0) {
        $errores[] = "Error: El número de serie ya existe en otro registro.";
    }

    if (empty($errores)) {
        $sql_insert_inventario = "INSERT INTO Inventario (IDproducto, Ubicacion, StockActual, StockMinimo, StockMaximo, IDunidadMedida, Estado, NumeroSerie) VALUES ('$IDproducto', '$Ubicacion', '$StockActual', '$StockMinimo', '$StockMaximo', '$IDunidadMedida', '$Estado', '$NumeroSerie')";

        if (mysqli_query($con, $sql_insert_inventario)) {
            header("Location: Inventario.php?mensaje=exito");
            exit;
        } else {
            echo "Error al agregar el inventario: " . mysqli_error($con);
        }
    } else {
        foreach ($errores as $error) {
            echo "<div style='color: red;'>$error</div>";
        }
        // Incluir el formulario de agregar nuevamente para que el usuario pueda corregir los errores
        include("1Agregar_Inventario.html"); // Asegúrate de que la ruta a tu formulario de agregar sea correcta
        exit;
    }
} else {
    // Si se accede a este script directamente sin POST, podrías mostrar un mensaje o redirigir al formulario
    include("1Agregar_Inventario.html"); // Muestra el formulario por defecto
}

mysqli_close($con);
?>