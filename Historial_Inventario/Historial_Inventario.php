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

$sql_Compras = "SELECT * FROM Compras";
$query_Compras = mysqli_query($con, $sql_Compras);

$sql_Productos = "SELECT * FROM Productos";
$query_Productos = mysqli_query($con, $sql_Productos);

$sql_Historial_Inventario = "SELECT * FROM Historial_Inventario";
$query_Historial_Inventario = mysqli_query($con, $sql_Historial_Inventario);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Historial del Inventario</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Tabla Historial_Inventario ~ <br> Suministros S.A. </font></th>

                

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
    <center> 
        <font size="6" face="Agency FB"> <h1>Formulario Historial del Inventario: </font>
    </center>

    <form action="Agregar_Historial_Inventario.php" method="POST"> 
                
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
            <tr>

            <td> <label for="Estado"><font size="5" face="Agency FB"> Estado: </font></label> <select name="Estado">
                <option value="Recibido">Recibido</option>
                <option value="Despachado">Despachado</option>
            </select> </td>

            <td> <input type="date" name="Fecha" placeholder="Fecha"> </td>
            <td> <input type="text" name="Descripcion" placeholder="Descripcion"> </td>
            </tr>

            <tr>
            <td> <input type="number" name="IDcompra" placeholder="IDcompra"> </td>
            <td> <input type="number" name="IDproducto" placeholder="IDproducto"> </td>
            <td> <input type="number" name="Cantidad" placeholder="Cantidad"> </td>            
            </tr>

        </table>
                <input type="submit" value="Agregar"style="padding: 15px 30px; font-size: 18px;">
    </form>

    </div>

    <div class="Historial_Inventario-table">
    <center> <font face="Agency FB"> <h1> Movimientos Registrados: </font> </center>

    <font size="5" face="Agency FB"> 
    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
            
            
                <tr>
                    <th>IDhistorial_Inventario</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    <th>IDcompra</th> 
                    <th>IDproducto</th> 
                    <th>Cantidad</th>
                 

                    <th></th>
                    <th></th>
                </tr>

                <?php while ($row = mysqli_fetch_array($query_Historial_Inventario)): ?>
                    <tr>
                        <td><?= $row['IDhistorial_Inventario'] ?></td>
                        <td><?= $row['Estado'] ?></td>
                        <td><?= $row['Fecha'] ?></td>
                        <td><?= $row['Descripcion'] ?></td>
                        <td><?= $row['IDcompra'] ?></td>
                        <td><?= $row['IDproducto'] ?></td>
                        <td><?= $row['Cantidad'] ?></td>

                        <th><a href="1Actualizar_Historial_Inventario.php?IDhistorial_Inventario=<?= $row['IDhistorial_Inventario'] ?>">Editar</a></th>
                        <th><a href="Eliminar_Historial_Inventario.php?IDhistorial_Inventario=<?= $row['IDhistorial_Inventario'] ?>">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
        </table>

        </font>
    </div>

    <button onclick="location.href='../Inicio Suministros SA.html'" style="padding: 15px 30px; font-size: 18px;"> Volver al inicio 📍 </button>

</body>

</html>