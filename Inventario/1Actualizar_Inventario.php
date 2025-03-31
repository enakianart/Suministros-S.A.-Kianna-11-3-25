<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDinventario = mysqli_real_escape_string($con, $_GET['IDinventario']);

$sql = "SELECT * FROM Inventario WHERE IDinventario='$IDinventario'";
$query = mysqli_query($con, $sql);

if ($query && mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);

    $sql_unidades = "SELECT * FROM UnidadMedida";
    $query_unidades = mysqli_query($con, $sql_unidades);

    $sql_Productos = "SELECT * FROM Productos";
$query_Productos = mysqli_query($con, $sql_Productos);
} else {
    echo "Producto en inventario no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suministros S.A. Editar Inventario</title>
</head>

<body bgcolor="#fcb0a0" style="margin: 30px;">
    <hr size="5" color="white" width="1350" align="center">
    <hr size="10" color="white" width="1350" align="center">
    <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
        <tr>
            <th rowspan="1"><font size="100" face="Agency FB"> ~ Editar Tabla Inventario ~ <br> Suministros S.A. </font></th>
            <th rowspan="1"><img src="../Hiki feli normal tamanio grandote.png" height="225"/></th>
        </tr>
    </table>
    <hr size="5" color="white" width="1350" align="center">
    <hr size="10" color="white" width="1350" align="center">

    <div style="display: flex; justify-content: center;">
        <center>
            <font size="5" face="Agency FB"><h1>Unidades de Medida:</h1></font>
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                <tr>
                    <th>IDunidadMedida</th>
                    <th>UnidadMedida</th>
                </tr>
                <?php while ($row_unidad = mysqli_fetch_array($query_unidades)): ?>
                    <tr>
                        <td><?= $row_unidad['IDunidadMedida'] ?></td>
                        <td><?= $row_unidad['UnidadMedida'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </center>

        <center>
            <font size="5" face="Agency FB"><h1>Productos:</h1></font>
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                <tr>
                    <th>IDproducto</th>
                    <th>Nombre</th> 

                </tr>
                <?php while ($row_Productos = mysqli_fetch_array($query_Productos)): ?>
                    <tr>
                        <td><?= $row_Productos['IDproducto'] ?></td>
                        <td><?= $row_Productos['Nombre'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </center>
    </div>

                   

        <div class="compras-form">
        <center>
            <font size="6" face="Agency FB"> <h1>Formulario Editar Inventario: </h1></font>
        </center>
        <form action="2Editar_Inventario.php" method="POST">
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
                <tr>
                    <td><input type="hidden" name="IDinventario" value="<?= $row['IDinventario'] ?>"></td>
                    <td><label for="IDproducto">IDproducto:</label>
                        <input type="number" name="IDproducto" placeholder="IDproducto" value="<?= $row['IDproducto'] ?>">
                    </td>
                    <td> <label for="Ubicacion">Ubicacion:</label>
                    <input type="text" name="Ubicacion" placeholder="Ubicacion" value="<?= $row['Ubicacion'] ?>"></td>
                </tr>
                <tr>

                <td><label for="StockActual">StockActual:</label>
                        <input type="number" name="StockActual" placeholder="StockActual" value="<?= $row['StockActual'] ?>">
                    </td> 

                    <td><label for="StockMinimo">StockMinimo:</label>
                        <input type="number" name="StockMinimo" placeholder="StockMinimo" value="<?= $row['StockMinimo'] ?>">
                    </td>

                    <td><label for="StockMaximo">StockMaximo:</label>
                        <input type="number" name="StockMaximo" placeholder="StockMaximo" value="<?= $row['StockMaximo'] ?>"> 
                    </td>
                </tr> 

                <tr> 

                <td><label for="IDunidadMedida">IDunidadMedida:</label>
                <input type="number" name="IDunidadMedida" placeholder="IDunidadMedida" value="<?= $row['IDunidadMedida'] ?>">

                <td>
                        <label for="Estado"><font size="5" face="Agency FB"> Estado: </font></label>
                        <select name="Estado">
                            <option value="Disponible" <?= ($row['Estado'] == 'Disponible') ? 'selected' : '' ?>>Disponible</option>
                            
                            <option value="Reservado" <?= ($row['Estado'] == 'Reservado') ? 'selected' : '' ?>>Reservado</option>

                            <option value="En Transito" <?= ($row['Estado'] == 'En Transito') ? 'selected' : '' ?>>En Transito</option>

                            <option value="Estropeado" <?= ($row['Estado'] == 'Estropeado') ? 'selected' : '' ?>>Estropeado</option> 
                        </select>
                    </td>

                    <td><label for="NumeroSerie">NumeroSerie:</label>
                <input type="number" name="NumeroSerie" placeholder="NumeroSerie" value="<?= $row['NumeroSerie'] ?>">

                </tr> 
            </table>
            <center>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">
            </center>
        </form>
    </div>
</body>
</html>