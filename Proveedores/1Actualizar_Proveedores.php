
<?php 
    include("../conexion/ConexionSuministrosSA.php");
    $con=connection();

    $IDproveedor=$_GET['IDproveedor'];

    $sql="SELECT * FROM proveedores WHERE IDproveedor='$IDproveedor'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Editar Proveedores</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Editar Tabla proveedores ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


        <div class="proveedores-form">
        <form action="2Editar_Proveedores.php" method="POST">
        <font size="6" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
               <tr>
                <td> <input type="hidden" name="IDproveedor" value="<?= $row['IDproveedor']?>"> </td>

                <td> <label for="NombreProveedor">Nombre del proveedor:</label>
                <input type="text" name="NombreProveedor" placeholder="NombreProveedor" value="<?= $row['NombreProveedor']?>"> </td>
                <td> <label for="NombreContacto">Nombre del contacto:</label>
                 <input type="text" name="NombreContacto" placeholder="NombreContacto" value="<?= $row['NombreContacto']?>"></td>
                </tr>

                <tr> 
                <td> <label for="Telefono">Telefono:</label>
                 <input type="text" name="Telefono" placeholder="Telefono" value="<?= $row['Telefono']?>"> </td>
                <td> <label for="Correo">Correo:</label>
                 <input type="email" name="Correo" placeholder="Correo" value="<?= $row['Correo']?>"> </td>
                <td> <label for="Direccion">Direccion:</label>
                 <input type="tetx" name="Direccion" placeholder="Direccion" value="<?= $row['Direccion']?>"> </td>
                </tr>
                
                <tr>
                <td> <label for="TiempoEntregaPromedio">Tiempo de entrega promedio:</label>
                 <input type="text" name="TiempoEntregaPromedio" placeholder="TiempoEntregaPromedio" value="<?= $row['TiempoEntregaPromedio']?>"> </td>
                 <td> <label for="CondicionPago">Condicion de pago:</label> <select name="CondicionPago">
                    <option value="Creditos">Creditos</option>
                    <option value="Plazos">Plazos</option>
                    <option value="Descuento">Descuento</option>
                </select> </td>
                <td> <label for="Estado">Estado:</label> <select name="Estado">
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                </select> </td>
               
                </tr>

        </table>
                <input type="submit" value="Actualizar" style="padding: 15px 30px; font-size: 18px;">  
            </form>
        </font>
        </div>
    </body>
</html>
