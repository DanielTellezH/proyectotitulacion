<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    // Código inseguro

    session_start();

    define('DEBUG', true);
    error_reporting(0);

    $_SESSION['Menu'] = 1;

    // Conexión con la base
    include("conexion.php");
    $conn = OpenCon();

    //=====================================================================
    //Inicialización de variables

    $mensajeS = $_SESSION['mensajeS'];
    $mensajeW = $_SESSION['mensajeW'];

    if($mensajeS != ""){
        $v_Mensaje = "success|$mensajeS|SI|20000";
        $_SESSION['mensajeS'] = "";
    }
    if($mensajeW != ""){
        $v_Mensaje = "warning|$mensajeW|SI|20000";
        $_SESSION['mensajeW'] = "";
    }

    $v_hidClave = "";
    $v_Estado   = "";

    $v_Estado       = $_REQUEST['estado_txt'];
    $v_hidClave     = $_REQUEST['hidClave'];
    $v_hidGuardar   = $_REQUEST['hidGuardar'];
    $v_hidModificar = $_REQUEST['hidModificar'];
    $v_hidEliminar  = $_REQUEST['hidEliminar'];

    // ====================================================================
    // Guardar
    if($v_hidGuardar == "SI"){
        if($v_hidClave == ""){
            // Aumentar numero de ID al insertar
            $v_ExisteMax = getCampo("select MAX(edo_id) as SALIDA from ESTADO");
            $var = substr($v_ExisteMax, 1, 2);
            $var = intval($var);
            $var = ($var+1);
            $var = "E".str_pad($var, 2, "0", STR_PAD_LEFT);

            // Insert
            $sqlIN = mysqli_query($conn, "insert into ESTADO(edo_id, estado) values ('$var', '$v_Estado');");

            if($sqlIN != ""){
                $mensaje   = "El registro se guardado correctamente.";
                $v_Mensaje = "success|$mensaje|SI|2000";
            }else{
                $mensaje   = "No se pudo guardar la información.";
                $v_Mensaje = "error|$mensaje|SI|2000";
            }
        }else{
            // Update
            $sqlUP = mysqli_query($conn, "update ESTADO set estado = '$v_Estado' where edo_id = '$v_hidClave'");

            if($sqlUP != ""){
                $mensaje   = "El registro se ha actualizado correctamente.";
                $v_Mensaje = "success|$mensaje|SI|2000";
            }else{
                $mensaje   = "No se pudo actualizar la información.";
                $v_Mensaje = "error|$mensaje|SI|2000";
            }
        }
    }

    // ====================================================================
    // Modificar
    if($v_hidModificar == "SI"){
        $slq = mysqli_query($conn, "select * from ESTADO where edo_id = '$v_hidClave'");
        
        while ($rowMD = mysqli_fetch_assoc($slq)) { 
            $v_Estado    = $rowMD['estado'];
        }
    }

    // ====================================================================
    // Eliminar
    if($v_hidEliminar == "SI"){
        $sqlD = mysqli_query($conn, "delete from ESTADO where edo_id = '$v_hidClave'");

        if($sqlD != ""){
        $mensaje   = "El registro se ha eliminado correctamente.";
        $v_Mensaje = "warning|$mensaje|SI|2000";
        }else{
            $mensaje   = "No se pudo eliminar la información.";
            $v_Mensaje = "error|$mensaje|SI|2000";
        }
        // Se limpian las variables
        $v_hidClave = "";
        $v_Estado   = "";
    }

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
            font-size: 25px;
            align: center;
            color: #3c9eb5;
            background: #3c9eb52b;
        }
        .info-td{
            font-size: 25px;
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
            font-size: 25px;
            font-weight: 600;
        }
        .imput-form{
            font-size: 25px;
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
            font-size: 25px;
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
    <form name="form1" id="form1" method="get" action="Edo.php" onSubmit="return checaCampos();">        
        <input name="hidClave"     type="hidden"  id="hidClave"     value="<?= $v_hidClave ?>">
        <input name="hidGuardar"   type="hidden"  id="hidGuardar"   value="NO">
        <input name="hidModificar" type="hidden"  id="hidModificar" value="NO">
        <input name="hidEliminar"  type="hidden"  id="hidEliminar"  value="NO">

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
                            ESTADOS (CÓDIGO VULNERABLE)
                        </div>
                    </div>
                </div>

                <section class="formulario2" style="margin-bottom: 40px;">
                    <br>
                    <div class="container-data" style="min-height: 130px;">
                        <div>
                            <div class="texto-datos" id="area">
                                <div style="display: flex;">
                                    <div style="padding: 0 75px 0 0;">
                                        <p data-name="estado_txt" class="title-form">Nombre del Estado:</p>
                                        <input type="text" name="estado_txt" id="estado_txt" value="<?= $v_Estado ?>" maxlength="500" class="imput-form" style="width: 410px;">
                                    </div>
                                </div>
                                <br>
                            </div>                
                        </div>
                       
                        <div style="display: flex; padding: 0 598px;">
                            <div style="padding: 0 25px 0 0;">
                                <a class="btn efecto">
                                    <input type="button" class="btn-form" id="btn_guardar" value="Guardar">
                                </a>
                            </div>
                            <div>
                                <a class="btn efecto" style="margin-left: 15px;">
                                    <input type="button" class="btn-form" id="btn_nuevo" value="Nuevo">
                                </a>
                            </div>
                        </div>
                        
                    </div>
                </section>

                <div style="display: flex; padding: 5px 25px;">
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
                            <th class="row_top" width="10%">ID</th>
                            <th class="row_top" width="70%">Nombre del Estado</th>
                            <th class="row_top" width="10%">Modificar</th>
                            <th class="row_top" width="10%">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                            $sql = 'select * from ESTADO order by edo_id';
                            $rst = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($rst)) { ?>
                                <tr> 
                                    <?php
                                    foreach ($row as $key => $item) { ?>
                                        <td class="info-td">
                                            <?= ($item !== null ? $item : "") ?>
                                        </td>
                                        <?php
                                    } ?> 
                                    <td class="btn_modificar info-td">
                                        <i class='bx bx-refresh' style="font-size: 28px;" onclick="modificar('<?= $row['edo_id'] ?>')"></i>
                                    </td>
                                    <td class="btn_eliminar info-td">
                                        <i class='bx bxs-trash' style="font-size: 28px;" onclick="eliminar('<?= $row['edo_id'] ?>')"></i>
                                    </td>
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
            // Boton de Nuevo
            $('#btn_nuevo').click(function (e) { 
                location.href = "Edo.php";
            });

            // Boton de Guardar
            $("#btn_guardar").click(function (e) { 
                var mensaje = "";

                if($('#estado_txt').val() == ""){
                mensaje += "-El Estado debe contener información. <br>"; 
                }

                if(mensaje != ""){
                    Swal.fire({
                        title: 'Alerta',
                        html: mensaje, 
                        icon: 'warning',
                        confirmButtonColor: '#f9a155',
                        confirmButtonText: 'OK',
                        footer: '<p style="color: #999; font-weight: 600; color: #fd7500; text-decoration: underline;">Rellene la información faltante.</p>'
                    });
                }else{
                    $("#hidGuardar").val("SI");
                    document.form1.submit();
                }
            });

            // Buscar 
            $("#buscar").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("table tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
        
        // Modificar
        function modificar(id){
            $("#hidModificar").val("SI");
            $("#hidClave").val(id);
            document.form1.submit();
        }

        // Eliminar
        function eliminar(id){
            Swal.fire({
                title: 'Alerta',
                text: "¿Estás seguro de eliminar este registro?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e03131',
                cancelButtonColor: '#9e9e9e',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if(result.isConfirmed){
                    document.form1.hidEliminar.value = "SI";
                    $("#hidClave").val(id);
                    document.form1.submit();
                }
            });
        }
    </script>
</body>
</html>