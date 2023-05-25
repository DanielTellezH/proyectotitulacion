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

    $v_hidClave  = "";
    $v_Edo       = "";
    $v_Alcaldia  = "";
    $v_Colonia   = "";
    $v_Cp        = "";
    $v_Calle     = "";
    $v_NumeroExt = "";

    $v_Edo       = $_REQUEST['estado_lst'];
    $v_Alcaldia  = $_REQUEST['alcaldia_txt'];
    $v_Colonia   = $_REQUEST['colonia_txt'];
    $v_Cp        = $_REQUEST['cp_txt'];
    $v_Calle     = $_REQUEST['calle_txt'];
    $v_NumeroExt = $_REQUEST['numext_txt'];
    
    $v_hidClave     = $_REQUEST['hidClave'];
    $v_hidGuardar   = $_REQUEST['hidGuardar'];
    $v_hidModificar = $_REQUEST['hidModificar'];
    $v_hidEliminar  = $_REQUEST['hidEliminar'];

    // ====================================================================
    // Guardar
    if($v_hidGuardar == "SI"){
        if($v_hidClave == ""){
            // Aumentar numero de ID al insertar
            $v_ExisteMax = getCampo("select MAX(direccion_id) as SALIDA from DIRECCION");
            $var = substr($v_ExisteMax, 1, 4);
            $var = intval($var);
            $var = ($var+1);
            $var = "D".str_pad($var, 4, "0", STR_PAD_LEFT);
            
            // Insert
            $sqlIN = mysqli_query($conn, "insert into DIRECCION(direccion_id, estado_id, alcaldia, colonia, cod_post, calle, num_ext)
                                            values ('$var', '$v_Edo', '$v_Alcaldia', '$v_Colonia', '$v_Cp', '$v_Calle', '$v_NumeroExt');");

            if($sqlIN != ""){
                $mensaje   = "El registro se guardado correctamente.";
                $v_Mensaje = "success|$mensaje|SI|2000";
            }else{
                $mensaje   = "No se pudo guardar la información.";
                $v_Mensaje = "error|$mensaje|SI|2000";
            }
        }else{
            // Update
            $sqlUP = mysqli_query($conn, "update DIRECCION set 
                                            estado_id = '$v_Edo', alcaldia = '$v_Alcaldia', colonia = '$v_Colonia', cod_post = '$v_Cp', calle = '$v_Calle', num_ext = '$v_NumeroExt'
                                            where direccion_id = '$v_hidClave'");

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
        $slq = mysqli_query($conn, "select * from DIRECCION where direccion_id = '$v_hidClave'");
        
        while ($rowMD = mysqli_fetch_assoc($slq)) { 
            $v_Edo       = $rowMD['estado_id'];
            $v_Alcaldia  = $rowMD['alcaldia'];
            $v_Colonia   = $rowMD['colonia'];
            $v_Cp        = $rowMD['cod_post'];
            $v_Calle     = $rowMD['calle'];
            $v_NumeroExt = $rowMD['num_ext'];
        }
    }

    // ====================================================================
    // Eliminar
    if($v_hidEliminar == "SI"){
        $sqlD = mysqli_query($conn, "delete from DIRECCION where direccion_id='$v_hidClave'");

        if($sqlD != ""){
        $mensaje   = "El registro se ha eliminado correctamente.";
        $v_Mensaje = "warning|$mensaje|SI|2000";
        }else{
            $mensaje   = "No se pudo eliminar la información.";
            $v_Mensaje = "error|$mensaje|SI|2000";
        }
        // Se limpian las variables
        $v_hidClave  = "";
        $v_Edo       = "";
        $v_Alcaldia  = "";
        $v_Colonia   = "";
        $v_Cp        = "";
        $v_Calle     = "";
        $v_NumeroExt = "";
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
        .info-td:nth-child(5){
            text-align: center;
        }
        .info-td:nth-child(7){
            text-align: center;
        }
        .info-td:nth-child(-9+10){
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
    <form name="form1" id="form1" method="post" action="Direccion.php" onSubmit="return checaCampos();">        
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
                            DIRECCIONES 
                        </div>
                    </div>
                </div>

                <section class="formulario2" style="margin-bottom: 10px;">
                    <br>
                    <div class="container-data" style="min-height: 270px;">
                        <div>
                            <div class="texto-datos" id="area">
                                <div style="display: flex;">
                                    <div style="padding: 0 65px 0 0;">
                                        <p data-name="estado_lst" class="title-form">Estado:</p>
                                        <div class="box">
                                            <select name="estado_lst" id="estado_lst" class="select-form" onChange="light_Title('estado_lst');" style="width: 220px;">
                                                <option value="" selected>Seleccione una opción</option>
                                                <?php
                                                $sql = mysqli_query($conn, 'select edo_id, estado from ESTADO');
                                                while ($rowE = mysqli_fetch_assoc($sql)){ ?>
                                                    <option value="<?= $rowE['edo_id'] ?>" <?php if($v_Edo == $rowE['edo_id']){ echo "selected"; } ?>>
                                                        <?= $rowE['estado'] ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <p data-name="alcaldia_txt" class="title-form">Alcaldía:</p>
                                        <input type="text" name="alcaldia_txt" id="alcaldia_txt" value="<?= $v_Alcaldia ?>" maxlength="50" class="imput-form" style="width: 430px;">
                                    </div>

                                </div>
                                <br>

                                <div style="display: flex;">
                                    <div style="padding: 0 65px 0 0;">
                                        <p data-name="colonia_txt" class="title-form">Colonia:</p>
                                        <input type="text" name="colonia_txt" id="colonia_txt" value="<?= $v_Colonia ?>" maxlength="30" class="imput-form" style="width: 430px;">
                                    </div>

                                    <div>
                                        <p data-name="calle_txt" class="title-form">Calle:</p>
                                        <input type="text" name="calle_txt" id="calle_txt" value="<?= $v_Calle ?>" maxlength="50" class="imput-form" style="width: 430px;">
                                    </div>
                                </div>

                                <div style="display: flex; margin-bottom: 50px;">
                                    <div style="padding: 0 150px 0 0;">
                                        <p data-name="cp_txt" class="title-form">Codigo Postal:</p>
                                        <input type="text" name="cp_txt" id="cp_txt" value="<?= $v_Cp ?>" maxlength="5" class="imput-form" style="width: 135px;" onkeypress="return isNumber(event)">
                                    </div>
                                    
                                    <div style="padding: 0 150px 0 0;">
                                        <p data-name="numext_txt" class="title-form">Número Exterior:</p>
                                        <input type="text" name="numext_txt" id="numext_txt" value="<?= $v_NumeroExt ?>" maxlength="2" class="imput-form" style="width: 135px;" onkeypress="return isNumber(event)">
                                    </div>
                                </div>
                            </div>                
                        </div>
                    
                        <div style="padding: 0 400px;">
                            <a class="btn efecto" style="margin-left: 15px;">
                                <input type="button" class="btn-form" id="btn_guardar" value="Guardar">
                            </a>
                            <a class="btn efecto" style="margin-left: 15px;">
                                <input type="button" class="btn-form" id="btn_nuevo" value="Nuevo">
                            </a>
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
                            <th class="row_top" width="5%">ID</th>
                            <th class="row_top" width="5%">Estado</th>
                            <th class="row_top" width="15%">Alcaldía</th>
                            <th class="row_top" width="10%">Colonia</th>
                            <th class="row_top" width="5%">C.P.</th>
                            <th class="row_top" width="16%">Calle</th>
                            <th class="row_top" width="5%">Num.Ext.</th>
                            <th class="row_top" width="4%">Modificar</th>
                            <th class="row_top" width="4%">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = 'select * from DIRECCION order by direccion_id';
                        $rst = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($rst)) { ?>
                            <tr> 
                                <?php
                                foreach ($row as $key => $item) {
                                    if($key == "estado_id"){
                                        $item = getCampo("select estado as SALIDA from ESTADO where edo_id='$item'");
                                    }else{
                                        $item = $item;
                                    } ?>
                                    <td class="info-td">
                                        <?= ($item !== null ? $item : "") ?>
                                    </td>
                                    <?php
                                } ?> 
                                <td class="btn_modificar info-td">
                                    <i class='bx bx-refresh' onclick="modificar('<?= $row['direccion_id'] ?>')"></i>
                                </td>
                                <td class="btn_eliminar info-td">
                                    <i class='bx bxs-trash' onclick="eliminar('<?= $row['direccion_id'] ?>')"></i>
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
                location.href = "Direccion.php";
            });

            // Boton de Guardar
            $("#btn_guardar").click(function (e) { 
                var mensaje = "";

                if($('#alcaldia_txt').val() == ""){
                mensaje += "-La Alcaldía debe contener información. <br>"; 
                }
                if($('#colonia_txt').val() == ""){
                mensaje += "-La Colonia debe contener información. <br>"; 
                }
                if($('#cp_txt').val() == ""){
                mensaje += "-El Código Postal debe contener información. <br>"; 
                }
                if($('#calle_txt').val() == ""){
                mensaje += "-La Calle debe contener información. <br>"; 
                }
                if($('#numext_txt').val() == ""){
                mensaje += "-El Número Exterior debe contener información. <br>"; 
                }
                if($('#estado_lst').val() == ""){
                mensaje += "-El estado debe estar seleccionado. <br>"; 
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