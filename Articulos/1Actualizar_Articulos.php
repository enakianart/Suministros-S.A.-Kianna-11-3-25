
<?php 
    include("../conexion/ConexionSuministrosSA.php");
    $con=connection();

    $IDarticulo=$_GET['IDarticulo'];

    $sql="SELECT * FROM articulos WHERE IDarticulo='$IDarticulo'";
    $query=mysqli_query($con, $sql);

    $row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Suministros S.A. Editar Articulos</title>
</head>

<body  bgcolor="#fcb0a0" style="margin: 30px;">

    <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >
        <table border="0" width="1360" height="60" cellpadding="2" bgcolor="white">
            <tr>

                <th rowspan="1"> <font size="100" face="Agency FB"> ~ Editar Tabla articulos ~ <br> Suministros S.A. </font></th>

               

                <th rowspan="1"> <img src="../Hiki feli normal tamanio grandote.png" height="225"/> </th>
    
            </tr>
        </table>

        <hr
        size="5" color="white" width= "1350" align="center" >
    <hr
        size="10" color="white" width= "1350" align="center" >


        <div class="articulos-form">
        <form action="2Editar_Articulos.php" method="POST">
        <font size="6" face="Agency FB">
        <table border="7" bordercolor="white" bgcolor="#fbc7bc" cellpadding="4" width="1000">
               <tr>
                <td> <input type="hidden" name="IDarticulo" value="<?= $row['IDarticulo']?>"> </td>

                <td> <label for="Articulo">Nombre articulo:</label>
                <input type="text" name="Articulo" placeholder="Articulo" value="<?= $row['Articulo']?>"> </td>
                <td> <label for="Costo">Costo:</label>
                 <input type="number" name="Costo" placeholder="Costo" value="<?= $row['Costo']?>"></td>
                 <td> <select name="Estado">
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
