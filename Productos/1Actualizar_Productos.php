
<?php 
    include("../conexion/ConexionSuministrosSA.php");
    $con=connection();

    $IDproducto=$_GET['IDproducto'];

    $sql="SELECT * FROM productos WHERE IDproducto='$IDproducto'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Editar Productos</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Editar Tabla productos ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


        <div class="productos-form">
        <form action="2Editar_Productos.php" method="POST">
        <font size="6" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
               <tr>
                <td> <input type="hidden" name="IDproducto" value="<?= $row['IDproducto']?>"> </td>

                <td> <label for="Nombre">Nombre:</label>
                <input type="text" name="Nombre" placeholder="Nombre" value="<?= $row['Nombre']?>"> </td>
                <td> <label for="Descripcion">Descripcion:</label>
                 <input type="text" name="Descripcion" placeholder="Descripcion" value="<?= $row['Descripcion']?>"></td>
                </tr>

                <tr> 
                <td> <label for="CodigoBarras">Codigo de Barras:</label>
                 <input type="number" name="CodigoBarras" placeholder="CodigoBarras" value="<?= $row['CodigoBarras']?>"> </td>
                <td> <label for="CostoUnitario">Costo Unitario:</label>
                 <input type="number" name="CostoUnitario" placeholder="CostoUnitario" value="<?= $row['CostoUnitario']?>"> </td>
                <td> <label for="PrecioUnitario">Precio Unitario:</label>
                 <input type="number" name="PrecioUnitario" placeholder="PrecioUnitario" value="<?= $row['PrecioUnitario']?>"> </td>
                </tr>
                
                <tr>
                <td> <label for="StockActual">Stock Actual:</label>
                 <input type="number" name="StockActual" placeholder="StockActual" value="<?= $row['StockActual']?>"> </td>
                <td> <label for="StockMinimo">Stock Minimo:</label> 
                <input type="number" name="StockMinimo" placeholder="StockMinimo" value="<?= $row['StockMinimo']?>"> </td>
                <td>  <label for="IDunidadMedida">ID Unidad de Medida:</label>
                <input type="number" name="IDunidadMedida" placeholder="IDunidadMedida" value="<?= $row['IDunidadMedida']?>"> </td>
                <td> <label for="IDcategoria">ID categoria:</label> 
                <input type="number" name="IDcategoria" placeholder="IDcategoria" value="<?= $row['IDcategoria']?>"> </td>
                </tr>

        </table>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">  
            </form>
        </font>
        </div>
    </body>
</html>
