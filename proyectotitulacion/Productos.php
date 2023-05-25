<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();

    define('DEBUG', true);
    error_reporting(0);

    $_SESSION['Menu'] = 2;

    // Conexión con la base
    include("conexion.php");
    $conn = OpenCon();

    //=====================================================================

    function getCampo($sql){
        global $conn;
        $salida = "";

        $stid = mysqli_query($conn, $sql);
        
        while ($row = mysqli_fetch_assoc($stid)){
            $salida = $row['SALIDA'];
        } 
        return $salida;
    }

    ?>

    <!----------------------------------------------->
    <title>Proyecto de titulación</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <script src="assets/js/jquery-3.5.1.min.js"></script>
    <script src="assets/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/gl_alerts.css">
    <script src="assets/js/gl_alerts.js"></script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

    <style>
        .row_top{
            height: 45px;
            align: center;
            color: #3c9eb5;
            background: #3c9eb52b;
        }
        .info-td{
            font-size: 18px;
            color: #363636;
            padding: 6px 0;
            border-bottom: 1px solid #bbbbbb38;
        }
        .info-td:nth-child(1){
            text-align: center;
        }
        .info-td:nth-child(2){
            text-align: center;
        }
        .info-td:nth-child(3){
            text-align: center;
        }
        .info-td:nth-child(4){
            text-align: center;
        }
        .info-td:nth-child(5){
            text-align: center;
        }
        .info-td:nth-child(6){
            text-align: center;
        }
        .info-td:nth-child(7){
            text-align: center;
        }
        .info-td:nth-child(8){
            text-align: center;
        }
        .btn_modificar{
            font-size: 22px;
            text-align: center;
            color: #646464;
            cursor: pointer;
            transition: .1s all;
        }
        .btn_modificar:hover{
            color: #42acc6;
        }
        .btn_eliminar{
            font-size: 22px;
            text-align: center;
            color: #646464;
            cursor: pointer;
            transition: .1s all;
        }
        .btn_eliminar:hover{
            color: #ff7575;
        }
        .formulario2{
            padding: 10px 90px;
        }
        .title-form{
            color: #417885;
            font-size: 16px;
            font-weight: 600;
        }
        .imput-form{
            font-size: 16px;
            padding: 4px;
            border-color: #52e3eb80;
            border-radius: 5px;
        }
        .select-form{
            font-size: 16px;
            padding: 4px;
            width: 240px;
            border-color: #52e3eb80;
            border-radius: 5px;
        }
        .btn-form{
            font-size: 18px;
            color: #276e7e;
            font-weight: 600;
            padding: 4px;
            border-color: #52e3eb80;
            border-radius: 5px;
            background: #bcf0ff;
            cursor: pointer;
        }
        body{
            font-family: "Open Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", Helvetica, Arial, sans-serif; 
        }
    </style>
</head>

<body>
    <form name="form1" id="form1" method="post" action="Productos.php" onSubmit="return checaCampos();">

        <!-- Menú principal -->
        <?php include('Menu_principal.php'); ?>
        
        <div id="gl-alerts"></div>
            <?php
            if($v_Mensaje != ""){
                include('assets/php/gl_alerts.php');
            }  
        ?>
        <section class="body">
            <div class="wrapper-container" style="margin-top: 40px;">
                <div class="placa">
                    <div class="header2">
                        <div class="nombre-sis">
                            PRODUCTOS 
                        </div>
                    </div>
                </div>

                <div style="display: flex; padding: 10px 0 30px 1250px">
                    <input type="text" id="buscar" placeholder="Buscar..." class="imput-form" style="width: 250px;">
                </div>
                
                <div class="placa" style="height: 30px;">
                    <div class="header2">
                        <div class="nombre-sis"> 
                        </div>
                    </div>
                </div>
                <table width="100%" cellspacing="1">
                    <thead>
                        <tr>
                            <th class="row_top" width="2%">ID</th>
                            <th class="row_top" width="12%">Nombre</th>
                            <th class="row_top" width="8%">Categoría</th>
                            <th class="row_top" width="3%">Precio</th>
                            <th class="row_top" width="12%">Descripción</th>
                            <th class="row_top" width="10%">Especificaciones</th>
                            <th class="row_top" width="2%">Año</th>
                            <th class="row_top" width="8%">Fabricante</th>
                            <!-- <th class="row_top" width="4%">Eliminar</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'select * from productos order by producto_id';
                        $rst = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($rst)) { ?>
                            <tr> 
                                <?php
                                foreach ($row as $key => $item) {
                                    if($key == "categoria_id"){
                                        $item = getCampo("select tipo_categoria as SALIDA from categoria where categoria_id='$item'");
                                    }else if($key == "precio"){
                                        $item = "$".$item;
                                    }else if($key == "fabricante_id"){
                                        $item = getCampo("select nombre_fabricante as SALIDA from fabricante where fabricante_id='$item'");
                                    }{
                                        $item = $item;
                                    } ?>
                                    <td class="info-td">
                                        <?= ($item !== null ? $item : "") ?>
                                    </td>
                                    <?php
                                } ?> 
                            </tr>

                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <br><br><br>
        </section>
        <?php
        mysqli_close($conn);
        ?>
	</form>
    <script>
        $(document).ready(function () {
            // Buscar 
            $("#buscar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
</body>
</html>