<?php
include("../conexion/ConexionSuministrosSA.php");
$con = connection();

$IDcompra = mysqli_real_escape_string($con, $_GET['IDcompra']);

$sql = "SELECT * FROM compras WHERE IDcompra='$IDcompra'";
$query = mysqli_query($con, $sql);

if ($query && mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);

    $sql_proveedores = "SELECT * FROM Proveedores";
    $query_proveedores = mysqli_query($con, $sql_proveedores);

    $sql_metodo_pago = "SELECT * FROM MetodoPago";
    $query_metodo_pago = mysqli_query($con, $sql_metodo_pago);
} else {
    echo "Compra no encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suministros S.A. Editar Compras</title>
</head>

<body bgcolor="#fcb0a0" style="margin: 30px;">
    <hr size="5" color="white" width="1350" align="center">
    <hr size="10" color="white" width="1350" align="center">
    <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
        <tr>
            <th rowspan="1"><font size="100" face="Agency FB"> ~ Editar Tabla Compras ~ <br> Suministros S.A. </font></th>
            <th rowspan="1"><img src="../Hiki feli normal tamanio grandote.png" height="225"/></th>
        </tr>
    </table>
    <hr size="5" color="white" width="1350" align="center">
    <hr size="10" color="white" width="1350" align="center">

    <table align="center">
        <tr>
            <td>
                <center>
                    <font size="4" face="Agency FB"><h1>Proveedores:</h1></font>
                    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                        <tr>
                            <th>IDproveedor</th>
                            <th>NombreProveedor</th>
                        </tr>
                        <?php while ($row_proveedor = mysqli_fetch_array($query_proveedores)): ?>
                            <tr>
                                <td><?= $row_proveedor['IDproveedor'] ?></td>
                                <td><?= $row_proveedor['NombreProveedor'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </center>
            </td>
            <td>
                <center>
                    <font size="4" face="Agency FB"><h1>Métodos de Pago:</h1></font>
                    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                        <tr>
                            <th>IDmetodoPago</th>
                            <th>MetodoPago</th>
                        </tr>
                        <?php while ($row_metodo = mysqli_fetch_array($query_metodo_pago)): ?>
                            <tr>
                                <td><?= $row_metodo['IDmetodoPago'] ?></td>
                                <td><?= $row_metodo['MetodoPago'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </table>
                </center>
            </td>
        </tr>
    </table>

    <div class="compras-form">
        <center>
            <font size="6" face="Agency FB"> <h1>Formulario Editar Compras: </h1></font>
        </center>
        <form action="2Editar_Compras.php" method="POST">
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
                <tr>
                    <td><input type="hidden" name="IDcompra" value="<?= $row['IDcompra'] ?>"></td>
                    <td><label for="FechaCompra">FechaCompra:</label>
                        <input type="date" name="FechaCompra" placeholder="FechaCompra" value="<?= $row['FechaCompra'] ?>">
                    </td>
                    <td><input type="number" name="NumeroFactura" placeholder="NumeroFactura" value="<?= $row['NumeroFactura'] ?>"></td>
                    <td><label for="FechaEstimadaEntrega">FechaEstimadaEntrega:</label>
                        <input type="date" name="FechaEstimadaEntrega" placeholder="FechaEstimadaEntrega" value="<?= $row['FechaEstimadaEntrega'] ?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="EstadoCompra"><font size="5" face="Agency FB"> Estado de Compra: </font></label>
                        <select name="EstadoCompra">
                            <option value="Pendiente" <?= ($row['EstadoCompra'] == 'Pendiente') ? 'selected' : '' ?>>Pendiente</option>
                            <option value="En transito" <?= ($row['EstadoCompra'] == 'En transito') ? 'selected' : '' ?>>En transito</option>
                            <option value="Entregada" <?= ($row['EstadoCompra'] == 'Entregada') ? 'selected' : '' ?>>Entregada</option>
                            <option value="Cancelada" <?= ($row['EstadoCompra'] == 'Cancelada') ? 'selected' : '' ?>>Cancelada</option>
                        </select>
                    </td>
                    <td>
                        <label for="RecepcionProductos"><font size="5" face="Agency FB"> Recepcion de Productos: </font></label>
                        <select name="RecepcionProductos">
                            <option value="Si" <?= ($row['RecepcionProductos'] == 'Si') ? 'selected' : '' ?>>Si</option>
                            <option value="No" <?= ($row['RecepcionProductos'] == 'No') ? 'selected' : '' ?>>No</option>
                        </select>
                    </td>
                    <td><input type="number" name="CostoTotal" placeholder="CostoTotal" value="<?= $row['CostoTotal'] ?>"></td>
                </tr>
                <tr>
                    <td><input type="number" name="IDproveedor" placeholder="IDproveedor" value="<?= $row['IDproveedor'] ?>"></td>
                    <td><input type="number" name="IDmetodoPago" placeholder="IDmetodoPago" value="<?= $row['IDmetodoPago'] ?>"></td>
                </tr>
            </table>
            <center>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">
            </center>
        </form>
    </div>
</body>
</html>