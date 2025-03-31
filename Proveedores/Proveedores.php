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

?>
<?php
$con = connection();

$sql = "SELECT * FROM proveedores";
$query = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Proveedores</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Tabla Proveedores ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


    <div class="proveedores-form">
    <center> 
        <font size="6" face="Agency FB"> <h1>Formulario proveedores: </font>
    </center>

    <form action="Agregar_Proveedores.php" method="POST">
            
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="2" width="1000">
            <tr>
            <td> <input type="text" name="NombreProveedor" placeholder="NombreProveedor"> </td>
            <td> <input type="text" name="NombreContacto" placeholder="NombreContacto"> </td>

            </tr>

            <tr>
            <td> <input type="text" name="Telefono" placeholder="Telefono"> </td>
           <td>  <input type="email" name="Correo" placeholder="Correo"> </td>
           <td>  <input type="text" name="Direccion" placeholder="Direccion"> </td>
           
            </tr>

            <tr>
            <td> <input type="text" name="TiempoEntregaPromedio" placeholder="TiempoEntregaPromedio"> </td>
            <td> <label for="CondicionPago"> <font size="5" face="Agency FB"> Condicion de pago:  </font> </label> <select name="CondicionPago">
                    <option value="Creditos">Creditos</option>
                    <option value="Plazos">Plazos</option>
                    <option value="Descuento">Descuento</option>
                </select> </td>
            <td> <label for="Estado"><font size="5" face="Agency FB"> Estado: </font></label> <select name="Estado">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select> </td>
           
            </tr>

        </table>
            <input type="submit" value="Agregar"style="padding: 15px 30px; font-size: 18px;">
    </form>

    </div>

    <div class="proveedores-table">
    <center> <font face="Agency FB"> <h1> Proveedores Registrados: </font> </center>

    <font size="5" face="Agency FB"> 
    <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
         
                <tr>
                    <th>IDproveedor</th>
                    <th>NombreProveedor</th>
                    <th>NombreContacto</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Direccion</th> 
                    <th>TiempoEntregaPromedio</th>
                    <th>CondicionPago</th>
                    <th>Estado</th>

                    <th></th>
                    <th></th>
                </tr>

                <?php while ($row = mysqli_fetch_array($query)): ?>
                    <tr>
                        <td><?= $row['IDproveedor'] ?></td>
                        <td><?= $row['NombreProveedor'] ?></td>
                        <td><?= $row['NombreContacto'] ?></td>
                        <td><?= $row['Telefono'] ?></td>
                        <td><?= $row['Correo'] ?></td>
                        <td><?= $row['Direccion'] ?></td>
                        <td><?= $row['TiempoEntregaPromedio'] ?></td>
                        <td><?= $row['CondicionPago'] ?></td>
                        <td><?= $row['Estado'] ?></td>

                        <th><a href="1Actualizar_Proveedores.php?IDproveedor=<?= $row['IDproveedor'] ?>">Editar</a></th>
                        <th><a href="Eliminar_Proveedores.php?IDproveedor=<?= $row['IDproveedor'] ?>">Eliminar</a></th>
                    </tr>
                <?php endwhile; ?>
        </table>

        </font>
    </div>

    <button onclick="location.href='../Inicio Suministros SA.html'" style="padding: 15px 30px; font-size: 18px;"> Volver al inicio 📍 </button>

</body>

</html>