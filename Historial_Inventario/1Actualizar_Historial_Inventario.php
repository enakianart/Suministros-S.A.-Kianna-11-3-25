
<?php 
    include("../conexion/ConexionSuministrosSA.php");
    $con=connection();

    $IDhistorial_Inventario=$_GET['IDhistorial_Inventario'];

    $sql="SELECT * FROM Historial_Inventario WHERE IDhistorial_Inventario='$IDhistorial_Inventario'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);

    $sql_Compras = "SELECT * FROM Compras";
    $query_Compras = mysqli_query($con, $sql_Compras);
    
    $sql_Productos = "SELECT * FROM Productos";
    $query_Productos = mysqli_query($con, $sql_Productos);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Editar Clientes</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Editar Tabla clientes ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


        <div style="display: flex; justify-content: center;">

<center>
    <font size="5" face="Agency FB"><h1>Compras:</h1></font>
    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
        <tr>
            <th>IDcompra</th>
            <th>FechaCompra</th> 
            <th>EstadoCompra</th> 
            <th>RecepcionProductos</th> 

        </tr>
        <?php while ($row_Compras = mysqli_fetch_array($query_Compras)): ?>
            <tr>
                <td><?= $row_Compras['IDcompra'] ?></td>
                <td><?= $row_Compras['FechaCompra'] ?></td>
                <td><?= $row_Compras['EstadoCompra'] ?></td>
                <td><?= $row_Compras['RecepcionProductos'] ?></td>


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

<br>


        <div class="Historial_Inventario-form">
        <form action="2Editar_Historial_Inventario.php" method="POST">
        <font size="6" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
               <tr>
                <td> <input type="hidden" name="IDhistorial_Inventario" value="<?= $row['IDhistorial_Inventario']?>"> </td>

                <td> <label for="Estado"><font size="5" face="Agency FB"> Estado: </font></label> <select name="Estado">
                <option value="Recibido">Recibido</option>
                <option value="Despachado">Despachado</option>
            </select> </td>

                <td> <label for="Fecha">Fecha:</label>
                 <input type="date" name="Fecha" placeholder="Fecha" value="<?= $row['Fecha']?>"></td>

                 <td> <label for="Descripcion">Descripcion:</label>
                 <input type="text" name="Descripcion" placeholder="Descripcion" value="<?= $row['Descripcion']?>"> </td>
                </tr>

                <tr> 
               
                <td> <label for="IDcompra">IDcompra:</label>
                 <input type="number" name="IDcompra" placeholder="IDcompra" value="<?= $row['IDcompra']?>"> </td>

                <td> <label for="IDproducto">IDproducto:</label>
                 <input type="number" name="IDproducto" placeholder="IDproducto" value="<?= $row['IDproducto']?>"> </td>

                 <td> <label for="Cantidad">Cantidad:</label>
                 <input type="number" name="Cantidad" placeholder="Cantidad" value="<?= $row['Cantidad']?>"> </td>
                </tr>

        </table>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">  
            </form>
        </font>
        </div>
    </body>
</html>
