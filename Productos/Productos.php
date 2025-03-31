<?php

function connection() {
    $servername = "localhost";
    $username = "root";
    $password = "lore";
    $database = "SuministrosSA";

    $connect = mysqli_connect($servername, $username, $password);

    mysqli_select_db($connect, $database);

    return $connect;
}

$con = connection();

$sql_productos = "SELECT * FROM productos";
$query_productos = mysqli_query($con, $sql_productos);

$sql_unidades = "SELECT * FROM UnidadMedida";
$query_unidades = mysqli_query($con, $sql_unidades);

$sql_categorias = "SELECT * FROM Categoria";
$query_categorias = mysqli_query($con, $sql_categorias);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suministros S.A. Productos</title>
</head>

<body bgcolor="#fcb0a0" style="margin: 30px;">

    <hr size="5" color="white" width="1350" align="center">
    <hr size="10" color="white" width="1350" align="center">
    <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
        <tr>
            <th rowspan="1"><font size="100" face="Agency FB"> ~ Tabla productos ~ <br> Suministros S.A. </font></th>
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
            <font size="5" face="Agency FB"><h1>Categorías:</h1></font>
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                <tr>
                    <th>IDcategoria</th>
                    <th>Categoria</th>
                </tr>
                <?php while ($row_categoria = mysqli_fetch_array($query_categorias)): ?>
                    <tr>
                        <td><?= $row_categoria['IDcategoria'] ?></td>
                        <td><?= $row_categoria['Categoria'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </center>
    </div>

    <div class="productos-form">
        <center>
            <font size="5" face="Agency FB"><h1>Formulario productos:</h1></font>
        </center>
        <form action="Agregar_Productos.php" method="POST">
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
                <tr>
                    <td><input type="text" name="Nombre" placeholder="Nombre"></td>
                    <td><input type="text" name="Descripcion" placeholder="Descripcion"></td>
                    <td><input type="number" name="CodigoBarras" placeholder="CodigoBarras"></td>
                </tr>
                <tr>
                    <td><input type="number" name="CostoUnitario" placeholder="CostoUnitario"></td>
                    <td><input type="number" name="PrecioUnitario" placeholder="PrecioUnitario"></td>
                    <td><input type="number" name="StockActual" placeholder="StockActual"></td>
                </tr>
                <tr>
                    <td><input type="number" name="StockMinimo" placeholder="StockMinimo"></td>
                    <td><input type="number" name="IDunidadMedida" placeholder="IDunidadMedida"></td>
                    <td><input type="number" name="IDcategoria" placeholder="IDcategoria"></td>
                </tr>
            </table>
            <input type="submit" value="Agregar" style="padding: 15px 30px; font-size: 18px;">
        </form>
    </div>

    <div class="productos-table">
        <center><font face="Agency FB"><h1>Productos Registrados:</h1></font></center>
        <font size="5" face="Agency FB">
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
                <tr>
                    <th>IDproducto</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>CodigoBarras</th>
                    <th>CostoUnitario</th>
                    <th>PrecioUnitario</th>
                    <th>StockActual</th>
                    <th>StockMinimo</th>
                    <th>IDunidadMedida</th>
                    <th>IDcategoria</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php while ($row_producto = mysqli_fetch_array($query_productos)): ?>
                    <tr>
                        <td><?= $row_producto['IDproducto'] ?></td>
                        <td><?= $row_producto['Nombre'] ?></td>
                        <td><?= $row_producto['Descripcion'] ?></td>
                        <td><?= $row_producto['CodigoBarras'] ?></td>
                        <td><?= $row_producto['CostoUnitario'] ?></td>
                        <td><?= $row_producto['PrecioUnitario'] ?></td>
                        <td><?= $row_producto['StockActual'] ?></td>
                        <td><?= $row_producto['StockMinimo'] ?></td>
                        <td><?= $row_producto['IDunidadMedida'] ?></td>
                        <td><?= $row_producto['IDcategoria'] ?></td>
                        <th><a href="1Actualizar_Productos.php?IDproducto=<?= $row_producto['IDproducto'] ?>">Editar</a></th>
                        <th><a href="Eliminar_Productos.php?IDproducto=<?= $row_producto['IDproducto'] ?>">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
            </table>
        </font>
    </div>

    <button onclick="location.href='../Inicio Suministros SA.html'" style="padding: 15px 30px; font-size: 18px;"> Volver al inicio 📍 </button>

</body>
</html>