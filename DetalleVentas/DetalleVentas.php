<?php

function connection(){
    $servername = "localhost";
    $username = "root";
    $password = "lore";
    $database = "SuministrosSA";

    $connect=mysqli_connect($servername, $username, $password);

    mysqli_select_db($connect, $database);

    return $connect;

    echo "Estoy conectado";

}

$con = connection();

$sql_DetalleVentas = "SELECT * FROM DetalleVentas";
$query_DetalleVentas = mysqli_query($con, $sql_DetalleVentas);

$sql_Ventas = "SELECT * FROM Ventas";
$query_Ventas = mysqli_query($con, $sql_Ventas);

$sql_Productos = "SELECT * FROM Productos";
$query_Productos = mysqli_query($con, $sql_Productos);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. DetalleVentas</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Tabla Detalle de Ventas ~ <br> Suministros S.A. </font></th>

                

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


        <div style="display: flex; justify-content: center;">

        <center>
            <font size="5" face="Agency FB"><h1>Ventas:</h1></font>
            <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="500">
                <tr>
                    <th>IDventa</th>
                    <th>FechaVenta</th>
                </tr>
                <?php while ($row_Ventas = mysqli_fetch_array($query_Ventas)): ?>
                    <tr>
                        <td><?= $row_Ventas['IDventa'] ?></td>
                        <td><?= $row_Ventas['FechaVenta'] ?></td>
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
                    <th>CostoUnitario</th>

                </tr>
                <?php while ($row_Productos = mysqli_fetch_array($query_Productos)): ?>
                    <tr>
                        <td><?= $row_Productos['IDproducto'] ?></td>
                        <td><?= $row_Productos['Nombre'] ?></td>
                        <td><?= $row_Productos['CostoUnitario'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </center>
    </div>
<br>


    <div class="DetalleVentas-form">
    <center> 
        <font size="6" face="Agency FB"> <h1>Formulario Detalle de Ventas: </font>
    </center>

    <form action="Agregar_DetalleVentas.php" method="POST">
                
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
            <tr>
            <td> <input type="number" name="IDventa" placeholder="IDventa"> </td>
            <td> <input type="number" name="IDproducto" placeholder="IDproducto"> </td>
            </tr>

            <tr>
            <td> <input type="number" name="Cantidad" placeholder="Cantidad"> </td>
            <td> <input type="number" name="CostoUnitario" placeholder="CostoUnitario"> </td>
            <td> <input type="number" name="Subtotal" placeholder="Subtotal"> </td>
            </tr>

        </table>
                <input type="submit" value="Agregar"style="padding: 15px 30px; font-size: 18px;">
    </form>

    </div>

    <div class="DetalleVentas-table">
    <center> <font face="Agency FB"> <h1> Detalle de Ventas Registradas: </font> </center>

    <font size="5" face="Agency FB"> 
    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
            
            
                <tr>
                    <th>IDdetalleVenta</th>
                    <th>IDventa</th>
                    <th>IDproducto</th>
                    <th>Cantidad</th>
                    <th>CostoUnitario</th> 
                    <th>Subtotal</th>


                    <th></th>
                    <th></th>
                </tr>

                <?php while ($row = mysqli_fetch_array($query_DetalleVentas)): ?>
                    <tr>
                        <td><?= $row['IDdetalleVenta'] ?></td>
                        <td><?= $row['IDventa'] ?></td>
                        <td><?= $row['IDproducto'] ?></td>
                        <td><?= $row['Cantidad'] ?></td>
                        <td><?= $row['CostoUnitario'] ?></td>
                        <td><?= $row['Subtotal'] ?></td>

                        <th><a href="1Actualizar_DetalleVenta.php?IDdetalleVenta=<?= $row['IDdetalleVenta'] ?>">Editar</a></th>
                        <th><a href="Eliminar_DetalleVenta.php?IDdetalleVenta=<?= $row['IDdetalleVenta'] ?>">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
        </table>

        </font>
    </div>

    <button onclick="location.href='../Inicio Suministros SA.html'" style="padding: 15px 30px; font-size: 18px;"> Volver al inicio 📍 </button>


    
</body>

</html>